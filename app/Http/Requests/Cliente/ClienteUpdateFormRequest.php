<?php

namespace proyecto_inicial\Http\Requests\Cliente;

use Illuminate\Foundation\Http\FormRequest;

class ClienteUpdateFormRequest extends FormRequest{
    
    public function authorize()
    {
        return true;
    }

    public function rules(){
        return [
            'nombre_cliente' => 'required|min:4|max:70|unique:tb_cliente,nombre_cliente,'.$this->id,
            'apellido_cliente' => 'bail|required|min:4|max:70|unique:tb_cliente,email_cliente,'.$this->id, //! bail -> anula las demás reglas 
            'tipo_cliente' => 'bail|required|not_in:0',
            'n_documento_cliente' => 'bail|required|min:4|max:10|unique:tb_cliente,n_documento_cliente,'.$this->id,
            'n_celular_cliente' => 'bail|required|min:4|max:9|unique:tb_cliente,n_celular_cliente,'.$this->id,
            'email_cliente' => 'bail|required|min:4|max:70|email|unique:tb_cliente,email_cliente,'.$this->id,
        ];
    }


    public function messages(){
        
        return [
            
            //? PARA NOMBRE 
            'nombre_cliente.required' => 'El nombre del cliente es obligatorio.',
            'nombre_cliente.min' => 'El nombre del cliente debe tener al menos 4 caracteres.',
            'nombre_cliente.max' => 'El nombre del cliente no puede tener más de 70 caracteres.',
            'nombre_cliente.unique' => 'Ya existe un cliente con este nombre, ingrese otro',
            
            //? PARA APELLIDO 
            'apellido_cliente.required' => 'El nombre del cliente es obligatorio.',
            'apellido_cliente.min' => 'El nombre del cliente debe tener al menos 4 caracteres.',
            'apellido_cliente.max' => 'El nombre del cliente no puede tener más de 70 caracteres.',
            'apellido_cliente.unique' => 'Ya existe un cliente con este nombre, ingrese otro',
            
            //? PARA TIPO 
            'tipo_cliente.required' => 'El tipo del cliente es obligatorio.',
            'tipo_cliente.not_in' => 'Debe seleccionar un tipo de cliente',
        

            //? PARA N° DE DOCUMENTO DE CLIENTE 
            'n_documento_cliente.required' => 'El documento del cliente es obligatorio.',
            'n_documento_cliente.min' => 'El número de documento debe tener al menos 4 caracteres.',
            'n_documento_cliente.max' => 'El número de documento no puede tener más de 10 caracteres.',
            'n_documento_cliente.numeric' => 'En número de documento deben ser solo números.',
            'n_documento_cliente.unique' => 'Ya existe este número de documento, ingrese otro',
            
            //? PARA N° DE CELULAR
            'n_celular_cliente.required' => 'El número del celular es obligatorio.',
            'n_celular_cliente.min' => 'El número del celular no debe tener menos de 4 dígitos.',
            'n_celular_cliente.max' => 'El celular del cliente no debe tener más de 9 dígitos.',
            'n_celular_cliente.unique' => 'Ya existe este número de celular, ingrese otro',
            


            //? PARA EMAIL
            'email_cliente.required' => 'El email es obligatorio.',
            'email_cliente.min' => 'El email debe tener al menos 4 caracteres.',
            'email_cliente.max' => 'El email no puede tener más de 70 caracteres.',
            'email_cliente.unique' => 'Ya existe este email, ingrese otro',
            'email_cliente.email' => 'El mail ingresado es incorrecto, ingrese otro',

        ];

    }



}
