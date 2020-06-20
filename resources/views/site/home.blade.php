@extends('layouts.site')

@section('title', 'Cardápio Digiral')

@section('content')
<div class="section-container">
    <header class="section-header">
        <div  class="div-header">
            <img src="http://192.168.0.106/media/images/logo.jpg" alt="Stickman"  height="125">
            <h3>Faça seu pedido que eviamos até você!</h3>
        </div>
        
    </header>
    <section class="title">
        <h1>Cardápio Digital</h1>
        <p>Escolha uma categotia</p>
    </section>
    <section class="categories">
        <ul>
        @foreach($front_categories as $category)
            <li class="cat-1" style="background: url({{$category->url}}) center;background-size: cover;">
                <a href="{{route('filterCategory',$category->id)}}">{{$category->categoria}}</a>
            </li>
        @endforeach
        </ul>
    </section>
</div>
@endsection