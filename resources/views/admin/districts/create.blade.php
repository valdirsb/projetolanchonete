@extends('adminlte::page')

@section('title', 'Bairros - Cadastrar novo bairro')

@section('content_header')
    <h1> Cadastrar novo Bairro </h1>
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
            <form action="{{ route('districts.store')}}" method="POST" class="form-horizontal">
                @csrf
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nome do Bairro</label>
                    <div class="col-sm-10">
                        <input type="text" name="bairro" value="{{old('bairro')}}" class="form-control @error('bairro') is-invalid @enderror" >
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Valor do Frete</label>
                    <div class="col-sm-10">
                        <input type="text" name="frete" inputmode="numeric" id="money" value="{{old('frete')}}" class="form-control money" >
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

@section('js')
<script>

$(function(){
    
    $('.money').mask('#.##0,00', {reverse: true});
});
</script>

<script type="text/javascript" src="{{asset('assets/js/jquery.mask.min.js')}}"></script>

    
@stop