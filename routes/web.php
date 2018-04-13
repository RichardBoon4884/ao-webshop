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

//Routes for shopping cart
Route::get('/shoppingcart', 'ShoppingCartController@index')->name('shoppingCartIndex');
Route::get('/shoppingcart/update/{productId}/{amount?}', 'ShoppingCartController@update')->name('shoppingCartUpdate');

//Routes for products
Route::get('/product', 'ProductController@index')->name('productIndex');
Route::get('/product/{id}/{slug?}', 'ProductController@view')->name('productView');