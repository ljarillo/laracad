@extends('adminlte::page')

@section('title', 'Cadastrar novo Atleta')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('athletes.index') }}">Atleta</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('athletes.create') }}" class="active">Novo</a></li>
    </ol>
    <h1>Cadastrar novo Atleta</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <form action="{{ route('athletes.store') }}" class="form" method="POST">
                @include('admin.pages.athletes._partials.form')
            </form>
        </div>
        <div class="card-footer">
        </div>
    </div>
@stop
