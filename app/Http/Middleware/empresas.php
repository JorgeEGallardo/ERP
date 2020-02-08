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
        $role = 1; //Número de rol
        if (!Auth::check()) {
            return redirect()->route('login'); //Página a la que se redireccionará si no se válida el inicio de sesión.
        }
        $method = $request->method();
        $url = $request->url();
        $roles = Auth::user()->role;
        $roles = explode(",", $roles); //Código para sacar los roles que tiene asignado el usuario.
        $urlE = env('APP_URL')."/empresas";
        if (in_array($role, $roles)) {
            if (in_array(2, $roles) && $url ==$urlE."/empresas2")
                return $next($request); //Si el $role se encuentra entre los roles del usuario se redireccionará a la página deseada.
            else if (in_array(3, $roles))
                return $next($request); //Si el $role se encuentra entre los roles del usuario se redireccionará a la página deseada.
            else if (in_array(4, $roles))
                return $next($request); //Si el $role se encuentra entre los roles del usuario se redireccionará a la página deseada.
            else if (in_array(5, $roles))
                return $next($request); //Si el $role se encuentra entre los roles del usuario se redireccionará a la página deseada.
            else
                return redirect()->back()->withErrors(['No tienes roles para acceder a esta aplicación']);
        } else {
            return redirect()->back()->withErrors(['No tienes roles para acceder a esta aplicación']); //En caso de que no redireccionará a la página principal.
        }
    }
}
