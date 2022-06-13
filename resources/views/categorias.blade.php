@extends('main')
@section('title', 'Categorias')
@section('content')
    <body>
        @can('admin')
        <a href="/categorias/nuevo/" class="btn btn-primary">Nueva categoria</a>
        @endcan
        <div class="grid-container-element">
        @foreach ($categorias as $categoria)
            <div class="grid-child-element">
                <h1>{{ $categoria->name }}</h1>
                <p>{{ $categoria->description }}</p>
                <h6>Subcategorias: 
                    @foreach ($subcategorias as $subcategoria)
                    @if ($subcategoria->categoria_id == $categoria->id)
                    <li>{{ $subcategoria->name }} 
                        @can('admin')
                        <a href="/subcategorias/eliminar/{{ $subcategoria->id }}">Eliminar</a></li>
                        @endcan
                    @endif
                    @endforeach
                </h6>
                @can('admin')
                <a href="/categorias/editar/{{ $categoria->id }}" class="btn btn-primary">Editar</a>
                <a href="/categorias/eliminar/{{ $categoria->id }}" class="btn btn-primary">Eliminar</a>
                <a href="/subcategorias/nuevo/{{ $categoria->id }}" class="btn btn-primary">Nueva subcategoria</a>
                @endcan
            </div>
        @endforeach
        </div>
    </body>
@endsection
