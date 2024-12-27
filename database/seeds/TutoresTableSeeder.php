<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\tutores;
use Illuminate\Support\Facades\Hash;

class TutoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $csvFile = fopen(storage_path("app/archivos/registros/tutores.csv"), "r");
        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {

            if (!$firstline) {
                tutores::create([

                    "ID_TUTOR"   => $data['0'],

                    "NOMBRE"        => $data['1'],
                    "CORREO"        => $data['2'],

                ]);

            }
            $firstline = false;

        }

        fclose($csvFile);
    }
}
