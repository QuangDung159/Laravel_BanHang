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
// Client site
Route::get('/', 'HomeController@index');

Route::get('/home', 'HomeController@index');

// Admin site
Route::get('/admin/home', 'AdminController@index');

Route::get('/admin/dashboard', 'AdminController@showDashboard');
