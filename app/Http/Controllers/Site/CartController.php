<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;

class CartController extends Controller {
    
    public function index(Request $request) {
        
        $carts =  $request->session()->get('cart', []);
        $array =[];

        foreach($carts as $key => $cart){
            $product = Product::find($cart['id']);

            $array['cartlist'][$key] = [
                'id' => $product->id,
                'produto' => $product->produto,
                'valor' => $product->valor,
                'qt' => $cart['qt'],
                'obs' => $cart['obs'],

            ];
        }

        return view('site.cart', $array );
        
       
    }

    public function add(Request $request) {
        //$request->session()->flush();

        $id = $request->input('id');
        $qt = $request->input('qt');
        $obs = $request->input('obs');

        $array = [
            'id' => $id,
            'qt' => $qt,
            'obs' => $obs
        ];

        $request->session()->push('cart', $array );

        return redirect()->route('cart');
    }

    public function del(Request $request, $chave) {
        //$request->session()->flush();

        $carts = $request->session()->get('cart');
        unset($carts[$chave]);
        $request->session()->forget('cart');
        $request->session()->put('cart', $carts);
        return redirect()->back();

    }

    public function pag(Request $request) {
        
        return view('site.pag');

    }
}
