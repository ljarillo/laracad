@extends('adminlte::page')

@section('title', "Permissões do cargo { $role->name }")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('roles.index') }}" >Cargos</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('roles.permissions', $role->id) }}" class="active">Permissões</a></li>
    </ol>

    <h1>Permissões do cargo <b>{{ $role->name }}</b> <a href="{{ route('roles.permissions.available', $role->id) }}" class="btn btn-dark"><i class="fa fa-plus-square"></i> Add nova permissão</a> </h1>
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
                @foreach($permissions as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                        <td class="text-center">
                            <a href="{{ route('roles.permissions.detach', [$role->id, $permission->id]) }}" class="btn btn-danger"><i class="fa fa-trash"></i> Desvincular</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if(isset($filters))
                {!! $permissions->appends($filters)->links() !!}
            @else
                {!! $permissions->links() !!}
            @endif

        </div>
    </div>
@stop
