@extends('adminlte::page')

@section('title', 'Pedidos')

@section('content_header')
    <h1>{{$title}}</h1>
@endsection

@section('content')

<div class="card">
    <div class="card-body">
      <table id="datatable" class="table">
        <thead>
            <tr>
                <th>Nº do Pedido</th>
                <th>Hora</th>
                <th>Nome do cliente</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pedidos as $pedido)

            @php
                switch ($pedido->status_id) {
                    case '1':
                        $botao2 = 'btn-secondary';
                        $icon2 = 'far fa-clipboard';
                        break;
                    case '2':
                        $botao2 = 'btn-warning';
                        $icon2 = 'fas fa-hamburger';
                        break;
                    case '3':
                        $botao2 = 'btn-info';
                        $icon2 = 'fas fa-motorcycle';
                        break;
                    case '4':
                        $botao2 = 'btn-success';
                        $icon2 = 'fas fa-clipboard-check';
                        break;
                    case '5':
                        $botao2 = 'btn-danger';
                        $icon2 = 'fas fa-window-close';
                        break;
                    
                    default:
                        $botao2 = 'btn-secondary';
                        $icon2 = 'far fa-clipboard';
                        break;
                }
            @endphp
                <tr>
                    <td><a href="#" >{{$pedido->id}}</a>

                        <!-- Modal Detalhes do pedido -->
                        <div class="modal fade" id="detailsModal{{$pedido->id}}" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="detailsModalLabel">Detalhes do Pedido Nº <strong style="color: red">{{$pedido->id}}</strong></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <p><strong>Nome do Cliente:</strong>  {{$pedido->user->name}}</p>
                                        </div>
                                        <div class="row">
                                            <p><strong>Telefone:</strong>  {{$pedido->user->phone}}</p>
                                        </div>
                                        <div class="row">
                                            <strong>Itens:</strong>
                                        </div>
                                        <table style="width:100%">
                                            <tr>
                                                <th>QTD</th>
                                                <th>Produto</th>
                                                <th>Subtotal</th>
                                            </tr>
                                            @foreach ($pedido->products as $product)
                                                <tr>
                                                    <td>{{$product->pivot->quantidade}}</td>
                                                    <td><strong>{{$product->produto}}</strong></td>
                                                    <td class="cart_price">
                                                        <div style="font-size: 18px">
                                                            R$ {{number_format($product->pivot->valor_total, 2, ',', '.')}}
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr style="border-bottom: 1px solid #bbb ">
                                                    <td colspan="4" class="cart_obs" style="border-top: 0; padding:5px "><strong>OBS: </strong>{{$product->pivot->obs}}</td>
                                                </tr>
                                            @endforeach
                                            
                                        </table>
                                        <div class="row">
                                            <strong>Endereço de entrega:</strong>
                                        </div>
                                        <div class="row">
                                            <p>{{$pedido->user->address}}</p>
                                        </div>
                                        <div class="row">
                                            <h5>Valor Total</h5>
                                        </div>
                                        <div class="row">
                                            <p>R$ {{number_format($pedido->valor, 2, ',', '.')}}</p>
                                        </div>

                                        <hr style="margin: 0">
                                        @if ($pedido->cartao)
                                            <div class="row">
                                                <strong> Trazer maquinhinha de cartão </strong>
                                            </div>
                                            <hr style="margin: 0">
                                        @endif
                                        @if ($pedido->dinheiro)
                                            <div class="row">
                                                <strong>Pagamento em dinheiro </strong><br>
                                            </div>
                                            <div class="row">
                                                <p>Troco para: R$ {{number_format($pedido->troco, 2, ',', '.')}}</p> 
                                            </div>
                                            <hr style="margin: 0">
                                        @endif
                                        
                                        
                                        <div class="row">
                                            <h5>OBS Gerais</h5>
                                        </div>
                                        <div class="row">
                                            {{$pedido->obs}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- / Modal Alterar Status -->

                        <!-- Modal Alterar Status -->
                        <div class="modal fade" id="exampleModal{{$pedido->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Alterar Status</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            @foreach ($statuses as $status)

                                            @php
                                            switch ($status->id) {
                                                case '1':
                                                    $botao = 'btn-secondary';
                                                    $icon = 'far fa-clipboard';
                                                    break;
                                                case '2':
                                                    $botao = 'btn-warning';
                                                    $icon = 'fas fa-hamburger';
                                                    break;
                                                case '3':
                                                    $botao = 'btn-info';
                                                    $icon = 'fas fa-motorcycle';
                                                    break;
                                                case '4':
                                                    $botao = 'btn-success';
                                                    $icon = 'fas fa-clipboard-check';
                                                    break;
                                                case '5':
                                                    $botao = 'btn-danger';
                                                    $icon = 'fas fa-window-close';
                                                    break;
                                                
                                                default:
                                                    $botao = 'btn-secondary';
                                                    $icon = 'far fa-clipboard';
                                                    break;
                                            }
                                            @endphp
                                                <form method="POST" action="{{ route('painel-order-status', ['id'=>$pedido->id] )}}" class="d-inline btn-block">
                                                    @method('PUT')
                                                    @csrf
                                                    <input type="hidden" name="status" value={{$status->id}}>
                                                    <button class="btn btn-sm {{$botao}} btn-block">
                                                        <i class="{{$icon}} fa-lg mr-2"></i> {{$status->nome}}
                                                    </button>
                                                </form>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- / Modal Alterar Status -->


                    </td>
                    <td>{{$pedido->created_at}}</td>
                    <td>{{$pedido->user->name}}</td>
                    <td>
                        <button type="button" class="btn btn-sm {{$botao2}} btn-block" data-toggle="modal" data-target="#exampleModal{{$pedido->id}}">
                            <i class="{{$icon2}} fa-lg mr-2"></i>  {{$pedido->status->nome}}
                        </button>
                    </td>
                    <td>
                        <a href="#" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#detailsModal{{$pedido->id}}"><i class="far fa-eye"></i> Visualizar</a>
                        
                        <a href="#" class="btn btn-sm btn-outline-info"><i class="fas fa-print"></i> Imprimir</a>
                    </td>
                </tr>

                
                
            @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
    
</div>

@endsection

@section('css')

<!-- CSS DataTables -->
<link rel="stylesheet" href="{{asset('vendor/datatables/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/datatables/css/responsive.bootstrap4.min.css')}}">
<!-- / CSS DataTables -->
@stop

@section('js')

<!-- JS DataTables -->
<script type="text/javascript" src="{{asset('vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('vendor/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
<script type="text/javascript" src="{{asset('vendor/datatables/js/dataTables.responsive.min.js')}}"></script>
<script type="text/javascript" src="{{asset('vendor/datatables/js/responsive.bootstrap4.min.js')}}"></script>
<script type="text/javascript" src="{{asset('vendor/datatables/js/script.js')}}"></script>
<script type="text/javascript">
    setTimeout(function(){
        location.reload();
    },60000);
 </script>

<!-- / JS DataTables -->
    
@stop