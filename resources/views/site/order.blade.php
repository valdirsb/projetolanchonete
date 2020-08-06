@extends('layouts.site')

@section('title', 'Pedidos')

@section('content')

@component('components.barravoltar')
VOLTAR
@endcomponent

<div class="section-container">
    <header class="cart-header">
        <div  class="div-cart">
            <i class="fas fa-clipboard-check"></i>
            <h1>Meus Pedidos</h1>
        </div>
    </header>
    <section>
        <h3 style="text-align: center; color:red">Acompanhe seu Pedido</h3> 
        <p style="text-align: center">Tempo extimado para entrega 40min</p>
        <div class="card cart">
            <div>
                <table>
                    <tr>
                        <th><h3>Nº</h3></th>
                        <th style="text-align: center"><h3>Status</h3></th>
                        <th style="text-align: center"><h3>Valor</h3></th>
                    </tr> 
                </table>
            </div>
        </div> 
        @foreach ($orders as $order)
            <a href="#">
                <div class="card">
                    <div>
                        <table>
                            <tr>
                                <td>{{$order->id}}</td>
                                <td style="width: 200px ; text-align:center">{{$order->status->nome}}</td>
                                <td>R$ {{$order->valor}}</td>
                            </tr>
                        </table>
                    </div>
                </div> 
            </a>
        @endforeach
    
        
    </section>

    @if (count($orderfinish) > 0)
        
    <section>
        <h3 style="text-align: center; color:red">Pedidos Entregues</h3> 
        <div class="card cart">
            <div>
                <table>
                    <tr>
                        <th><h3>Nº</h3></th>
                        <th style="text-align: center"><h3>Status</h3></th>
                        <th style="text-align: center"><h3>Valor</h3></th>
                    </tr> 
                </table>
            </div>
        </div> 
        @foreach ($orderfinish as $order)
            <a href="#">
                <div class="card">
                    <div>
                        <table>
                            <tr>
                                <td>{{$order->id}}</td>
                                <td style="width: 200px ; text-align:center">{{$order->status->nome}}</td>
                                <td>R$ {{$order->valor}}</td>
                            </tr>
                        </table>
                    </div>
                </div> 
            </a>
        @endforeach
    
        
    </section>


    @endif

    @if (count($ordercancel) > 0)
        
    <section>
        <h3 style="text-align: center; color:red">Pedidos Cancelados</h3> 
        <div class="card cart">
            <div>
                <table>
                    <tr>
                        <th><h3>Nº</h3></th>
                        <th style="text-align: center"><h3>Status</h3></th>
                        <th style="text-align: center"><h3>Valor</h3></th>
                    </tr> 
                </table>
            </div>
        </div> 
        @foreach ($ordercancel as $order)
            <a href="#">
                <div class="card">
                    <div>
                        <table>
                            <tr>
                                <td>{{$order->id}}</td>
                                <td style="width: 200px ; text-align:center">{{$order->status->nome}}</td>
                                <td>R$ {{$order->valor}}</td>
                            </tr>
                        </table>
                    </div>
                </div> 
            </a>
        @endforeach
    
        
    </section>


    @endif

    

</div>




@endsection