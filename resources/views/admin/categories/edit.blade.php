@extends('adminlte::page')

@section('title', 'Editar Categorias')

@section('content_header')
    <h1>Editar Categoria</h1>
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
    <form action="{{ route('categories.update', ['category'=>$category->id] )}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Nome da Categoria</label>
            <div class="col-sm-10">
                <input type="text" name="categoria" value="{{$category->categoria}}" class="form-control @error('categoria') is-invalid @enderror" >
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Imagem Atual</label>
            <div class="col-sm-10">
                <img src="{{asset($category->url)}}" alt="" style="width:200px; height:100px; object-fit:cover">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Alterar Imagem</label>
            
            <div class="custom-file col-sm-6">
                <input type="file" name="file" id="customFile" class="custom-file-input" >
                <label class="custom-file-label" for="customFile">Eescolha uma imagem</label>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Nova Imagem</label>
            <div class="col-sm-10">
                <img src="" id="category-img-tag" style="" />
            </div>
        </div>
        
        <div class="form-group row">
            <label class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10">
                <input type="submit" value="Salvar" class="btn btn-success">
            </div>
        </div>   
    </form>
</div>
</div>


@endsection

@section('js')
<script>

$(function(){

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#category-img-tag').attr('src', e.target.result);
            }
            $('#category-img-tag').attr('style',"width:200px; height:100px; object-fit:cover");
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#customFile").change(function(){
        readURL(this);
    });
});
</script>

    
@stop