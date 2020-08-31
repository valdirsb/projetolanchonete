@extends('adminlte::page')

@section('title', 'Adicionar item')

@section('content_header')
    <h1>Adicionar item</h1>
@endsection

@section('content')


<div class="card">
    
    <div class="card-header">
        <h4>Filtrar</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <a class="btn btn-warning m-1" href="{{ route('painel-order-novo-products') }}">Todos</a> 
            @foreach ($categories as $category)
                <a class="btn btn-warning m-1" href="{{ route('painel-order-novo-productscat', ['id' => $category->id]) }}">{{$category->categoria}}</a> 
            @endforeach
        </div>
    </div>
</div>


<div class="card">
    
    <div class="card-header">
        <h4>Todas</h4>
    </div>
    <div class="card-body">
       <table  id="datatable" class="table table-hover datatable">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Nome</th>
                    <th>Valor</th>
                    <th>Quantidade / OBS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td><a href="#" data-toggle="tooltip" title="{{$product->descricao}}">{{$product->produto}}</a></td>
                        <td>{{$product->valor}}</td>
                        <td>
                            <form method="POST" action="{{ route('painel-order-novo-post')}}" class="d-inline btn-block">
                                @csrf
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <input type="hidden" name="cart_on" value=1>
                                <input name="qt" type="number" min="1" value="1" style="width: 40px">
                                <input type="text" name="obs" style="width: 250px" placeholder="Observação">
                                <input type="submit" class="btn btn-success" value="Adicionar">
                            </form>
                        </td>

                    </tr>
                @endforeach
                
                
            </tbody>
        </table> 
    </div>
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

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>

<!-- / JS DataTables -->
    
@stop