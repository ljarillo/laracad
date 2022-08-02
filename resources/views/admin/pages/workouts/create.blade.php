@extends('adminlte::page')

@section('title', 'Cadastrar nova Treino')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('workouts.index') }}">Treino</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('workouts.create') }}" class="active">Novo</a></li>
    </ol>
    <h1>Cadastrar nova Treino</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <form action="{{ route('workouts.store') }}" class="form" method="POST">
                @include('admin.pages.workouts._partials.form')
            </form>
        </div>
        <div class="card-footer">
        </div>
    </div>
@stop
