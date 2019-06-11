<?php

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

Route::get('/home', 'HomeController@index')->name('home');


Route::prefix('admin')->group(function (){
    Route::get('/home', 'Admin\AdminController@index')->name('admin.index');
    Route::get('/register', 'Admin\Auth\RegisterController@showRegistrationForm')->name('admin.register');
    Route::post('/register', 'Admin\Auth\RegisterController@register');
    Route::get('/login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Admin\Auth\LoginController@login')->name('admin.login.submit');
    Route::post('/logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');
});