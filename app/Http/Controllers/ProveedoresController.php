<?php

namespace App\Http\Controllers;

use App\Http\Requests\proveedoresRequest;
use App\Proveedores;
use Illuminate\Http\Request;

class ProveedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proveedores = Proveedores::all();
        return view('proveedores.RProveedores')->with(compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $giros = \DB::select('Select * from giros');
        $formas = \DB::select('Select * from formas_pagos');
        $clasificacion = \DB::select('Select * from clasificacion');
        return view('proveedores.FProveedores')->with(compact('clasificacion'))->with(compact('giros'))->with(compact('formas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(proveedoresRequest $request)
    {
        $proveedor = new Proveedores();
        $proveedor->Nombre = $request->nombre;
        $proveedor->Clave = $request->clave;
        $proveedor->Calle = $request->calle;
        $proveedor->NExt = $request->next;
        $proveedor->Nint = $request->nInt;
        $proveedor->ECalle = $request->ecalle;
        $proveedor->ECalle2 = $request->ecalle2;
        $proveedor->Colonia = $request->colonia;
        $proveedor->CP = $request->CP;
        $proveedor->Pais = $request->pais;
        $proveedor->Estado = $request->estado;
        $proveedor->Municipio = $request->ciudad;
        $proveedor->Poblacion = $request->poblacion;
        $proveedor->Nacionalidad = $request->nacionalidad;
        $proveedor->Clasificacion = $request->clasificacion;
        $proveedor->Giro = $request->giro;
        $proveedor->RFC = $request->rfc;
        $proveedor->Curp = $request->curp;
        $proveedor->DiasCredito = $request->dias;
        $proveedor->Saldo    = $request->saldo;
        $proveedor->Limite = $request->limite;
        $proveedor->Forma = $request->forma;
        $proveedor->Titular = $request->titular;
        $proveedor->Banco = $request->banco;
        $proveedor->Sucursal = $request->sucursal;
        $proveedor->Cuenta = $request->cuenta;
        $proveedor->Clabe = $request->clabe;
        $proveedor->Telefono = $request->telefono;
        $proveedor->Fax = $request->fax;
        $proveedor->Email = $request->email;
        $proveedor->Pagina = $request->web;
        $proveedor->save();
        \App\Helpers\AuxFunction::instance()->movimientoNuevo("Proveedor $request->nombre agregado.", "Proveedores");
        return back()->with('success', "Proveedor agregado con éxito.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\compradores  $compradores
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $giros = \DB::select('Select * from giros');
        $formas = \DB::select('Select * from formas_pagos');
        $clasificacion = \DB::select('Select * from clasificacion');

        $proveedor = Proveedores::find($id);
        $proveedor->Municipio =  \DB::select('Select * from cities where id=?',[$proveedor->Municipio]);
        $proveedor->Estado = \DB::select('Select * from states where id=?',[$proveedor->Estado]);
        $proveedor->Pais =  \DB::select('Select * from countries where id=?',[$proveedor->Pais]);
        return view('proveedores.SProveedores')->with(compact('proveedor'))->with(compact('clasificacion'))->with(compact('giros'))->with(compact('formas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\compradores  $compradores
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\compradores  $compradores
     * @return \Illuminate\Http\Response
     */
    public function update(proveedoresRequest $request, $id)
    {
        $proveedor = Proveedores::find($id);
        $proveedor->Nombre = $request->nombre;
        $proveedor->Clave = $request->clave;
        $proveedor->Calle = $request->calle;
        $proveedor->NExt = $request->next;
        $proveedor->Nint = $request->nInt;
        $proveedor->ECalle = $request->ecalle;
        $proveedor->ECalle2 = $request->ecalle2;
        $proveedor->Colonia = $request->colonia;
        $proveedor->CP = $request->CP;
        $proveedor->Pais = $request->pais;
        $proveedor->Estado = $request->estado;
        $proveedor->Municipio = $request->municipio;
        $proveedor->Poblacion = $request->poblacion;
        $proveedor->Nacionalidad = $request->nacionalidad;
        $proveedor->Clasificacion = $request->clasificacion;
        $proveedor->Giro = $request->giro;
        $proveedor->RFC = $request->rfc;
        $proveedor->Curp = $request->curp;
        $proveedor->DiasCredito = $request->dias;
        $proveedor->Saldo    = $request->saldo;
        $proveedor->Limite = $request->limite;
        $proveedor->Forma = $request->forma;
        $proveedor->Titular = $request->titular;
        $proveedor->Banco = $request->banco;
        $proveedor->Sucursal = $request->sucursal;
        $proveedor->Cuenta = $request->cuenta;
        $proveedor->Clabe = $request->clabe;
        $proveedor->Telefono = $request->telefono;
        $proveedor->Fax = $request->fax;
        $proveedor->Email = $request->email;
        $proveedor->Pagina = $request->web;
        $proveedor->save();
        \App\Helpers\AuxFunction::instance()->movimientoNuevo("Proveedor $request->nombre actualizado.", "Proveedor");
        return redirect('proveedores')->with('success', "Proveedor actualizado con éxito.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\compradores  $compradores
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proveedor = Proveedores::find($id);
        $proveedor = $proveedor->Nombre;
        Proveedores::destroy($id);
        \App\Helpers\AuxFunction::instance()->movimientoNuevo("Proveedor $proveedor eliminado.", "Proveedor");
        return redirect('proveedores')->with('success', "Proveedor $proveedor eliminado con éxito.");
    }
}
