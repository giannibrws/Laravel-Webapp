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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
// Redirect to userController index function:
Route::get('/home', 'UserController@index')->name('home');


// Assign crud routes to userController:
Route::resource('User', 'UserController');
Route::get('/create', 'HomeController@create')->name('create');
Route::get('/edit', 'HomeController@edit')->name('edit');

