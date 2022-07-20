@extends('adminlte::page')

@section('title', "Detalhes da categoria { $category->name }")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categorias</a></li>
        <li class="breadcrumb-item"><a href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a></li>
    </ol>

    <h1>Detalhes da categoria <b>{{ $category->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <ul>
                <li><b>Nome:</b> {{ $category->name }}</li>
                <li><b>Url:</b> {{ $category->url }}</li>
                <li><b>Descrição:</b> {{ $category->description }}</li>
                <li><b>Empresa:</b> {{ $category->tenant->name }}</li>
            </ul>
        </div>
        <div class="card-footer">
            @include('admin.includes.alerts')

            <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> DELETAR O CATEGORIA {{ strtoupper($category->name) }}</button>
            </form>
        </div>
    </div>
@stop
