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
const BRAND_CONTROLLER = 'BrandController@';
const PRODUCT_CONTROLLER = 'ProductController@';
const CART_CONTROLLER = 'CartController@';

// Client site
Route::group(['middleware' => 'cache.client.data'], function () {
    Route::get('/', 'HomeController@index');
    Route::get('/home', 'HomeController@index');

    Route::get('/category/{id}', CATEGORY_CONTROLLER . 'showProductByCategory');
    Route::get('/brand/{id}', BRAND_CONTROLLER . 'showProductByBrand');
    Route::get('/product/{id}', PRODUCT_CONTROLLER . 'showProductDetailPage');
    Route::post('/doAddToCart', CART_CONTROLLER . 'doAddToCart');
    Route::get('/cart', CART_CONTROLLER . 'showCartPage');
});

// Admin site
Route::post('/doLoginAdmin', 'AdminController@doLoginAdmin');
Route::get('/doLogoutAdmin', 'AdminController@doLogoutAdmin');

Route::group(['prefix' => '/admin'], function () {
    // admin
    Route::get('/home', 'AdminController@index');
    Route::get('/dashboard', 'AdminController@showDashboard')->middleware('check.login');

    // category
    Route::group(['prefix' => '/category', 'middleware' => 'check.login'], function () {
        Route::get('/add', CATEGORY_CONTROLLER . 'doShowAddCategoryPage');
        Route::get('/all', CATEGORY_CONTROLLER . 'doShowAllCategoryPage');
        Route::post('/doAddCategory', CATEGORY_CONTROLLER . 'doAddCategory');
        Route::get('/changeStatus', CATEGORY_CONTROLLER . 'changeStatus');
        Route::post('/doEditCategory/{id}', CATEGORY_CONTROLLER . 'doEditCategory');
        Route::get('/edit/{id}', CATEGORY_CONTROLLER . 'showEditCategoryPage');
        Route::get('/delete/{id}', CATEGORY_CONTROLLER . 'deleteCategory');
    });

    // brand
    Route::group(['prefix' => '/brand', 'middleware' => 'check.login'], function () {
        Route::get('/add', BRAND_CONTROLLER . 'doShowAddPage');
        Route::get('/all', BRAND_CONTROLLER . 'doShowAllPage');
        Route::post('/doAdd', BRAND_CONTROLLER . 'doAdd');
        Route::get('/changeStatus', BRAND_CONTROLLER . 'changeStatus');
        Route::post('/doEdit/{id}', BRAND_CONTROLLER . 'doEdit');
        Route::get('/edit/{id}', BRAND_CONTROLLER . 'showEditPage');
        Route::get('/delete/{id}', BRAND_CONTROLLER . 'doDelete');
    });

    // product
    Route::group(['prefix' => '/product', 'middleware' => 'check.login'], function () {
        Route::get('/add', PRODUCT_CONTROLLER . 'doShowAddPage');
        Route::get('/all', PRODUCT_CONTROLLER . 'doShowAllPage');
        Route::post('/doAdd', PRODUCT_CONTROLLER . 'doAdd');
        Route::get('/changeStatus', PRODUCT_CONTROLLER . 'changeStatus');
        Route::post('/doEdit/{id}', PRODUCT_CONTROLLER . 'doEdit');
        Route::get('/edit/{id}', PRODUCT_CONTROLLER . 'showEditPage');
        Route::get('/delete/{id}', PRODUCT_CONTROLLER . 'doDelete');
    });
});
