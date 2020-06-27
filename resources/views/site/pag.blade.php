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
        <h2>R$ 50,00</h2>
    </header>
    
    <div class="card">
        <div>
            <h3>Como deseja pagar?</h3>
            <hr>
            <form>
                <input type="checkbox" name="cartão" value="Car">
                <label for="cartão"> Trazer a maquininha de cartão</label>
                <hr>
                <input type="checkbox" name="dinheiro" value="Bike">
                <label for="dinheiro"> Vou pagar em Dinheiro</label><br>
                <input type="number" name="troco" placeholder="Troco para">
            </form>
        </div>
    </div>

    <div class="card">
        <div>
            <h3>Observações Gerais:</h3>
            <hr>
            <form>
                <textarea id="subject" name="obs" placeholder="Alguma Observação?" style="height:80px"></textarea>
                
              </form>
        </div>
    </div>
    <div class="flex-center">
        <a href="#" class="botao-carrinho" ><i class="fas fa-clipboard-check"></i>CONCLUIR PEDIDO</a>
    </div>

</div>











@endsection