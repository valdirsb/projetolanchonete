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

<div>
    
  <div class="flex-center">
    <a href="/user/login" class="botao-carrinho" ><i class="fas fa-sign-in-alt"></i>Fazer login</a>
  </div>
  <div class="flex-center">
    <a href="/user/register" class="botao-carrinho" ><i class="fas fa-user-plus"></i>Novo Cadastro</a>
  </div>

{{--
  
  <div class="flex-center">
    <a href="#" class="botao-face" ><i class="fab fa-facebook" style="font-size: 32px"></i>Fazer Login com Facebook</a>
  </div>
  
  --}}
  

</div>

</div>



@endsection