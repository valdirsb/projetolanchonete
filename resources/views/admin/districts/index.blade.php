@extends('adminlte::page')

@section('title', 'Bairros Cadastrados')

@section('content_header')
    <h1>Bairros Cadastrados</h1><br>
    <a href="{{ route('districts.create')}}" class="btn btn-sm btn-success">Adicionar Bairro</a>
@endsection

@section('content')

<div class="card">
    <div class="card-body">
      <table id="datatable" class="table table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Valor do Frete</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($districts as $district)
                <tr>
                    <td>{{$district->id}}</td>
                    <td>{{$district->nome}}</td>
                    <td>{{$district->frete}}</td>
                    <td>
                        <a href="{{ route('districts.edit', ['district' => $district->id]) }}" class="btn btn-sm btn-info"><i class="fas fa-pencil-alt"></i> Editar</a>
                        
                        <form method="POST" action="{{ route('districts.destroy', ['district' => $district->id]) }}" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Excluir</button>
                        </form>
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