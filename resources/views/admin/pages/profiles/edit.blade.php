@extends('adminlte::page')

@section('title', "Editar o perfil { $profile->name }")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('profiles.index') }}" >Perfis</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('profiles.edit', $profile->id) }}" class="active">Editar - {{ $profile->name }}</a></li>
    </ol>
    <h1>Editar o perfil <b>{{ $profile->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <form action="{{ route('profiles.update', $profile->id) }}" class="form" method="POST">
                @method('PUT')
                @include('admin.pages.profiles._partials.form')
            </form>
        </div>
        <div class="card-footer">
        </div>
    </div>
@stop
