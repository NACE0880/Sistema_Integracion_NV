<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usos', function (Blueprint $table) {
            $table->increments('ID_USO');
            $table->integer('ID_ADT')->nullable(false)->unsigned();

            $table->string('ESTATUS_REGISTRO', 200)->charset('utf8');
            $table->string('ESTATUS_OFERTA', 200)->charset('utf8');
            $table->string('TIPO_USO', 200)->charset('utf8');
            $table->string('MAYORIA_POBLACION', 200)->charset('utf8');
            $table->time('HORA_INICIO', $precision = 0);
            $table->time('HORA_FINAL', $precision = 0);
            $table->integer('USUARIOS_SEMANALES');
            $table->string('OBSERVACIONES', 200);


        });

        Schema::table('usos', function ($table) {
            $table->foreign('ID_ADT')
                ->references('ID_ADT')->on('adts')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usos');
    }
}
