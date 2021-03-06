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

Route::namespace('Admin')->group(function () {
    Route::get('/login', 'LoginController@showLoginForm');
    Route::post('/login', 'LoginController@login')->name('admin.login');
    Route::group(['middleware' => ['auth:admin']], function () {
        Route::post('/logout', 'LoginController@logout')->name('logout');
        Route::get('/', 'ProductController@index');
        Route::resource('products', 'ProductController');
        Route::resource('brands', 'BrandController');

        Route::post('product-update/{id}', 'ProductController@update')->name('product-update');
    });
});
