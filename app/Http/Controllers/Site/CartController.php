<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Order;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller {
    
    public function index(Request $request) {

        $data = $request->session()->get('cart', []);
        $array = $this->cart($data);

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
        $data = $request->session()->get('cart', []);
        $array = $this->cart($data);

        return view('site.pag', $array );
    }

    public function pagok(Request $request) {

        $user = Auth::user();

        $cartao = $request->input('cartao');
        $dinheiro = $request->input('dinheiro');
        $troco = $request->input('troco');
        $obs = $request->input('obs');
        $entrega = $request->input('entrega');

        $data = $request->session()->get('cart', []);
        $array = $this->cart($data);

        //$retorno = $this->cartenviar($user,$cartao,$dinheiro,$troco,$obs,$array);
        //return view('site.pagok',$retorno );

        $retorno2 = $this->ordersave($user,$cartao,$dinheiro,$troco,$obs,$entrega,$array);
        
        $request->session()->forget('cart');
        
        //return redirect($retorno['link']);
        //return redirect()->route('home');
        return view('site.ordercomp');

    }




    protected function cart($data) {

        $user = Auth::user();
        
        $vtotal = 0;

        foreach($data as $key => $cart){
            $product = Product::find($cart['id']);

            $vitem = $cart['qt']*$product->valor;
            $vtotal += $vitem;

            $array['cartlist'][$key] = [
                'id' => $product->id,
                'produto' => $product->produto,
                'valor' => $product->valor,
                'qt' => $cart['qt'],
                'obs' => $cart['obs'],

            ];
        }

        $array['vtotal'] = $vtotal;
        if($user && isset($user->endereco)){
            $array['frete'] = $user->endereco->district->frete;
            $array['user'] = $user;
        }else{
            $array['frete'] = 0;
        }
        

        return $array;
    }

    protected function cartenviar($user,$cartao,$dinheiro,$troco,$obs,$array) {

$stringCart ='';

foreach($array['cartlist'] as $item){
    $vitem = $item['qt']*$item['valor'];
$stringCart .= $item['qt'].' '.$item['produto'].'('.$item['obs'].')
Valor: R$'.number_format($vitem, 2, ',', '.').'
*********
';
    
}

$texto = '=============================
Novo Pedido Recebido
Nome:'.$user->name.'
=============================
=========== PEDIDO ===========

'.$stringCart.'
==== ENDEREÇO DE ENTREGA ====

'.$user->address.'

=============================
Valor Total:
R$ '.number_format($array['vtotal'], 2, ',', '.').'
=============================
'.$cartao.'
-------------------------------
'.$dinheiro.'
troco para: R$ '.$troco.'
-------------------------------
OBS gerais:
'.$obs.'

CLIQUE EM ENVIAR ===>
';

$textoconvertido = rawurlencode ($texto);


        $array['link'] = 'https://api.whatsapp.com/send?phone=5581984594763&text='.$textoconvertido;
        $array['texto'] = $texto;
        $array['textoconvertido'] = $textoconvertido;


        return $array;

    }

    protected function ordersave($user,$cartao,$dinheiro,$troco,$obs,$entrega,$array){

        $user_id = $user->id;
        $address_id = $user->endereco->id;
        $frete = $user->endereco->district->frete;

        if($cartao){
            $cartao = 1;
        }

        if($dinheiro){
            $dinheiro = 1;
        }


        $newpedido = new Order();
            $newpedido->user_id = $user_id;
            $newpedido->address_id = $address_id;
            if($cartao){
                $newpedido->cartao = 1;
            }
            if($dinheiro){
                $newpedido->dinheiro = 1;
            }
            $newpedido->obs = $obs;
            $newpedido->troco = floatval($troco);
            $newpedido->entrega = $entrega;
            if($entrega==0){
                $newpedido->frete = 0;
                $newpedido->valor = 0;
            }else{
                $newpedido->frete = floatval($frete);
                $newpedido->valor = floatval($frete);
            }
            $newpedido->save();

        foreach($array['cartlist'] as $produto){
            $product = Product::find($produto['id']);

            $vtotal = $produto['qt']*$product->valor;

            $newpedido->products()->save($product, [
            'quantidade' => $produto['qt'],
            'valor_unitario' => $product->valor,
            'valor_total' => $vtotal,
            'obs' => $produto['obs']
            ]);

            $newpedido->valor += $vtotal;
        }

        $newpedido->save();

        return $newpedido;

    }

}
