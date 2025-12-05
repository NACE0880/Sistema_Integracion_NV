<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveColumnasFromDatosCapturaEstadoTutoriasCerradasInternas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('datos_captura_estado_tutorias_cerradas_internas', function (Blueprint $table) {
            $table->dropColumn(['INTERNET_PROMEDIO_INTERNAS', 'INTERNET_BAJO_INTERNAS', 'INTERNET_ALTO_INTERNAS']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('datos_captura_estado_tutorias_cerradas_internas', function (Blueprint $table) {
            $table->string('INTERNET_PROMEDIO_INTERNAS')->nullable();
            $table->string('INTERNET_BAJO_INTERNAS')->nullable();
            $table->string('INTERNET_ALTO_INTERNAS')->nullable();
        });
    }
}
