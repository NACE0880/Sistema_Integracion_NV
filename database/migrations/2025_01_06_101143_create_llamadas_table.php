<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLlamadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('llamadas', function (Blueprint $table) {
            $table->increments('ID_LLAMADA');
            $table->integer('ID_ADT')->nullable(false)->unsigned();

            $table->dateTime('FECHA');

            $table->string('RESPONSABLE', 50);
            $table->string('ESTATUS', 50);
            $table->string('OBSERVACIONES', 200);
            $table->string('LIGA', 150);
            $table->string('EXPEDIENTE', 150);

        });

        Schema::table('llamadas', function ($table) {
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
        Schema::dropIfExists('llamadas');
    }
}
