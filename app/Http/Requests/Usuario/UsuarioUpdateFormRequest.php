<?php

namespace proyecto_inicial\Http\Requests\Usuario;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;
use Illuminate\Validation\Rule;

//use Illuminate\Support\Facades\Route;

class UsuarioUpdateFormRequest extends FormRequest{
    
    protected $route;

    public function __construct(Route $route){
        $this->route = $route;
        //dd($this->route->parameter('usuario'));
    }

    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            
            'nombre_usuario' => 'required|min:4|max:70|unique:tb_usuario,nombre_usuario,'.$this->id,
            'email_usuario' => 'bail|required|min:9|max:70|email|unique:tb_usuario,email_usuario,'.$this->id, //! bail -> anula las demás reglas 
            

            /*
            'nombre_usuario' => 'required|min:4|max:70|unique:tb_usuario,nombre_usuario',
            'email_usuario' => 'bail|required|min:9|max:70|email|unique:tb_usuario,email_usuario', //! bail -> anula las demás reglas 
            */
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
    
        ];

    }
    
}
