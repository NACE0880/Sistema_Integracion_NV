<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\equipamientos;

class EquipamientosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $csvFile = fopen(storage_path("app/archivos/registros/equipamientos.csv"), "r");
        $firstline = true;
        while (($data = fgetcsv($csvFile, 4000, ",")) !== FALSE) {

            if (!$firstline) {
                equipamientos::create([

                    "ID_EQUIPAMIENTO"   => $data['0'],
                    "ID_ADT"            => $data['1'],

                    "PC"                => $data['2'],
                    "LAPTOP"            => $data['3'],
                    "NETBOOK"           => $data['4'],
                    "CLASSMATE"         => $data['5'],
                    "XO"                => $data['6'],
                    "OBSERVACIONES"     => $data['7'],
                    "TIPO"              => $data['8'],

                ]);

            }
            $firstline = false;

        }

        fclose($csvFile);
    }
}
