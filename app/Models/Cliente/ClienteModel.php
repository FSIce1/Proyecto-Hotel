<?php

namespace proyecto_inicial\Models\Cliente;

use Illuminate\Database\Eloquent\Model;

class ClienteModel extends Model{
    
    protected $table = 'tb_cliente';

    protected $primaryKeys = 'id';

    public $timestamps = false;

    protected $fillable = [
        'nombre_cliente',
        'apellido_cliente',
        'tipo_cliente',
        'n_documento_cliente',
        'n_celular_cliente',
        'email_cliente',
        'id_usuario_fk'
    ];

}
