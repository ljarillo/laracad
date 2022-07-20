@extends('adminlte::page')

@section('title', "Permissões disponíveis do perfil {$profile->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('profiles.index') }}" >Perfis</a></li>
        <li class="breadcrumb-item"><a href="{{ route('profiles.permissions', $profile->id) }}">Permissões</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('profiles.permissions.available', $profile->id) }}" class="active">Novas Permissões</a></li>
    </ol>

    <h1>Permissões disponíveis do perfil <b>{{ $profile->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('profiles.permissions.available', $profile->id) }}" method="POST" class="form form-inline">
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
                <form action="{{ route('profiles.permissions.attach', $profile->id) }}" method="POST">
                    @csrf
                    @foreach($permissions as $permission)
                        <tr>
                            <td>
                                <input type="checkbox" id="permission-{{ $permission->id }}" name="permissions[]" value="{{ $permission->id }}">
                            </td>
                            <td><label for="permission-{{ $permission->id }}">{{ $permission->name }}</label></td>
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
                {!! $permissions->appends($filters)->links() !!}
            @else
                {!! $permissions->links() !!}
            @endif

        </div>
    </div>
@stop
