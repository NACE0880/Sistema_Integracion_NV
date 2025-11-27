<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatosCapturaEstadoTutoriasAbiertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_captura_estado_tutorias_abiertas', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('INTERNET_PROMEDIO_ABIERTAS', 20, 10);
            $table->integer('INTERNET_BAJO_ABIERTAS');
            $table->integer('INTERNET_ALTO_ABIERTAS');
            $table->integer('USUARIOS_BDTS_ACUMULADOS');
            $table->integer('USUARIOS_BDTS_REGISTRARON');
            $table->integer('USUARIOS_BDTS_TOTALES');
            $table->integer('USUARIOS_BDTS_REGISTRADOS');
            $table->integer('USUARIOS_BDTS_INSCRITOS');
            $table->integer('USUARIOS_BDTS_CONSTANCIAS');
            $table->integer('OFERTA_EDUCATIVA_NUEVOS_TALLERES');
            $table->integer('OFERTA_EDUCATIVA_TALLERES');
            $table->integer('OFERTA_EDUCATIVA_EN_LINEA');
            $table->integer('OFERTA_EDUCATIVA_TALLERES_EN_DESARROLLO');
            $table->integer('SOLICITUDES_RECIBIDAS');
            $table->integer('SOLICITUD_BDT');
            $table->integer('SOLICITUD_REEQUIPAMIENTO');
            $table->integer('SOLICITUD_RETIRO');
            $table->integer('SOLICITUD_OTROS');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datos_captura_estado_tutorias_abiertas');
    }
}
