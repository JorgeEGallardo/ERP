<?php

namespace App\Http\Controllers;

use App\Avisos;
use App\Http\Requests\seriesRequest;
use App\Movimientos;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class AdministradorController extends Controller
{
    public function index() //Tablas del panel de administrador
    {
        $avisos = Avisos::all();
        $movimientos = Movimientos::orderBy('created_at', 'ASC')->get();
        $roles = \DB::select('select * from roles');
        $giros = \DB::select('select * from giros');
        $ubicaciones = \DB::select('select * from ubicaciones');
        $tiposUsuarios = \DB::select('select * from tipos_usuarios');
        $clasificaciones = \DB::select('select * from clasificacion');
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
        $usuariosTipos = \DB::select('select * from USERS');
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
        foreach ($usuariosTipos as $usuario) {
            $rolesS = explode(",", $usuario->role);
            $str = "";
            foreach ($rolesS as $rol) {
                $rolN = \DB::select('select Nombre from tipos_usuarios where id = ?', [$rol]);
                if (isset($rolN[0]))
                    $str = $str . $rolN[0]->Nombre . ",";
            }
            $usuario->role = $str;
        }
        return view('admin')->with(compact('tiposUsuarios'))
            ->with(compact('ubicaciones'))
            ->with(compact('clasificaciones'))
            ->with(compact('giros'))
            ->with(compact('movimientos'))
            ->with(compact('roles'))
            ->with(compact('tipos'))
            ->with(compact('series'))
            ->with(compact('usuariosSeries'))
            ->with(compact('usuariosRoles'))
            ->with(compact('usuariosTipos'))
            ->with(compact('avisos'));
    }

    public function seriesView($id) //Regresa todas las series ligadas a un usuario
    {
        $series = \DB::select('select S.id, S.Nombre,T.Nombre as Tipo from series S inner join tipos_Series T where S.id_usuario = ? and S.id_tipo = T.id', [$id]);
        $tipos = \DB::select('select * from tipos_series');
        return view('Auth.FSUsuarios')->with(compact('series'))->with('id', $id)->with(compact('tipos'));
    }

    public function rolesView($id, $user = null) //Regresa todos los permisos ligados a un usuario
    {
        $usuarios = \DB::select('select * from users');
        $roles = \DB::select('select * from roles');
        $tiposUsuarios = \DB::select('select * from tipos_usuarios');
        $rolesUsuario = \DB::select('select role from users where id=?', [$id]);
        $rolesUsuario = explode(",", $rolesUsuario[0]->role);
        if (isset($user))
            $id = $user;
        return view('Auth.FPUsuarios')->with(compact('usuarios'))->with(compact('roles'))->with(compact('rolesUsuario'))->with('id', $id)->with(compact('tiposUsuarios'));
    }

    public function permisosEdit($id, Request $request) //Actualiza los permisos de un usuario
    {
        $usuario = User::find($id);
        $roles = explode(',', $usuario->role);
        if (!isset($roles))
            $roles = array();
        try {

            if (isset($request->roles)) {
                if (in_array('101', $roles))
                    $roles = array_merge($request->roles, ['101']);
                else
                    $roles = $request->roles;
                $usuario->role = implode(",", $roles);
            } else
            if (in_array('101', $roles))
                $usuario->role = "101";
            else
                $usuario->role = "";

            $usuario->save();
            \App\Helpers\AuxFunction::instance()->movimientoNuevo("Cambio de permisos al usuario " . "$usuario->name", "Administrador");

            return redirect('/control')->with('success', "Permisos actualizados con éxito.");
        } catch (Exception $e) {
            return redirect('/control')->withErrors('Hubó un error al intentar actualizar los permisos' . $e);
        }
    }

    public function serieStore($id, seriesRequest $request) //Crea una nueva serie
    {
        $rel = false;
        $series = \DB::select('select S.id, S.Nombre,T.Nombre as Tipo from series S inner join tipos_Series T where S.id_usuario = ? and S.id_tipo = T.id', [$id]);
        $tipos = \DB::select('select * from tipos_series');
        try {
            $rel = \DB::insert('insert into series (Nombre, id_tipo, id_usuario) values (?, ?, ?)', [$request->Nombre, $request->tipo, $id]);
            \App\Helpers\AuxFunction::instance()->movimientoNuevo("Nueva serie agregada para el usuario " . "$id", "Administrador");
        } catch (Exception $e) {
            return back()->withErrors(['La serie no se pudó asignar.'])->with(compact('series'))->with('id', $id)->with(compact('tipos'));
        }
        if ($rel)
            return back()->with('success', "Serie asignada correctamente")->with(compact('series'))->with('id', $id)->with(compact('tipos'));
    }

    public function serieDestroy($id) //Elimina una serie
    {
        $rel = false;
        $series = \DB::select('select S.id, S.Nombre,T.Nombre as Tipo from series S inner join tipos_Series T where S.id_usuario = ? and S.id_tipo = T.id', [$id]);
        $tipos = \DB::select('select * from tipos_series');
        try {
            $serie = \App\series::find($id);
            $serie = $serie->Nombre;
            $rel = \DB::delete('delete from series where id=?', [$id]);

            \App\Helpers\AuxFunction::instance()->movimientoNuevo("Serie eliminada $serie ", "Administrador");
        } catch (Exception $e) {
            return back()->withErrors(['La serie no se pudó borrar.'])->with(compact('series'))->with('id', $id)->with(compact('tipos'));
        }
        if ($rel)
            return back()->with('success', "Serie eliminada correctamente")->with(compact('series'))->with('id', $id)->with(compact('tipos'));
    }

    public function permisosCreate(Request $request) //Crea un nuevo permiso
    {
        $rel = false;
        try {
            $rel = \DB::insert('insert into roles (Nombre) values (?)', [$request->Nombre]);
            \App\Helpers\AuxFunction::instance()->movimientoNuevo("Permiso $request->Nombre creado ", "Administrador");
        } catch (Exception $e) {
            return back()->withErrors(['El permiso no pudó ser creado.']);
        }
        if ($rel)
            return back()->with('success', "Permiso creado exitosamente.");
    }

    public function tiposSeriesCreate(Request $request) //Crea un nuevo tipo de serie
    {
        $rel = false;
        try {
            $rel = \DB::insert('insert into tipos_series (Nombre) values (?)', [$request->Nombre]);
            \App\Helpers\AuxFunction::instance()->movimientoNuevo("Tipo $request->Nombre de serie creado ", "Administrador");
        } catch (Exception $e) {
            return back()->withErrors(['El tipo de serie no se pudó crear.']);
        }
        if ($rel)
            return back()->with('success', "Tipo de serie creado correctamente");
    }

    public function clasificacionCreate(Request $request) //Crea un nuevo tipo de serie
    {
        $rel = false;
        try {
            $rel = \DB::insert('insert into clasificacion (Nombre) values (?)', [$request->Nombre]);
            \App\Helpers\AuxFunction::instance()->movimientoNuevo("Clasificación $request->Nombre creada ", "Administrador");
        } catch (Exception $e) {
            return back()->withErrors(['El tipo de clasificación no se pudó crear.']);
        }
        if ($rel)
            return back()->with('success', "Clasificación creada correctamente");
    }
    public function tiposUsuariosCreate(Request $request) //Crea un nuevo tipo de serie
    {
        $rel = false;
        try {
            $rel = \DB::insert('insert into tipos_usuarios (Nombre) values (?)', [$request->Nombre]);
            \App\Helpers\AuxFunction::instance()->movimientoNuevo("El tipo de usuario $request->Nombre creado ", "Administrador");
        } catch (Exception $e) {
            return back()->withErrors(['El tipo de usuario no se pudó crear.']);
        }
        if ($rel)
            return back()->with('success', "Tipo de usuario creado correctamente");
    }
    public function ubicacionesCreate(Request $request) //Crea un nuevo tipo de serie
    {
        $rel = false;
        try {
            $rel = \DB::insert('insert into ubicaciones (Nombre) values (?)', [$request->Nombre]);
            \App\Helpers\AuxFunction::instance()->movimientoNuevo("Ubicación $request->Nombre creada ", "Administrador");
        } catch (Exception $e) {
            return back()->withErrors(['La ubicación no se pudó crear.' . $e]);
        }
        if ($rel)
            return Redirect::to(URL::previous() . "#ubicaciones")->with('success', "Ubicación creada correctamente");
    }
    public function girosCreate(Request $request) //Crea un nuevo tipo de serie
    {


        $rel = false;
        try {
            $rel = \DB::insert('insert into giros (Nombre) values (?)', [$request->Nombre]);
            \App\Helpers\AuxFunction::instance()->movimientoNuevo("Giro $request->Nombre  creado ", "Administrador");
        } catch (Exception $e) {
            return back()->withErrors(['El Giro no se pudó crear.']);
        }
        if ($rel)
            return Redirect::to(URL::previous() . "#giros")->with('success', "Giro creado correctamente");
    }
}
