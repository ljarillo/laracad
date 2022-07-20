@extends('adminlte::page')

@section('title', 'Cadastrar nova empresa')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('tenants.index') }}">Empresas</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('tenants.create') }}" class="active">Novo</a></li>
    </ol>
    <h1>Cadastrar nova empresa</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <form action="{{ route('tenants.store') }}" class="form" method="POST" enctype="multipart/form-data">
                @include('admin.pages.tenants._partials.form')
            </form>
        </div>
        <div class="card-footer">
        </div>
    </div>
@stop
