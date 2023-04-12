<?php

namespace App\Http\Controllers;

use App\Imports\PostsImport;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Maatwebsite\Excel\Facades\Excel;

class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $this->model()->query();
        $query->orderBy('id', 'desc')

            ->with('company:id,name')
            ->with('user:id,name');

        return response()->json($query->paginate(10));
    }

    public function importCSV(Request $request)
    {

        $file = $request->file('csv_file');
        Excel::import(new PostsImport, $file);
        $query = $this->model()->query()
            ->orderBy('id', 'desc')
            ->orderBy('created_at', 'desc')
            ->with('company:id,name')
            ->with('user:id,name')
            ->paginate(10);
        return response()->json($query);
    }
}
