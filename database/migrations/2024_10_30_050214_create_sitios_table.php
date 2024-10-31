<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSitiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sitios', function (Blueprint $table) {
            $table->increments('ID_SITIO');
            $table->integer('ID_ENTORNO')->nullable(false)->unsigned();

            $table->string('SITIO', 100)->charset('utf8');
            // $table->timestamps();
        });

        Schema::table('sitios', function ($table) {
            $table->foreign('ID_ENTORNO')
                ->references('ID_ENTORNO')->on('entornos')
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
        Schema::dropIfExists('sitios');
    }
}
