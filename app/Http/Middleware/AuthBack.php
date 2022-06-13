<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Controllers\Back\LoginController;

class AuthBack
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $routes_without_login = array(
                'login',
                'logged'
            );

            if(!in_array($request->route()->getName(), $routes_without_login)){
                
                if(auth()->guest()){
                    $request->session()->put('url.intended', url()->current());
                    return redirect()->action([LoginController::class, 'index']);
                }
            }
            else{
                
                if(!auth()->user()->active){
                    auth()->logout();
                    return redirect()->action([LoginController::class, 'index']);
                }
            }
            
            return $next($request);
        }
        catch (\Exception $e) {
            return redirect()->action([LoginController::class, 'index']);
        }
    }
}
