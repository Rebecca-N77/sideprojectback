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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');
Route::get('logout', 'AuthController@logout');
Route::group(['middleware' => 'auth.jwt'], function () {
    

   
});
Route::get('messages', 'MessageController@index');
Route::get('messages/{id}', 'MessageController@show');
Route::post('messages', 'MessageController@store');
Route::put('messages/{id}', 'MessageController@update');
Route::delete('messages/{id}', 'MessageController@destroy');

Route::get('categories', 'CategoryController@index');
Route::get('categories/{id}', 'CategoryController@show');
Route::post('categories', 'CategoryController@store');
Route::put('categories/{id}', 'CategoryController@update');
Route::delete('categories/{id}', 'CategoryController@destroy');

Route::get('items', 'ItemController@index');
Route::get('items/{id}', 'ItemController@show');
Route::post('items', 'ItemController@store');
Route::put('items/{id}', 'ItemController@update');
Route::delete('items/{id}', 'ItemController@destroy');