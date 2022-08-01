@extends('adminlte::page')

@section('title', 'Exercícios')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('exercises.index') }}" class="active">Exercícios</a></li>
    </ol>

    <h1>Exercícios <a href="{{ route('exercises.create') }}" class="btn btn-dark"><i class="fa fa-plus-square"></i> Add</a> </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('exercises.search') }}" method="POST" class="form form-inline">
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
                    <th>Name</th>
                    <th>URL</th>
                    <th class="text-center" style="width: 20%">Ação</th>
                </tr>
                </thead>
                <tbody>
                @foreach($exercises as $exercise)
                    <tr>
                        <td><img src="{{ url("storage/{$exercise->image}") }}" alt="{{ $exercise->name }}" class="image product-image-thumb" /></td>
                        <td>{{ $exercise->name }}</td>
                        <td>{{ $exercise->url }}</td>
                        <td class="text-center">
                            <a href="{{ route('exercises.show', $exercise->id) }}" class="btn btn-info"><i class="fa fa-eye"></i> Ver</a>
                            <a href="{{ route('exercises.edit', $exercise->id) }}" class="btn btn-warning"><i class="fa fa-pen"></i> Editar</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if(isset($filters))
                {!! $exercises->appends($filters)->links() !!}
            @else
                {!! $exercises->links() !!}
            @endif

        </div>
    </div>
@stop
