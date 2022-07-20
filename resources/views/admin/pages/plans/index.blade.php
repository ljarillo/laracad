@extends('adminlte::page')

@section('title', 'Planos')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('plans.index') }}" class="active">Planos</a></li>
    </ol>

    <h1>Planos <a href="{{ route('plans.create') }}" class="btn btn-dark"><i class="fa fa-plus-square"></i> Add</a> </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('plans.search') }}" method="POST" class="form form-inline">
                @csrf
                <input type="text" name="filter" placeholder="Busca" class="form-control" value="{{ $filters['filter'] ?? '' }}">
                <div class="input-group">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-dark"><i class="fa fa-filter"></i> Filtrar</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            @include('admin.includes.alerts')
            <table class="table">
                <thead class="thead-light">
                <tr>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th class="text-center" style="width: 25%">Ação</th>
                </tr>
                </thead>
                <tbody>
                @foreach($plans as $plan)
                <tr>
                    <td>{{ $plan->name }}</td>
                    <td>R$ {{ number_format($plan->price, 2, ',', '.') }}</td>
                    <td class="text-center">
                        <a href="{{ route('plans.show', $plan->url) }}" class="btn btn-info"><i class="fa fa-eye"></i> Ver</a>
                        <a href="{{ route('details.index', $plan->url) }}" class="btn btn-primary"><i class="fa fa-pen"></i> Detalhes</a>
                        <a href="{{ route('plans.edit', $plan->url) }}" class="btn btn-warning"><i class="fa fa-pen"></i> Editar</a>
                        <a href="{{ route('plans.profiles', $plan->id) }}" class="btn btn-info"><i class="fas fa-address-book"></i></a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if(isset($filters))
                {!! $plans->appends($filters)->links() !!}
            @else
                {!! $plans->links() !!}
            @endif

        </div>
    </div>
@stop
