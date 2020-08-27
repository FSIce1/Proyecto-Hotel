<?php

namespace proyecto_inicial\Models\Habitacion;

use Illuminate\Database\Eloquent\Model;

class HabitacionModel extends Model{
    
    protected $table = 'tb_habitacion';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'codigo_habitacion',
        'id_piso_fk',
        'id_tipo_fk',
        'id_usuario_fk',
        'descripcion_habitacion'
    ];

}
