<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class empresas
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
        $role =1; //Número de rol
        if (!Auth::check()) {
            return redirect()->route('login'); //Página a la que se redireccionará si no se válida el inicio de sesión.
        }
        $roles= Auth::user()->role;
        $roles= explode(",",$roles); //Código para sacar los permisos que tiene asignado el usuario.

        if (in_array($role, $roles)) {
            return $next($request); //Si el $role se encuentra entre los permisos del usuario se redireccionará a la página deseada.
        }else {
            return redirect()->route('home')->withErrors(['No tienes permisos para acceder a esta aplicación']); //En caso de que no redireccionará a la página principal.
        }
    }
}
