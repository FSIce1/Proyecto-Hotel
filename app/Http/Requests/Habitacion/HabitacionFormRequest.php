<?php

namespace proyecto_inicial\Http\Requests\Habitacion;

use Illuminate\Foundation\Http\FormRequest;

class HabitacionFormRequest extends FormRequest{
    
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            
        ];
    }
    
}
