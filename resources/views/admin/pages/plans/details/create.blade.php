@extends('adminlte::page')

@section('title', "Cadastrar novo detalhe do plano { $plan->name }")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.show', $plan->url) }}">{{ $plan->name }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('details.index', $plan->url) }}">Detalhes</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('details.create', $plan->url) }}" class="active">Novo</a></li>
    </ol>

    <h1>Cadastrar novo detalhe do plano {{ $plan->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header"></div>
        <div class="card-body">
            <form action="{{ route('details.store', $plan->url) }}" class="form" method="POST">
                @include('admin.pages.plans.details._partials.form')
            </form>
        </div>
        <div class="card-footer"></div>
    </div>
@stop
