@extends('adminlte::page')

@section('title', 'Atletas')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('athletes.index') }}" class="active">Atletas</a></li>
    </ol>

    <h1>Atletas <a href="{{ route('athletes.create') }}" class="btn btn-dark"><i class="fa fa-plus-square"></i> Add</a> </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('athletes.search') }}" method="POST" class="form form-inline">
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
                    <th>E-mail</th>
                    <th class="text-center" style="width: 25%">Ação</th>
                </tr>
                </thead>
                <tbody>
                @foreach($athletes as $athlete)
                    <tr>
                        <td>{{ $athlete->name }}</td>
                        <td>{{ $athlete->email }}</td>
                        <td class="text-center">
                            <a href="{{ route('athletes.show', $athlete->id) }}" class="btn btn-info"><i class="fa fa-eye"></i> Ver</a>
                            <a href="{{ route('athletes.edit', $athlete->id) }}" class="btn btn-warning"><i class="fa fa-pen"></i> Editar</a>
                            <a href="{{ route('athletes.workouts', $athlete->id) }}" class="btn btn-default"><i class="fas fa-file-alt"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if(isset($filters))
                {!! $athletes->appends($filters)->links() !!}
            @else
                {!! $athletes->links() !!}
            @endif

        </div>
    </div>
@stop
