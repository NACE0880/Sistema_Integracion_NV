<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEspaciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('espacios', function (Blueprint $table) {
            $table->increments('ID_ESPACIO');
            $table->integer('ID_SITIO')->nullable(false)->unsigned();

            $table->string('NOMBRE', 100)->charset('utf8');
            // $table->timestamps();
        });

        Schema::table('espacios', function ($table) {
            $table->foreign('ID_SITIO')
                ->references('ID_SITIO')->on('sitios')
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
        Schema::dropIfExists('espacios');
    }
}
