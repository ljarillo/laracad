@extends('adminlte::page')

@section('title', 'Categorias')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('categories.index') }}" class="active">Categorias</a></li>
    </ol>

    <h1>Categorias <a href="{{ route('categories.create') }}" class="btn btn-dark"><i class="fa fa-plus-square"></i> Add</a> </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('categories.search') }}" method="POST" class="form form-inline">
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
                    <th>Descrição</th>
                    <th class="text-center" style="width: 15%">Ação</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        <td class="text-center">
                            <a href="{{ route('categories.show', $category->id) }}" class="btn btn-info"><i class="fa fa-eye"></i> Ver</a>
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning"><i class="fa fa-pen"></i> Editar</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if(isset($filters))
                {!! $categories->appends($filters)->links() !!}
            @else
                {!! $categories->links() !!}
            @endif

        </div>
    </div>
@stop
