<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
    if (!Auth::check()) {
        return redirect()->route('login'); //Página a la que se redireccionará si no se válida el inicio de sesión.
    }
    $role = 101; //Número de rol

    $roles = Auth::user()->role;
    $roles = explode(",", $roles); //Código para sacar los roles que tiene asignado el usuario.
    if (in_array($role, $roles)) {
        return $next($request); //Si el $role se encuentra entre los roles del usuario se redireccionará a la página deseada.
    }else{
        abort(404);
    }
}
}
