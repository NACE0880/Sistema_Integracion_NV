<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiposDañosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipos_danos', function (Blueprint $table) {
            $table->increments('ID_TIPO_DANO');
            $table->integer('ID_PRIORIDAD')->nullable(false)->unsigned();

            $table->string('DETALLE', 100)->charset('utf8');
            // $table->timestamps();
        });

        Schema::table('tipos_danos', function ($table) {
            $table->foreign('ID_PRIORIDAD')
                ->references('ID_PRIORIDAD')->on('prioridades')
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
        Schema::dropIfExists('tipos_danos');
    }
}
