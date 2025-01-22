<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\lineas;

class LineasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $csvFile = fopen(storage_path("app/archivos/registros/lineas.csv"), "r");
        $firstline = true;
        while (($data = fgetcsv($csvFile, 3000, ",")) !== FALSE) {

            if (!$firstline) {
                lineas::create([

                    "ID_LINEA"      => $data['0'],
                    "ID_ADT"        => $data['1'],

                    "LINEA"         => $data['2'],
                    "DIAN"          => empty($data['3']) ? null : $data['3'],
                    "APORTA"        => $data['4'],
                    "PAGA"          => $data['5'],
                    "FACTURACION"   => $data['6'],
                    "VIGENCIA"      => empty($data['7']) ? null : $data['7'],
                    "CUENTA_MAESTRA"=> $data['8'],
                    "NO_SERVICIOS"  => $data['9'],
                    "ANCHO_BANDA"   => ($data['10'] == '-') ? 0 : $data['10'],
                    "TECNOLOGIA"    => $data['11'],
                    "COSTO"         => ($data['12'] == '-') ? 0 : $data['12'],
                    "PAQUETE"       => $data['13'],
                    "SEMAFORO"      => $data['14'],
                    "GB_RECIBIDO"   => ($data['15'] == '-') ? 0 : $data['15'],
                    "GB_ENVIADOS"   => ($data['16'] == '-') ? 0 : $data['16'],

                    "OBSERVACIONES" => $data['17'],

                ]);

            }
            $firstline = false;

        }

        fclose($csvFile);
    }
}
