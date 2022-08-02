@extends('adminlte::page')

@section('title', "Treinos disponíveis para o Atleta {$athlete->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('athletes.index') }}" >Atletas</a></li>
        <li class="breadcrumb-item"><a href="{{ route('athletes.workouts', $athlete->id) }}">Treinos disponíveis</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('athletes.workouts.available', $athlete->id) }}" class="active">Novos Treinos</a></li>
    </ol>

    <h1>Treinos disponíveis para o Atleta <b>{{ $athlete->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('athletes.workouts.available', $athlete->id) }}" method="POST" class="form form-inline">
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
                    <th class="text-center" style="width: 5%">#</th>
                    <th>Nome</th>
                </tr>
                </thead>
                <tbody>
                <form action="{{ route('athletes.workouts.attach', $athlete->id) }}" method="POST">
                    @csrf
                    @foreach($workouts as $workout)
                        <tr>
                            <td>
                                <input type="checkbox" id="workout-{{ $workout->id }}" name="workouts[]" value="{{ $workout->id }}">
                            </td>
                            <td><label for="workout-{{ $workout->id }}">{{ $workout->name }}</label></td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="2">
                            <button type="submit" class="btn btn-dark">Vincular</button>
                        </td>
                    </tr>
                </form>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if(isset($filters))
                {!! $workouts->appends($filters)->links() !!}
            @else
                {!! $workouts->links() !!}
            @endif

        </div>
    </div>
@stop
