<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCapturaUsuariosEstadoTutoriasAbiertasInternasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('captura_usuarios_estado_tutorias_abiertas_internas', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('ID_CASA'); 
            $table->foreign('ID_CASA')->references('ID_CASA')->on('casas')->onDelete('cascade');
            
            $table->integer('META');
            $table->integer('REAL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('captura_usuarios_estado_tutorias_abiertas_internas');
    }
}
