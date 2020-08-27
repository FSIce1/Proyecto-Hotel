<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHabitacionTable extends Migration{
    
    public function up(){
        Schema::create('tb_habitacion', function (Blueprint $table) {
            
            $table->increments('id');
            $table->string('codigo_habitacion',60);
            
            //LLAVE FORÁNEA - ID PISO
            $table->integer('id_piso_fk')->unsigned();

            //LLAVE FORÁNEA - ID TIPO
            $table->integer('id_tipo_fk')->unsigned();

            //LLAVE FORÁNEA - ID USUARIO
            $table->integer('id_usuario_fk')->unsigned();


            $table->text('descripcion_habitacion');

            $table->foreign('id_piso_fk')->references('id')->on('tb_piso')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('id_tipo_fk')->references('id')->on('tb_tipo')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('id_usuario_fk')->references('id')->on('tb_usuario')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            
        });
    }

    public function down(){
        Schema::dropIfExists('tb_habitacion');
    }
    
}
