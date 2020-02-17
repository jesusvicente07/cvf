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

            if($request->is('trayectorias/selecionadas') || $request->is('selecionar/trayectorias') || $request->is('mi/progreso/*')){
                return back();
            }else if(Auth::user()->type == 2 ){
                    if($request->is('editar/coordinador/*') || $request->is('coordinadores') 
                        || $request->is('nuevo/coordinador') ||  $request->is('carreras') ||  $request->is('nueva/carrera') ||  $request->is('editar/carrera/*')
                        || $request->is('mi/progreso/*'))
                    return back();                
                    
                    return $next($request);

            }else{
                return $next($request);
            }
            
        }

        if (Auth::guard('student')->check() ) {

            if($request->is('trayectorias/selecionadas') || $request->is('selecionar/trayectorias') || $request->is('editar/trayectorias/selecionadas/*') || $request->is('/')
                || $request->is('mi/progreso/*')){
                return $next($request);
            }else{
                return redirect('trayectorias/selecionadas');
            }
        }


        return  redirect('login');
    }
}
