@extends('layouts.site')

@section('title', 'Carrinho')

@section('carrinho', 'class=active')

@section('content')

@component('components.barravoltar')
VOLTAR
@endcomponent

<div class="section-container container-form">
    <header class="cart-pag-header">
        <h1>Total</h1>
        <h2><span id="valor2">{{'R$ '.number_format($vtotal+$frete, 2, ',', '.')}}</span></h2>
    </header>
<form method="POST">
    @csrf
    <div class="card">
        <div>
            <h3>Como vai ser a forma de entrega?</h3>
            <hr>
            <div>
                <input type="radio" name="entrega" value=0  onclick="troca1()">
                <input type="hidden" value="{{number_format($vtotal, 2, ',', '.')}}" id="valor"  />
                <label for="cartão"> Vou retirar no balcão </label>
                <p style="font-size: 18px; color: #FF841C; font-weight: bold ">Frete: R$ 0,00</p>
                <hr>
                <input type="radio" name="entrega" value=1 onclick="troca2()" checked>
                <label for="dinheiro"> Entregue no meu endereço</label><br>
                <p>{{$user->endereco->logradouro}}, {{$user->endereco->numero}}, {{$user->endereco->district->nome}}</p>
                <p style="font-size: 18px; color: #FF841C; font-weight: bold ">Frete: R$ <span id="frete">{{number_format($user->endereco->district->frete, 2, ',', '.')}}</span></p>
            </div>
        </div>
    </div>
    <div class="card">
        <div>
            <h3>Como deseja pagar?</h3>
            <hr>
            <div>
                <input type="checkbox" name="cartao" value="Traga a maquininha de cartão">
                <label for="cartão"> Trazer a maquininha de cartão</label>
                <hr>
                <input type="checkbox" name="dinheiro" value="vou pagar em dinheiro">
                <label for="dinheiro"> Vou pagar em Dinheiro</label><br>
                <input type="text" inputmode="numeric" class="money" id="money" name="troco" placeholder="Troco para" >
            </div>
        </div>
    </div>
    <div class="card">
        <div>
            <h3>Observações Gerais:</h3>
            <hr>
            <div>
                <textarea id="subject" name="obs" placeholder="Alguma Observação?" style="height:80px"></textarea>
                
            </div>
        </div>
    </div>
    <div class="flex-center">
        <input type="submit" value="Finalizar Compra" >
    </div>
</form>

</div>

@endsection

<script type="text/javascript">

    function troca1(){
        var numero1 = parseFloat($('#valor').val()) ;
        var texto = numero1.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"});
        
        $('#valor2').text(texto);
    };
        
    function troca2(){
        var numero1 = parseFloat($('#valor').val()) ;
        var numero2 = parseFloat($('#frete').text()) ;
        var soma = numero1+numero2;
        
    
        var texto = soma.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"});
        
        $('#valor2').text(texto);
    };
        
</script>