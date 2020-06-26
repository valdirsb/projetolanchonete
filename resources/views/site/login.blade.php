@extends('layouts.site')

@section('title', 'Login')

@section('cadastro', 'class=active')

@section('content')

@component('components.barravoltar')
VOLTAR
@endcomponent



<div class="section-container">

<header class="cart-header">
    <div  class="div-cart">
        <i class="fas fa-user"></i>
        <h1>Login</h1>
    </div>
</header>
@if(session('warning'))
    <h3 style="text-align: center; color: red">{{session('warning')}}</h3>
@endif
<div class="container-form">
    <form method="POST">
    @csrf
    <div class="row">
      <div class="col-25">
        <label for="email">Digite seu email:</label>
      </div>
      <div class="col-75">
        <input type="email" name="email" >
      </div>
    </div>
    <div class="row">
        <div class="col-25">
          <label for="senha">Digite sua senha:</label>
        </div>
        <div class="col-75">
          <input type="password" name="password">
        </div>
    </div>
    <div class="row">
      <input type="submit" value="Entrar">
    </div>
    </form>
  </div>

</div>



@endsection