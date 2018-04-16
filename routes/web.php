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

use Illuminate\Support\Facades\Input;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Routes for shopping cart
Route::get('/shoppingcart', 'ShoppingCartController@index')->name('shoppingCartIndex');
Route::get('/shoppingcart/update/{productId}/{amount?}', 'ShoppingCartController@update')->name('shoppingCartUpdate');

// Turn the put request into a get with parameters
Route::put('/shoppingcart/update/{productId}', function (int $productId)
{
    $amount = Input::get('amount');
    return redirect()->route('shoppingCartUpdate', ['productId' => $productId, 'amount' => $amount]);
})->name('shoppingCartUpdatePut');

//Routes for order
Route::get('/shoppingcart/order/confirm', 'OrderController@confirmOrder')->name('orderConfirm');
Route::get('/shoppingcart/order/place', 'OrderController@placeOrder')->name('placeConfirm');
Route::get('/orders/{orderId}', 'OrderController@viewOrder')->name('viewOrder');
Route::get('/orders', 'OrderController@index')->name('orderIndex');

//Routes for products
Route::get('/product', 'ProductController@index')->name('productIndex');
Route::get('/product/{id}/{slug?}', 'ProductController@view')->name('productView');

//Routes for categories
Route::get('/categories', 'CategoryController@index')->name('categoryIndex');
Route::get('/categories/{id}/{slug?}', 'CategoryController@view')->name('categoryView');