<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;

class CartController extends Controller
{
    public function index(Request $request) {

        $cart = $request->session()->get('cart');

        

        return view('site.cart', ['carts'=> $cart]);
    }

    public function add(Request $request) {
        //$request->session()->flush();


        $id = $request->input('id');
        $qt = $request->input('qt');
        $obs = $request->input('obs');

        $request->session()->push('cart', [
                'id_product'=> $id,
                'qt'=> $qt,
                'obs'=> $obs,
        ]);
    }
}
