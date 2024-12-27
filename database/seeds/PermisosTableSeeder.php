<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\permisos;

class PermisosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $csvFile = fopen(storage_path("app/archivos/registros/permisos.csv"), "r");
        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {

            if (!$firstline) {
                permisos::create([

                    "ID_PERMISO" => $data['0'],
                    "NOMBRE" => $data['1'],

                ]);

            }
            $firstline = false;

        }

        fclose($csvFile);
    }
}
