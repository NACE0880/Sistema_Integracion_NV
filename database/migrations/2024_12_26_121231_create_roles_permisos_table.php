<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesPermisosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles_permisos', function (Blueprint $table) {
            $table->increments('ID_ROLES_PERMISOS');
            $table->integer('ID_ROL')->nullable(false)->unsigned();
            $table->integer('ID_PERMISO')->nullable(false)->unsigned();
        });

        Schema::table('roles_permisos', function ($table) {
            $table->foreign('ID_ROL')
                ->references('ID_ROL')->on('roles')
                ->onDelete('cascade');

            $table->foreign('ID_PERMISO')
                ->references('ID_PERMISO')->on('permisos')
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
        Schema::dropIfExists('roles_permisos');
    }
}
