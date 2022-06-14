@extends('main')
@section('title', 'Tarifas')
@section('content')
    <body>
        <h1>{{ $product->name }} <a href="{{ route('tarifa-nuevo', [$id]) }}" class="btn btn-primary">Añadir tarifa</a></h1>
        <div class="grid-container-element">
        <?php $i=1; ?>
        @foreach ($tarifas as $tarifa)
            <div class="grid-child-element">
            <h2>Tarifa {{ $i }}</h2>
            <h6>Fecha de inicio: {{ $tarifa->start_date }}</h6>
            <h6>Fecha de finalización: {{ $tarifa->end_date }}</h6>
            <h3>Precio unidad: {{ $tarifa->price }}€</h3>
            @can('admin')
            <a href="{{ route('tarifa-editar', [$tarifa->id]) }}" class="btn btn-primary">Editar</a>
            <a href="{{ route('tarifa-eliminar', [$tarifa->id]) }}" class="btn btn-primary">Eliminar</a>
            @endcan
            </div>
            <?php $i++ ?>
        @endforeach
        </div>
    </body>
@endsection
