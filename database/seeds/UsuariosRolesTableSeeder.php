<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\usuarios_roles;

class UsuariosRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvFile = fopen(storage_path("app/archivos/registros/usuarios_roles.csv"), "r");
        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {

            if (!$firstline) {
                usuarios_roles::create([

                    "ID_USUARIOS_ROLES" => $data['0'],

                    "ID_USUARIO" => $data['1'],
                    "ID_ROL" => $data['2'],
                ]);

            }
            $firstline = false;

        }

        fclose($csvFile);
    }
}
