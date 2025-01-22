<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLineasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lineas', function (Blueprint $table) {
            $table->increments('ID_LINEA');
            $table->integer('ID_ADT')->nullable(false)->unsigned();

            $table->string('LINEA', 200)->charset('utf8');
            $table->string('DIAN', 200)->charset('utf8')->nullable();
            $table->string('APORTA', 200)->charset('utf8');
            $table->string('PAGA', 200)->charset('utf8');
            $table->string('FACTURACION', 200)->charset('utf8');
            $table->date('VIGENCIA')->nullable();
            $table->string('CUENTA_MAESTRA', 200)->charset('utf8');
            $table->integer('NO_SERVICIOS');
            $table->integer('ANCHO_BANDA');
            $table->string('TECNOLOGIA', 200)->charset('utf8');
            $table->decimal('COSTO', 10, 4);
            $table->string('PAQUETE', 200)->charset('utf8');
            $table->string('SEMAFORO', 200)->charset('utf8');
            $table->decimal('GB_RECIBIDO', 10, 3);
            $table->decimal('GB_ENVIADOS', 10, 3);

            $table->string('OBSERVACIONES', 200);


        });

        Schema::table('lineas', function ($table) {
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
        Schema::dropIfExists('lineas');
    }
}
