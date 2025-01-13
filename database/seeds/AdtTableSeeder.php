<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\adts;

class AdtTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $csvFile = fopen(storage_path("app/archivos/registros/adt.csv"), "r");
        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {

            if (!$firstline) {
                adts::create([

                    "ID_ADT"        => $data['0'],

                    "INICIATIVA"    => empty($data['1']) ? null : $data['1'],
                    "ESTATUS_ACTUAL"=> $data['2'],
                    "CLAVE"         => $data['3'],
                    "PCC"           => $data['4'],
                    "ESPECIFICAS"   => $data['5'],
                    "ENTORNO"       => $data['6'],
                    "ESCOLARIZACION"=> $data['7'],
                    "SERVICIO"      => $data['8'],

                    "NOMBRE"        => $data['9'],
                    "ESTADO"        => $data['10'],
                    "MUNICIPIO"     => $data['11'],
                    "LOCALIDAD"     => $data['12'],
                    "FECHA_ENTREGA" => $data['13'],

                    "CONVENIO"      => $data['14'],
                    "FECHA_INICIO_CONVENIO"     => $data['15'],
                    "FECHA_TERMINO_CONVENIO"    => (DateTime::createFromFormat('Y-m-d',$data['16'])) ? $data['16'] : null,
                    "CONVENIO_VENCIDO"          => $data['17'],
                    "SITUACION_LEGAL_EQUIPO"    => $data['18'],
                    "DEPENDENCIA_AIRE"          => empty($data['19']) ? null : $data['19'],

                ]);

            }
            $firstline = false;

        }

        fclose($csvFile);
    }
}
