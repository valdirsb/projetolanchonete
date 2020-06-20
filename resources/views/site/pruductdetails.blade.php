@extends('layouts.site')

@section('title', $product->produto)

@section('content')
<div class="section-container">
    <header class="section-header">
        <div  class="div-header">
            <img src="https://logo.criativoon.com/wp-content/uploads/2016/07/logotipo-lanchonete.png" alt="Stickman"  height="125">
            <h3>Faça seu pedido que eviamos até você!</h3>
        </div>
        
    </header>
    <section class="tittles">
        <h1>Cardápio Digital</h1>
    </section>
    <section class="categories">
        {{$product->produto}}
    </section>
</div>
@endsection