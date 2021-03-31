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
    Route::get('','AddressUserController@index');
    Route::get('address-active/{user_id}', 'AddressUserController@addressActive');
    Route::put('update/{addressUser}', 'AddressUserController@update');
    Route::post('store', 'AddressUserController@store');
    Route::post('default', 'AddressUserController@default');
    Route::post('permanent', 'AddressUserController@permanent');
    Route::get('delete/{id}', 'AddressUserController@delete');
});

