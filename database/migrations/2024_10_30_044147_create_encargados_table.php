<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEncargadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('encargados', function (Blueprint $table) {
            $table->increments('ID_ENCARGADO');
            $table->integer('ID_AREA')->nullable()->unsigned();

            $table->string('NOMBRE', 100)->charset('utf8');
            $table->string('PUESTO', 100)->charset('utf8');
            $table->string('CORREO', 100)->charset('utf8');
            // $table->timestamps();
        });

        Schema::table('encargados', function ($table) {
            $table->foreign('ID_AREA')
                ->references('ID_AREA')->on('areas')
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
        Schema::dropIfExists('encargados');
    }
}
