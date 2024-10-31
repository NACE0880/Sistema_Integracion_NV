<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjetosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('objetos', function (Blueprint $table) {
            $table->increments('ID_OBJETO');
            $table->integer('ID_ENTORNO')->nullable(false)->unsigned();

            $table->string('NOMBRE', 100)->charset('utf8');
            // $table->timestamps();
        });

        Schema::table('objetos', function ($table) {
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
        Schema::dropIfExists('objetos');
    }
}
