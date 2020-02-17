<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class proveedoresRequest extends FormRequest
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
        return [
            'rfc' => ['required','regex:/^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/'],
            'clave'=>['required', 'regex:/^[A-Z][0-9]{3}[DPE]$/'],
            'nombre'=>['required'],
            'calle'=>['required'],
            'colonia'=>['required'],
            'dias'=>['required'],
            'CP'=>['required', 'regex: /^\d+$/'],
            'curp'=>['nullable','regex:/^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/'],
        ];
    }
    public function messages()
    {
        return [
            'rfc.regex' => 'El RFC tiene un formato incorrecto.',
            'clave.regex' => 'La clave tiene una un formato incorrecto. Debe seguir un formato parecido a L000P, A002D',
            'CP.regex' => 'El código postal tiene un formato incorrecto. Solo se permiten números.',
            'curp.regex' => 'La CURP tiene un formato incorrecto.',

        ];
    }
}
