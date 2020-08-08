<?php

namespace proyecto_inicial\Http\Requests\Usuario;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioFormRequest extends FormRequest{
    
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'name' => 'required|min:4|max:70|unique:users,name',
            'email' => 'bail|required|min:9|max:70|email|unique:users,email', //! bail -> anula las demás reglas 
            'password' => 'bail|required|min:9|max:70|confirmed',
            'password_confirmation' => 'required|min:9',
        ];
    }

    
    public function messages(){
        
        return [
            //? PARA NOMBRE 
            'name.required' => 'El nombre de usuario es obligatorio.',
            'name.min' => 'El nombre del usuario debe tener al menos 4 caracteres.',
            'name.max' => 'El nombre del usuario no puede tener más de 70 caracteres.',
            'name.unique' => 'Ya existe un usuario con este nombre, ingrese otro', 
            
            //? PARA EMAIL
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'Formato incorrecto para el email.',
            'email.min' => 'El email debe tener al menos 9 caracteres.',
            'email.max' => 'El email no debe tener más de 70 caracteres.',
            'email.unique' => 'El email ya existe, ingrese otro', 
            
            //? PARA CONTRASEÑAS
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 9 caracteres.',
            'password.max' => 'La contraseña no debe tener más de 70 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden, intente nuevamente.',

            //? PARA VERFICIAR CONTRASEÑA
            'password_confirmation.required' => 'La contraseña de verificación es requerida.',
            'password_confirmation.min' => 'La contraseña de verificación debe tener al menos 9 caracteres.',
            //'password_confirmation.confirmed' => 'La contraseña no coincide, intente nuevamente.',

        ];

    }

}
