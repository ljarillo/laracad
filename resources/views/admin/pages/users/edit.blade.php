@extends('adminlte::page')

@section('title', "Editar usuário { $user->name }")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}" >Usuários</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('users.edit', $user->id) }}" class="active">Editar - {{ $user->name }}</a></li>
    </ol>
    <h1>Editar usuário <b>{{ $user->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <form action="{{ route('users.update', $user->id) }}" class="form" method="POST">
                @csrf
                @method('PUT')

                @include('admin.pages.users._partials.form')
            </form>
        </div>
        <div class="card-footer">
        </div>
    </div>
@stop
