<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveColumnasFromDatosCapturaEstadoTutoriasAbiertas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('datos_captura_estado_tutorias_abiertas', function (Blueprint $table) {
            $table->dropColumn(['INTERNET_PROMEDIO_ABIERTAS', 'INTERNET_BAJO_ABIERTAS', 'INTERNET_ALTO_ABIERTAS']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('datos_captura_estado_tutorias_abiertas', function (Blueprint $table) {
            $table->string('INTERNET_PROMEDIO_ABIERTAS')->nullable();
            $table->string('INTERNET_BAJO_ABIERTAS')->nullable();
            $table->string('INTERNET_ALTO_ABIERTAS')->nullable();
        });
    }
}
