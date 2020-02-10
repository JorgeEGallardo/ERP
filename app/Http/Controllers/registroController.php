<?php

namespace App\Http\Controllers;

use App\roles as AppRoles;
use App\User;
use Illuminate\Http\Request;
use roles;

class registroController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create(){
        $roles = AppRoles::all();
        return view('auth.register')->with(compact('roles'));
    }
    public function store(request $request){
        $usuario = new User();
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = \Hash::make($request->password);
        if (isset($request->role))
        $usuario->role= implode( ",", $request->roles );
        else
        $usuario->role = "";
        $usuario->save();
        $data = AppRoles::all();
        return back()->with('success', 'El usuario se ha creado exitosamente.')->with(compact('data'));;
    }
    public function index(){
        $usuarios = \DB::select('select * from users');
        foreach ($usuarios as $usuario) {
            $series =  \DB::select('select S.Nombre, T.Nombre as tipo from tipos_series T inner join series S inner join users U
            where S.id_usuario = U.id and S.id_tipo = T.id and U.id = ?', [$usuario->id]);
            $str = "";
            foreach ($series as $serie) {
                $str = $str.$serie->Nombre."[".$serie->tipo."],";
            }
            $usuario->role = $str;
        }
        return $usuarios;
    }
}
