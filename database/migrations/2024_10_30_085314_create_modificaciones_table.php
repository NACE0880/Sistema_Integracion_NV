<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModificacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modificaciones', function (Blueprint $table) {
            $table->increments('ID_MODIFICACION');
            $table->integer('ID_TICKET')->nullable(false)->unsigned();

            $table->string('TIPO', 50);
            $table->string('RESPONSABLE', 50);
            $table->string('JUSTIFICACION', 200)->nullable();
            $table->dateTime('FECHA');
            // $table->timestamps();
        });

        Schema::table('modificaciones', function ($table) {
            $table->foreign('ID_TICKET')
                ->references('ID_TICKET')->on('tickets')
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
        Schema::dropIfExists('modificaciones');
    }
}
