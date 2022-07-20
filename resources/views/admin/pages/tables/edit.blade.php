@extends('adminlte::page')

@section('title', "Editar mesa { $table->identify }")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('tables.index') }}">Mesas</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('tables.edit', $table->id) }}" class="active">Editar - {{ $table->identify }}</a></li>
    </ol>
    <h1>Editar mesa <b>{{ $table->identify }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <form action="{{ route('tables.update', $table->id) }}" class="form" method="POST">
                @csrf
                @method('PUT')

                @include('admin.pages.tables._partials.form')
            </form>
        </div>
        <div class="card-footer">
        </div>
    </div>
@stop
