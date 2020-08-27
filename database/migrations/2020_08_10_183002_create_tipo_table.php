<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoTable extends Migration{
    
    public function up(){
        Schema::create('tb_tipo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_tipo',60)->unique();
            
            //LLAVE FORÁNEA - ID USUARIO
            $table->integer('id_usuario_fk')->unsigned();

            $table->foreign('id_usuario_fk')->references('id')->on('tb_usuario')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            
        });
    }

    public function down(){
        Schema::dropIfExists('tb_tipo');
    }
}
