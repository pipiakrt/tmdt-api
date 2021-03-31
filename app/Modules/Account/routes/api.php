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

Route::post('reset-password', 'ProfileController@resetPassword');
Route::post('change-password', 'ProfileController@changePasswordToken');
Route::post('check-token', 'ProfileController@checkToken');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('profile', 'ProfileController@index');
    Route::get('profile/{user}', 'ProfileController@show');
    Route::post('change-image', 'ProfileController@changeImage');
    Route::post('update/{id}', 'ProfileController@update');
    Route::post('favourite', 'ProfileController@favourite');

    Route::get('{id}', 'ProfileController@show');
    Route::post('/changePassword','ProfileController@changePassword')->name('changePassword');
});

