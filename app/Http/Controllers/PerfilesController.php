<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class PerfilesController extends Controller
{
    public function eventos(Request $request)
    {
        $evento = DB::insert(
            'insert into EVENTOS (Nombre, Descripcion,Inicio,Fin,id_usuario, created_at, updated_at) values (?, ?, ?, ?, ?,?,?)',
            [$request->evento, $request->descripcion, $request->start, $request->end,  Auth::user()->id, date('Y-m-d h:i:s'), date("Y-m-d h:i:s")]
        );
        return back();
    }
    public function destroy($id){
        DB::delete('delete from eventos where id = ? and id_usuario = ?', [$id,Auth::user()->id]);
        return back();
    }
    public function show()
    {
        $usuarios = User::find(Auth::user()->id);
        $eventosR = DB::select('select * from eventos where id_usuario = ?', [Auth::user()->id]);
        $eventos = array();
        $meses = array('','Enero', 'Febrero' , 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre','Noviembre', 'Diciembre');
        foreach ($eventosR as $evento) {
            $eventoTemp = new stdClass();
            $eventoTemp->title = $evento->Nombre;
            $eventoTemp->description = $evento->Descripcion;
            $eventoTemp->start = $evento->Inicio;
            $eventoTemp->end = $evento->Fin;
            $eventoTemp->id =$evento->id;
            $eventoTemp->inicio =date('d',strtotime($evento->Inicio))." de ".$meses[date('n', strtotime($evento->Inicio))]." del ".date('Y',strtotime($evento->Fin));
            $evento->Fin= date('d-m-Y', strtotime('-1 day', strtotime($evento->Fin)));;
            $eventoTemp->fin =date('d',strtotime($evento->Fin))." de ".$meses[date('n', strtotime($evento->Fin))]." del ".date('Y',strtotime($evento->Fin));
            array_push($eventos, $eventoTemp);
        }
        $eventos = json_encode($eventos);


        return view('Perfiles.RPerfiles')->with(compact('usuarios'))->with(compact('eventos'));
    }
}
