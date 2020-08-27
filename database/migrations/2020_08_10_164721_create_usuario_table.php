<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuarioTable extends Migration{
    
    public function up(){
        Schema::create('tb_usuario', function (Blueprint $table) {
            
            $table->increments('id');
            $table->string('nombre_usuario',60)->unique();
            $table->string('contraseña_usuario',60);
            $table->string('email_usuario',60)->unique();
            $table->enum('estado_usuario',['Activo','Inactivo'])->default('Activo');
            
            $table->timestamps();
            
        });
    }

    public function down(){
        Schema::dropIfExists('tb_usuario');
    }
}
