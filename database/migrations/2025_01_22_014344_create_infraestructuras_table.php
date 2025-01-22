<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfraestructurasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infraestructuras', function (Blueprint $table) {
            $table->increments('ID_INFRAESTRUCTURA');
            $table->integer('ID_ADT')->nullable(false)->unsigned();

            $table->string('KIT_SENALIZACION', 200)->charset('utf8');
            $table->string('ELECTRICIDAD', 200)->charset('utf8');
            $table->string('PINTURA_INTERIOR', 200)->charset('utf8');
            $table->string('PINTURA_EXTERIOR', 200)->charset('utf8');
            $table->string('OBSERVACIONES', 200);

        });

        Schema::table('infraestructuras', function ($table) {
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
        Schema::dropIfExists('infraestructuras');
    }
}
