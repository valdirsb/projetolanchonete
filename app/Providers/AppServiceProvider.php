<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Category;
use App\Product;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //LISTAR CATEGORIAS
        $categories = Category::all();
        View::share('front_categories', $categories);

        //LISTAR PRODUTOS
        $product = Product::all();
        View::share('front_product', $product);
    }
}
