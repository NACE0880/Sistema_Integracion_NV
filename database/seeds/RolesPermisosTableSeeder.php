<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\roles_permisos;

class RolesPermisosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvFile = fopen(storage_path("app/archivos/registros/roles_permisos.csv"), "r");
        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {

            if (!$firstline) {
                roles_permisos::create([

                    "ID_ROLES_PERMISOS" => $data['0'],

                    "ID_ROL" => $data['1'],
                    "ID_PERMISO" => $data['2'],
                ]);

            }
            $firstline = false;

        }

        fclose($csvFile);
    }
}

