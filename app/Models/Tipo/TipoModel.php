<?php

namespace proyecto_inicial\Models\Tipo;

use Illuminate\Database\Eloquent\Model;

class TipoModel extends Model{
    
    protected $table = 'tb_tipo';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'nombre_tipo',
        'id_usuario_fk'
    ];

}
