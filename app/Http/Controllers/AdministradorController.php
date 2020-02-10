<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use Illuminate\Http\Request;

class AdministradorController extends Controller
{
    public function index(){
        $roles = \DB::select('select * from roles');
        $tipos = \DB::select('select * from tipos_series');
        $usuariosSeries = \DB::select('select * from users');
        foreach ($usuariosSeries as $usuario) {
            $series =  \DB::select('select S.Nombre, T.Nombre as tipo from tipos_series T inner join series S inner join users U
            where S.id_usuario = U.id and S.id_tipo = T.id and U.id = ?', [$usuario->id]);
            $str = "";
            foreach ($series as $serie) {
                $str = $str.$serie->Nombre."[".$serie->tipo."],";
            }
            $usuario->role = $str;
        }
        $series = \DB::select('select U.name as Nombre,S.id ,U.email as Email, T.Nombre as Tipo, S.Nombre as Serie from users U inner
        join tipos_series T inner join series S where T.id = S.id_tipo and S.id_usuario = u.id');

        $usuariosRoles = \DB::select('select * from users');

        foreach ($usuariosRoles as $usuario) {


            $rolesS = explode(",", $usuario->role);
$str ="";
            foreach ($rolesS as $rol) {

                $rolN = \DB::select('select Nombre from roles where id = ?', [$rol]);
                if(isset($rolN[0]))
                $str = $str.$rolN[0]->Nombre.",";
            }
            $usuario->role = $str;
        }



        return view('admin')->with(compact('roles'))->with(compact('tipos'))->with(compact('series'))->with(compact('usuariosSeries'))->with(compact('usuariosRoles'));

}
}
