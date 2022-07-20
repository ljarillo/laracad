@extends('adminlte::page')

@section('title', "Detalhes do cargo { $role->name }")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('roles.index') }}" >Cargos</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('roles.show', $role->id) }}" class="active">{{ $role->name }}</a></li>
    </ol>

    <h1>Detalhes do cargo <b>{{ $role->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <ul>
                <li><b>Nome:</b> {{ $role->name }}</li>
                <li><b>Descrição:</b> {{ $role->description }}</li>
            </ul>
        </div>
        <div class="card-footer">
            @include('admin.includes.alerts')

            <form action="{{ route('roles.destroy', $role->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> DELETAR O CARGO {{ strtoupper($role->name) }}</button>
            </form>
        </div>
    </div>
@stop
