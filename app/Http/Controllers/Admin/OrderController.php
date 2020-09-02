<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Order;
use App\Product;
use App\Category;
use App\Status;
use App\User;
use App\District;
use App\Address;

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
        $districts = District::all();

        $cliente = $request->session()->get('client', []);

        $data = $request->session()->get('cart-admin', []);
        $array = $this->cart($data);

        $array['clients'] = $clientes;
        $array['client'] = $cliente;
        $array['products'] = $pruducts;
        $array['districts'] = $districts;

        return view('admin.orders.new', $array);
    }

    public function newclient(Request $request){

        $data = $request->only([
            'name',
            'email',
            'phone',
            'district',
            'logradouro',
            'numero',
            'cep'
        ]);

        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['nullable','string', 'email', 'max:200'],
            'phone' => ['required', 'string', 'max:20','unique:users'],
            'district' => ['required', 'max:20'],
            'logradouro' => ['required','string', 'max:200'],
            'numero' => ['required', 'string'],
            'cep' => ['nullable', 'string'],
        ]);

        if($validator->fails()) {
            return redirect()->route('painel-order-novo')
            ->withErrors($validator)
            ->withInput();
        }

        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->phone = $data['phone'];
        $user->password = Hash::make($data['phone']);
        $user->save();

        $newaddress = new Address();
            $newaddress->user_id = $user->id;
            $newaddress->district_id = $data['district'];
            $newaddress->logradouro = $data['logradouro'];
            $newaddress->numero = $data['numero'];
            $newaddress->cep = $data['cep'];
            $newaddress->save();

        $request->session()->put('client', $user );

        return redirect()->route('painel-order-novo');


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

        $products = Product::where('disponivel', 1)->get();
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
            'category' => $category
        ]);
    }

    public function pagok(Request $request) {

        $cartao = $request->input('cartao');
        $dinheiro = $request->input('dinheiro');
        $troco = $request->input('troco');
        $obs = $request->input('obs');
        $entrega = $request->input('entrega');
        $user_id = $request->input('user_id');

        $user = User::find($user_id);

        //inicio do Validator
        $datauser = $request->only([
            'usuario',
            'itens_do_pedido'
        ]);

        $validator = Validator::make($datauser, [
            'usuario' => ['required'],
            'itens_do_pedido' => ['required'],
        ]);

        if($validator->fails()) {
            return redirect()->route('painel-order-novo')
            ->withErrors($validator)
            ->withInput();
        }


        //fim do validator
        

        $data = $request->session()->get('cart-admin', []);
        if($data){
            $array = $this->cart($data);

            $retorno2 = $this->ordersave($user,$cartao,$dinheiro,$troco,$obs,$entrega,$array);
            
            $request->session()->forget(['cart-admin', 'client']);
        } else{
            alert('nenhum item selecionado');
        }

        return redirect()->route('painel-order');

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
