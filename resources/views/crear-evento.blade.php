@extends('main')
@section('title', 'Crear evento')
@section('content')
    <body>
        <form method="post" action="/evento/creado">
        {{ csrf_field() }}
            <div class="form-group">
                <label for="fecha">Fecha</label>
                <input name='fecha' type="text" class="form-control" id="fecha" placeholder="Entra una fecha">
            </div>
            <div class="form-group">
                <label for="producto">Producto</label>
                <input name='producto' type="text" class="form-control" id="producto" placeholder="Entra un producto">
            </div>
            <div class="form-group">
                <label for="numero">Número</label>
                <input name='numero' type="text" class="form-control" id="numero" placeholder="Entra el número de productos">
            </div>
            <button type="submit" class="btn btn-primary">Crear</button>
        </form>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        
        @if(isset($errors) && sizeof($errors)>0)
            <div class='alert alert-danger'>
                <ul class='list-group'>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </body>
@endsection

