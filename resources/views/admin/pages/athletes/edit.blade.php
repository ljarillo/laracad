@extends('adminlte::page')

@section('title', "Editar usuário { $athlete->name }")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('athletes.index') }}" >Atleta</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('athletes.edit', $athlete->id) }}" class="active">Editar - {{ $athlete->name }}</a></li>
    </ol>
    <h1>Editar Atleta <b>{{ $athlete->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <form action="{{ route('athletes.update', $athlete->id) }}" class="form" method="POST">
                @csrf
                @method('PUT')

                @include('admin.pages.athletes._partials.form')
            </form>
        </div>
        <div class="card-footer">
        </div>
    </div>
@stop
