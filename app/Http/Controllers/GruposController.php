<?php

namespace App\Http\Controllers;

use App\articulos;
use App\Grupos;
use App\Http\Requests\gruposRequest;
use App\Lineas;
use Exception;
use Illuminate\Http\Request;

class GruposController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grupos = Grupos::all();
        return view('Articulos.Grupos.RGrupos')->with(compact('grupos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Articulos.Grupos.FGrupos');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(gruposRequest $request)
    {
        $grupo = new Grupos;
        $grupo->Clave = $request->clave;
        $grupo->Nombre = $request->nombre;
        $grupo->save();
        return back()->with('success', 'El grupo se ha agregado con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Grupos  $grupos
     * @return \Illuminate\Http\Response
     */
    public function show( $grupos)
    {
        $grupo = Grupos::find($grupos);
        return view('Articulos.Grupos.SGrupos')->with(compact('grupo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Grupos  $grupos
     * @return \Illuminate\Http\Response
     */
    public function edit($grupos)
    {
        $grupo = Grupos::find($grupos);
        return view('Articulos.Grupos.SGrupos')->with(compact('grupo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Grupos  $grupos
     * @return \Illuminate\Http\Response
     */
    public function update(gruposRequest $request, $grupos)
    {
        $grupo = Grupos::find($grupos);
        $lineas = Lineas::where('id_grupo',$grupos)->get();
        if($grupo->Clave=="")
            return redirect('/grupos')->withErrors('Este elemento no se puede editar.');
        foreach($lineas as $linea){
            $articulos  = articulos::where('id_linea',$linea->id)->get();
            foreach($articulos as $articulo){
                $articulo::find($articulo->id);
                $articulo->Clave = substr($articulo->Clave,strlen($grupo->Clave));
                $articulo->save();
            }
            $linea::find($linea->id);
            $linea->Clave = substr($linea->Clave,strlen($grupo->Clave));
            $linea->Clave = $request->clave.$linea->Clave;
            $linea->save();
            foreach($articulos as $articulo){
                $articulo::find($articulo->id);
                $articulo->Clave = $request->clave.$articulo->Clave;
                $articulo->save();
            }
        }

        $grupo->Clave = $request->clave;
        $grupo->Nombre = $request->nombre;
        $grupo->save();
        return redirect('/grupos')->with('success','Grupo actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Grupos  $grupos
     * @return \Illuminate\Http\Response
     */
    public function destroy($grupos)
    {
        try{
            Grupos::destroy($grupos);
            return back()->with('success','El grupo se ha eliminado con éxito.');
        }catch(Exception $e){
            return back()->withErrors("El grupo esta ligado a una o más líneas. No puede ser eliminado.");
        }
        return back()->withErrors("El grupo esta ligado a una o más líneas. No puede ser eliminado.");

    }
}
