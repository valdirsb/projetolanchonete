<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Category;

class ProductController extends Controller
{
    public function index() {
        $products = Product::all();

        return view('site.productlist', ['products'=>$products, 'category'=>[]]);
    }

    // Filtro por Categoria
    public function filterCategory($id){
        $products = Product::where('id_categoria', $id)->where('disponivel', 1)->get();
        $category = Category::find($id);

        return view('site.productlist', ['products'=>$products, 'category'=>$category]);
    }

    //Detalhes do produto
    public function one($id){
        $product = Product::find($id);

        return view('site.pruductdetails', ['product'=>$product]);
    }
}
