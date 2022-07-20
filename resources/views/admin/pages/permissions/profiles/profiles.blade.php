@extends('adminlte::page')

@section('title', "Perfils da permissão { $permission->name }")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('permissions.index') }}" >Permissão</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('permissions.profiles', $permission->id) }}" class="active">Perfils - {{ $permission->name }}</a></li>
    </ol>

    <h1>Perfils da permissão <b>{{ $permission->name }}</b></h1>
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
                @foreach($profiles as $profile)
                    <tr>
                        <td>{{ $profile->name }}</td>
                        <td class="text-center">
                            <a href="{{ route('profiles.permissions.detach', [$profile->id, $permission->id]) }}" class="btn btn-danger"><i class="fa fa-trash"></i> Desvincular</a>
                        </td>
                    </tr>
                @endforeach
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
