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



Route::post('register', ('App\Http\Controllers\UserController@register'));
Route::post('login', ('App\Http\Controllers\UserController@login'));

Route::post('addProduct', ('App\Http\Controllers\ProductController@addProduct'));
Route::get('products', ('App\Http\Controllers\ProductController@productList'));
Route::get('delete/{id}', ('App\Http\Controllers\ProductController@deleteProduct'));
Route::get('product/{id}', ('App\Http\Controllers\ProductController@singleProduct'));

Route::post('edit/{id}', ('App\Http\Controllers\ProductController@editProduct'));
Route::get('search/{key}', ('App\Http\Controllers\ProductController@search'));


Route::middleware('auth:sanctum')->group(function () {
   Route::get('user', ('App\Http\Controllers\UserController@user'));
   Route::post('logout', ('App\Http\Controllers\UserController@logout'));
});
