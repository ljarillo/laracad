@extends('adminlte::page')

@section('title', "Exercícios do Treino { $workout->name }")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('workouts.index') }}" >Treinos</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('workouts.exercises', $workout->id) }}" class="active">Exercícios do Treino</a></li>
    </ol>

    <h1>Exercícios do Treino <b>{{ $workout->name }}</b>
        <a href="{{ route('workouts.exercises.available', $workout->id) }}" class="btn btn-dark"><i class="fa fa-plus-square"></i> Add Exercício</a>
    </h1>
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
                    <th style="width: 10%">Repetição</th>
                    <th style="width: 40%">Exercício</th>
                    <th>Descrição</th>
                    <th class="text-center" style="width: 10%">Ação</th>
                </tr>
                </thead>
                <tbody>
                @foreach($exercises as $exercise)
                    <tr>
                        <td>{{ $exercise->pivot->repetition ?? '' }}</td>
                        <td>{{ $exercise->name }}</td>
                        <td>{{ $exercise->pivot->description ?? '' }}</td>
                        <td class="text-center">
                            <a href="{{ route('workouts.exercises.detach', [$workout->id, $exercise->id]) }}" class="btn btn-danger"><i class="fa fa-trash"></i> Desvincular</a>
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
