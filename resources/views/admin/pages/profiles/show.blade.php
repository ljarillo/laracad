@extends('adminlte::page')

@section('title', "Detalhes do perfil { $profile->name }")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('profiles.index') }}" >Perfis</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('profiles.show', $profile->id) }}" class="active">{{ $profile->name }}</a></li>
    </ol>

    <h1>Detalhes do perfil <b>{{ $profile->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <ul>
                <li><b>Nome:</b> {{ $profile->name }}</li>
                <li><b>Descrição:</b> {{ $profile->description }}</li>
            </ul>
        </div>
        <div class="card-footer">
            @include('admin.includes.alerts')

            <form action="{{ route('profiles.destroy', $profile->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> DELETAR O PERFIL {{ strtoupper($profile->name) }}</button>
            </form>
        </div>
    </div>
@stop
