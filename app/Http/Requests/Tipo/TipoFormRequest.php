<?php

namespace proyecto_inicial\Http\Requests\Tipo;

use Illuminate\Foundation\Http\FormRequest;

class TipoFormRequest extends FormRequest{
    
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'nombre_tipo' => 'required|min:4|max:60|unique:tb_tipo,nombre_tipo',
        ];
    }

    public function messages(){
        
        return [
            
            //? PARA NOMBRE 
            'nombre_tipo.required' => 'El nombre del tipo es obligatorio.',
            'nombre_tipo.min' => 'El nombre del tipo debe tener al menos 4 caracteres.',
            'nombre_tipo.max' => 'El nombre del tipo no puede tener más de 60 caracteres.',
            'nombre_tipo.unique' => 'Ya existe este tipo con este nombre, ingrese otro',
            

        ];

    }

}
