@extends('adminlte::page')

@section('title', "Detalhes do produto { $product->title }")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produtos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.show', $product->id) }}">{{ $product->title }}</a></li>
    </ol>

    <h1>Detalhes do produto <b>{{ $product->title }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <img src="{{ url("storage/{$product->image}") }}" alt="{{ $product->title }}" style="max-width: 400px" class="image"/>
            <ul>
                <li><b>Título:</b> {{ $product->title }}</li>
                <li><b>Flag:</b> {{ $product->flag }}</li>
                <li><b>Preço:</b> R$ {{ number_format($product->price, 2, ',', '.') }}</li>
                <li><b>Descrição:</b> {{ $product->description }}</li>
                <li><b>Empresa:</b> {{ $product->tenant->name }}</li>
            </ul>
        </div>
        <div class="card-footer">
            @include('admin.includes.alerts')

            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> DELETAR O PRODUTO {{ strtoupper($product->title) }}</button>
            </form>
        </div>
    </div>
@stop
