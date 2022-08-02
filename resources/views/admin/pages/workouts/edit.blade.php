@extends('adminlte::page')

@section('title', "Editar Treino { $workout->name }")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('workouts.index') }}">Treino</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('workouts.edit', $workout->id) }}" class="active">Editar - {{ $workout->name }}</a></li>
    </ol>
    <h1>Editar Treino <b>{{ $workout->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <form action="{{ route('workouts.update', $workout->id) }}" class="form" method="POST">
                @csrf
                @method('PUT')

                @include('admin.pages.workouts._partials.form')
            </form>
        </div>
        <div class="card-footer">
        </div>
    </div>
@stop
