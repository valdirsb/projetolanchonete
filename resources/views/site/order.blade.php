@extends('layouts.site')

@section('title', 'Pedidos')

@section('content')

@component('components.barravoltar')
VOLTAR
@endcomponent



@if (count($orders)>1)
    vc tem muitos Pedidos
@else
   vc tem 1 ou nenhum pedido     
@endif

<div class="section-container">
    <header class="cart-header">
        <div  class="div-cart">
            <i class="fas fa-shopping-cart"></i>
            <h1>Meus Pedidos</h1>
        </div>
    </header>

</div>




@endsection