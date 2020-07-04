@extends('adminlte::page')

@section('title', 'Usuarios - Admin')

@section('content_header')
    <h1>
        Usuarios - Admin
        <a href="{{ route('admin.create')}}" class="btn btn-sm btn-success">Novo Usuário</a>
    </h1>
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        <a href="{{ route('admin.edit', ['admin' => $user->id]) }}" class="btn btn-sm btn-info">Editar</a>
                        <a href="{{ route('admin.destroy', ['admin' => $user->id]) }}" class="btn btn-sm btn-danger">Excluir</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

    {{ $users->links() }}

@endsection