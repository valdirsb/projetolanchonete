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
Route::get('/','Site\SiteController@index')->name('home');

//LISTAR OS PRODUTOS
Route::prefix('/products')->group(function(){
    Route::get('/','Site\ProductController@index');
    Route::get('/category/{id}','Site\ProductController@filterCategory')->name('filterCategory');
});

//DETALHES DO PRODUTO
Route::get('/product/{id}','Site\ProductController@one')->name('productdetails');

//CARRINHO
Route::prefix('/cart')->group(function(){
    Route::get('/','Site\CartController@index')->name('cart');
    Route::post('/','Site\CartController@add');
    Route::get('/del/{chave}','Site\CartController@del');
    Route::get('/pag','Site\CartController@pag')->middleware('auth');
    Route::post('/pag','Site\CartController@pagok')->middleware('auth');
});

//CADASTRO

Route::prefix('/user')->group(function(){
    Route::get('/','Site\UserController@index')->middleware('auth')->name('perfil');
    Route::get('/options','Site\UserController@loginoptions')->name('options');

    Route::get('/login','Auth\LoginController@index')->name('login');
    Route::post('/login','Auth\LoginController@authenticate');

    Route::get('/register','Auth\RegisterController@index')->name('register');
    Route::post('/register','Auth\RegisterController@register');

    Route::get('/logout','Auth\LoginController@logout')->name('logout');
    
});



//ADMIN

Route::prefix('/painel')->group(function(){
    Route::get('/','Admin\HomeController@index')->name('painel');

    Route::get('/login','Admin\Auth\LoginController@index')->name('painel-login');
    Route::post('/login','Admin\Auth\LoginController@authenticate');

    Route::post('/logout','Admin\Auth\LoginController@logout')->name('painel-logout');

    Route::get('/register','Admin\Auth\RegisterController@index')->name('painel-register');
    Route::post('/register','Admin\Auth\RegisterController@register');
    
    //cardapio
    Route::resource('cardapio/products', 'Admin\ProductController');
    Route::resource('cardapio/categories', 'Admin\CategoryController');

    //Usuarios

        //clientes
        Route::resource('users/clients', 'Admin\UserController');
        //Admins
        Route::resource('users/admin', 'Admin\AdminController');


});



//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
