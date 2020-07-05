@extends('adminlte::page')

@section('title', 'Categorias - Adicionar nova Categoria')

@section('content_header')
    <h1> Adicionar nova Categoria </h1>
@endsection

@section('content')

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
            <form action="{{ route('categories.store')}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nome da Categoria</label>
                    <div class="col-sm-10">
                        <input type="text" name="categoria" value="{{old('categoria')}}" class="form-control @error('categoria') is-invalid @enderror" >
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Imagem</label>
                    <div class="custom-file col-sm-6">
                        <input type="file" name="file" id="customFile" class="custom-file-input" >
                        <label class="custom-file-label" for="customFile">Eescolha uma imagem</label>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <input type="submit" value="Cadastrar" class="btn btn-success">
                    </div>
                </div>   
            </form>
        </div>
    </div>

    

@endsection