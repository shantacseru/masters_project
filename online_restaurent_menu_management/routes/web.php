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

Route::get('/',  'WelcomeController@index');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user/profile', 'HomeController@profile')->name('profile');
Route::get('/cart', 'CartController@index')->name('cart');
Route::get('/order-details', 'OrderController@index')->name('order');

Route::post('/confirm-order', 'OrderController@create')->name('confirm-order');
Route::post('/update-user-info', 'HomeController@update_user_info')->name('update-user-info');
