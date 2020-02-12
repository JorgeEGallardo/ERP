<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class proveedores
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
        $role = 11; //Número de rol
        if (!Auth::check()) {
            return redirect()->route('login'); //Página a la que se redireccionará si no se válida el inicio de sesión.
        }
        $method = $request->method();
        $roles = Auth::user()->role;
        $roles = explode(",", $roles); //Código para sacar los roles que tiene asignado el usuario.
        if (in_array($role, $roles)) {
            if ($method=="GET")
                return $next($request); //Si el $role se encuentra entre los roles del usuario se redireccionará a la página deseada.
            else if (in_array(12, $roles)&&$method=="POST")
                return $next($request); //Si el $role se encuentra entre los roles del usuario se redireccionará a la página deseada.
            else if (in_array(13, $roles)&&$method=="DELETE")
                return $next($request); //Si el $role se encuentra entre los roles del usuario se redireccionará a la página deseada.
            else if (in_array(14, $roles)&&$method=="PUT")
                return $next($request); //Si el $role se encuentra entre los roles del usuario se redireccionará a la página deseada.
            else
                return redirect()->back()->withErrors(['No tienes permisos para realizar esta acción']);
        } else {
            return redirect()->back()->withErrors(['No tienes permisos para acceder a esta aplicación']); //En caso de que no redireccionará a la página principal.
        }
    }
}
