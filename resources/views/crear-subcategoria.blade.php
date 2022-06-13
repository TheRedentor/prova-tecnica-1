@extends('main')
@section('title', 'Crear subcategoria')
@section('content')
    <body>
        <form method="post" action="/subcategorias/creado/{{$id}}">
        {{ csrf_field() }}
            <div class="form-group">
                <label for="name">Nombre</label>
                <input name='name' type="text" class="form-control" id="name" placeholder="Entra un nombre">
            </div>
            <div class="form-group">
                <label for="description">Descripción</label>
                <input name='description' type="text" class="form-control" id="description" placeholder="Entra una descripción">
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
