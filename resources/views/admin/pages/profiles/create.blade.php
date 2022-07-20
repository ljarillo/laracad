@extends('adminlte::page')

@section('title', 'Cadastrar novo perfil')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('profiles.index') }}">Perfil</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('profiles.create') }}" class="active">Novo</a></li>
    </ol>
    <h1>Cadastrar novo perfil</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <form action="{{ route('profiles.store') }}" class="form" method="POST">
                @include('admin.pages.profiles._partials.form')
            </form>
        </div>
        <div class="card-footer">
        </div>
    </div>
@stop
