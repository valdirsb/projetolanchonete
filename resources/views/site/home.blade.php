@extends('layouts.site')

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
        <p>Escolha uma categotia</p>
    </section>
    <section class="categories">
        <ul>
        @foreach($categories as $category)
            <li class="cat-1" style="background: url({{$category->url}}) center;background-size: cover;">
                <a href="#">{{$category->categoria}}</a>
            </li>
        @endforeach
        </ul>
    </section>
</div>
@endsection