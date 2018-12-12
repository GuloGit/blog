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


Route::group(["middleware"=>"auth"], function(){
    Route::get('/admin',"Admin\\Categories@index")->name("admin");
    Route::resource("admin/categories", "Admin\\Categories");
    Route::resource("admin/posts", "Admin\\Posts");
    Route::resource("admin/users", "Admin\\Users")->except(["show"]);
    Route::get("admin/search", 'Admin\Search@index')->name('SearchForm');
    Route::post("admin/search", 'Admin\Search@result')->name('search');
    });


// Authentication Routes...
Route::get('admin/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('admin/login', 'Auth\LoginController@login');
Route::get('admin/logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
Route::get('admin/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('admin/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('admin/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('admin/password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

Route::get('/', 'HomeController@index')->name('home');
