@extends('adminlte::page')

@section('title', "Detalhes da empresa { $tenant->name }")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('tenants.index') }}">Empresas</a></li>
        <li class="breadcrumb-item"><a href="{{ route('tenants.show', $tenant->id) }}">{{ $tenant->name }}</a></li>
    </ol>

    <h1>Detalhes da empresa <b>{{ $tenant->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <img src="{{ url("storage/{$tenant->logo}") }}" alt="{{ $tenant->name }}" style="max-width: 400px" class="image"/>
            <ul>
                <li><b>Plano:</b> {{ $tenant->plan->name }}</li>
                <li><b>Nome:</b> {{ $tenant->name }}</li>
                <li><b>CNPL:</b> {{ $tenant->cnpj }}</li>
                <li><b>Url:</b> {{ $tenant->url }}</li>
                <li><b>E-mail:</b> {{ $tenant->email }}</li>
                <li><b>Ativo:</b> {{ $tenant->active == 'Y' ? 'Sim' : 'Não'}}</li>
            </ul>

            <hr>
            <h3>Assinatura</h3>
            <ul>
                <li><b>Data Assinatura:</b> {{ $tenant->subscription }}</li>
                <li><b>Data Expira:</b> {{ $tenant->expires_at }}</li>
                <li><b>Identificador:</b> {{ $tenant->subscription_id }}</li>
                <li><b>Ativo?</b> {{ $tenant->subscription_active ? 'Sim' : 'Não'}}</li>
                <li><b>Cancelou?</b> {{ $tenant->subscription_suspended ? 'Sim' : 'Não'}}</li>
            </ul>
        </div>
        <div class="card-footer">
        </div>
    </div>
@stop
