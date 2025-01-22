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
                    "CLAVE_SITIO"   => $data['3'],
                    "CLAVE_MATUTINO"=> empty($data['4']) ? null : $data['4'],
                    "CLAVE_VESPERTINO"=> empty($data['5']) ? null : $data['5'],
                    "DOMICILIO"     => empty($data['6']) ? null : $data['6'],
                    "CP"            => empty($data['7']) ? null : $data['7'],
                    "PCC"           => $data['8'],
                    "ESPECIFICAS"   => $data['9'],
                    "ENTORNO"       => $data['10'],
                    "ESCOLARIZACION"=> $data['11'],
                    "SERVICIO"      => $data['12'],

                    "NOMBRE"        => $data['13'],
                    "ESTADO"        => $data['14'],
                    "MUNICIPIO"     => $data['15'],
                    "LOCALIDAD"     => $data['16'],
                    "FECHA_ENTREGA" => $data['17'],

                    "CONVENIO"      => $data['18'],
                    "FECHA_INICIO_CONVENIO"     => $data['19'],
                    "FECHA_TERMINO_CONVENIO"    => (DateTime::createFromFormat('Y-m-d',$data['20'])) ? $data['20'] : null,
                    "CONVENIO_VENCIDO"          => $data['21'],
                    "SITUACION_LEGAL_EQUIPO"    => $data['22'],
                    "DEPENDENCIA_AIRE"          => empty($data['23']) ? null : $data['23'],

                ]);

            }
            $firstline = false;

        }

        fclose($csvFile);
    }
}
