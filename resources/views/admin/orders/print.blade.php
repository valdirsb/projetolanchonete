
<pre>
  ======================================
  PEDIDO NÚMERO: {{$pedido->id}}
  Nome: {{$pedido->user->name}}
  ======================================
  =============== PEDIDO ===============

@foreach ($pedido->products as $product)
  {{$product->pivot->quantidade}} {{$product->produto}} ({{$product->pivot->obs}})
  Valor total: R$ {{number_format($product->pivot->valor_total, 2, ',', '.')}}
  *********

@endforeach
  ======== ENDEREÇO DE ENTREGA ========

  {{$pedido->address->logradouro}}, {{$pedido->address->numero}}
  {{$pedido->address->district->nome}}, CEP: {{$pedido->address->cep}}

  ======== VALOR DO FRETE ========
  R$ {{number_format($pedido->frete, 2, ',', '.')}}
  =====================================
  Valor Total:
  R$ {{number_format($pedido->valor, 2, ',', '.')}}
  =====================================
@if ($pedido->cartao)
  Trazer maquinhinha de cartão
@endif
  -------------------------------------
@if ($pedido->dinheiro)
  Pagamento em dinheiro
  Troco para: R$ {{number_format($pedido->troco, 2, ',', '.')}}
@endif
  -------------------------------------
  OBS gerais:
  {{$pedido->obs}}




</pre>

<script type="text/javascript">

        window.print();

 </script>