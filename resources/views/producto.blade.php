@extends('main')
@section('title', $product->name)
@section('content')
<body>
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
            @foreach ($subcategorias as $subcategoria)
                @if ($product->subcategoria_id == $subcategoria->id)
                <h6>Subcategoria: {{ $subcategoria->name }}</h6>
                @endif
            @endforeach
        @endif
    @endforeach
    @foreach ($tarifas as $tarifa)
        @if ($tarifa->product_id == $product->id)
            @if ($tarifa->start_date <= $fecha && $tarifa->end_date >= $fecha)
            <h5>Unidad: {{ $tarifa->price }}€</h5>
            @endif
        @endif
    @endforeach
    @can('admin')
    <a href="{{ route('pdf', [$product->id]) }}" class="btn btn-primary">Descargar PDF</a>
    @endcan
</body>
@endsection