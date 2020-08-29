<?php

namespace proyecto_inicial\Http\Requests\Reserva;

use Illuminate\Foundation\Http\FormRequest;

class ReservaFormUpdateRequest extends FormRequest{
    
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            
        ];
    }
    
}
