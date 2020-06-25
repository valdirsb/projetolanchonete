@extends('layouts.site')

@section('title')
    @if($category)
            Cardápio Digital - {{$category->categoria}}
        @else
            Cardápio Digital -Todas as Categorias
    @endif
@endsection

@section('cardapio', 'class=active')

@section('content')

@component('components.barravoltar')
VOLTAR
@endcomponent

<div class="section-container">
    <header style="background: url({{$category?$category->url:'https://media.gazetadopovo.com.br/bomgourmet/2019/09/pastel-de-camarao-10-pasteis-c5f12cc0.jpg'}}) center;background-size: cover;">
        <div  class="div-header">
            <img src="http://192.168.0.106/media/images/logo.jpg" alt="Stickman"  height="125">
            <h1>Cardápio Digital</h1>
        </div>
        
    </header>
    <section class="title">
        @if($category)
            <h1>{{$category->categoria}}</h1>
        @else
            <h1>Todas as Categorias</h1>
        @endif
    </section>
    <section class="productlist">
        @foreach($products as $product)
            <a href="{{route('productdetails',$product->id)}}">
                <div class="card">
                    <div>
                        <h3>{{$product->produto}}</h3>
                        <p>{{$product->descricao}}</p>
                        <h4>R$ {{$product->valor}}</h4>
                    </div>
                    @if($product->imagem)
                        <img src="{{$product->imagem}}" class="img-cover" alt="imagem" >
                    @endif
                </div> 
            </a>
        @endforeach
    
        
    </section>
    

</div>
@endsection