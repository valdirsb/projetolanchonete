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
Route::get('/products','ProductController@all');
Route::get('/products/category/{id}','ProductController@filterCategory');
Route::get('/product/{id}','ProductController@one');
Route::post('/product','ProductController@new');
Route::put('/product/{id}','ProductController@edit');
Route::delete('/product/{id}','ProductController@delete');

//Rotas de Categorias
Route::get('/category','CategoryController@all');
Route::get('/category/{id}','CategoryController@one');
Route::post('/category','CategoryController@new');
Route::put('/category/{id}','CategoryController@edit');
Route::delete('/category/{id}','CategoryController@delete');

//Rotas de Upload de imagens

Route::post('/imageupload', 'UploadController@imageupload')->name('imageupload');

