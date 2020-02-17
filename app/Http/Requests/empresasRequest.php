<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class empresasRequest extends FormRequest
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
        $id = $this->route('empresa');

        return [
            'nombre'=>['required', 'unique:empresas,nombre,'.$id],
            'registropatronal'=>['required', 'unique:empresas,registropatronal,'.$id],
            'rfc' => ['required','unique:empresas,RFC,'.$id,'regex:/^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/'],
            'telefono'=>['required', 'regex: /^\d+$/'],
            'telefono2'=>['nullable', 'regex: /^\d+$/'],
            'numero'=>['required', 'regex: /^\d+$/'],
            'CP'=>['required', 'regex: /^\d+$/'],
            ];
    }
    public function messages()
{
    return [
        'nombre.unique'=>'Ya existe una empresa con este nombre',
        'rfc.unique'=>'Ya existe una empresa con este RFC',
        'registropatronal.unique'=>'Ya existe una empresa con este registro patronal',
        'rfc.regex' => 'El RFC tiene un formato incorrecto.',
        'telefono.regex' => 'El teléfono tiene un formato incorrecto. Solo se permiten números.',
        'telefono2.regex' => 'El teléfono adicional tiene un formato incorrecto. Solo se permiten números.',
        'numero.regex' => 'El número de calle tiene un formato incorrecto. Solo se permiten números.',
        'CP.regex' => 'El código postal tiene un formato incorrecto. Solo se permiten números.',

    ];
}
}
