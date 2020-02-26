<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class lineasRequest extends FormRequest
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
        $id = $this->route('linea');
        return [
            'nombre'=>['required', 'unique:lineas,nombre,'.$id],
            'clave'=>['required', 'unique:lineas,clave,'.$id],
        ];
    }
    public function messages()
    {
        return [
            'nombre.unique'=>'Ya existe una línea con este nombre.',
            'clave.unique'=>'Ya existe una línea con esta clave.',
            'nombre.required'=>'El campo nombre es necesario.',
            'clave.required'=>'El campo clave es necesario.',
        ];
    }
}