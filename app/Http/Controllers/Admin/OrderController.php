<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\Product;
use App\Status;

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

        // INÍCIO DO CÓDIGO DE IMPRESSÃO DIRETA

        $texto="TEXTO PARA IMPRIMIR"; // texto que será impresso

        $_SESSION['PrintBuffer']="$texto";

        $handle=printer_open("conta"); // impressora configurada no windows

        printer_set_option($handle, PRINTER_MODE, "RAW");

        printer_write($handle, $_SESSION['PrintBuffer']);

        printer_close($handle);
        // FIM DO CÓDIGO DE IMPRESSÃO DIRETA


        return redirect()->route('painel-order');
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
