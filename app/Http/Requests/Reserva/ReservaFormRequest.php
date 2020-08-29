<?php

namespace proyecto_inicial\Http\Requests\Reserva;

use Illuminate\Foundation\Http\FormRequest;

class ReservaFormRequest extends FormRequest{
    
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            
        ];
    }

}
