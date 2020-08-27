<?php

namespace proyecto_inicial\Http\Requests\Usuario;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioFormRequest extends FormRequest{
    
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'nombre_usuario' => 'required|min:4|max:70|unique:tb_usuario,nombre_usuario',
            'email_usuario' => 'bail|required|min:9|max:70|email|unique:tb_usuario,email_usuario', //! bail -> anula las demás reglas 
            'contraseña_usuario' => 'bail|required|min:9|max:70|confirmed',
            'contraseña_usuario_confirmation' => 'required|min:9',
        ];
    }

    
    public function messages(){
        
        return [
            //? PARA NOMBRE 
            'nombre_usuario.required' => 'El nombre de usuario es obligatorio.',
            'nombre_usuario.min' => 'El nombre del usuario debe tener al menos 4 caracteres.',
            'nombre_usuario.max' => 'El nombre del usuario no puede tener más de 70 caracteres.',
            'nombre_usuario.unique' => 'Ya existe un usuario con este nombre, ingrese otro', 
            
            //? PARA EMAIL
            'email_usuario.required' => 'El email es obligatorio.',
            'email_usuario.email' => 'Formato incorrecto para el email.',
            'email_usuario.min' => 'El email debe tener al menos 9 caracteres.',
            'email_usuario.max' => 'El email no debe tener más de 70 caracteres.',
            'email_usuario.unique' => 'El email ya existe, ingrese otro', 
            
            //? PARA CONTRASEÑAS
            'contraseña_usuario.required' => 'La contraseña es obligatoria.',
            'contraseña_usuario.min' => 'La contraseña debe tener al menos 9 caracteres.',
            'contraseña_usuario.max' => 'La contraseña no debe tener más de 70 caracteres.',
            'contraseña_usuario.confirmed' => 'Las contraseñas no coinciden, intente nuevamente.',

            //? PARA VERFICIAR CONTRASEÑA
            'contraseña_usuario_confirmation.required' => 'La contraseña de verificación es requerida.',
            'contraseña_usuario_confirmation.min' => 'La contraseña de verificación debe tener al menos 9 caracteres.',
            //'password_confirmation.confirmed' => 'La contraseña no coincide, intente nuevamente.',

        ];

    }

}
