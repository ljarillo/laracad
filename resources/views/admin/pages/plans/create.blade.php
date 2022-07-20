@extends('adminlte::page')

@section('title', 'Cadastrar novo plano')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('plans.create') }}" class="active">Novo</a></li>
    </ol>
    <h1>Cadastrar novo plano</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <form action="{{ route('plans.store') }}" class="form" method="POST">
                @include('admin.pages.plans._partials.form')
            </form>
        </div>
        <div class="card-footer">
        </div>
    </div>
@stop
