<?php

use App\Http\Controllers\Auth\MyRegisterController;
use Illuminate\Support\Facades\Auth;
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
    return view('layouts.master');
});

Auth::routes();
Route::get('/register', [MyRegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [MyRegisterController::class, 'registering'])->name('registering');
Route::get('/register/google', [MyRegisterController::class, 'registerGoogle'])->name('register.google');
Route::get('google/callback', [MyRegisterController::class, 'handleGoogleCallback'])->name('google.callback');
