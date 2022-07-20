@extends('adminlte::page')

@section('title', "Editar permissão { $permission->name }")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('permissions.index') }}" >Permissões</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('permissions.edit', $permission->id) }}" class="active">Editar - {{ $permission->name }}</a></li>
    </ol>
    <h1>Editar permissão <b>{{ $permission->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <form action="{{ route('permissions.update', $permission->id) }}" class="form" method="POST">
                @method('PUT')
                @include('admin.pages.permissions._partials.form')
            </form>
        </div>
        <div class="card-footer">
        </div>
    </div>
@stop
