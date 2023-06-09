<?php

use App\Http\Controllers\TasksController;
use App\Http\Controllers\UrlController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/items', function () {
        return view('items');
    })->name('items');

    Route::get('/tasks', function () {
        return view('tasks');
    })->name('tasks');

    Route::get('/url-shortener', function () {
        return view('url-shortener');
    })->name('url-shortener');

   
});

//Route::resource('url-shortener', UrlController::class);


