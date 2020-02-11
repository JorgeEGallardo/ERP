<?php

namespace App\Http\Controllers;

use App\Http\Requests\userEditRequest;
use App\Http\Requests\userRequest;
use App\roles as AppRoles;
use App\User;
use Exception;
use Illuminate\Http\Request;
use roles;

class registroController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create()
    {
        $roles = AppRoles::all();
        return view('auth.register')->with(compact('roles'));
    }
    public function store(userRequest $request)
    {
        $usuario = new User();
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = \Hash::make($request->password);
        if (isset($request->roles))
            $usuario->role = implode(",", $request->roles);
        else
            $usuario->role = "";
        $usuario->save();
        $data = AppRoles::all();
        return back()->with('success', 'El usuario se ha creado exitosamente.')->with(compact('data'));;
    }
    public function index()
    {
        $usuarios = \DB::select('select * from users');
        foreach ($usuarios as $usuario) {
            $series =  \DB::select('select S.Nombre, T.Nombre as tipo from tipos_series T inner join series S inner join users U
            where S.id_usuario = U.id and S.id_tipo = T.id and U.id = ?', [$usuario->id]);
            $str = "";
            foreach ($series as $serie) {
                $str = $str . $serie->Nombre . "[" . $serie->tipo . "],";
            }
            $usuario->role = $str;
        }
        return $usuarios;
    }
    public function destroy($id)
    {
        $rel = false;
        try {
            $rel = \DB::delete('delete from users where id =?', [$id]);
        } catch (Exception $e) {
            return back()->withErrors(['El usuario no se pudó eliminar.']);
        }
        if ($rel)
            return back()->with('success', "Usuario eliminado correctamente");
    }
    public function edit($id)
    {
        $usuarios = \DB::select('select * from users where id=?', [$id]);
        return view('auth.SUsuarios')->with(compact('usuarios'))->with('id', $id);
    }
    public function usuarioEdit(userEditRequest $request, $id)
    {
        $usuario = User::find($id);
        if ($request->password) {
            $usuario->name = $request->name;
            $usuario->email = $request->email;
            $usuario->password = \Hash::make($request->password);
            $usuario->save();
            return redirect('/control')->with('success', 'El usuario y contraseña se han actualizado con éxito.');
        }
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->save();
        return redirect('/control')->with('success', 'El usuario se ha actualizado con éxito.');

    }
}
