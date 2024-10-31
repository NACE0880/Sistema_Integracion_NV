<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElementosObjetosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elementos_objetos', function (Blueprint $table) {
            $table->increments('ID_ELEMENTO_OBJ');
            $table->integer('ID_OBJETO')->nullable(false)->unsigned();

            $table->string('NOMBRE', 100)->charset('utf8');
            // $table->timestamps();
        });

        Schema::table('elementos_objetos', function ($table) {
            $table->foreign('ID_OBJETO')
                ->references('ID_OBJETO')->on('objetos')
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
        Schema::dropIfExists('elementos_objetos');
    }
}
