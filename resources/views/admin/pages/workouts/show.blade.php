@extends('adminlte::page')

@section('title', "Detalhes da Treino { $workout->name }")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('workouts.index') }}">Treinos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('workouts.show', $workout->id) }}">{{ $workout->name }}</a></li>
    </ol>

    <h1>Detalhes da Treino <b>{{ $workout->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <ul>
                <li><b>Nome:</b> {{ $workout->name }}</li>
                <li><b>Url:</b> {{ $workout->url }}</li>
                <li><b>Descrição:</b> {{ $workout->description }}</li>
                <li><b>Empresa:</b> {{ $workout->tenant->name }}</li>
            </ul>
        </div>
        <div class="card-footer">
            @include('admin.includes.alerts')

            <form action="{{ route('workouts.destroy', $workout->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> DELETAR O TREINO {{ strtoupper($workout->name) }}</button>
            </form>
        </div>
    </div>
@stop
