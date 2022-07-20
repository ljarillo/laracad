@extends('adminlte::page')

@section('title', 'Cadastrar novo cargo')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Cargos</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('roles.create') }}" class="active">Novo</a></li>
    </ol>
    <h1>Cadastrar novo cargo</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <form action="{{ route('roles.store') }}" class="form" method="POST">
                @include('admin.pages.roles._partials.form')
            </form>
        </div>
        <div class="card-footer">
        </div>
    </div>
@stop
