<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class EntornosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('entornos')->insert(['ID_ENTORNO' => 1,  'ENTORNO' => 'INTERNO']);
        DB::table('entornos')->insert(['ID_ENTORNO' => 2,  'ENTORNO' => 'EXTERNO']);

    }
}
