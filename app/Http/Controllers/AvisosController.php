<?php

namespace App\Http\Controllers;
use Auth;
use App\Avisos;
use Illuminate\Http\Request;

class AvisosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $aviso = new Avisos(); 
        $aviso->usuario = Auth::user()->name;
        $aviso->titulo = $request->titulo; 
        $aviso->mensaje=$request->mensaje;
        $aviso->tipo=$request->tipo; 
        $aviso->save();
        return redirect('/control');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Avisos  $avisos
     * @return \Illuminate\Http\Response
     */
    public function show(Avisos $avisos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Avisos  $avisos
     * @return \Illuminate\Http\Response
     */
    public function edit(Avisos $avisos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Avisos  $avisos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Avisos $avisos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Avisos  $avisos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Avisos $avisos)
    {
        //
    }
}
