<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class empresas extends Model
{
    protected $fillable = [
        'Nombre','RFC','RegistroPatronal','Calle','Numero','Colonia','Ciudad','Estado','Pais','CP','Email','Telefono','Telefono2'
    ];
}
