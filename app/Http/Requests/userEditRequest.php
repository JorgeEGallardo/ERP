<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class userEditRequest extends FormRequest
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

    public function rules()
    {
        $id = $this->route('id');
        return [
            'name'=>['required', 'unique:users,name,'.$id],
            'email'=>['required', 'unique:users,email,'.$id],
            'password'=>['confirmed'],
        ];
    }

    public function messages()
    {
        return [
            'name.unique'=>'Este usuario ya existe.',
            'email.unique'=>'Este correo ya esta asignado a un usuario.',
            'name.required'=>'Es necesario que ingrese un nombre de usuario.',
            'email.required'=>'Es necesario que ingrese un correo electrónico.',
            'password.confirmed'=>'Las contraseñas no coinciden.',
            'password.min'=>'La contraseña debe tener por lo menos 8 carácteres.',
               ];
    }
}
