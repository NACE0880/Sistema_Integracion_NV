<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drives', function (Blueprint $table) {
            $table->increments('ID_DRIVE');
            $table->integer('ID_CASA')->nullable(false)->unsigned();

            $table->string('LIGA', 200)->charset('utf8');
            // $table->timestamps();
        });

        Schema::table('drives', function ($table) {
            $table->foreign('ID_CASA')
                ->references('ID_CASA')->on('casas')
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
        Schema::dropIfExists('drives');
    }
}
