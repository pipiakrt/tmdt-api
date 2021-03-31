<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
// Route::middleware('auth:sanctum')->group(function () {

    Route::resource('/', 'OrderController');
    Route::get('list', 'OrderController@list');
    Route::post('store', 'OrderController@store');
    Route::get('index', 'OrderController@index');
    Route::get('{id}', 'OrderController@show');
    Route::post('change-status', 'OrderController@changeStatus');
    Route::post('statistical/{booth}', 'OrderController@statistical');
    Route::post('revenue/{booth}', 'OrderController@revenue');
    Route::post('shipper/{id}', 'OrderController@shipper');
// });