@extends('adminlte::page')

@section('title', "Editar categoria { $category->name }")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categoria</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('categories.edit', $category->id) }}" class="active">Editar - {{ $category->name }}</a></li>
    </ol>
    <h1>Editar categoria <b>{{ $category->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <form action="{{ route('categories.update', $category->id) }}" class="form" method="POST">
                @csrf
                @method('PUT')

                @include('admin.pages.categories._partials.form')
            </form>
        </div>
        <div class="card-footer">
        </div>
    </div>
@stop
