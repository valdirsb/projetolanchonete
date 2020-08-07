@extends('layouts.site')

@section('title', 'Cadastro')

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
@if($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
@endif
<div class="container-form">
    <form method="POST">
    @csrf
    <div class="row">
        <div class="col-25">
          <label for="nome">Digite seu nome:</label>
        </div>
        <div class="col-75">
            <input type="text" name="name" value="{{old('name')}}" >
        </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="email">Digite seu Telefone:</label>
      </div>
      <div class="col-75">
        <input type="text" name="phone"class="phone" id="phone" value="{{old('phone')}}" >
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="email">Digite seu email:</label>(opcional)
      </div>
      <div class="col-75">
        <input type="email" name="email" value="{{old('email')}}" >
      </div>
    </div>
    <div class="row">
        <div class="col-25">
          <label for="senha">Digite sua senha:</label>
        </div>
        <div class="col-75">
          <input type="password" name="password" >
        </div>
    </div>
    <div class="row">
        <div class="col-25">
          <label for="senha">Confirme sua senha:</label>
        </div>
        <div class="col-75">
          <input type="password" name="password_confirmation">
        </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="subject">Endereço para entrega</label>
      </div>
      <div class="col-75">
        <textarea id="subject" name="address" placeholder="Degite seu endereço..." style="height:150px"></textarea>
      </div>
    </div>
    <div class="row">
      <input type="submit" value="Cadastrar">
    </div>
    </form>
  </div>

</div>



@endsection