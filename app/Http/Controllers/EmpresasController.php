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
        $data = empresas::orderBy('id', 'DESC')->get();
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

        $countries = \DB::select('select * from countries');
        return view('empresas/FEmpresas')->with(compact('countries'));
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
        $data = empresas::orderBy('id', 'DESC')->get();
        return redirect('/empresas/create')->with('success', 'La empresa "'.$empresa->Nombre.'" se ha creado con éxito.')->with(compact('data'));

    }




    /**
     * Display the specified resource.
     *
     * @param  \App\empresas  $empresas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    $countries = \DB::select('select * from countries');
       $empresa = empresas::find($id);
       if (!$empresa){
        return redirect('/empresas')->withErrors('No se pudó encontrar esa empresa. ');

       }
       return view('empresas/SEmpresas')
       ->with(compact('empresa'))
       ->with(compact('countries'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\empresas  $empresas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empresa = empresas::find($id);
        return view('empresas/Modal/EditEmpresas')
        ->with(compact('empresa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\empresas  $empresas
     * @return \Illuminate\Http\Response
     */
    public function update(empresasRequest $request, $id)
    {

        $empresa = empresas::find($id);
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
        return redirect()->back()->with('success', 'La empresa "'.$empresa->Nombre.'" se ha actualizado con éxito.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\empresas  $empresas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $empresa = empresas::find($id);
       $name = $empresa->Nombre;
       $empresa->delete();
       return redirect()->back()->with('success', 'La empresa "'.$name.'" se ha eliminado con éxito.');
    }
}
