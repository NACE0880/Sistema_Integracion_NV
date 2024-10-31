<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CasasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('casas')->insert(['ID_CASA' => 1,  'NOMBRE' => 'Aldea Iztapalapa', 'ESTATUS' => 'ABIERTA', 'CORREO' => 'reportes.bdt@gmail.com']);
        DB::table('casas')->insert(['ID_CASA' => 2,  'NOMBRE' => 'Campeche', 'ESTATUS' => 'CERRADA', 'CORREO' => 'reportes.bdt@gmail.com']);
        DB::table('casas')->insert(['ID_CASA' => 3,  'NOMBRE' => 'Cuautla', 'ESTATUS' => 'CERRADA', 'CORREO' => 'reportes.bdt@gmail.com']);
        DB::table('casas')->insert(['ID_CASA' => 4,  'NOMBRE' => 'Culiacán', 'ESTATUS' => 'CERRADA', 'CORREO' => 'reportes.bdt@gmail.com']);
        DB::table('casas')->insert(['ID_CASA' => 5,  'NOMBRE' => 'Saltillo', 'ESTATUS' => 'CERRADA', 'CORREO' => 'reportes.bdt@gmail.com']);
        DB::table('casas')->insert(['ID_CASA' => 6,  'NOMBRE' => 'Tapachula', 'ESTATUS' => 'CERRADA', 'CORREO' => 'reportes.bdt@gmail.com']);
        DB::table('casas')->insert(['ID_CASA' => 7,  'NOMBRE' => 'Tuxtla', 'ESTATUS' => 'CERRADA', 'CORREO' => 'reportes.bdt@gmail.com']);
        DB::table('casas')->insert(['ID_CASA' => 8,  'NOMBRE' => 'Veracruz', 'ESTATUS' => 'CERRADA', 'CORREO' => 'reportes.bdt@gmail.com']);
        DB::table('casas')->insert(['ID_CASA' => 9,  'NOMBRE' => 'Sedena', 'ESTATUS' => 'ABIERTA', 'CORREO' => 'reportes.bdt@gmail.com']);
        DB::table('casas')->insert(['ID_CASA' => 10,  'NOMBRE' => 'Semar', 'ESTATUS' => 'ABIERTA', 'CORREO' => 'reportes.bdt@gmail.com']);
    }
}
