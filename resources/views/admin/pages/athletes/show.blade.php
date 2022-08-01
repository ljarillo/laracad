@extends('adminlte::page')

@section('title', "Detalhes do Atleta { $athlete->name }")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('athletes.index') }}">Usuários</a></li>
        <li class="breadcrumb-item"><a href="{{ route('athletes.show', $athlete->id) }}">{{ $athlete->name }}</a></li>
    </ol>

    <h1>Detalhes do Atleta <b>{{ $athlete->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <ul>
                <li><b>Nome:</b> {{ $athlete->name }}</li>
                <li><b>E-mail:</b> {{ $athlete->email }}</li>
                <li><b>Empresa:</b> {{ $athlete->tenant->name }}</li>
            </ul>
        </div>
        <div class="card-footer">
            @include('admin.includes.alerts')

            <form action="{{ route('athletes.destroy', $athlete->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> DELETAR O ATLETA {{ strtoupper($athlete->name) }}</button>
            </form>
        </div>
    </div>
@stop
