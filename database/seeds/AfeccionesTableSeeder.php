<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AfeccionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('afecciones')->insert(['ID_AFECCION' => 1,  'ID_AREA' => 6, 'NOMBRE' => 'Alarma']);
        DB::table('afecciones')->insert(['ID_AFECCION' => 2,  'ID_AREA' => 9, 'NOMBRE' => 'Imagen Corporativa']);
        DB::table('afecciones')->insert(['ID_AFECCION' => 3,  'ID_AREA' => 2, 'NOMBRE' => 'Deterioro']);
        DB::table('afecciones')->insert(['ID_AFECCION' => 4,  'ID_AREA' => 2, 'NOMBRE' => 'Deterioro Interno']);
        DB::table('afecciones')->insert(['ID_AFECCION' => 5,  'ID_AREA' => 1, 'NOMBRE' => 'Deterioro Externo']);
        DB::table('afecciones')->insert(['ID_AFECCION' => 6,  'ID_AREA' => 2, 'NOMBRE' => 'Infraestructura']);
        DB::table('afecciones')->insert(['ID_AFECCION' => 7,  'ID_AREA' => 2, 'NOMBRE' => 'Infraestructura Interna']);
        DB::table('afecciones')->insert(['ID_AFECCION' => 8,  'ID_AREA' => 1, 'NOMBRE' => 'Infraestructura Externa']);
        DB::table('afecciones')->insert(['ID_AFECCION' => 9,  'ID_AREA' => 4, 'NOMBRE' => 'Mobiliario']);
        DB::table('afecciones')->insert(['ID_AFECCION' => 10,  'ID_AREA' => 2, 'NOMBRE' => 'Salud']);
        DB::table('afecciones')->insert(['ID_AFECCION' => 11,  'ID_AREA' => 5, 'NOMBRE' => 'Seguridad']);
        DB::table('afecciones')->insert(['ID_AFECCION' => 12,  'ID_AREA' => 1, 'NOMBRE' => 'Seguridad Aldea']);
        DB::table('afecciones')->insert(['ID_AFECCION' => 13,  'ID_AREA' => 3, 'NOMBRE' => 'Sistema Aire Acondicionado']);
    }
}
