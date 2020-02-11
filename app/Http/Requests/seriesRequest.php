<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class seriesRequest extends FormRequest
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
            'Nombre'=>['required', 'unique:series', 'max:9'],
            'tipo'=>['required'],
        ];
    }

    public function messages()
    {
        return [
            'Nombre.unique'=>'Esta serie esta duplicada',
            'Nombre.max'=>'La serie debe ser menor a 10 caracteres.',
            'Nombre.required'=>'Es necesario que ingrese una serie.',
            'tipo.required'=>'Es necesario que ingrese un tipo de serie.',
               ];
    }
}
