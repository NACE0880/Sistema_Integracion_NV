<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios_roles', function (Blueprint $table) {
            $table->increments('ID_USUARIOS_ROLES');
            $table->integer('ID_USUARIO')->nullable(false)->unsigned();
            $table->integer('ID_ROL')->nullable(false)->unsigned();
        });

        Schema::table('usuarios_roles', function ($table) {
            $table->foreign('ID_USUARIO')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('ID_ROL')
                ->references('ID_ROL')->on('roles')
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
        Schema::dropIfExists('usuarios_roles');
    }
}
