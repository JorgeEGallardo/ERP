<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class gruposRequest extends FormRequest
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
        $id = $this->route('grupo');
        return [
            'nombre' => ['required', 'unique:grupos,nombre,' . $id],
            'clave' => ['required', 'unique:grupos,clave,' . $id],
        ];
    }
    public function messages()
    {
        return [
            'nombre.unique' => 'Ya existe un grupo con este nombre.',
            'clave.unique' => 'Ya existe un grupo con esta clave.',
            'nombre.required' => 'El campo nombre es necesario.',
            'clave.required' => 'El campo clave es necesario.',
        ];
    }
}
