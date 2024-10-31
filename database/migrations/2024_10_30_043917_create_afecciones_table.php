<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAfeccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('afecciones', function (Blueprint $table) {
            $table->increments('ID_AFECCION');
            $table->integer('ID_AREA')->nullable(false)->unsigned();

            $table->string('NOMBRE', 100)->charset('utf8');
            // $table->timestamps();
        });

        Schema::table('afecciones', function ($table) {
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
        Schema::dropIfExists('afecciones');
    }
}
