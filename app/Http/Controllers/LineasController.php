<?php

namespace App\Http\Controllers;

use App\articulos;
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
        return view('Articulos.Lineas.FLineas');
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
        $linea->Clave = $request->clave; 
        $linea->Nombre = $request->nombre; 
        $linea->save();
        return back()->with('success', 'La línea se ha agregado con éxito.'); 
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
        return view('Articulos.Lineas.SLineas')->with(compact('linea'));
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
        foreach($articulos as $articulo){
            $articulo::find($articulo->id);
            $articulo->Clave = substr($articulo->Clave,strlen($linea->Clave));
            $articulo->Clave = $request->clave.$articulo->Clave;
            $articulo->save();
        }
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