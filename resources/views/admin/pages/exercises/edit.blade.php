@extends('adminlte::page')

@section('title', "Editar Exercício { $exercise->name }")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('exercises.index') }}">Exercícios</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('exercises.edit', $exercise->id) }}" class="active">Editar - {{ $exercise->name }}</a></li>
    </ol>
    <h1>Editar Exercício <b>{{ $exercise->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <form action="{{ route('exercises.update', $exercise->id) }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @include('admin.pages.exercises._partials.form')
            </form>
        </div>
        <div class="card-footer">
        </div>
    </div>
@stop
