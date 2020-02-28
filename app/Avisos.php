<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Avisos extends Model
{
    protected $fillable = [
        'titulo', 'mensaje', 'usuario', 'tipo'
    ];
}
