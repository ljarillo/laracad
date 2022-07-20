@extends('adminlte::page')

@section('title', "Editar produto { $product->title }")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produtos</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('products.edit', $product->id) }}" class="active">Editar - {{ $product->title }}</a></li>
    </ol>
    <h1>Editar produto <b>{{ $product->title }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <form action="{{ route('products.update', $product->id) }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @include('admin.pages.products._partials.form')
            </form>
        </div>
        <div class="card-footer">
        </div>
    </div>
@stop
