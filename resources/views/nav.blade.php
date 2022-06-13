@php
    Route::get('login', [LoginController::class,'index']);
    Route::get('logout', [LoginController::class,'logout']);
@endphp

<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Prova tècnica</a>
    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            @auth
                <a class="nav-link" href="{{ action([LoginController::class,'logout']) }}">{{ auth()->user()->name }} - Log out</a>
            @endauth
            @guest
                <a class="nav-link" href="{{ action([LoginController::class,'index']) }}">Sign in</a>
            @endguest
        </li>
    </ul>
</nav>
