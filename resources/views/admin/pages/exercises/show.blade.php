@extends('adminlte::page')

@section('title', "Detalhes do Exercício { $exercise->name }")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('exercises.index') }}">Exercícios</a></li>
        <li class="breadcrumb-item"><a href="{{ route('exercises.show', $exercise->id) }}">{{ $exercise->name }}</a></li>
    </ol>

    <h1>Detalhes do Exercício <b>{{ $exercise->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <img src="{{ url("storage/{$exercise->image}") }}" alt="{{ $exercise->name }}" style="max-width: 400px" class="image"/>
            <ul>
                <li><b>Título:</b> {{ $exercise->name }}</li>
                <li><b>URL:</b> {{ $exercise->url }}</li>
                <li><b>Descrição:</b> {{ $exercise->description }}</li>
            </ul>
        </div>
        <div class="card-footer">
            @include('admin.includes.alerts')

            <form action="{{ route('exercises.destroy', $exercise->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> DELETAR O EXERCÍCIO {{ strtoupper($exercise->title) }}</button>
            </form>
        </div>
    </div>
@stop
