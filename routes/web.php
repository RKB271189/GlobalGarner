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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::group(['middleware' => 'web'], function () {
    Route::namespace('Web\User')->group(function () {
        Route::get('/', 'DashboardController@viewdash')->name('dashboard');
        Route::post('/filter', 'DashboardController@filterproduct')->name('filter');
        Route::get('filter-product/{data}', 'DashboardController@viewfilter')->name('filter-product');
    });
    Route::namespace('Web\Auth')->group(function () {
        Route::get('/login', 'LoginController@view')->name('login');
        Route::post('/verify', 'LoginController@verify')->name('verify-login');
        Route::get('/register', 'LoginController@register')->name('register');
        Route::post('/register-form', 'LoginController@registerform')->name('register-form');
        Route::get('/logout', 'LoginController@logout')->name('logout');
    });
});

Route::group(['middleware' => ['web', 'vendor']], function () {
    Route::namespace('Web\User')->group(function () {
        Route::resource('product', 'ProductController');
    });
});
Route::group(['middleware' => ['web', 'admin']], function () {
    Route::namespace('Web\User')->group(function () {
        Route::resource('products', 'ProductController', ['only' => [
            'index'
        ]]);
    });
});
