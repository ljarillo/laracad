@extends('adminlte::page')

@section('title', "Detalhes do usuário { $user->name }")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuários</a></li>
        <li class="breadcrumb-item"><a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a></li>
    </ol>

    <h1>Detalhes do usuário <b>{{ $user->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <ul>
                <li><b>Nome:</b> {{ $user->name }}</li>
                <li><b>E-mail:</b> {{ $user->email }}</li>
                <li><b>Empresa:</b> {{ $user->tenant->name }}</li>
            </ul>
        </div>
        <div class="card-footer">
            @include('admin.includes.alerts')

            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> DELETAR O USUÁRIO {{ strtoupper($user->name) }}</button>
            </form>
        </div>
    </div>
@stop
