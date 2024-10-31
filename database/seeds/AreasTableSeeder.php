<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('areas')->insert(['ID_AREA' => 1,  'NOMBRE' => 'Alcaldía']);
        DB::table('areas')->insert(['ID_AREA' => 2,  'NOMBRE' => 'CTBR']);
        DB::table('areas')->insert(['ID_AREA' => 3,  'NOMBRE' => 'FYCSA']);
        DB::table('areas')->insert(['ID_AREA' => 4,  'NOMBRE' => 'INTTELMEX']);
        DB::table('areas')->insert(['ID_AREA' => 5,  'NOMBRE' => 'Seguridad Patrimonial']);
        DB::table('areas')->insert(['ID_AREA' => 6,  'NOMBRE' => 'PEMSA - Seguridad Industrial']);
        DB::table('areas')->insert(['ID_AREA' => 7,  'NOMBRE' => 'SEDENA']);
        DB::table('areas')->insert(['ID_AREA' => 8,  'NOMBRE' => 'SEMAR']);
        DB::table('areas')->insert(['ID_AREA' => 9,  'NOMBRE' => 'Publicidad']);
        DB::table('areas')->insert(['ID_AREA' => 10,  'NOMBRE' => 'Finanzas Filiales']);
        DB::table('areas')->insert(['ID_AREA' => 11,  'NOMBRE' => 'Otros']);
    }
}
