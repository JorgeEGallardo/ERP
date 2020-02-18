<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class autorizacionesCompras extends Model
{
    protected $fillable=[
       'LimiteInferior', 'LimiteSuperior','id_tipo_usuario'
    ];
}
