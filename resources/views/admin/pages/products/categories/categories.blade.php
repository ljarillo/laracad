@extends('adminlte::page')

@section('title', "Categoria do produto { $product->title }")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}" >Categorias</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('products.categories', $product->id) }}" class="active">Produtos</a></li>
    </ol>

    <h1>Categoria do produto <b>{{ $product->title }}</b> <a href="{{ route('products.categories.available', $product->id) }}" class="btn btn-dark"><i class="fa fa-plus-square"></i> Add nova categoria</a> </h1>
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
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td class="text-center">
                            <a href="{{ route('products.categories.detach', [$product->id, $category->id]) }}" class="btn btn-danger"><i class="fa fa-trash"></i> Desvincular</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if(isset($filters))
                {!! $categories->appends($filters)->links() !!}
            @else
                {!! $categories->links() !!}
            @endif

        </div>
    </div>
@stop
