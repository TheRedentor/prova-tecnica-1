@extends('main')
@section('title', 'Categorias')
@section('content')
    <body>
        @can('admin')
        <a href="{{ route('categoria-nuevo') }}" class="btn btn-primary">Nueva categoria</a>
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
                        <a href="{{ route('subcategoria-eliminar', [$subcategoria->id]) }}">Eliminar</a></li>
                        @endcan
                    @endif
                    @endforeach
                </h6>
                @can('admin')
                <a href="{{ route('categoria-editar', [$categoria->id]) }}" class="btn btn-primary">Editar</a>
                <a href="{{ route('categoria-eliminar', [$categoria->id]) }}" class="btn btn-primary">Eliminar</a>
                <a href="{{ route('subcategoria-nuevo', [$categoria->id]) }}" class="btn btn-primary">Nueva subcategoria</a>
                @endcan
            </div>
        @endforeach
        </div>
    </body>
@endsection
