<?php

namespace App\ModelFilters;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Str;

/**
 * @mixin QueryBuilder
 */
abstract class ModelFilter
{

    protected $blacklist = [];
    /**
     * Array of input to filter.
     *
     * @var array
     */
    protected $input;

    /**
     * @var QueryBuilder
     */
    protected $query;

    /**
     * Drop `_id` from the end of input keys when referencing methods.
     *
     * @var bool
     */
    protected $drop_id = true;

    /**
     * Convert input keys to camelCase
     * Ex: my_awesome_key will be converted to myAwesomeKey($value).
     *
     * @var bool
     */
    protected $camel_cased_methods = true;

    /**
     * This is to be able to bypass relations if we are filtering a joined table.
     *
     * @var bool
     */
    protected $relationsEnabled;

    /**
     * Tables already joined in the query to filter by the joined column instead of using
     *  ->whereHas to save a little bit of resources.
     *
     * @var null
     */
    private $_joinedTables;

    /**
     * ModelFilter constructor.
     *
     * @param $query
     * @param  array  $input
     * @param  bool  $relationsEnabled
     */
    public function __construct($query, array $input = [], $relationsEnabled = true)
    {
        $this->query = $query;
        $this->input = $this->removeEmptyInput($input);
        $this->relationsEnabled = $relationsEnabled;
        // $this->registerMacros();
    }

    /**
     * @param $method
     * @param $args
     * @return mixed
     */
    public function __call($method, $args)
    {
        $resp = call_user_func_array([$this->query, $method], $args);

        // Only return $this if query builder is returned
        // We don't want to make actions to the builder unreachable
        return $resp instanceof QueryBuilder ? $this : $resp;
    }

    /**
     * Remove empty strings from the input array.
     *
     * @param  array  $input
     * @return array
     */
    public function removeEmptyInput($input)
    {
        $filterableInput = [];

        foreach ($input as $key => $val) {
            if ($this->includeFilterInput($key, $val)) {
                $filterableInput[$key] = $val;
            }
        }

        return $filterableInput;
    }

    /**
     * Handle all filters.
     *
     * @return QueryBuilder
     */
    public function handle()
    {
        // Filter global methods
        if (method_exists($this, 'setup')) {
            $this->setup();
        }

        // Run input filters
        $this->filterInput();


        return $this->query;
    }

    /**
     * Add a where constraint to a relationship.
     *
     * @param $relation
     * @param $column
     * @param  string|null  $operator
     * @param  string|null  $value
     * @param  string  $boolean
     * @return $this
     */
    public function related($relation, $column, $operator = null, $value = null, $boolean = 'and')
    {
        if ($column instanceof \Closure) {
            return $this->addRelated($relation, $column);
        }

        // If there is no value it is a where = ? query and we set the appropriate params
        if ($value === null) {
            $value = $operator;
            $operator = '=';
        }

        return $this->addRelated($relation, function ($query) use ($column, $operator, $value, $boolean) {
            return $query->where($column, $operator, $value, $boolean);
        });
    }

    /**
     * @param $key
     * @return string
     */
    public function getFilterMethod($key)
    {
        // Remove '.' chars in methodName
        $methodName = str_replace('.', '', $this->drop_id ? preg_replace('/^(.*)_id$/', '$1', $key) : $key);

        // Convert key to camelCase?
        return $this->camel_cased_methods ? Str::camel($methodName) : $methodName;
    }

    /**
     * Filter with input array.
     */
    public function filterInput()
    {
        foreach ($this->input as $key => $val) {
            // Call all local methods on filter
            $method = $this->getFilterMethod($key);

            if ($this->methodIsCallable($method)) {
                $this->{$method}($val);
            }
        }
    }

