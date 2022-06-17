@extends('main')
@section('title', 'Productos')
@section('content')
    <body>
        @can('admin')
        <a href="{{ route('producto-nuevo') }}" class="btn btn-primary">Nuevo producto</a>
        <a href="{{ route('excel') }}" class="btn btn-primary">Descargar XLS</a>
        @endcan
        <div class="grid-container-element">
        @foreach ($products as $product)
            <div class="grid-child-element">
            <h2>{{ $product->name }}</h2>
            <img src='{{ $product->image }}' alt='{{ $product->name }}' style="height:150px;">
            <p>{{ $product->description }}</p>
            @foreach ($categoria_products as $categoria_product)
                @if ($categoria_product->product_id == $product->id)
                    @foreach ($categorias as $categoria)
                        @if ($categoria_product->categoria_id == $categoria->id)
                        <h6>Categorias: {{ $categoria->name }}</h6>
                        @endif
                    @endforeach
                @endif
            @endforeach
            @foreach ($subcategorias as $subcategoria)
                @if ($product->subcategoria_id == $subcategoria->id)
                <h6>Subcategoria: {{ $subcategoria->name }}</h6>
                @endif
            @endforeach
            @foreach ($tarifas as $tarifa)
                @if ($tarifa->product_id == $product->id)
                    @if ($tarifa->start_date <= $fecha && $tarifa->end_date >= $fecha)
                        <h5>Unidad: {{ $tarifa->price }}€</h5>
                    @endif
                @endif
            @endforeach
            @if ($product->stock <= 0)
            <p style="color:red;">NO HAY STOCK</p>
            @endif
            <a href="{{ route('producto', [$product->id]) }}" class="btn btn-primary">Ver producto</a>
            @can('admin')
            <a href="{{ route('producto-editar', [$product->id]) }}" class="btn btn-primary">Editar</a>
            <a href="{{ route('producto-eliminar', [$product->id]) }}" class="btn btn-primary">Eliminar</a>
            <a href="{{ route('tarifas', [$product->id]) }}" class="btn btn-primary">Editar tarifas</a>
            @endcan
            </div>
        @endforeach
        </div>
    </body>
@endsection
