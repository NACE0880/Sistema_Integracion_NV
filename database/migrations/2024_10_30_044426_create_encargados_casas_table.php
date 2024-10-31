<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEncargadosCasasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('encargados_casas', function (Blueprint $table) {
            $table->increments('ID_ENCARGADOS_CASAS');
            $table->integer('ID_ENCARGADO')->nullable(false)->unsigned();
            $table->integer('ID_CASA')->nullable(false)->unsigned();

            // $table->timestamps();
        });

        Schema::table('encargados_casas', function ($table) {
            $table->foreign('ID_ENCARGADO')
                ->references('ID_ENCARGADO')->on('encargados')
                ->onDelete('cascade');

            $table->foreign('ID_CASA')
                ->references('ID_CASA')->on('casas')
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
        Schema::dropIfExists('encargados_casas');
    }
}
