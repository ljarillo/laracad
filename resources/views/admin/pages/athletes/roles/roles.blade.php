@extends('adminlte::page')

@section('title', "Cargos do usuário { $user->name }")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}" >Usuários</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('users.roles', $user->id) }}" class="active">Cargos</a></li>
    </ol>

    <h1>Cargos do usuário <b>{{ $user->name }}</b> <a href="{{ route('users.roles.available', $user->id) }}" class="btn btn-dark"><i class="fa fa-plus-square"></i> Add novo cargo</a> </h1>
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
                @foreach($roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td class="text-center">
                            <a href="{{ route('users.roles.detach', [$user->id, $role->id]) }}" class="btn btn-danger"><i class="fa fa-trash"></i> Desvincular</a>
                        </td>
                    </tr>
                @endforeach
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
