@extends('adminlte::page')

@section('title', "Editar plano { $plan->name }")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}" >Perfis</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('plans.edit', $plan->url) }}" class="active">Editar - {{ $plan->name }}</a></li>
    </ol>
    <h1>Editar plano <b>{{ $plan->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <form action="{{ route('plans.update', $plan->url) }}" class="form" method="POST">
                @csrf
                @method('PUT')

                @include('admin.pages.plans._partials.form')
            </form>
        </div>
        <div class="card-footer">
        </div>
    </div>
@stop
