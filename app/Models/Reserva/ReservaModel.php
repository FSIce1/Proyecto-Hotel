<?php

namespace proyecto_inicial\Models\Reserva;

use Illuminate\Database\Eloquent\Model;

class ReservaModel extends Model{
    
    protected $table = 'tb_reserva';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id_cliente_fk',
        'id_habitacion_fk',
        'id_usuario_fk',
        'detalles_habitacion',
        'estado_reserva'
    ];

}
