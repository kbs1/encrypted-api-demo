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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/demo/{number}/{execute?}', 'ClientController@index')->name('demo');
Route::any('/webapi/demo/{number}', 'Api\ServerController@index')->name('webapi.demo');
Route::any('/webapi-unencrypted/demo/{number}', 'Api\ServerController@index')->name('webapi-unencrypted.demo');
