@extends('adminlte::page')

@section('title', "Editar o cargo { $role->name }")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('roles.index') }}" >Cargos</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('roles.edit', $role->id) }}" class="active">Editar - {{ $role->name }}</a></li>
    </ol>
    <h1>Editar o cargo <b>{{ $role->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <form action="{{ route('roles.update', $role->id) }}" class="form" method="POST">
                @method('PUT')
                @include('admin.pages.roles._partials.form')
            </form>
        </div>
        <div class="card-footer">
        </div>
    </div>
@stop
