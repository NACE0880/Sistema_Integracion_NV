<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contactos', function (Blueprint $table) {
            $table->increments('ID_CONTACTO');
            $table->integer('ID_ADT')->nullable(false)->unsigned();

            $table->string('NOMBRE', 100)->charset('utf8');
            $table->string('CARGO', 100)->charset('utf8');
            $table->string('TELEFONO', 100)->charset('utf8');
            $table->string('CELULAR', 100)->charset('utf8');
            $table->string('CORREO', 100)->charset('utf8');
            $table->string('TIPO', 100)->charset('utf8');

        });

        Schema::table('contactos', function ($table) {
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
        Schema::dropIfExists('contactos');
    }
}
