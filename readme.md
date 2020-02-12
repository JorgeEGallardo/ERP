<h2>Instalación del sistema</h2>
En una carpeta vacia clonar este repositorio. Correr el comando composer install. Copiar a la carpeta raiz el archivo .ENV único para que se pueda conectar a la base de datos.<i>En caso de que no se cuente con acceso al .ENV del sistema principal y solo se quiera hacer una modificación cambiar el .ENVEXAMPLE A .ENV y llenar este con los datos del servidor local en este repositorio se puede encontrar un archivo .sql para importar la base de datos.</i> 

<h2>Agregar un nuevo tipo de usuario</h2> 
Cada tipo nuevo de usuario lleva un número de rol, un midleware y un controller. 

```
php artisan make:middleware usuarionuevo
php artisan make:controller usuarionuevoController 
```
En el middleware recien creado agregamos "use Auth" debajo del namespace esto para comprobar que si se haya iniciado sesión.  
Cambiar la funcion handle() por 
```
	$role = 1; //Número de rol
        if (!Auth::check()) {
            return redirect()->route('login'); //Página a la que se redireccionará si no se válida el inicio de sesión.
        }
        $method = $request->method();
        $roles = Auth::user()->role;
        $roles = explode(",", $roles); //Código para sacar los roles que tiene asignado el usuario.
        if (in_array($role, $roles)) {
            if ($method=="GET")
                return $next($request); //Si el $role se encuentra entre los roles del usuario se redireccionará a la página deseada.
            else if (in_array(2, $roles)&&$method=="POST")
                return $next($request); //Si el $role se encuentra entre los roles del usuario se redireccionará a la página deseada.
            else if (in_array(3, $roles)&&$method=="DELETE")
                return $next($request); //Si el $role se encuentra entre los roles del usuario se redireccionará a la página deseada.
            else if (in_array(4, $roles)&&$method=="PUT")
                return $next($request); //Si el $role se encuentra entre los roles del usuario se redireccionará a la página deseada.
            else
                return redirect()->back()->withErrors(['No tienes permisos para realizar esta acción']);
        } else {
            return redirect()->back()->withErrors(['No tienes permisos para acceder a esta aplicación']); //En caso de que no redireccionará a la página principal.
        }
        
```
Para que Laravel entienda que el código va a controlar el acceso de usuarios es necesario registrarlo en el archivo app/Http/Kernel.php como un elemento mas del arreglo $routeMiddleware. 

````
'usuarionuevo' => \App\Http\Middleware\usuarionuevo::class,
````
En el controllador basta con crear las funciones que necesite ese tipo de usuario (acceder a cierta página, insertar cierta información).    
[Agregar el nombre del nuevo tipo de usuario al arreglo: ]    

Por último es necesario apuntar el controlador y el middleware en el archivo routes/web.php   
```

Route::get('/urlParaIngresar', 'usuarionuevoController@index')->name('usuarionuevo')->middleware('usuarionuevo');
````
<h2>roles</h2>
<ol>
    <li>Empresas</li>
    <li>Compradores</li>
    <li>Departamentos</li>
    <li>Proveedores</li>
    <li>Articulos</li>
    <li>Requisiciones</li>
    <li>Autorizaciones</li>
    <li>roles</li>
</ol>
