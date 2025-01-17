@extends('adminlte::page')

@section('title', 'Painel')

@section('content_header')
    <h1>Dashboard</h1>
@endsection

@section('content')

<div class="row">
    <div class="col-md-3">
        <div class="small-box bg-secondary">
            <div class="inner">
                <h3>{{$onlineCount}}</h3>
                <p>Clientes On-line</p>
            </div>
            <div class="icon">
                <i class="fas fa-fw fa-user"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <a href="painel/users/clients">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$clientsCount}}</h3>
                    <p>Clientes Cadastrados</p>
                </div>
                <div class="icon">
                    <i class="fas fa-fw fa-user-friends"></i>
                </div>
            </div>
        </a>
        
    </div>
    <div class="col-md-3">
        <a href="painel/cardapio/products">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{$productsCount}}</h3>
                    <p>Produtos Cadastrados</p>
                </div>
                <div class="icon">
                    <i class="fas fa-fw fa-utensils"></i>
                </div>
            </div>
        </a>
        
    </div>
    <div class="col-md-3">
        <a href="painel/orders">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$newOrdersCount}}</h3>
                    <p>Novos Pedidos</p>
                </div>
                <div class="icon">
                    <i class="fas fa-fw fa-clipboard-check"></i>
                </div>
            </div>
        </a>
        
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="cart">
            <div class="card-header">
                <h3>Produtos mais vendidos -</h3>

            </div>
        </div>
    </div>
</div>

@endsection

