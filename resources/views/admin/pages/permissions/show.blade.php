@extends('adminlte::page')

@section('title', "Detalhes da permissão { $permission->name }")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('permissions.index') }}" >Permissões</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('permissions.show', $permission->id) }}" class="active">{{ $permission->name }}</a></li>
    </ol>

    <h1>Detalhes da permissão <b>{{ $permission->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <ul>
                <li><b>Nome:</b> {{ $permission->name }}</li>
                <li><b>Descrição:</b> {{ $permission->description }}</li>
            </ul>
        </div>
        <div class="card-footer">
            @include('admin.includes.alerts')

            <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> DELETAR O PERFIL {{ strtoupper($permission->name) }}</button>
            </form>
        </div>
    </div>
@stop
