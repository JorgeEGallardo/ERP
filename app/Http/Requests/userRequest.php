<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class userRequest extends FormRequest
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
            'name'=>['required', 'unique:users'],
            'email'=>['required', 'unique:users'],
            'password'=>['required', 'min:8','confirmed'],
        ];
    }

    public function messages()
    {
        return [
            'name.unique'=>'Este usuario ya existe.',
            'email.unique'=>'Este correo ya esta asignado a un usuario.',
            'name.required'=>'Es necesario que ingrese un nombre de usuario.',
            'email.required'=>'Es necesario que ingrese un correo electrónico.',
            'password.required'=>'Es necesario que ingrese una contraseña.',
            'password.confirmed'=>'Las contraseñas no coinciden.',
            'password.min'=>'La contraseña debe tener por lo menos 8 carácteres.',
               ];
    }
}
