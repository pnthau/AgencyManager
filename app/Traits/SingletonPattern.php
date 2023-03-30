<?php

namespace App\Traits;

trait SingletonPattern
{
    static protected $instance = NULL;
    final protected function __contruct()
    {
    }
    static public function instance()
    {
        if (!static::$instance) {
            static::$instance = new static;
        }
        return static::$instance;
    }
}
