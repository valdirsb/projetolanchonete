@extends('layouts.site')

@section('title', 'Perfil')

@section('cadastro', 'class=active')

@section('content')

@component('components.barravoltar')
VOLTAR
@endcomponent

<div class="section-container">

<header class="cart-header">
    <div  class="div-cart">
        <i class="fas fa-user"></i>
        <h1>Perfil de Usuário</h1>
    </div>
</header>

<div class="card">
  <div>
      <h3>Usuário Logado:</h3>
      <table>
        <tr>
          <td><strong>Nome: </strong></td>
          <td>{{$user->name}}</td>
        </tr>
        <tr>
          <td>Email:</td>
          <td>{{$user->email}}</td>
        </tr>
      </table>
  </div>
</div>

<div class="card">
  <div>
      <h3>Endereço para entrega:</h3>
      <p class="address">
        {{$user->address}}
      </p>
  </div>
</div>

@if ($order)
    <div class="flex-center">
      <a href="/order" class="botao-cont-2" ><i class="fas fa-clipboard-check"></i>ver meus pedidos</a>
    </div>
@endif


<div class="flex-center">
  <a href="/" class="botao-cont-2" ><i class="fas fa-cart-arrow-down"></i>Continuar Comprando</a>
</div>

<div class="flex-center">
  <a href="/cart" class="botao-carrinho" ><i class="fas fa-clipboard-check"></i>CONCLUIR PEDIDO</a>
</div>

<div class="flex-center">
  <a href="/user/logout" class="botao-logout" ><i class="fas fa-sign-out-alt"></i>Logout</a>
</div>


</div>



@endsection