@extends('adminlte::page')

@section('title', "Detalhes da mesa { $table->identify }")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('tables.index') }}">Mesas</a></li>
        <li class="breadcrumb-item"><a href="{{ route('tables.show', $table->id) }}">{{ $table->identify }}</a></li>
    </ol>

    <h1>Detalhes da mesa <b>{{ $table->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <ul>
                <li><b>Identificação:</b> {{ $table->identify }}</li>
                <li><b>Descrição:</b> {{ $table->description }}</li>
                <li><b>Empresa:</b> {{ $table->tenant->name }}</li>
            </ul>
        </div>
        <div class="card-footer">
            @include('admin.includes.alerts')

            <form action="{{ route('tables.destroy', $table->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> DELETAR A MESA {{ strtoupper($table->identify) }}</button>
            </form>
        </div>
    </div>
@stop
