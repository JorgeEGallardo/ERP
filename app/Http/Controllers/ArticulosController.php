<?php

namespace App\Http\Controllers;

use App\articulos;
use Illuminate\Http\Request;

class ArticulosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articulos = Articulos::all();
        return view('articulos.RArticulos')->with(compact('articulos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articulos.FArticulos');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $articulo = new Articulos();
        $articulo->Nombre = $request->nombre;
        $articulo->save();
        \App\Helpers\AuxFunction::instance()->movimientoNuevo("Árticulo $request->nombre agregado.", "Árticulos");
        return back()->with('success', "Árticulo agregado con éxito.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\articulos  $articulos
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $articulo = Articulos::find($id);
        return view('articulos.SArticulos')->with(compact('articulo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\articulos  $articulos
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\articulos  $articulos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $articulo = Articulos::find($id);
        $articulo->Nombre = $request->nombre;
        $articulo->save();
        \App\Helpers\AuxFunction::instance()->movimientoNuevo("Árticulo $request->nombre actualizado.", "Administrador");
        return redirect('articulos')->with('success', "Árticulo actualizado con éxito.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\articulos  $articulos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $articulo = Articulos::find($id);
        $articulo = $articulo->Nombre;
        Articulos::destroy($id);
        \App\Helpers\AuxFunction::instance()->movimientoNuevo("Árticulo $articulo eliminado.", "Administrador");
        return redirect('articulos')->with('success', "Árticulo $articulo eliminado con éxito.");
    }
}
