@extends('adminlte::page')

@section('title', "Exercícios disponíveis para o Treino {$workout->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('workouts.index') }}" >Treino</a></li>
        <li class="breadcrumb-item"><a href="{{ route('workouts.exercises', $workout->id) }}">Exercícios do Treino</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('workouts.exercises.available', $workout->id) }}" class="active">Novos Exercícios</a></li>
    </ol>

    <h1>Exercícios disponíveis para o Treino <b>{{ $workout->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('workouts.exercises.available', $workout->id) }}" method="POST" class="form form-inline">
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
            <form action="{{ route('workouts.exercises.attach', $workout->id) }}" method="POST">
                @csrf
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th class="text-center" style="width: 5%">#</th>
                        <th style="width: 20%">Repetição</th>
                        <th style="width: 20%">Exercício</th>
                        <th>Descrição</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($exercises as $key => $exercise)
                            <tr>
                                <td>
                                    <input type="checkbox" id="exercise-{{ $exercise->id }}" name="exercises[{{$key}}][exercise_id]" value="{{ $exercise->id }}">
                                </td>
                                <td><label for="exercise-{{ $exercise->id }}">{{ $exercise->name }}</label></td>
                                <td>
                                    <input type="text" name="exercises[{{$key}}][repetition]" class="form-control" placeholder="Repetições:">
                                </td>
                                <td>
                                    <input type="text" name="exercises[{{$key}}][description]" class="form-control" placeholder="Descrição:">
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="4">
                                <button type="submit" class="btn btn-dark">Vincular</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
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
