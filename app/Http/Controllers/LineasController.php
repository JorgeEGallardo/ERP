<?php

namespace App\Http\Controllers;

use App\articulos;
use App\Grupos;
use App\Http\Requests\lineasRequest;
use App\Lineas;
use Illuminate\Http\Request;

class LineasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lineas = Lineas::all();
        return view('Articulos.Lineas.RLineas')->with(compact('lineas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grupos=Grupos::all();
        return view('Articulos.Lineas.FLineas')->with(compact('grupos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(lineasRequest $request)
    {
        $linea = new Lineas;
        $linea->Clave = Grupos::find($request->grupo)->Clave.$request->clave;
        $linea->Nombre = $request->nombre;
        $linea->id_grupo = $request->grupo;

        $aExists = Lineas::where('Clave', $linea->Clave)->where('id','<>',$linea->id)->get();
        if (!isset($aExists[0])) {
            $linea->save();
            \App\Helpers\AuxFunction::instance()->movimientoNuevo("Artículo $request->clave agregado.", "Administrador");
            return back()->with('success', "Línea agregada con éxito.");
        } else {
            return back()->withErrors("Ya existe una línea con esa clave.");
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lineas  $lineas
     * @return \Illuminate\Http\Response
     */
    public function show( $lineas)
    {

        $linea = Lineas::find($lineas);
        $grupos = Grupos::all();
        $grupo = Grupos::find($linea->id_grupo);
        $linea->Clave = substr($linea->Clave,strlen($grupo->Clave));
        return view('Articulos.Lineas.SLineas')->with(compact('linea'))->with(compact('grupos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lineas  $lineas
     * @return \Illuminate\Http\Response
     */
    public function edit($lineas)
    {
        $linea = Lineas::find($lineas);
        return view('Articulos.Lineas.SLineas')->with(compact('linea'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lineas  $lineas
     * @return \Illuminate\Http\Response
     */
    public function update(lineasRequest $request, $lineas)
    {
        $linea = Lineas::find($lineas);
        $articulos = articulos::where('id_linea',$lineas)->get();


        $request->clave = Grupos::find($request->grupo)->Clave.$request->clave;

        $aExists = Lineas::where('clave', $request->clave)->where('id','<>',$request->id)->get();
        if (isset($aExists[0])) {
            return back()->withErrors("Ya existe una línea con esa clave.");
        }
        foreach($articulos as $articulo){
            $articulo::find($articulo->id);
            $articulo->Clave = substr($articulo->Clave,strlen($linea->Clave));
            $articulo->Clave = $request->clave.$articulo->Clave;
            $articulo->save();
        }
        $linea->id_grupo = $request->grupo;
        $linea->Clave = $request->clave;
        $linea->Nombre = $request->nombre;
        $linea->save();
        return redirect('/lineas')->with('success','Línea actualizada con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lineas  $lineas
     * @return \Illuminate\Http\Response
     */
    public function destroy($lineas)
    {
        Lineas::destroy($lineas);
        return back()->with('success','La línea se ha eliminado con éxito.');
    }
}
