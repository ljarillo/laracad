@extends('adminlte::page')

@section('title', "Detalhe { $detail->name }")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.show', $plan->url) }}">{{ $plan->name }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('details.index', $plan->url) }}">Detalhes</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('details.show', [$plan->url, $detail->id]) }}" class="active">{{ $detail->name }}</a></li>
    </ol>

    <h1>Detalhe <b>{{ $detail->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header"></div>
        <div class="card-body">
            <ul>
                <li><b>Nome:</b> {{ $detail->name }}</li>
            </ul>
        </div>
        <div class="card-footer">
            <form action="{{ route('details.destroy', [$plan->url, $detail->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> DELETAR O DETALHE {{ strtoupper($detail->name) }} DO PLANO {{ strtoupper($plan->name) }}</button>
            </form>
        </div>
    </div>
@stop
