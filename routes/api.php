<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::any('/demo/100', 'Api\ServerController@demo100');
Route::any('/demo/101', 'Api\ServerController@demo101');
Route::any('/demo/{number}', 'Api\ServerController@index')->name('api.demo');
