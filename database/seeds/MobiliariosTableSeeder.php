<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\mobiliarios;

class MobiliariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $csvFile = fopen(storage_path("app/archivos/registros/mobiliarios.csv"), "r");
        $firstline = true;
        while (($data = fgetcsv($csvFile, 3000, ",")) !== FALSE) {

            if (!$firstline) {
                mobiliarios::create([

                    "ID_MOBILIARIO"     => $data['0'],
                    "ID_ADT"            => $data['1'],

                    "MESA_RECTANGULAR_GRANDE"   => $data['2'],
                    "MESA_RECTANGULAR_MEDIANA"  => $data['3'],
                    "MESA_CIRCULAR"             => $data['4'],
                    "SILLAS"                    => $data['5'],
                    "MUEBLE_RESGUARDO"          => $data['6'],

                    "OBSERVACIONES"     => $data['7'],
                    "TIPO"              => $data['8'],

                ]);

            }
            $firstline = false;

        }

        fclose($csvFile);
    }
}
