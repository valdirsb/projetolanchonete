<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Route::get('/', function () {
    return view('welcome');
});
*/

//PAGINA INICIAL

Route::get('/','Site\SiteController@index');

//LISTAR OS PRODUTOS

Route::prefix('/products')->group(function(){
    Route::get('/','Site\ProductController@index');
    Route::get('/category/{id}','Site\ProductController@filterCategory')->name('filterCategory');
});

//DETALHES DO PRODUTO

Route::get('/product/{id}','Site\ProductController@one')->name('productdetails');


//CARRINHO

Route::get('/cart','Site\CartController@index')->name('cart');

Route::post('/cart','Site\CartController@add');




//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
