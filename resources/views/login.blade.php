@extends('main')
@section('title', 'Iniciar sesión')
@section('content')
    <body>
        <form method="post" action="{{ route('logged') }}">
        {{ csrf_field() }}
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input name='email' type="email" class="form-control" id="exampleInputEmail1" placeholder="Entra el teu email" value="{{ old('email') }}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Contrasenya</label>
                <input name='password' type="password" class="form-control" id="examplePassword1" placeholder="Entra la teva contrasenya">
            </div>
            <div class="form-check">
                <input name='remember' type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Vols recordar la sessió?</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
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
