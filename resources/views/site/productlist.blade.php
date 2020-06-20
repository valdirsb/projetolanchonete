@extends('layouts.site')

@section('title')
    @if($category)
            Cardápio Digital - {{$category->categoria}}
        @else
            Cardápio Digital -Todas as Categorias
    @endif
@endsection

@section('content')
<div class="section-container">
    <header class="section-header">
        <div  class="div-header">
            <img src="https://logo.criativoon.com/wp-content/uploads/2016/07/logotipo-lanchonete.png" alt="Stickman"  height="125">
            <h3>
            @if($category)
                {{$category->categoria}}
            @else
                Todas as Categorias
            @endif
            </h3>
        </div>
        
    </header>
    <section class="tittles">
        <h1>Cardápio Digital</h1>
        <p>Escolha uma categotia</p>
    </section>
    <section class="categories">
        <ul>
        @foreach($products as $product)
            <li>
                <a href="{{route('productdetails',$product->id)}}">{{$product->produto}}</a>
            </li>
        @endforeach
        </ul>
    </section>
</div>
@endsection