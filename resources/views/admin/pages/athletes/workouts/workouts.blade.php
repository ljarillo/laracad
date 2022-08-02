@extends('adminlte::page')

@section('title', "Treino do Atleta { $athlete->name }")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('athletes.index') }}" >Atleta</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('athletes.workouts', $athlete->id) }}" class="active">Treino do Atleta</a></li>
    </ol>

    <h1>Treino do Atleta <b>{{ $athlete->name }}</b> <a href="{{ route('athletes.workouts.available', $athlete->id) }}" class="btn btn-dark"><i class="fa fa-plus-square"></i> Add Treino</a> </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
        </div>
        <div class="card-body">
            @include('admin.includes.alerts')
            <table class="table">
                <thead class="thead-light">
                <tr>
                    <th>Nome</th>
                    <th class="text-center" style="width: 10%">Ação</th>
                </tr>
                </thead>
                <tbody>
                @foreach($workouts as $workout)
                    <tr>
                        <td>{{ $workout->name }}</td>
                        <td class="text-center">
                            <a href="{{ route('athletes.workouts.detach', [$athlete->id, $workout->id]) }}" class="btn btn-danger"><i class="fa fa-trash"></i> Desvincular</a>
                        </td>
                    </tr>
                @endforeach
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