    /**
     * Filter relationships defined in $this->relations array.
     *
     * @return $this
     */
    public function filterRelations()
    {
        // Verify we can filter by relations and there are relations to filter by
        if ($this->relationsEnabled()) {
            foreach ($this->getAllRelations() as $related => $filterable) {
                // Make sure we have filterable input
                if (count($filterable) > 0) {
                    if ($this->relationIsJoined($related)) {
                        $this->filterJoinedRelation($related);
                    } else {
                        $this->filterUnjoinedRelation($related);
                    }
                }
            }
        }

        return $this;
    }

    /**
     * Get all input to pass through related filters and local closures as an array.
     *
     * @param  string  $relation
     * @return array
     */
    // public function getRelationConstraints($relation)
    // {
    //     return array_key_exists($relation, $this->allRelations) ? $this->allRelations[$relation] : [];
    // }

    /**
     * Call setup method for relation before filtering on it.
     *
     * @param $related
     * @param $query
     */
    public function callRelatedLocalSetup($related, $query)
    {
        if (method_exists($this, $method = Str::camel($related) . 'Setup')) {
            $this->{$method}($query);
        }
    }

    /**
     * Run the filter on models that already have their tables joined.
     *
     * @param $related
     */

    /**
     * Get the model filter of a related model.
     *
     * @param $relation
     * @return mixed
     */
    public function getRelatedFilter($relation)
    {
        return $this->getRelatedModel($relation)->getModelFilterClass();
    }



    /**
     * Check to see if there is input or locally defined methods for the given relation.
     *
     * @param $relation
     * @return bool
     */
    public function relationIsFilterable($relation)
    {
        return $this->relationUsesFilter($relation) || $this->relationIsLocal($relation);
    }

    /**
     * Checks if there is input that should be passed to a related Model Filter.
     *
     * @param $related
     * @return bool
     */
    public function relationUsesFilter($related)
    {
        return count($this->getRelatedFilterInput($related)) > 0;
    }

    /**
     * Checks to see if there are locally defined relations to filter.
     *
     * @param $related
     * @return bool
     */
    public function relationIsLocal($related)
    {
        return count($this->getLocalRelation($related)) > 0;
    }

    /**
     * Retrieve input by key or all input as array.
     *
     * @param  string|null  $key
     * @param  mixed|null  $default
     * @return array|mixed|null
     */
    public function input($key = null, $default = null)
    {

        if ($key === null) {
            return $this->input;
        }

        return array_key_exists($key, $this->input) ? $this->input[$key] : $default;
    }

    /**
     * Disable querying relations (Mainly for joined tables as the related model isn't queried).
     *
     * @return $this
     */
    public function disableRelations()
    {
        $this->relationsEnabled = false;

        return $this;
    }

    /**
     * Enable querying relations.
     *
     * @return $this
     */
    public function enableRelations()
    {
        $this->relationsEnabled = true;

        return $this;
    }

    /**
     * Checks if filtering by relations is enabled.
     *
     * @return bool
     */
    public function relationsEnabled()
    {
        return $this->relationsEnabled;
    }

    /**
     * Add values to filter by if called in setup().
     * Will ONLY filter relations if called on additional method.
     *
     * @param $key
     * @param  null  $value
     */
    public function push($key, $value = null)
    {
        if (is_array($key)) {
            $this->input = array_merge($this->input, $key);
        } else {
            $this->input[$key] = $value;
        }
    }

    /**
     * Method to determine if input should be passed to the filter
     * Returning false will exclude the input from being used in filter logic.
     *
     * @param  mixed  $value
     * @param  string  $key
     * @return bool
     */
    protected function includeFilterInput($key, $value)
    {
        return $value !== '' && $value !== null && !(is_array($value) && empty($value));
    }

    /**
     * Check if the method is not blacklisted and callable on the extended class.
     *
     * @param $method
     * @return bool
     */
    public function methodIsCallable($method)
    {
        return !$this->methodIsBlacklisted($method) &&
            method_exists($this, $method) &&
            !method_exists(ModelFilter::class, $method);
    }

    /**
     * @param $method
     * @return bool
     */
    public function methodIsBlacklisted($method)
    {
        return in_array($method, $this->blacklist, true);
    }
}
