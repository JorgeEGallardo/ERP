<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class autorizaciones extends Model
{
    protected $fillable=[
        'id_departamento', 'id_usuario'
    ];
}
