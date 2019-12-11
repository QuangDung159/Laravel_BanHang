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

const CATEGORY_CONTROLLER = 'CategoryController@';

// Client site
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

// Admin site
Route::post('/doLoginAdmin', 'AdminController@doLoginAdmin');
Route::get('/doLogoutAdmin', 'AdminController@doLogoutAdmin');

Route::group(['prefix' => '/admin'], function () {
    // admin
    Route::get('/home', 'AdminController@index');
    Route::get('/dashboard', 'AdminController@showDashboard');

    // category
    Route::group(['prefix' => '/category'], function () {
        Route::get('/add', CATEGORY_CONTROLLER . 'doShowAddCategoryPage');
        Route::get('/all', CATEGORY_CONTROLLER . 'doShowAllCategoryPage');
        Route::post('/doAddCategory', CATEGORY_CONTROLLER . 'doAddCategory');
        Route::get('/changeStatus', CATEGORY_CONTROLLER . 'changeStatus');
    });
});
