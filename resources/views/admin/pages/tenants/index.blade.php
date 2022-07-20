@extends('adminlte::page')

@section('title', 'Empresas')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('tenants.index') }}" class="active">Empresas</a></li>
    </ol>

    <h1>Empresas <a href="{{ route('tenants.create') }}" class="btn btn-dark"><i class="fa fa-plus-square"></i> Add</a> </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('tenants.search') }}" method="POST" class="form form-inline">
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
                    <th>Imagem</th>
                    <th>Nome</th>
                    <th class="text-center" style="width: 20%">Ação</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tenants as $tenant)
                    <tr>
                        <td><img src="{{ url("storage/{$tenant->logo}") }}" alt="{{ $tenant->name }}" class="image tenant-image-thumb" /></td>
                        <td>{{ $tenant->name }}</td>
                        <td class="text-center">
                            <a href="{{ route('tenants.show', $tenant->id) }}" class="btn btn-info"><i class="fa fa-eye"></i> Ver</a>
                            <a href="{{ route('tenants.edit', $tenant->id) }}" class="btn btn-warning"><i class="fa fa-pen"></i> Editar</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if(isset($filters))
                {!! $tenants->appends($filters)->links() !!}
            @else
                {!! $tenants->links() !!}
            @endif

        </div>
    </div>
@stop
