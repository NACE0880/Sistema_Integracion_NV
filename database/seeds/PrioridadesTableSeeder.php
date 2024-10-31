<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PrioridadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('prioridades')->insert(['ID_PRIORIDAD' => 1,  'NOMBRE' => 'ALTA']);
        DB::table('prioridades')->insert(['ID_PRIORIDAD' => 2,  'NOMBRE' => 'MEDIA']);
        DB::table('prioridades')->insert(['ID_PRIORIDAD' => 3,  'NOMBRE' => 'BAJA']);

    }
}
