<?php

namespace App\Http\Controllers;

use App\departamentos as Departamentos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartamentosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $departamentos = DB::select('select D.id,D.Nombre, U.Nombre as Ubicacion from departamentos D inner join ubicaciones U where D.ubicacion=U.ID');
        return view('departamentos.RDepartamentos')->with(compact('departamentos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ubicaciones = DB::select('select * from ubicaciones');
        return view('departamentos.FDepartamentos')->with(compact('ubicaciones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $departamento = new Departamentos();
        $existe= DB::select('select * from departamentos where Nombre = ? and Ubicacion = ?',[$request->nombre, $request->ubicacion]);
        if(isset($existe[0]))
            return back()->withErrors('Este departamento ya existe.');
        $departamento->Nombre = $request->nombre;
        $departamento->Ubicacion = $request->ubicacion;
        $departamento->save();
        \App\Helpers\AuxFunction::instance()->movimientoNuevo("Departamento $request->nombre agregado.","Administrador");
        return back()->with('success', "Departamento agregado con éxito.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\compradores  $compradores
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $departamento = Departamentos::find($id);
        $ubicaciones = DB::select('select * from ubicaciones');
        return view('departamentos.SDepartamentos')->with(compact('ubicaciones'))->with(compact('departamento'));
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
        $departamento=Departamentos::find($id);
        $departamento->Nombre = $request->nombre;
        $departamento->save();
        \App\Helpers\AuxFunction::instance()->movimientoNuevo("Departamento $request->nombre actualizado.","Administrador");
        return redirect('departamentos')->with('success', "Departamento actualizado con éxito.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\compradores  $compradores
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $departamento=Departamentos::find($id);
        $departamento = $departamento->Nombre;
        Departamentos::destroy($id);
        \App\Helpers\AuxFunction::instance()->movimientoNuevo("Departamento $departamento eliminado.","Administrador");
        return redirect('departamentos')->with('success', "Departamento $departamento eliminado con éxito.");
    }
}
