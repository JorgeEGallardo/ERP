<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticulosRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('articulo');
        return [
            'clave'=>['required', 'unique:articulos, clave,'.$id],
            'descripcion'=>['required'],
            'unidadentrada'=>['required'],
            'unidadsalida'=>['required'],
            'factor'=>['required'],
            'claveadicional'=>['nullable','unique:articulos, claveadicional,'.$id],
            'lineas'=>['required'],
            'proveedores'=>['required'],
            'existencia'=>['nullable'],
            'clave'=>['required'],
            'clave'=>['required'],
            'clave'=>['required'],
        ];
    }
}
