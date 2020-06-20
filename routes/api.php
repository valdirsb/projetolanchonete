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

Route::get('/ping', function (Request $request) {
    return ['pong' => true];
});

//Rotas de Produtos
Route::get('/products','Api\ProductController@all')->name('productapi');
Route::get('/products/category/{id}','Api\ProductController@filterCategory');
Route::get('/product/{id}','Api\ProductController@one');
Route::post('/product','Api\ProductController@new');
Route::put('/product/{id}','Api\ProductController@edit');
Route::delete('/product/{id}','Api\ProductController@delete');

//Rotas de Categorias
Route::get('/category','Api\CategoryController@all');
Route::get('/category/{id}','Api\CategoryController@one');
Route::post('/category','Api\CategoryController@new');
Route::put('/category/{id}','Api\CategoryController@edit');
Route::delete('/category/{id}','Api\CategoryController@delete');

//Rotas de Upload de imagens

Route::post('/imageupload', 'UploadController@imageupload')->name('imageupload');

