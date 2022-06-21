<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function handleLogin(LoginRequest $request){
        if($request->has('remember') && $request->input('remember') == "on"){
            $remember = true;
        }
        else{
            $remember = false;
        }

        //dd($request->all(), $remember);

        if(auth()->attempt(['email' => $request->input('email'), 'password' => $request->input('password'),], $remember)) {
            //dd($request->all());
            return redirect()->intended(route('categorias'));
        }
        else {
            //dd($request->all());
            return redirect()->route('login')->with('error_login', 'Email o contrasenya incorrecte');
        }
    }

    public function logout(){
        if(auth()->check()){
            auth()->logout();
            return redirect()->route('login');
        }
    }
}
