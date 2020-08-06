@extends('adminlte::page')

@section('title', 'Usuarios - Clientes')

@section('content_header')
    <h1>Clientes Cadastrados</h1>
@endsection

@section('content')

<div class="card">
    <div class="card-body">
      <table id="datatable" class="table table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        <form method="POST" action="{{ route('clients.destroy', ['client' => $user->id]) }}" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir?')">
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

<!-- / JS DataTables -->
    
@stop