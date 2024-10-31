<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrioridadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prioridades', function (Blueprint $table) {
            $table->increments('ID_PRIORIDAD');

            $table->string('NOMBRE', 50)->nullable(false)->charset('utf8');
            // $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prioridades');
    }
}
