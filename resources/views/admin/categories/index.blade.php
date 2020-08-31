@extends('adminlte::page')

@section('title', 'Categorias')

@section('content_header')
    <h1>Cardapio - Categorias</h1><br>
    <a href="{{ route('categories.create')}}" class="btn btn-sm btn-success">Adicionar Categoria</a>
@endsection

@section('content')


  <div class="card">
    <div class="card-body">
      <table class="table table-hover datatable">
        <thead>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Imagem</th>
          <th>Ações</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->categoria}}</td>
                    <td>
                        <img src="{{$category->url}}" style="width:100px; height:50px; object-fit:cover" alt="">
                    </td>
                    <td>
                        <a href="{{ route('categories.edit', ['category' => $category->id]) }}" class="btn btn-sm btn-info"><i class="fas fa-pencil-alt"></i> Editar</a>
                        
                        <form method="POST" action="{{ route('categories.destroy', ['category' => $category->id]) }}" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir?')">
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