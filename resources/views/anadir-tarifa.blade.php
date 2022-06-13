@extends('main')
@section('title', 'Añadir tarifa')
@section('content')
    <body>
        <form method="post" action="/tarifas/creado/{{$id}}">
        {{ csrf_field() }}
            <div class="form-group">
                <label for="start_date">Fecha de inicio de tarifa</label>
                <input name='start_date' type="text" class="form-control" id="start_date" placeholder="Entra la fecha de inicio de la tarifa">
            </div>
            <div class="form-group">
                <label for="end_date">Fecha de finalización de tarifa</label>
                <input name='end_date' type="text" class="form-control" id="end_date" placeholder="Entra la fecha de finalización de la tarifa">
            </div>
            <div class="form-group">
                <label for="price">Precio de la tarifa</label>
                <input name='price' type="text" class="form-control" id="price" placeholder="Entra el precio de la tarifa">
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
