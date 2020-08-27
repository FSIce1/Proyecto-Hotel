<?php

namespace proyecto_inicial\Models\Usuario;

use Illuminate\Database\Eloquent\Model;

class UsuarioModel extends Model{
    
    protected $table = 'tb_usuario';

    //protected $primaryKey = 'id_usuario';
    
    protected $primaryKey = 'id';

    //public $timestamps = false;

    protected $fillable = [
        'nombre_usuario',
        'contraseña_usuario',
        'email_usuario',
        'estado_usuario'
    ];

}
