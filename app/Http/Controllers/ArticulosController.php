<?php

namespace App\Http\Controllers;

use App\articulos;
use App\Grupos;
use App\Http\Requests\ArticulosRequest;
use App\Lineas;
use App\Proveedores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticulosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articulosO = DB::select('select A.* from articulos A  inner join lineas L where A.id_linea = L.id order by L.id_grupo');
        $articulos = array();
        $linea = "";
        $grupo = "";
        foreach ($articulosO as $articulo) {
            $LineaO = Lineas::find($articulo->id_linea);
            $GrupoO = Grupos::find(Lineas::find($articulo->id_linea)->id_grupo);
            $articulo->id_linea = $LineaO->Nombre;
            $articulo->id_grupo = $GrupoO->Nombre;
          //  $articulo->id_proveedor = Proveedores::find($articulo->id_proveedor)->Nombre;
            if ($grupo != $articulo->id_grupo) {
                $grupo = $articulo->id_grupo;
                $grupoA  = new Articulos();
                $grupoA->id_grupo = $grupo;
                $grupoA->Clave = $GrupoO->Clave . "0000000";
                $grupoA->id = -2;
                array_push($articulos, $grupoA);
            }
            if ($linea != $articulo->id_linea) {
                $linea = $articulo->id_linea;
                $grupo = $articulo->id_grupo;
                $lineaA  = new Articulos();
                $lineaA->id_linea = $linea;
                $lineaA->id_grupo = "$grupo";
                $lineaA->Clave = $LineaO->Clave . "00000";
                $lineaA->id = -1;
                array_push($articulos, $lineaA);
            }
            $articulo->Estado = "Bien";
            if ($articulo->Existencia > $articulo->Maximo)
                $articulo->Estado = "Saturado";
            if ($articulo->Existencia < $articulo->Minimo)
                $articulo->Estado = "Faltante";

            array_push($articulos, $articulo);
        }

        return view('articulos.RArticulos')->with(compact('articulos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lineas = Lineas::all();
        $proveedores = Proveedores::all();
        return view('articulos.FArticulos')->with(compact('lineas'))->with(compact('proveedores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticulosRequest $request)
    {
        $articulo = new Articulos();
        $articulo->Clave = Lineas::find($request->linea)->Clave . $request->clave;;
        $articulo->ClaveAlterna = $request->claveadicional; //Nullable
        $articulo->Descripcion = $request->descripcion;
        $articulo->id_linea = $request->linea;
        $articulo->UnidadEntrada = $request->unidadentrada;
        $articulo->UnidadSalida = $request->unidadsalida;
        $articulo->Factor = $request->factor;
        $articulo->Existencia = $request->existencia;
        $articulo->Minimo = $request->minimo;
        $articulo->Maximo = $request->maximo;
        $articulo->Esquema = $request->esquema;
        $articulo->CostoPromedio = $request->costopromedio;
        $articulo->CostoUltimo = $request->costoultimo;
        $articulo->Volumen = $request->volumen;
        $articulo->Peso = $request->peso;
        $articulo->Precio = $request->precio;
        $articulo->ClaveSat = $request->clavesat;
        $articulo->ClaveUnidad = $request->claveunidad;
        $nullable = array('ClaveAlterna', 'ClaveSat', 'ClaveUnidad');
        $articulo = \App\Helpers\AuxFunction::instance()->objetoNulo($articulo, $nullable);
        $aExists = articulos::where('Clave', $articulo->Clave)->get();
        if (!isset($aExists[0])) {
            $articulo->save();
            \App\Helpers\AuxFunction::instance()->movimientoNuevo("Artículo $request->clave agregado.", "Administrador");
            return back()->with('success', "Artículo agregado con éxito.");
        } else {
            return back()->withErrors("Ya existe un artículo con esa clave.");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\articulos  $articulos
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lineas = Lineas::all();
        $proveedores = Proveedores::all();
        $articulo = Articulos::find($id);

        $linea = Lineas::find($articulo->id_linea);
        $articulo->Clave = substr($articulo->Clave, strlen($linea->Clave));
        return view('articulos.SArticulos')->with(compact('articulo'))->with(compact('lineas'))->with(compact('proveedores'));
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
    public function update(ArticulosRequest $request, $id)
    {
        $linea = Lineas::find($request->linea)->Clave;
        $articulo = Articulos::find($id);
        $articulo->Clave = $linea . $request->clave;
        $articulo->ClaveAlterna = $request->claveadicional; //Nullable
        $articulo->Descripcion = $request->descripcion;
        $articulo->id_linea = $request->linea;
        $articulo->UnidadEntrada = $request->unidadentrada;
        $articulo->UnidadSalida = $request->unidadsalida;
        $articulo->Factor = $request->factor;
        $articulo->Existencia = $request->existencia;
        $articulo->Minimo = $request->minimo;
        $articulo->Maximo = $request->maximo;
        $articulo->Esquema = $request->esquema;
        $articulo->CostoPromedio = $request->costopromedio;
        $articulo->CostoUltimo = $request->costoultimo;
        $articulo->Volumen = $request->volumen;
        $articulo->Peso = $request->peso;
        $articulo->Precio = $request->precio;
        $articulo->ClaveSat = $request->clavesat;
        $articulo->ClaveUnidad = $request->claveunidad;
        $articulo->id_proveedor = $request->proveedor;
        $nullable = array('ClaveAlterna', 'ClaveSat', 'ClaveUnidad', 'FechaUltimaVenta', 'FechaUltimaCompra');
        $articulo = \App\Helpers\AuxFunction::instance()->objetoNulo($articulo, $nullable);
        $aExists = articulos::where('Clave', $articulo->Clave)->where('id','<>',$articulo->id)->get();
        if (!isset($aExists[0])) {
            $articulo->save();
            \App\Helpers\AuxFunction::instance()->movimientoNuevo("Artículo $request->clave agregado.", "Administrador");
            return back()->with('success', "Artículo actualizado con éxito.");
        } else {
            return back()->withErrors("Ya existe un artículo con esa clave.");
        }
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
        \App\Helpers\AuxFunction::instance()->movimientoNuevo("Artículo $articulo eliminado.", "Administrador");
        return redirect('articulos')->with('success', "Artículo $articulo eliminado con éxito.");
    }
}
