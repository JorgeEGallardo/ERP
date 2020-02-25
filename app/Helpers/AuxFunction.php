<?php

namespace App\Helpers;

use App\Movimientos;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class AuxFunction
{
    public function movimientoNuevo($Nombre, $Categoria)
    {
        $movimientos = new Movimientos();
        $movimientos->Nombre = $Nombre;
        $movimientos->Categoria = $Categoria;
        $movimientos->Usuario = Auth::user()->name;
        $movimientos->save();
    }

    public static function objetoNulo($objeto, $nullable=array())
    {
        $atributos = $objeto->getAttributes();

        foreach ($atributos as $key => $val) {
            if ($val == null && !in_array($key,$nullable)) $atributos[$key] = '0';
        }
        $objeto->setRawAttributes($atributos);
        return $objeto;
    }

    public static function empresaSesion($id)
    {
        \session::put('empresa', $id);
        return back();
    }

    public static function instance()
    {
        return new AuxFunction();
    }
}
