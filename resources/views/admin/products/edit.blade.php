@extends('adminlte::page')

@section('title', 'Produtos - Editar Produto')

@section('content_header')
    <h1> Editar Produto </h1>
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
            <form action="{{ route('products.update', ['product'=>$product->id])}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nome do Produto</label>
                    <div class="col-sm-10">
                        <input type="text" name="produto" value="{{$product->produto}}" class="form-control @error('produto') is-invalid @enderror" >
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Descrição</label>
                    <div class="col-sm-10">
                        <input type="text" name="descricao" value="{{$product->descricao}}" class="form-control @error('descricao') is-invalid @enderror" >
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Categoria</label>
                    <div class="col-sm-4">
                        <select name="id_categoria" class="form-control">
                            @foreach ($categories as $category)
                                <option value={{$category->id}} {{ $category->id===$product->id_categoria?"selected":"" }} >{{$category->categoria}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Valor</label>
                    <div class="col-sm-4">
                        <input type="text" name="valor" inputmode="numeric" id="money" value="{{$product->valor}}" class="form-control money" >
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Disponivel</label>

                    <div class="col-sm-4 custom-control custom-switch">
                        <input type="checkbox" id="customSwitch1" name="disponivel" class="custom-control-input" {{$product->disponivel?"checked":"" }} >
                        <label for="customSwitch1" class="custom-control-label"></label>
                    </div>

                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Imagem</label>
                    <div class="col-sm-10">
                        <img src="{{asset($product->imagem)}}" id="category-img-tag" alt="" style="width:200px; height:100px; object-fit:cover">
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

    $('.money').mask('#.##0,00', {reverse: true});
});
</script>

<script type="text/javascript" src="{{asset('assets/js/jquery.mask.min.js')}}"></script>

    
@stop