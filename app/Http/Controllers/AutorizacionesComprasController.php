<?php

namespace App\Http\Controllers;

use App\autorizacionesCompras;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AutorizacionesComprasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = DB::select('select A.id,A.LimiteInferior, A.LimiteSuperior, U.Nombre from autorizaciones_compras A inner join tipos_usuarios U
        where U.ID= A.id_tipo_usuario');
        return view('AutorizacionesCompras.RAutorizacionesCompras')->with(compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usuarios = DB::select('select * from tipos_usuarios');
        return view('AutorizacionesCompras.FAutorizacionesCompras')->with(compact('usuarios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $autorizacion = new autorizacionesCompras();
        $autorizacion->LimiteInferior = $request->linferior;
        $autorizacion->LimiteSuperior = $request->lsuperior;
        $autorizacion->id_tipo_usuario = $request->usuario;
        $autorizacion->save();
        return redirect('autorizacionesCompras')->with('success','Autorización de compra agregada con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\autorizacionesCompras  $autorizacionesCompras
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $autorizacion = autorizacionesCompras::find($id);
        $usuarios = DB::select('select * from tipos_usuarios');
        return view('AutorizacionesCompras.SAutorizacionesCompras')->with(compact('autorizacion'))->with(compact('usuarios'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\autorizacionesCompras  $autorizacionesCompras
     * @return \Illuminate\Http\Response
     */
    public function edit(autorizacionesCompras $autorizacionesCompras)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\autorizacionesCompras  $autorizacionesCompras
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        $autorizacion = autorizacionesCompras::find($id);
        $autorizacion->LimiteInferior = $request->linferior;
        $autorizacion->LimiteSuperior = $request->lsuperior;
        $autorizacion->id_tipo_usuario = $request->usuario;
        $autorizacion->save();
        return redirect('autorizacionesCompras')->with('success','Autorización de compra actualizada con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\autorizacionesCompras  $autorizacionesCompras
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        autorizacionesCompras::destroy($id);
        return redirect('autorizacionesCompras')->with('success','Registro eliminado con éxito.');
        }
}
