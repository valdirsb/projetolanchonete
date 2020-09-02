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
    Route::get('/pag','Site\CartController@pag')->middleware('auth')->middleware('checkaddress');
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

    Route::get('/register-address','Site\AddressController@index')->name('registerAddress');
    Route::post('/register-address','Site\AddressController@register');

    Route::get('/logout','Auth\LoginController@logout')->name('logout');
    
});

//PEDIDOS

Route::get('/order','Site\OrderController@index');



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

    //Perfil

    Route::get('/profile','Admin\ProfileController@index')->name('painel-profile');
    Route::PUT('/profilesave','Admin\ProfileController@save')->name('painel-profile.save');

    //Bairros
    Route::resource('/districts', 'Admin\DistrictController');

    //Usuarios

        //clientes
        Route::resource('users/clients', 'Admin\UserController');
        //Admins
        Route::resource('users/admin', 'Admin\AdminController');

    //Pedidos

        //teste
        Route::get('/teste','Admin\OrderController@teste');
        Route::get('/orders','Admin\OrderController@index')->name('painel-order');
        Route::get('/orders/entregues','Admin\OrderController@entregues');
        Route::get('/orders/cancelados','Admin\OrderController@cancelados');
        Route::PUT('/orders/{id}','Admin\OrderController@savestatus')->name('painel-order-status');
        Route::get('/orders/print/{id}','Admin\OrderController@print')->name('painel-order-print');

        //Criar Pedido
        Route::get('/orders/novo','Admin\OrderController@novo')->name('painel-order-novo');
        Route::post('/orders/novo','Admin\OrderController@add')->name('painel-order-novo-post');
        Route::post('/orders/novo/client','Admin\OrderController@newclient')->name('painel-order-novo-client');
        Route::get('/orders/novo/products','Admin\OrderController@productslist')->name('painel-order-novo-products');
        Route::get('/orders/novo/products/{id}','Admin\OrderController@productslistcat')->name('painel-order-novo-productscat');
        Route::get('/orders/novo/del/{chave}','Admin\OrderController@del');
        Route::post('/orders/novo/add','Admin\OrderController@pagok')->name('painel-order-novo-add');

});



//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
