
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

// redirect to login route: 
Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
// Redirect to userController index function:

// Only authenticated users may access this route...
Route::group(['middleware' => 'auth'], function () {

    Route::get('/', 'UserController@index')->name('home');
    Route::get('/home', 'UserController@index')->name('home');

    // Assign crud routes to userController:
    Route::resource('User', 'UserController');
    Route::resource('User/?', 'HomeController');
    Route::resource('Home', 'HomeController');
    
    Route::get('/create', 'HomeController@create')->name('create');
    Route::get('/edit', 'HomeController@edit')->name('edit');

});
