<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\User;
use App\Order;
use App\Visitor;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $productsCount = 0 ;
        $clientsCount = 0 ;
        $newOrdersCount = 0 ;
        $onlineCount = 0;

        //Contagem de produtos
        $productsCount = Product::count();
        //Contagem de Clientes Cadastrados
        $clientsCount = User::count();
        //Contagem de Pedidos em Aberto 
        $newOrdersCount = Order::where('status_id', 1)->count();
        //Contagem de usuarios online
        $datelimit = date('Y-m-d H:i:s', strtotime('-5 minutes'));
        $onlineList = Visitor::select('ip')->where('date_access', '>=', $datelimit)->groupBy('ip')->get();
        $onlineCount = count($onlineList);

        

        return view('admin.home', [
            'onlineCount' => $onlineCount,
            'clientsCount' => $clientsCount,
            'productsCount' => $productsCount,
            'newOrdersCount' => $newOrdersCount
        ]);
    }
}
