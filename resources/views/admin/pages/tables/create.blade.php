@extends('adminlte::page')

@section('title', 'Cadastrar nova mesa')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('tables.index') }}">Mesas</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('tables.create') }}" class="active">Novo</a></li>
    </ol>
    <h1>Cadastrar nova mesa</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <form action="{{ route('tables.store') }}" class="form" method="POST">
                @include('admin.pages.tables._partials.form')
            </form>
        </div>
        <div class="card-footer">
        </div>
    </div>
@stop
