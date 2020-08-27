<?php

namespace proyecto_inicial\Models\Piso;

use Illuminate\Database\Eloquent\Model;

class PisoModel extends Model{
    
    protected $table = 'tb_piso';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'nombre_piso',
        'id_usuario_fk'
    ];

}
