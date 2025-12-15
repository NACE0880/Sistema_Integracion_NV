<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveDatosCapturaDeUsuariosEstadoTutoriasAbiertasInternas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('datos_captura_de_usuarios_estado_tutorias_abiertas_internas');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('datos_captura_de_usuarios_estado_tutorias_abiertas_internas', function (Blueprint $table) {
            $table->increments('id'); 
        });
    }
}
