@extends('layouts.site')

@section('title', 'Cadastrar Endereço')

@section('cadastro', 'class=active')

@section('content')

@component('components.barravoltar')
VOLTAR
@endcomponent



<div class="section-container">

<header class="cart-header">
    <div  class="div-cart">
        <i class="fas fa-user"></i>
        <h1>Cadastro de endereço</h1>
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
          <label for="nome">Bairro:</label>
        </div>
        <div class="col-75">
          <select id="district" name="district">
            @foreach ($districts as $district)
              <option value={{$district->id}}>{{$district->nome}}</option>
            @endforeach
          </select>
        </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="logradouro">Digite seu enderesço:</label>
      </div>
      <div class="col-75">
        <textarea id="subject" name="logradouro" placeholder="Degite seu endereço..." style="height:90px"></textarea>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="numero">Numero:</label>
      </div>
      <div class="col-75">
        <input type="text" name="numero" value="{{old('numero')}}" >
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="cep">Digite seu CEP:</label>
      </div>
      <div class="col-75">
        <input type="text" name="cep" value="{{old('cep')}}" >
      </div>
    </div>
    
    <div class="row">
      <input type="submit" value="Cadastrar">
    </div>
    </form>
  </div>

</div>



@endsection