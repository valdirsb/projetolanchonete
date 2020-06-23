@extends('layouts.site')

@section('cardapio', 'class=active')

@section('title', $product->produto)

@section('content')

@component('components.barravoltar')
VOLTAR
@endcomponent

<div class="section-container">
    
    <section class="title">
        @if($product->imagem)
            <img src="{{$product->imagem}}" alt="Stickman"  width="250" >
        @else  
            <img src="http://192.168.0.106/media/images/logo.jpg" alt="Stickman"  height="125">
        @endif
        
    </section>
    <div class="card">
        <div>
            <h3>{{$product->produto}}</h3>
            <p>{{$product->descricao}}</p>
            
        </div>
        <h4 class="preco">{{ 'R$ '.number_format($product->valor, 2, ',', '.')}}</h4>
    </div>
    <form id="form" method="POST" action="/cart" class="addtocartform">
        @csrf

        {{-- Adicionais --}}

        <!--
        <div class="card">
            <div>
                <h4 class="h-red">Adicionais</h4>
                
                <div>
                    <input type="checkbox" id="1" name="check1" value="check1">
                    <label for="check1">Batata Frita</label>
                </div>
                <div>
                    <input type="checkbox" id="1" name="check1" value="check1">
                    <label for="check1">carne</label>
                </div>
                <div>
                    <input type="checkbox" id="1" name="check1" value="check1">
                    <label for="check1">verduras</label>
                </div>
                <div>
                    <input type="checkbox" id="1" name="check1" value="check1">
                    <label for="check1">milho e ervilha</label>
                </div>
                <div>
                    <input type="checkbox" id="1" name="check1" value="check1">
                    <label for="check1">catchup</label>
                </div>
                
            </div>
        </div>
        -->

        <div class="card">
            <div class="cardTextarea">
                <h4 class="h-red">Alguma Observação?</h4>
                <textarea name="obs"></textarea>
            </div>
        </div>
        <div class="flex">
            <div class="flex-1"><p>Quantidade:</p></div>
            <div class="flex-1"><p>Valor Total:</p></div>
        </div>
        <div class="flex">
            <div class="flex-1">
                <div class="contador">
                    <button data-action="decrease">-</button>
                    <input type="text" name="qt" value="1" class="addtocart_qt" />
                    <input type="hidden" name="vu" value="{{$product->valor}}" class="valor_unit"  />
                    <input type="hidden" name="id" value="{{$product->id}}" class="valor_unit"  />
                    <button data-action="increase">+</button>
                </div>
            </div>
            <div class="flex-1">
                <p class="valor">{{'R$ '.number_format($product->valor, 2, ',', '.')}}</p>
            </div>
        </div>
        <div class="flex-center">
            <input type="submit" class="botao-carrinho" value="ADICIONAR AO CARRINHO">
        </div>
        

    </form>
    

    
</div>
@endsection