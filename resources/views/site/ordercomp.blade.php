@extends('layouts.site')

@section('title', 'Pedido Finalizado')

@section('content')

@component('components.barravoltar')
VOLTAR
@endcomponent

<div class="section-container">
    <header class="cart-header">
        <div  class="div-cart">
            <i class="fas fa-clipboard-check"></i>
            <h1>Pedido Finalizado com Sucesso!</h1>
        </div>
    </header>
    <section>
        <h3 style="text-align: center; color:red">Acompanhe seu Pedido</h3> 
        <p style="text-align: center">Tempo extimado para entrega 40min</p>
        <div class="card cart">
            <div>
                <div class="flex-center">
                    <a href="/order" class="botao-cont-2" ><i class="fas fa-clipboard-check"></i>ver meus pedidos</a>
                </div>
            </div>
        </div> 
    
        
    </section>

    

    

</div>




@endsection