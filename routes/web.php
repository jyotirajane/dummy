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
Route::get('/users', 'UsersController@index');
Route::get('/ajax/users/json', 'UsersController@loadUsersJSON');
Route::name('addUser')->get('/users/add', 'UsersController@create');
Route::post('/users/add', 'UsersController@store');

Route::get('/orders', 'OrderController@index');
Route::get('/orders/upload', 'OrderController@uploadScreen');
Route::post('/orders/upload', 'OrderController@postUpload');
Route::get('/ajax/orders/json', 'OrderController@loadOrdersJSON');
Route::get('/orders/download', 'OrderController@export_order');
Route::get('/reports/summary_download', 'OrderController@export_summary');
Route::get('/reports/building_summary/download', 'OrderController@export_building_summary');
Route::get('/reports', 'OrderController@reports');
Route::get('/ajax/reports/json', 'OrderController@loadReportsJSON');
