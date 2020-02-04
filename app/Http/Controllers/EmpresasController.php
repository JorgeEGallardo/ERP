<?php

namespace App\Http\Controllers;

use App\empresas;
use App\Http\Requests\empresasRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Validator;
class EmpresasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = empresas::all();
        return view('empresas/REmpresas')
        ->with(compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empresas/FEmpresas');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(empresasRequest $request)
    {
        //        'Nombre','RFC','RegistroPatronal','Calle','Numero','Colonia','Ciudad','Estado','Pais','CP','Email','Telefono','Telefono2'
        $empresa = new empresas();
        $empresa->Nombre = $request->nombre;
        $empresa->RFC = $request->rfc;
        $empresa->RegistroPatronal = $request->registropatronal;
        $empresa->Calle = $request->calle;
        $empresa->Numero = $request->numero;
        $empresa->Colonia = $request->colonia;
        $empresa->Ciudad = $request->ciudad;
        $empresa->Estado = $request->estado;
        $empresa->Pais = $request->pais;
        $empresa->CP = $request->CP;
        $empresa->Email = $request->email;
        $empresa->Telefono = $request->telefono;
        $empresa->Telefono2 = $request->telefono2;
        $empresa->save();
        return "<h1>Redirección a las tablas con mensaje subido con exito</h1>";

    }




    /**
     * Display the specified resource.
     *
     * @param  \App\empresas  $empresas
     * @return \Illuminate\Http\Response
     */
    public function show(empresas $empresas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\empresas  $empresas
     * @return \Illuminate\Http\Response
     */
    public function edit(empresas $empresas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\empresas  $empresas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, empresas $empresas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\empresas  $empresas
     * @return \Illuminate\Http\Response
     */
    public function destroy(empresas $empresas)
    {
        //
    }
}
