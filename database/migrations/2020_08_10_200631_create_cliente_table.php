<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClienteTable extends Migration{
    
    public function up(){
        Schema::create('tb_cliente', function (Blueprint $table) {
            
            $table->increments('id');
            $table->string('nombre_cliente',60);
            $table->string('apellido_cliente',60);
            $table->enum('tipo_cliente',['Dni','Ruc','Pasaporte','Carnet Extranjero'])->default('Dni');
            $table->string('n_documento_cliente',10)->unique();
            $table->string('n_celular_cliente',30);
            $table->string('email_cliente',60)->unique();
            
            //LLAVE FORÁNEA - ID USUARIO
            
            $table->integer('id_usuario_fk')->unsigned();

            $table->foreign('id_usuario_fk')->references('id')->on('tb_usuario')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            //$table->timestamps();

        });
    }

    public function down(){
        Schema::dropIfExists('tb_cliente');
    }
}
