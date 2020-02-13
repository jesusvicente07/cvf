<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class AuthSession
{
    
    public function handle($request, Closure $next, $guard = null)
    {

        if (Auth::guard($guard)->check()) {

            if($request->is('trayectorias/selecionadas') || $request->is('selecionar/trayectorias')){
                return back();
            }else{
                return $next($request);
            }
            
        }

        if (Auth::guard('student')->check() ) {

            if($request->is('trayectorias/selecionadas') || $request->is('selecionar/trayectorias') || $request->is('editar/trayectorias/selecionadas/*') || $request->is('/')){
                return $next($request);
            }else{
                return redirect('trayectorias/selecionadas');
            }
        }


        return  redirect('login');
    }
}
