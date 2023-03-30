<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return "This my route admin";
});

Route::get('/users', [UserController::class, 'showDatatableUsers'])->name('users.index');
Route::get('/users/show', [UserController::class, 'showUserDetail'])->name('users.show');
Route::post('/users/api/search', [UserController::class, 'searchUsers'])->name('users.search');
