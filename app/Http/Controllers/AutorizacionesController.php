<?php

namespace App\Http\Controllers;

use App\autorizaciones;
use App\User;
use Autorizaciones as GlobalAutorizaciones;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AutorizacionesController extends Controller
{
    function update($id, Request $request){
        try{
        DB::delete('delete from autorizaciones where id_usuario = ?', [$id]);
        $autorizacion = new autorizaciones();
        foreach ($request->departamentos as $departamento) {
            $autorizacion = new autorizaciones();
            $autorizacion->id_departamento=$departamento;
            $autorizacion->id_usuario=$id;
            $autorizacion->save();
        }
    }catch(Exception $e){

    }

        return redirect('/autorizaciones')->with('success', 'Autorizaciones actualizadas correctamente.');
    }
    function index(){
        $users = \DB::select('select * from users');
        $autorizadores = array();
        foreach ($users as $usuario) {
            $rolesS = explode(",", $usuario->role);
            $rol = env('AUTORIZADOR');
            if(in_array($rol, $rolesS))
                array_push($autorizadores, $usuario);

        }
        foreach ($autorizadores as $usuario) {
            $autorizacion = DB::select('SELECT D.Nombre, U.Nombre as ubicacion from autorizaciones A inner join departamentos d inner join ubicaciones u where A.id_departamento = d.id and d.Ubicacion = u.ID and a.id_usuario = ?', [$usuario->id]);
            $str="";
            foreach($autorizacion as $aut){
                $str = $str.$aut->Nombre."-".$aut->ubicacion.", ";
            }
            $usuario->id_departamento = $str;
        }
        $usuarios = $autorizadores;

        return view('Autorizaciones.RAutorizaciones')->with(compact('usuarios'));

}
    function show($id){
        /* <select class="form-control" name="autorizador">
        @foreach($autorizadores as $autorizador)
        <option type="text" class="form-control" value="{{ $autorizador->id }}" placeholder="Ubicacion" required>
            {{$autorizador->name}}
        </option>
        @endforeach
    </select>
        $users = \DB::select('select * from users');
        $autorizadores = array();
        foreach ($users as $usuario) {
            $rolesS = explode(",", $usuario->role);
            $rol = env('AUTORIZADOR');
            if(in_array($rol, $rolesS))
                array_push($autorizadores, $usuario);
        }
        */
        $ubicaciones = DB::select('select * from ubicaciones');
        $ADepartamentos = array();
        $AUbicaciones = array();
        foreach($ubicaciones as $ubicacion){
            $departamento = DB::select('select * from departamentos where ubicacion = ?', [$ubicacion->ID]);
            array_push($ADepartamentos, $departamento);
            array_push($AUbicaciones, $ubicacion);
        }
        $user = User::find($id);

        $autorizacionesS = DB::select('select id_departamento from autorizaciones where id_usuario =?', [$id]);
        $autorizaciones = array();
        foreach ($autorizacionesS as $autorizacion) {
            array_push( $autorizaciones,$autorizacion->id_departamento);
        }
        return view('Autorizaciones.SAutorizaciones')->with(compact('autorizaciones'))->with('user', $user)->with(compact('ADepartamentos'))->with(compact('AUbicaciones'))/*->with(compact('autorizadores'))*/;
    }
}
