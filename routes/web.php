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

Route::namespace('User')->group(function () {
    Route::get('/login', 'LoginController@showLoginForm')->name('user.login');
    Route::post('/login', 'LoginController@login');
    Route::group(['middleware' => ['auth']], function () {
        Route::post('/logout', 'LoginController@logout')->name('user.logout');
    });
    Route::get('/', 'HomeController@index')->name('user.home');
    Route::get('/products/detail/{id}', 'ProductController@detail')->name('products.detail');
});



