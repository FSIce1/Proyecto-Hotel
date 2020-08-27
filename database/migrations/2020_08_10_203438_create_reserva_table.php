<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservaTable extends Migration{

    public function up(){
        Schema::create('tb_reserva', function (Blueprint $table) {
            
            $table->increments('id');
            
            // TODO: LLAVES FORÁNEAS
            //LLAVE FORÁNEA - ID CLIENTE
            $table->integer('id_cliente_fk')->unsigned();

            //LLAVE FORÁNEA - ID HABITACION
            $table->integer('id_habitacion_fk')->unsigned();

            //LLAVE FORÁNEA - ID USUARIO
            $table->integer('id_usuario_fk')->unsigned();

            
            $table->text('detalles_habitacion');
            $table->enum('estado_reserva',['Activo','Inactivo'])->default('Activo');

            
            $table->foreign('id_cliente_fk')->references('id')->on('tb_cliente')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('id_habitacion_fk')->references('id')->on('tb_habitacion')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('id_usuario_fk')->references('id')->on('tb_usuario')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            
            $table->timestamps();

        });
    }

    public function down(){
        Schema::dropIfExists('tb_reserva');
    }

}