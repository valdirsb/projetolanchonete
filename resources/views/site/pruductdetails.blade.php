@extends('layouts.site')

@section('title', $product->produto)

@section('content')
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
        <h4 class="preco">R$ {{$product->valor}}</h4>
    </div>
    <form action="">
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
        <div class="card">
            <div class="cardTextarea">
                <h4 class="h-red">Alguma Observação?</h4>
                <textarea name="message"></textarea>
            </div>
        </div>
        <div class="contador">
            <div>-</div>
            <div>1</div>
            <div>+</div>
        </div>
        <div class="flex-center">
            <a href="#" class="botao-carrinho"><i class="fas fa-shopping-cart"></i>ADICIONAR AO CARRINHO</a>
        </div>
        

    </form>
    

    
</div>
@endsection