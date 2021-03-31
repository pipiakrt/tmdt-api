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
    Route::get('booth', 'ProductController@booth');
    Route::get('product_of_user/{id}', 'ProductController@productsOfUser');
    Route::post('store', 'ProductController@store');
    Route::post('update', 'ProductController@update');
    Route::post('favourite', 'ProductController@favourite');
    Route::get('delete/{id}', 'ProductController@delete');

});

Route::get('search', 'ProductController@search');

Route::get('relate', 'ProductController@relate');
Route::get('', 'ProductController@index');
Route::get('new', 'ProductController@new');
Route::get('{id}', 'ProductController@show');

