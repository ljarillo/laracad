@extends('adminlte::page')

@section('title', "Detalhes do planos {$plan->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.show', $plan->url) }}">{{ $plan->name }}</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('details.index', $plan->url) }}" class="active">Detalhes</a></li>
    </ol>

    <h1>Detalhes do planos {{$plan->name}} <a href="{{ route('details.create', $plan->url) }}" class="btn btn-dark"><i class="fa fa-plus-square"></i> Add</a> </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header"></div>
        <div class="card-body">
            @include('admin.includes.alerts')
            <table class="table">
                <thead class="thead-light">
                <tr>
                    <th>Nome</th>
                    <th class="text-center" style="width: 20%">Ação</th>
                </tr>
                </thead>
                <tbody>
                @foreach($details as $detail)
                    <tr>
                        <td>{{ $detail->name }}</td>
                        <td class="text-center">
                            <form action="{{ route('details.destroy', [$plan->url, $detail->id]) }}" method="POST">
                                <a href="{{ route('details.show', [$plan->url, $detail->id]) }}" class="btn btn-info"><i class="fa fa-eye"></i> Ver</a>
                                <a href="{{ route('details.edit', [$plan->url, $detail->id]) }}" class="btn btn-warning"><i class="fa fa-pen"></i> Editar</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Deletar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if(isset($filters))
                {!! $details->appends($filters)->links() !!}
            @else
                {!! $details->links() !!}
            @endif

        </div>
    </div>
@stop
