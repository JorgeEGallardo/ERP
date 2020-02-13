<?php

namespace App\Http\Controllers;

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
        return view('proveedores.FProveedores');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
        $proveedor->Forma = $request->Forma;
        $proveedor->Forma = isset($request->Forma) ? $request->Forma : '0';
        return $proveedor->Forma;
        $proveedor->Titular = $request->titular;
        $proveedor->Banco = $request->banco;
        $proveedor->Sucursal = $request->sucursal;
        $proveedor->Cuenta = $request->cuenta;
        $proveedor->Clabe = $request->clabe;
        $proveedor->Telefono = $request->telefono;
        $proveedor->Fax = $request->fax;
        $proveedor->Email = $request->email;
        $proveedor->Pagina = $request->Web;
        $proveedor->save();
        \App\Helpers\AuxFunction::instance()->movimientoNuevo("Proveedor $request->nombre agregado.", "Administrador");
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
        $proveedor = Proveedores::find($id);
        return view('proveedores.SProveedores')->with(compact('proveedor'));
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
    public function update(Request $request, $id)
    {
        $proveedor = Proveedores::find($id);
        $proveedor->Nombre = $request->nombre;
        $proveedor->save();
        \App\Helpers\AuxFunction::instance()->movimientoNuevo("Proveedor $request->nombre actualizado.", "Administrador");
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
        \App\Helpers\AuxFunction::instance()->movimientoNuevo("Proveedor $proveedor eliminado.", "Administrador");
        return redirect('proveedores')->with('success', "Proveedor $proveedor eliminado con éxito.");
    }
}
