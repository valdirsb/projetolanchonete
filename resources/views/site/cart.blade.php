@extends('layouts.site')

@section('title', 'Carrinho')

@section('carrinho', 'class=active')

@section('content')

@component('components.barravoltar')
VOLTAR
@endcomponent

<div class="section-container">
    <header class="cart-header">
        <div  class="div-cart">
            <i class="fas fa-shopping-cart"></i>
            <h1>Carrinho de Compras</h1>
        </div>
    </header>


<div class="card cart">
    <table>
        @php
            $vtotal = 0
        @endphp
        @if(isset($cartlist))
            @foreach ($cartlist as $kay=>$item)

            @php
                $vitem = $item['qt']*$item['valor'];
                $vtotal += $vitem;
            @endphp
                <tr>
                    <td><a href="/cart/del/{{$kay}}"><i class="fas fa-times"></i></a></td>
                    <td>{{$item['qt']}}</td>
                    <td><strong>{{$item['produto']}}</strong></td>
                    <td class="cart_price">
                        <div style="font-size: 12px; color: #d6211b">
                            Preço unitário
                        </div>
                        <div style="font-size: 12px ; color:#888">
                            {{'R$ '.number_format($item['valor'], 2, ',', '.')}}
                        </div>
                        <div style="font-size: 12px; color: #d6211b">
                            Preço total
                        </div>
                        <div style="font-size: 18px">
                            {{'R$ '.number_format($vitem, 2, ',', '.')}}
                        </div>
                        
                    </td>
                </tr>
                <tr style="border-bottom: 1px solid #bbb">
                    <td colspan="4" class="cart_obs"><strong>OBS: </strong>{{$item['obs']}}</td>
                </tr>
            @endforeach
        @else
            <tr><td style="text-align: center" class="sem-item">Não há Itens no Carrinho!</td></tr>
        @endif

        <tr>
            <td  colspan="4"  style="text-align: center">
                <a href="/" class="botao-cont" >Continuar Comprando</a>
            </td>
        </tr>
    </table>

    
</div>

<div class="flex">
    <div class="flex-1">
        <p class="cart-val-total">VALOR TOTAL: <span class="valor">{{'R$ '.number_format($vtotal, 2, ',', '.')}}</span></p>
    </div>
</div>

<div class="flex-center">
    <a href="#" class="botao-carrinho" ><i class="fas fa-clipboard-check"></i>FECHAR PEDIDO</a>
</div>

</div>



{{--
<pre>
    {{print_r($cartlist)}}
</pre>


<br>
@foreach ($cartlist as $item)
    {{$item['produto']}} <br>
@endforeach
--}}




@endsection