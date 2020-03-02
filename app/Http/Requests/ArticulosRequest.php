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
        $linea = $this->input('linea');
        $linea = \DB::select('select * from lineas where id = ?', [$linea]);
        $linea =  $linea[0]->Clave;
        return [
            'clave' => ['required', 'unique:articulos,Clave,' . $id],
            'descripcion' => ['required'],
            'unidadentrada' => ['required'],
            'unidadsalida' => ['required'],
            'factor' => ['required', 'regex: /(\d)*\.*(\d)*/'],
            'claveadicional' => ['nullable', 'unique:articulos,ClaveAlterna,' . $id],
            'linea' => ['required'],
            'existencia' => ['nullable', 'regex: /(\d)*\.*(\d)*/'],
            'minimo' => ['nullable', 'regex: /(\d)*\.*(\d)*/'],
            'maximo' => ['nullable', 'regex: /(\d)*\.*(\d)*/', 'gte:minimo'],
            'volumen' => ['nullable', 'regex: /(\d)*\.*(\d)*/'],
            'peso' => ['nullable', 'regex: /(\d)*\.*(\d)*/'],
        ];
    }
    public function messages()
    {
        return [
            'clave.max' => 'La clave debe tener 5 carácteres.',
            'clave.regex' => 'La clave debe contener solo números.',
            'clave.min' => 'La clave debe tener 5 carácteres.',
            'clave.unique' => 'Ya existe un artículo con esta clave.',
            'claveadicional.unique' => 'Ya existe un árticulo con esta clave adicional.',
            'clave.regex' => 'La clave tiene un formato incorrecto, solo se aceptan números.',
            'factor.regex' => 'El factor tiene un formato incorrecto. Solo se permiten números.',
            'existencia.regex' => 'El existencia adicional tiene un formato incorrecto. Solo se permiten números.',
            'minimo.regex' => 'El mínimo  tiene un formato incorrecto. Solo se permiten números.',
            'maximo.regex' => 'El máximo  tiene un formato incorrecto. Solo se permiten números.',
            'volumen.regex' => 'El volumen  tiene un formato incorrecto. Solo se permiten números.',
            'peso.regex' => 'El peso tiene un formato incorrecto. Solo se permiten números.',
            'maximo.gte' => 'El valor de stock máximo es menor al valor de stock mínimo.',
        ];
    }
}
