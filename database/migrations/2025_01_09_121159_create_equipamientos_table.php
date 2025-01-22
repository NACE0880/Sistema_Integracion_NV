<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipamientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipamientos', function (Blueprint $table) {
            $table->increments('ID_EQUIPAMIENTO');
            $table->integer('ID_ADT')->nullable(false)->unsigned();

            $table->integer('PC');
            $table->integer('LAPTOP');
            $table->integer('NETBOOK');
            $table->integer('CLASSMATE');
            $table->integer('XO');
            $table->string('OBSERVACIONES', 200);
            $table->string('TIPO', 100)->charset('utf8');

        });

        Schema::table('equipamientos', function ($table) {
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
        Schema::dropIfExists('equipamientos');
    }
}
