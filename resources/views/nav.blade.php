@php
    Route::get('login', [LoginController::class,'index']);
    Route::get('logout', [LoginController::class,'logout']);
@endphp

<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Prova tècnica</a>
    <form class="form-control form-control-dark w-100" method="post" action="{{ route('productos-post') }}">
        {{ csrf_field() }}
        <input name='name' type="text" placeholder="Buscar productos..." aria-label="Search">
        <button type="submit">Buscar</button>
    </form>
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            @auth
                <a class="nav-link" href="{{ route('logout') }}">{{ auth()->user()->name }} - Log out</a>
            @endauth
            @guest
                <a class="nav-link" href="{{ route('login') }}">Sign in</a>
            @endguest
        </li>
    </ul>
</nav>
