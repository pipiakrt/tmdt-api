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
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('', 'BoothController@index');
    Route::post('store', 'BoothController@store');
    Route::post('change-image', 'BoothController@changeImage');
    Route::post('update/{id}', 'BoothController@update');
 
});
Route::get('{id}', 'BoothController@show');

