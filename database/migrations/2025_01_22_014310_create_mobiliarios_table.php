<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMobiliariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobiliarios', function (Blueprint $table) {
            $table->increments('ID_MOBILIARIO');
            $table->integer('ID_ADT')->nullable(false)->unsigned();

            $table->integer('MESA_RECTANGULAR_GRANDE');
            $table->integer('MESA_RECTANGULAR_MEDIANA');
            $table->integer('MESA_CIRCULAR');
            $table->integer('SILLAS');
            $table->integer('MUEBLE_RESGUARDO');
            $table->string('OBSERVACIONES', 200);
            $table->string('TIPO', 100)->charset('utf8');

        });

        Schema::table('mobiliarios', function ($table) {
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
        Schema::dropIfExists('mobiliarios');
    }
}
