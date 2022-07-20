@extends('adminlte::page')

@section('title', 'Cadastrar novo produto')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produtos</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('products.create') }}" class="active">Novo</a></li>
    </ol>
    <h1>Cadastrar novo produto</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <form action="{{ route('products.store') }}" class="form" method="POST" enctype="multipart/form-data">
                @include('admin.pages.products._partials.form')
            </form>
        </div>
        <div class="card-footer">
        </div>
    </div>
@stop
