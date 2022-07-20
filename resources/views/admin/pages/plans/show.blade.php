@extends('adminlte::page')

@section('title', "Detalhes do plano { $plan->name }")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.show', $plan->url) }}">{{ $plan->name }}</a></li>
    </ol>

    <h1>Detalhes do plano <b>{{ $plan->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <ul>
                <li><b>Nome:</b> {{ $plan->name }}</li>
                <li><b>URL:</b> {{ $plan->url }}</li>
                <li><b>Preço:</b> R$ {{ number_format($plan->price, 2, ',', '.') }}</li>
                <li><b>Descrição:</b> {{ $plan->description }}</li>
            </ul>
        </div>
        <div class="card-footer">
            @include('admin.includes.alerts')

            <form action="{{ route('plans.destroy', $plan->url) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> DELETAR O PLANO {{ strtoupper($plan->name) }}</button>
            </form>
        </div>
    </div>
@stop
