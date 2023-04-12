<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class PostController extends Controller
{
    public function __construct()
    {
        $currentRoute = Route::currentRouteName();
        $explode = explode('.', $currentRoute);
        $ucfirst = array_map('ucfirst', $explode);
        $title = implode(' / ', $ucfirst);

        View::share('title', $title);
        View::share('table', $this->table());
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showDatatable(Request $request)
    {

        $viewData = [];
        $query = $this->model()->query();
        // if ($request->filled('role')) {
        //     $query->where('role', $request->role);
        //     // dd($qury)
        // }
        $viewData['posts'] = $query->orderBy('id', 'desc')
            ->with('company:id,name')
            ->with('company:id,name')
            ->paginate(10)
            ->appends($request->all());
        //set value flash session old .
        session()->flashInput($request->input());

        return view($this->prefix() . 'index')
            ->with('viewData', $viewData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }

    public function prefix()
    {
        return 'admin.posts.';
    }
}
