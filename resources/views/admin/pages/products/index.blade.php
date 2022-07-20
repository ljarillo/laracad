@extends('adminlte::page')

@section('title', 'Produtos')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('products.index') }}" class="active">Produtos</a></li>
    </ol>

    <h1>Produtos <a href="{{ route('products.create') }}" class="btn btn-dark"><i class="fa fa-plus-square"></i> Add</a> </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('products.search') }}" method="POST" class="form form-inline">
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
                    <th>Imagem</th>
                    <th>Título</th>
                    <th>Preço</th>
                    <th class="text-center" style="width: 20%">Ação</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td><img src="{{ url("storage/{$product->image}") }}" alt="{{ $product->title }}" class="image product-image-thumb" /></td>
                        <td>{{ $product->title }}</td>
                        <td>R$ {{ number_format($product->price, 2, ',', '.') }}</td>
                        <td class="text-center">
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-info"><i class="fa fa-eye"></i> Ver</a>
                            <a href="{{ route('products.categories', $product->id) }}" class="btn btn-primary"><i class="fa fa-layer-group"></i> Categorias</a>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning"><i class="fa fa-pen"></i> Editar</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if(isset($filters))
                {!! $products->appends($filters)->links() !!}
            @else
                {!! $products->links() !!}
            @endif

        </div>
    </div>
@stop
