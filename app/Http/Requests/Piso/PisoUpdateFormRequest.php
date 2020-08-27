<?php

namespace proyecto_inicial\Http\Requests\Piso;

use Illuminate\Foundation\Http\FormRequest;

class PisoUpdateFormRequest extends FormRequest{
    
    public function authorize()
    {
        return true;
    }

    public function rules(){
        return [
            'nombre_piso' => 'required|min:4|max:60|unique:tb_piso,nombre_piso,'.$this->id,
        ];
    }

    public function messages(){
        
        return [
            
            //? PARA NOMBRE 
            'nombre_piso.required' => 'El nombre del piso es obligatorio.',
            'nombre_piso.min' => 'El nombre del piso debe tener al menos 4 caracteres.',
            'nombre_piso.max' => 'El nombre del piso no puede tener más de 60 caracteres.',
            'nombre_piso.unique' => 'Ya existe este piso con este nombre, ingrese otro',
            

        ];

    }

}
