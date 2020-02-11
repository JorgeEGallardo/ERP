<?php

namespace App\Http\Controllers;

use App\Http\Requests\seriesRequest;
use App\User;
use Exception;
use Illuminate\Http\Request;

class AdministradorController extends Controller
{
    public function index()
    {
        $roles = \DB::select('select * from roles');
        $tipos = \DB::select('select * from tipos_series');
        $usuariosSeries = \DB::select('select * from users');
        foreach ($usuariosSeries as $usuario) {
            $series =  \DB::select('select S.Nombre, T.Nombre as tipo from tipos_series T inner join series S inner join users U
            where S.id_usuario = U.id and S.id_tipo = T.id and U.id = ?', [$usuario->id]);
            $str = "";
            foreach ($series as $serie) {
                $str = $str . $serie->Nombre . "[" . $serie->tipo . "],";
            }
            $usuario->role = $str;
        }
        $series = \DB::select('select U.name as Nombre,S.id ,U.email as Email, T.Nombre as Tipo, S.Nombre as Serie from users U inner
        join tipos_series T inner join series S where T.id = S.id_tipo and S.id_usuario = u.id');

        $usuariosRoles = \DB::select('select * from users');

        foreach ($usuariosRoles as $usuario) {


            $rolesS = explode(",", $usuario->role);
            $str = "";
            foreach ($rolesS as $rol) {

                $rolN = \DB::select('select Nombre from roles where id = ?', [$rol]);
                if (isset($rolN[0]))
                    $str = $str . $rolN[0]->Nombre . ",";
            }
            $usuario->role = $str;
        }



        return view('admin')->with(compact('roles'))->with(compact('tipos'))->with(compact('series'))->with(compact('usuariosSeries'))->with(compact('usuariosRoles'));
    }

    public function seriesView($id)
    {
        $series = \DB::select('select S.id, S.Nombre,T.Nombre as Tipo from series S inner join tipos_Series T where S.id_usuario = ? and S.id_tipo = T.id', [$id]);
        $tipos = \DB::select('select * from tipos_series');
        return view('Auth.FSUsuarios')->with(compact('series'))->with('id', $id)->with(compact('tipos'));
    }

    public function rolesView($id)
    {
        $roles = \DB::select('select * from roles');
        $rolesUsuario = \DB::select('select role from users where id=?', [$id]);
        $rolesUsuario = explode(",", $rolesUsuario[0]->role);
        return view('Auth.FPUsuarios')->with(compact('roles'))->with(compact('rolesUsuario'))->with('id', $id);
    }

    public function permisosEdit($id, Request $request)
    {
        $usuario = User::find($id);

        $roles = explode(',',$usuario->role);
        if(in_array('101', $roles))
            $roles = array_merge($request->roles,['101']);
        else
            $roles = $request->roles;
        if (isset($request->roles))
            $usuario->role = implode(",", $roles);
        else
            $usuario->role = "";
        $usuario->save();
        return redirect('/control')->with('success', "Permisos actualizados con éxito.");
    }

    public function serieStore($id, seriesRequest $request)
    {
        $rel = false;

        $series = \DB::select('select S.id, S.Nombre,T.Nombre as Tipo from series S inner join tipos_Series T where S.id_usuario = ? and S.id_tipo = T.id', [$id]);
        $tipos = \DB::select('select * from tipos_series');
        try {
            $rel = \DB::insert('insert into series (Nombre, id_tipo, id_usuario) values (?, ?, ?)', [$request->Nombre, $request->tipo, $id]);
        } catch (Exception $e) {
            return back()->withErrors(['La serie no se pudó asignar.'])->with(compact('series'))->with('id', $id)->with(compact('tipos'));
        }
        if ($rel)
            return back()->with('success', "Serie asignada correctamente")->with(compact('series'))->with('id', $id)->with(compact('tipos'));
    }

    public function serieDestroy($id)
    {
        $rel = false;

        $series = \DB::select('select S.id, S.Nombre,T.Nombre as Tipo from series S inner join tipos_Series T where S.id_usuario = ? and S.id_tipo = T.id', [$id]);
        $tipos = \DB::select('select * from tipos_series');
        try {
            $rel = \DB::delete('delete from series where id=?', [$id]);
        } catch (Exception $e) {
            return back()->withErrors(['La serie no se pudó borrar.'])->with(compact('series'))->with('id', $id)->with(compact('tipos'));
        }
        if ($rel)
            return back()->with('success', "Serie eliminada correctamente")->with(compact('series'))->with('id', $id)->with(compact('tipos'));
    }

    public function permisosCreate(Request $request)
    {
        $rel = false;

        try {
            $rel = \DB::insert('insert into roles (Nombre) values (?)', [$request->Nombre]);
        } catch (Exception $e) {
            return back()->withErrors(['El permiso no pudó ser creado.']);
        }
        if ($rel)
            return back()->with('success', "Permiso creado exitosamente.");
    }

    public function tiposSeriesCreate(Request $request)
    {
        $rel = false;

        try {
            $rel = \DB::insert('insert into tipos_series (Nombre) values (?)', [$request->Nombre]);
        } catch (Exception $e) {
            return back()->withErrors(['El tipo de serie no se pudó crear.']);
        }
        if ($rel)
            return back()->with('success', "Tipo de serie creado correctamente");
    }


}
