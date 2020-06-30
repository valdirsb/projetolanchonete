@extends('layouts.site')

@section('title', 'Carrinho')

@section('carrinho', 'class=active')

@section('content')

@component('components.barravoltar')
VOLTAR
@endcomponent

<div class="section-container container-form">
    <header class="cart-pag-header">
        <h1>Detalhes do Pedido</h1>
    </header>
    <div>
        <textarea name="" id="" disabled rows="35">
            {{$texto}}
        </textarea>
    </div>
    <a href={{$link}} class="botao-whatsapp" ><i class="fab fa-whatsapp" style="font-size: 30px"></i>Enviar via WhatsApp</a>
</div>





@endsection

