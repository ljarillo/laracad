@extends('adminlte::page')

@section('title', "Cargos disponíveis do usuário {$user->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}" >Usuários</a></li>
        <li class="breadcrumb-item"><a href="{{ route('users.roles', $user->id) }}">Cargos</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('users.roles.available', $user->id) }}" class="active">Novos Cargos</a></li>
    </ol>

    <h1>Cargos disponíveis do usuário <b>{{ $user->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('users.roles.available', $user->id) }}" method="POST" class="form form-inline">
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
                <form action="{{ route('users.roles.attach', $user->id) }}" method="POST">
                    @csrf
                    @foreach($roles as $role)
                        <tr>
                            <td>
                                <input type="checkbox" id="role-{{ $role->id }}" name="roles[]" value="{{ $role->id }}">
                            </td>
                            <td><label for="role-{{ $role->id }}">{{ $role->name }}</label></td>
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
                {!! $roles->appends($filters)->links() !!}
            @else
                {!! $roles->links() !!}
            @endif

        </div>
    </div>
@stop
