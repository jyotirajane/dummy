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



Auth::routes();
Route::get('/', 'HomeController@loadBase');
Route::get('/dashboard', 'HomeController@loadBase')->name('home');
Route::get('/users', 'HomeController@loadUsers');
Route::get('/orders', 'OrderController@index');
Route::get('/orders/upload', 'OrderController@uploadScreen');
Route::post('/orders/upload', 'OrderController@postUpload');
Route::get('/ajax/orders/json', 'OrderController@loadOrdersJSON');
