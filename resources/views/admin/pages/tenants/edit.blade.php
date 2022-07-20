@extends('adminlte::page')

@section('title', "Editar empresa { $tenant->name }")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('tenants.index') }}">Empresas</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('tenants.edit', $tenant->id) }}" class="active">Editar - {{ $tenant->name }}</a></li>
    </ol>
    <h1>Editar empresa <b>{{ $tenant->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <form action="{{ route('tenants.update', $tenant->id) }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @include('admin.pages.tenants._partials.form')
            </form>
        </div>
        <div class="card-footer">
        </div>
    </div>
@stop
