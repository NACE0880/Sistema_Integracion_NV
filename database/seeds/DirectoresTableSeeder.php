<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DirectoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('directores')->insert(['ID_DIRECTOR' => 1,  'ID_CASA' => 1, 'NOMBRE' => 'Gabriel Reyes Betanzos', 'CORREO' => 'gabriel.reyes@telmexeducacion.com']);
        DB::table('directores')->insert(['ID_DIRECTOR' => 2,  'ID_CASA' => 2, 'NOMBRE' => 'Marisol Alcocer Martínez', 'CORREO' => 'marisol.alcocer@telmexeducacion.com']);
        DB::table('directores')->insert(['ID_DIRECTOR' => 3,  'ID_CASA' => 3, 'NOMBRE' => 'Luz Adriana Hernández Jaímes', 'CORREO' => 'adriana.hernandez@telmexeducacion.com']);
        DB::table('directores')->insert(['ID_DIRECTOR' => 4,  'ID_CASA' => 4, 'NOMBRE' => 'Francisco Hurtado Rico', 'CORREO' => 'francisco.hurtado@telmexeducacion.com']);
        DB::table('directores')->insert(['ID_DIRECTOR' => 5,  'ID_CASA' => 5, 'NOMBRE' => 'Patricia Ledezma Molina', 'CORREO' => 'patricia.ledezma@telmexeducacion.com ']);
        DB::table('directores')->insert(['ID_DIRECTOR' => 6,  'ID_CASA' => 6, 'NOMBRE' => 'Julia Vázquez Meza', 'CORREO' => 'julia.vazquez@telmexeducacion.com ']);
        DB::table('directores')->insert(['ID_DIRECTOR' => 7,  'ID_CASA' => 7, 'NOMBRE' => 'Dolores Molina Álvarez', 'CORREO' => 'dolores.molina@telmexeducacion.com']);
        DB::table('directores')->insert(['ID_DIRECTOR' => 8,  'ID_CASA' => 8, 'NOMBRE' => 'Jairo Aljady Valadez Crisanto', 'CORREO' => 'jairo.valadez@telmexeducacion.com']);
        DB::table('directores')->insert(['ID_DIRECTOR' => 9,  'ID_CASA' => 9, 'NOMBRE' => 'Clara Rosa Castellanos Cruz', 'CORREO' => 'ctsedena09@telmexeducacion.com']);
        DB::table('directores')->insert(['ID_DIRECTOR' => 10,  'ID_CASA' => 10, 'NOMBRE' => 'Teresa de Jesús Mata Moreno', 'CORREO' => 'teresa.mata@telmexeducacion.com']);
    }
}
