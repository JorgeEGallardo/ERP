<?php
namespace App\Helpers;

use App\Movimientos;
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


     public static function instance()
     {
         return new AuxFunction();
     }
}
