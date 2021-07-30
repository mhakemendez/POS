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



Route::get('/', 'Auth\LoginController@loginshow')->name('loginshow');

Route::get('/admin', 'HomeController@index')->name('admin.home')->middleware('is_admin');

Auth::routes();

Route::get('/cashier', 'HomeController@adminHome')->name('home');

// products routes
Route::get('/product', 'ProductController@index')->name('product.index');
Route::get('/create', 'ProductController@create')->name('product.create');
Route::post('/store', 'ProductController@store')->name('product.store');
Route::get('/delete/{id}', 'ProductController@destroy')->name('product.delete');
Route::get('/edit/{id}', 'ProductController@edit')->name('product.edit');
Route::post('/update/{id}', 'ProductController@update')->name('product.update');
Route::get('/show', 'ProductController@show')->name('product.show');
// products routes

// Users routes
Route::get('/users', 'UserController@index')->name('users.index');
Route::get('/users/create', 'UserController@create')->name('users.create');
Route::post('/users/store', 'UserController@store')->name('users.store');
Route::get('/users/edit/{id}', 'UserController@edit')->name('users.edit');
Route::post('/users/update/{id}', 'UserController@update')->name('users.update');
Route::get('/users/delete/{id}', 'UserController@destroy')->name('users.delete');
// Users routes

// Category routes
Route::get('/category', 'CategoryController@index')->name('category.index');
Route::get('/category/store', 'CategoryController@store')->name('category.store');
// Category routes

// Orders routes
Route::get('/order', 'OrderItemController@index')->name('order.index');
Route::get('/add_order/{id}', 'OrderItemController@create')->name('order.create');
Route::post('/orderupdate/{id}', 'OrderItemController@update')->name('order.update');
Route::get('/orderdelete/{id}', 'OrderItemController@destroy')->name('order.delete');
// Orders routes

// checkout routes
Route::get('/checkout', 'CheckoutController@index')->name('checkout.index');
Route::post('/checkoutstore', 'CheckoutController@store')->name('checkout.store');
Route::get('/showcheckout/{id}', 'CheckoutController@show')->name('checkout.show');
Route::get('/print/{id}', 'CheckoutController@print')->name('checkout.print');
// checkout routes

// Sales routes
Route::get('/sales', 'InvoiceController@index')->name('invoice.index');
// Sales routes

// Customers routes
Route::get('/customers', 'CustomerController@index')->name('customer.index');
// Customers routes



