<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatosCapturaEstadoTutoriasAbiertasInternasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_captura_estado_tutorias_abiertas_internas', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('INTERNET_PROMEDIO_INTERNAS', 20, 10);
            $table->integer('INTERNET_BAJO_INTERNAS');
            $table->integer('INTERNET_ALTO_INTERNAS');
            $table->integer('INTERNET_INFINITUM_PERSONAL_INTERNO');
            $table->integer('INTERNET_VOZ_PERSONAL_INTERNO');
            $table->integer('INTERNET_ENLACE_PERSONAL_EXTERNO');
            $table->integer('INTERNET_VOZ_PERSONAL_EXTERNO');
            $table->integer('MOBILIARIO_MESAS');
            $table->integer('MOBILIARIO_SILLAS');
            $table->integer('MOBILIARIO_LIBREROS');
            $table->integer('MOBILIARIO_TV');
            $table->integer('MOBILIARIO_ARCHIVEROS');
            $table->integer('MOBILIARIO_RACKS');
            $table->integer('MOBILIARIO_CARRITO_CARGADOR');
            $table->integer('USUARIOS_ACUMULADO');
            $table->decimal('GASTO_MENSUAL_ACUMULADO', 20, 2);
            $table->decimal('GASTO_MENSUAL', 20, 2);
            $table->decimal('GASTO_MENSUAL_RENTA', 20, 2);
            $table->decimal('GASTO_MENSUAL_ASEO', 20, 2);
            $table->decimal('GASTO_MENSUAL_LUZ', 20, 2);
            $table->decimal('GASTO_MENSUAL_VIGILANCIA', 20, 2);
            $table->decimal('GASTO_AGUA_POTABLE', 20, 2);
            $table->decimal('GASTO_NOMINA_OPERACION', 20, 2);
            $table->decimal('GASTO_NOMINA_GERENCIA', 20, 2);
            $table->decimal('GASTO_MANTENIMIENTOS_TOTAL', 20, 2);
            $table->decimal('GASTO_MANTENIMIENTOS_EJERCIDO', 20, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datos_captura_estado_tutorias_abiertas_internas');
    }
}
