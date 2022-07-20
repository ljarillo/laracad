@extends('adminlte::page')

@section('title', "Perfis disponíveis para o plano {$plan->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}" >Planos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.profiles', $plan->id) }}">Perfis</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('plans.profiles.available', $plan->id) }}" class="active">Disponíveis</a></li>
    </ol>

    <h1>Perfis disponíveis para o plano <b>{{ $plan->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('plans.profiles.available', $plan->id) }}" method="POST" class="form form-inline">
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
                <form action="{{ route('plans.profiles.attach', $plan->id) }}" method="POST">
                    @csrf
                    @foreach($profiles as $profile)
                        <tr>
                            <td>
                                <input type="checkbox" id="permission-{{ $profile->id }}" name="profiles[]" value="{{ $profile->id }}">
                            </td>
                            <td><label for="permission-{{ $profile->id }}">{{ $profile->name }}</label></td>
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
                {!! $profiles->appends($filters)->links() !!}
            @else
                {!! $profiles->links() !!}
            @endif

        </div>
    </div>
@stop
