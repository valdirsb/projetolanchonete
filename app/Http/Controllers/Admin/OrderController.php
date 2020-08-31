<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\Product;
use App\Category;
use App\Status;
use App\User;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function index(){

        $pedidos = Order::where('status_id', 1)->orWhere('status_id', 2)->orWhere('status_id', 3)->get();
        $statuses = Status::all();

        return view('admin.orders.index', [
            'title' => 'Novos Pedidos',
            'pedidos' => $pedidos,
            'statuses' => $statuses
        ]);
    }

    public function novo(Request $request){
        $clientes = User::all();
        $pruducts = Product::all();

        $cliente = $request->session()->get('client', []);

        $data = $request->session()->get('cart-admin', []);
        $array = $this->cart($data);

        $array['clients'] = $clientes;
        $array['client'] = $cliente;
        $array['products'] = $pruducts;

        return view('admin.orders.new', $array);
    }
    public function add(Request $request) {
        //$request->session()->flush();


        $client_id = $request->input('client_id');
        $client_on = $request->input('client_on');
        $product_id = $request->input('product_id');
        $cart_on = $request->input('cart_on');
        $qt = $request->input('qt');
        $obs = $request->input('obs');

        if($client_on){
            $cliente = User::find($client_id);
            $request->session()->put('client', $cliente );
        }

        if($cart_on){
            $array = [
                'id' => $product_id,
                'qt' => $qt,
                'obs' => $obs
            ];
            $request->session()->push('cart-admin', $array );
        }


        return redirect()->route('painel-order-novo');
    }

    public function del(Request $request, $chave) {
        //$request->session()->flush();

        $carts = $request->session()->get('cart-admin');
        unset($carts[$chave]);
        $request->session()->forget('cart-admin');
        $request->session()->put('cart-admin', $carts);
        return redirect()->back();

    }

    public function productslist(Request $request) {
        //$request->session()->flush();

        $products = Product::all();
        $categories = Category::all();

        return view('admin.orders.products', [
            'products'=> $products,
            'categories' => $categories
        ]);
    }

    public function productslistcat($id) {
        //$request->session()->flush();

        $products = Product::where('id_categoria', $id)->where('disponivel', 1)->get();
        $category = Category::find($id);
        $categories = Category::all();

        return view('admin.orders.products', [
            'products'=> $products,
            'categories' => $categories,
        ]);
    }


    public function entregues(){

        $pedidos = Order::where('status_id', 4)->get();
        $statuses = Status::all();

        return view('admin.orders.index', [
            'title' => 'Pedidos Entregues',
            'pedidos' => $pedidos,
            'statuses' => $statuses
        ]);
    }

    

    public function cancelados(){

        $pedidos = Order::where('status_id', 5)->get();
        $statuses = Status::all();

        return view('admin.orders.index', [
            'title' => 'Pedidos Cancelados',
            'pedidos' => $pedidos,
            'statuses' => $statuses
        ]);
    }

    public function savestatus(Request $request, $id){

        $data = $request->only([
            'status',
        ]);

        $pedido = Order::find($id);

        $pedido->status_id = $data['status'];

        $pedido->save();

        return redirect()->route('painel-order');
    }

    public function print($id){

        $pedido = Order::find($id);

        return view('admin.orders.print', [
            'pedido' => $pedido
        ]);
    }


    protected function cart($data) {
        
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

        return $array;
    }


    public function teste(){
       /*
        $user_id = 1;
        $address_id = 1;
        $produtos = [
            [
                'produto_id' => 26,
                'quantidade' => 2,
                'obs' => 'outro Hamburguer OBS'
            ],
            [
                'produto_id' => 20,
                'quantidade' => 3,
                'obs' => 'outro Pastel de frango com catupiry OBS'
            ],
            [
                'produto_id' => 45,
                'quantidade' => 3,
                'obs' => 'mais um Refrigerante OBS'
            ],
        ];

        $newpedido = new Order();
            $newpedido->user_id = $user_id;
            $newpedido->address_id = $address_id;
            $newpedido->valor = 0;
            $newpedido->save();

        foreach($produtos as $produto){
            $product = Product::find($produto['produto_id']);

            $vtotal = $produto['quantidade']*$product->valor;

            $newpedido->products()->save($product, [
            'quantidade' => $produto['quantidade'],
            'valor_unitario' => $product->valor,
            'valor_total' => $vtotal,
            'obs' => $produto['obs']
            ]);

            $newpedido->valor += $vtotal;
        }

        $newpedido->save();

        echo "ok";
*/
        

        
        /*
        $product = Product::find(16);

        $newpedido = new Order();
            $newpedido->user_id = 1;
            $newpedido->address_id = 1;
            $newpedido->valor = 250;
            $newpedido->status_id = 1;
            $newpedido->save();

            $newpedido->products()->save($product, [
                'quantidade' => 2,
                'valor_unitario' => 1,
                'valor_total' => 1,
                'obs' => 'la la la'
            ]);
        */
        
        //EXIBIR PEDIDOS

        
        $pedido = Order::find(10);

        echo "- itens: <br>";

        foreach ($pedido->products as $product) {
            echo "Produto: ".$product->produto ."<br>" ;
            echo "Descrição: ".$product->descricao ."<br>" ;
            echo "Quantidade: ".$product->pivot->quantidade."<br>" ;
            echo "Valor Unitario: ".$product->pivot->valor_unitario."<br>" ;
            echo "Valor Total: ".$product->pivot->valor_total."<br><br>" ;
        }

        echo "- Valor Total:". $pedido->valor ." <br>";
        echo "- endereço:". $pedido->address_id ." <br>";
        echo "- Status:". $pedido->status_id ." <br>";
        
    
    }
}
