@extends('layouts.site')

@section('title', 'Carrinho')

@section('content')

@component('components.barravoltar')
VOLTAR
@endcomponent

{{print_r($carts)}}

<br>

@if(Session::has("cart"))
@foreach(Session::get("cart") as $item)
{{$item["id_product"]}}
{{$item["qt"]}} <br>
@endforeach
@endif

@endsection