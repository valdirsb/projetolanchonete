@extends('layouts.site')

@section('title', 'Carrinho')

@section('cadastro', 'class=active')

@section('content')

@component('components.barravoltar')
VOLTAR
@endcomponent

<div class="section-container">
    <header class="cart-header">
        <div  class="div-cart">
            <i class="fas fa-user"></i>
            <h1>Cadastro</h1>
        </div>
    </header>

</div>



@endsection