<h2>Agregar un nuevo tipo de usuario</h2> 
Cada tipo nuevo de usuario lleva un número de rol, un midleware y un controller. 

```
php artisan make:middleware usuarionuevo
php artisan make:controller usuarionuevoController 
```
En el middleware recien creado agregamos "use Auth" debajo del namespace esto para comprobar que si se haya iniciado sesión.  
Cambiar la funcion handle() por 
```
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
```
En el controllador basta con crear las funciones que necesite ese tipo de usuario (acceder a cierta página, insertar cierta información).    
[Agregar el nombre del nuevo tipo de usuario al arreglo: ]    

Por último es necesario apuntar el controlador y el middleware en el archivo routes/web.php   
```

Route::get('/urlParaIngresar', 'usuarionuevoController@index')->name('usuarionuevo')->middleware('usuarionuevo');
````
<h2>Permisos</h2>
<ol>
    <li>Empresas</li>
    <li>Compradores</li>
    <li>Departamentos</li>
    <li>Proveedores</li>
    <li>Articulos</li>
    <li>Requisiciones</li>
    <li>Autorizaciones</li>
    <li>Permisos</li>
</ol>
