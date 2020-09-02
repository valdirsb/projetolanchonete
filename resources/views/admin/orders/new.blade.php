@extends('adminlte::page')

@section('title', 'Fazer novo Pedido')

@section('content_header')
    <h1>Fazer novo Pedido</h1>
@endsection

@section('content')
<form action="{{ route('painel-order-novo-add') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
@csrf
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            <h5><i class="icon fas fa-ban"></i> Ocorreu um erro</h5>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="card">
    <div class="card-body">
        
           <h3>Cliente:</h3>
            <div class="form-group row">
                <button type="button" class="btn btn-info m-1"  data-toggle="modal" data-target="#findClient"><i class="fa fa-search"></i> Procurar Cliente</button>
                <button type="button" class="btn btn-info m-1"  data-toggle="modal" data-target="#addClient"><i class="fas fa-plus"></i> Novo Cadastro</button>
            </div>

            <div class="form-group row">
                <h5 class="col-sm-2">Nome do Cliente:</h5>
                <div class="col-sm-10">
                    @if ($client)
                        <p>{{$client->name}}</p>
                        <input type="hidden" name="user_id" value="{{$client->id}}">
                        <input type="hidden" name="usuario" value=1>
                    @endif
                    
                </div>
            </div>

            <div class="form-group">
                <div class="form-check">
                  <input class="form-check-input" type="radio"  onclick=troca1() name="entrega" value="0" checked="">
                  <label class="form-check-label">retirar no Balcão</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" onclick=troca2() name="entrega" value="1" {{isset($client->endereco)?"": "disabled"}}>
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
                        <input type="hidden" id="frete" name="frete" value="{{$client->endereco->district->frete}}">
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
                    <input type="hidden" name="itens_do_pedido" value=1>
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
<div class="text-center"><h2>Valor Total: <span id="valor2">{{'R$ '.number_format($vtotal, 2, ',', '.')}}</span></h2></div>

<input type="hidden" id="valor" name="valor" value="{{$vtotal}}">
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
        <input type="submit" class="btn btn-success m-1" value="FINALIZAR">
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
                        <tr style="display: none">
                            <td>nome</td>
                            <td>
                                <form method="POST" action="{{ route('painel-order-novo-post')}}" class="d-inline btn-block">
                                    @csrf
                                    <input type="hidden" name="client_id" value="0">
                                    <input type="hidden" name="client_on" value=1>
                                    <button class="btn btn-sm btn-secondary btn-block">
                                       teste form
                                    </button>
                                </form>
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
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

<!-- Modal Cadastrar Cliente -->
<div class="modal fade" id="addClient" tabindex="-1" role="dialog" aria-labelledby="addClientLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addClientLabel">Cadastrar Novo Cliente </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('painel-order-novo-client')}}" method="POST" class="form-horizontal">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nome</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">E-mail</label>
                                <div class="col-sm-9">
                                    <input type="email" name="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Telefone</label>
                                <div class="col-sm-9">
                                    <input type="text" name="phone" inputmode="numeric" id="phone"  class="form-control @error('phone') is-invalid @enderror">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Bairro</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="district">
                                        @foreach ($districts as $district)
                                            <option value="{{$district->id}}">{{$district->nome}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Endereço</label>
                                <div class="col-sm-9">
                                    <input type="text" name="logradouro" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Numero</label>
                                <div class="col-sm-3">
                                    <input type="text" name="numero" class="form-control">
                                </div>
                                <label class="col-sm-2 col-form-label">CEP</label>
                                <div class="col-sm-4">
                                    <input type="text" name="cep" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <input type="submit" value="Cadastrar" class="btn btn-success">
                                </div>
                            </div>   
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- / Modal Cadastrar Cliente -->

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

<script>

    function troca1(){
        var numero1 = parseFloat($('#valor').val()) ;
        var texto = numero1.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"});
        
        $('#valor2').text(texto);
    };
        
    function troca2(){
        var numero1 = parseFloat($('#valor').val()) ;
        var numero2 = parseFloat($('#frete').val()) ;
        var soma = numero1+numero2;
        
    
        var texto = soma.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"});
        
        $('#valor2').text(texto);
    };

    $(function(){

    var SPMaskBehavior = function (val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
      },
    spOptions = {
        onKeyPress: function(val, e, field, options) {
            field.mask(SPMaskBehavior.apply({}, arguments), options);
          }
    };
      
    $('#phone').mask(SPMaskBehavior, spOptions);

    });
        
    </script>

<script type="text/javascript" src="{{asset('assets/js/jquery.mask.min.js')}}"></script>
<!-- / JS DataTables -->
    
@stop