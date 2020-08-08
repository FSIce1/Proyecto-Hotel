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
            'name' => 'required|min:4|max:70|unique:users,name,'.$this->id,
            /*
            'name' => [
                'required',
                'min:4',
                'max:70',
                Rule::unique('users')->ignore($this->route->parameter('usuario'))
            ],
            */
            'email' => 'bail|required|min:9|max:70|email|unique:users,email,'.$this->id, //! bail -> anula las demás reglas 
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
    
        ];

    }
    
}
