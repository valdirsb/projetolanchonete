@extends('adminlte::page')

@section('title', 'Fazer novo Pedido')

@section('content_header')
    <h1>Fazer novo Pedido</h1>
@endsection

@section('content')
<form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
@csrf
<div class="card">
    <div class="card-body">
        
           <h3>Cliente:</h3>
            <div class="form-group row">
                <button type="button" class="btn btn-info m-1"  data-toggle="modal" data-target="#findClient"><i class="fa fa-search"></i> Procurar Cliente</button>
                <button type="button" class="btn btn-info m-1"><i class="fas fa-plus"></i> Novo Cadastro</button>
            </div>

            <div class="form-group row">
                <h5 class="col-sm-2">Nome do Cliente:</h5>
                <div class="col-sm-10">
                    @if ($client)
                        <p>{{$client->name}}</p>
                        <input type="hidden" name="user_id" value="{{$client->id}}">
                    @endif
                    
                </div>
            </div>

            <div class="form-group">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="entrega" value="0" checked="">
                  <label class="form-check-label">retirar no Balcão</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="entrega" value="1" {{isset($client->endereco)?"": "disabled"}}>
                  <label class="form-check-label">Entregar no Endereço:</label>
                </div>
                <p class="bg-gradient-secondary p-1">
                    @if ($client)
                        @if (isset($client->endereco))
                            {{$client->endereco->logradouro}}, {{$client->endereco->district->nome}}
                            <input type="hidden" name="address_id" value="{{$client->endereco->id}}">
                        @else 
                            Endereço ão cadastrado 
                            <button type="button" class="btn btn-info m-1"><i class="fas fa-plus"></i> Cadastrar endereço</button>
                        @endif
                    @endif
                </p>

                @if (isset($client->endereco))
                        <p class="text-danger">Frete: R$ {{$client->endereco->district->frete}}</p>
                        <input type="hidden" name="frete" value="{{$client->endereco->district->frete}}">
                @endif
                
            </div>

            
        
    </div>
</div>

<div class="card">
    <div class="card-body">
        
        <h3>Itens do Pedido:</h3>
        <div class="form-group row">
            <a class="btn btn-info m-1" href="{{ route('painel-order-novo-products') }}"><i class="fa fa-search"></i>Adicionar item</a>
        </div>

        <table class="table table-hover">
            <thead>
            <tr>
                <th></th>
                <th>QT</th>
                <th>Nome</th>
                <th>OBS</th>
                <th>Valor unitario</th>
                <th>Valor Total</th>
            </tr>
            </thead>
            <tbody>
                @if(isset($cartlist))
                    @foreach ($cartlist as $kay=>$item)

                    @php
                        $vitem = $item['qt']*$item['valor'];
                    @endphp
                        <tr>
                            <td><a href="{{asset('painel/orders/novo/del/'.$kay)}}"><i class="fa fa-times text-danger" aria-hidden="true"></a></i></td>
                            <td>{{$item['qt']}}</td>
                            <td>{{$item['produto']}}</td>
                            <td>{{$item['obs']}}</td>
                            <td>{{'R$ '.number_format($item['valor'], 2, ',', '.')}}</td>
                            <td>{{'R$ '.number_format($vitem, 2, ',', '.')}}</td>
                        </tr>
                    @endforeach
                @else 
                    <tr>
                        <td>Sem itens</td>
                    </tr>
                @endif
                
            </tbody>
          </table>  
        
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h3>Pagamento:</h3>
        <div class="form-group">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="cartao">
              <label class="form-check-label">Pagar com cartão</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="dinheiro">
              <label class="form-check-label">Pagar com dinheiro:</label>
            </div>
            <div class="form-group row">
                <div class="col-3">
                    <input type="text" name="troco" class="form-control" placeholder="Troco">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="text-center"><h2>Valor Total: {{'R$ '.number_format($vtotal, 2, ',', '.')}}</h2></div>

<div class="card">
    <div class="card-body">
        <div class="form-group">
            <label>OBS:</label>
            <textarea class="form-control" name="obs" rows="3" placeholder="Enter ..."></textarea>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body text-center">
        <button type="button" class="btn btn-success m-1"><i class="fas fa-plus"></i> Finalizar</button>
    </div>
</div>

<!-- Modal Procurar Clientes -->
<div class="modal fade" id="findClient" tabindex="-1" role="dialog" aria-labelledby="findClientLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="findClientLabel">Procurar Cliente </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <table  id="datatable" class="table table-hover datatable">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>E-mail</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $client)
                        <tr>
                            <td>{{$client->id}}</td>
                            <td>
                                <form method="POST" action="{{ route('painel-order-novo-post')}}" class="d-inline btn-block">
                                    @csrf
                                    <input type="hidden" name="client_id" value="{{$client->id}}">
                                    <input type="hidden" name="client_on" value=1>
                                    <button class="btn btn-sm btn-secondary btn-block">
                                        {{$client->name}}
                                    </button>
                                </form>
                            </td>
                            <td>{{$client->phone}}</td>
                            <td>{{$client->email}}</td>
                        </tr>   
                        @endforeach
                        
                        
                    </tbody>
                  </table> 
                
            </div>
        </div>
    </div>
</div>
<!-- / Modal Procurar Clientes -->

<!-- Modal Procurar Itens do pedido -->
<div class="modal fade" id="findItens" tabindex="-1" role="dialog" aria-labelledby="findItensLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="findItensLabel">Adicionar itens </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe src="{{ route('painel-order-novo-products') }}" name="main" id="main" frameborder="0" width="99%" height="1000" align="left" >Your browser isn't compatible</iframe>
                {{--
                <table  id="datatable" class="table table-hover datatable">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>Nome</th>
                        <th>descrição</th>
                        <th>Valor</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td>
                                <form method="POST"action="{{ route('painel-order-novo-post')}}" class="d-inline btn-block">
                                    @csrf
                                    <input type="hidden" name="client_id" value="{{$product->id}}">
                                    <button class="btn btn-sm btn-secondary btn-block">
                                        {{$product->produto}}
                                    </button>
                                </form>
                            </td>
                            <td>{{$product->descricao}}</td>
                            <td>{{$product->valor}}</td>
                        </tr>   
                        @endforeach
                        
                        
                    </tbody>
                  </table>
                --}}
            </div>
        </div>
    </div>
</div>
<!-- / Modal Procurar Itens do pedido -->

</form>
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


<!-- / JS DataTables -->
    
@stop