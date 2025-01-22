<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adts', function (Blueprint $table) {
            $table->increments('ID_ADT');
            // $table->integer('ID_CASA')->nullable(false)->unsigned();
            // $table->integer('NUMERO');

            $table->string('INICIATIVA', 50)->nullable();
            $table->string('ESTATUS_ACTUAL', 25);
            $table->string('CLAVE_SITIO', 50);
            $table->string('CLAVE_MATUTINO', 100)->nullable();
            $table->string('CLAVE_VESPERTINO', 100)->nullable();
            $table->string('DOMICILIO', 200)->nullable();
            $table->string('CP', 50)->nullable();
            $table->integer('PCC');
            $table->string('ESPECIFICAS', 50);
            $table->string('ENTORNO', 50);
            $table->string('ESCOLARIZACION', 50);
            $table->string('SERVICIO', 50);

            $table->string('NOMBRE', 100);
            $table->string('ESTADO', 50);
            $table->string('MUNICIPIO', 50);
            $table->string('LOCALIDAD', 100);
            $table->date('FECHA_ENTREGA');

            $table->string('CONVENIO', 50);
            $table->date('FECHA_INICIO_CONVENIO')->nullable();
            $table->date('FECHA_TERMINO_CONVENIO')->nullable();
            $table->string('CONVENIO_VENCIDO', 50);
            $table->string('SITUACION_LEGAL_EQUIPO', 50);
            $table->string('DEPENDENCIA_AIRE', 100)->nullable();

        });

        // Schema::table('adts', function ($table) {
        //     $table->foreign('ID_CASA')
        //         ->references('ID_CASA')->on('casas')
        //         ->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adts');
    }
}
