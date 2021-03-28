<?php

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

Route::view('/', 'index')
    -> name('index');

Route::group(['middleware' => 'auth'], function() {
    Route::view('/dashboard', 'dashboard')
        -> name('dashboard');
    
    Route::resource('/images', App\Http\Controllers\ImageController::class) 
        -> middleware(['verified']);
});

require __DIR__.'/auth.php';
