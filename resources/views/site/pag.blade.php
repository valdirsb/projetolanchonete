@extends('layouts.site')

@section('title', 'Carrinho')

@section('carrinho', 'class=active')

@section('content')

@component('components.barravoltar')
VOLTAR
@endcomponent

<div class="section-container container-form">
    <header class="cart-pag-header">
        <h1>Pagamento</h1>
        <h2>{{'R$ '.number_format($vtotal, 2, ',', '.')}}</h2>
    </header>
<form method="POST">
    @csrf
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