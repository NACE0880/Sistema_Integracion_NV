<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\contactos;

class ContactosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $csvFile = fopen(storage_path("app/archivos/registros/contactos.csv"), "r");
        $firstline = true;
        while (($data = fgetcsv($csvFile, 3000, ",")) !== FALSE) {

            if (!$firstline) {
                contactos::create([

                    "ID_CONTACTO"   => $data['0'],
                    "ID_ADT"        => $data['1'],

                    "NOMBRE"        => empty($data['2']) ? '---' : $data['2'],
                    "CARGO"         => empty($data['3']) ? '---' : $data['3'],
                    "TELEFONO"      => empty($data['4']) ? '---' : $data['4'],
                    "CELULAR"       => empty($data['5']) ? '---' : $data['5'],
                    "CORREO"        => empty($data['6']) ? '---' : $data['6'],
                    "TIPO"          => $data['7'],

                ]);

            }
            $firstline = false;

        }

        fclose($csvFile);
    }
}
