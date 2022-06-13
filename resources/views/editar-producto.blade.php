@extends('main')
@section('title', 'Editar producto')
@section('content')
    <body>
        <form method="post" action="/productos/editado/{{$id}}">
        {{ csrf_field() }}
            <div class="form-group">
                <label for="name">Nombre</label>
                <input name='name' type="text" class="form-control" id="name" placeholder="Entra un nombre" value={{$name}}>
            </div>
            <div class="form-group">
                <label for="description">Descripción</label>
                <input name='description' type="text" class="form-control" id="description" placeholder="Entra una descripción" value="{{$description}}">
            </div>
            <div class="form-group">
                <label for="image">Imagen</label>
                <input name='image' type="text" class="form-control" id="image" placeholder="Entra un link de imagen" value={{$image}}>
            </div>
            <div class="form-group">
                <label for="categoria">Categoria</label>
                <input name='categoria' type="text" class="form-control" id="categoria" placeholder="Entra el nombre de la categoria" value={{$categoria_name}}>
            </div>
            <div class="form-group">
                <label for="subcategoria">Subcategoria</label>
                <input name='subcategoria' type="text" class="form-control" id="subcategoria" placeholder="Entra el nombre de la subcategoria" value={{$subcategoria_name}}>
            </div>
            <button type="submit" class="btn btn-primary">Editar</button>
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
