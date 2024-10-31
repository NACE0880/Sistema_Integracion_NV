<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

// Clases de los correos
use Illuminate\Support\Facades\Mail;
use App\Mail\ReporteSemanal;

class ResumenSemanal extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'resumen:tutorias';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Resumen de todas las tareas y el total de horas dedicado a las tutorias (historico).';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $destinatario_mail = 'miguelangelzz2900@gmail.com';
        $cc = 'reportes.bdt@gmail.com';

        $data_mail = [
            'administrador' => 'ALFREDO VALLADARES',
            'resumen' => [
                [
                    'periodo' => 'Semana 1',
                    'efectuadas' => '1',
                    'pendientes' => '2',
                    'cierre' => '3',
                    'fallasinternet' => '4',
                    'registros' => '5',
                ],
                [
                    'periodo' => 'Semana 2',
                    'efectuadas' => '0',
                    'pendientes' => '0',
                    'cierre' => '0',
                    'fallasinternet' => '0',
                    'registros' => '0',
                ],
                [
                    'periodo' => 'Semana 3',
                    'efectuadas' => '0',
                    'pendientes' => '0',
                    'cierre' => '0',
                    'fallasinternet' => '0',
                    'registros' => '0',
                ],
                [
                    'periodo' => 'Semana 4',
                    'efectuadas' => '0',
                    'pendientes' => '0',
                    'cierre' => '0',
                    'fallasinternet' => '0',
                    'registros' => '0',
                ],
            ],
            'sincontacto_bdt' => [
                [
                    'clave' => 'CLAVESITIO_1',
                    'escuela' => 'ESCUELA_1',
                    'nombre' => 'NOMBRE_1',
                    'turno' => 'MATUTINO',
                ],
                [
                    'clave' => 'CLAVESITIO_2',
                    'escuela' => 'ESCUELA_2',
                    'nombre' => 'NOMBRE_2',
                    'turno' => 'MATUTINO',
                ],
                [
                    'clave' => 'CLAVESITIO_3',
                    'escuela' => 'ESCUELA_3',
                    'nombre' => 'NOMBRE_3',
                    'turno' => 'VESPERTINO',
                ],
                [
                    'clave' => 'CLAVESITIO_4',
                    'escuela' => 'ESCUELA_4',
                    'nombre' => 'NOMBRE_4',
                    'turno' => 'VESPERTINO',
                ],
            ]
        ];

        $destinatario_tel = '525518794743';
        $data_whats = [
            'contenido' => 'Fin Tutoria',
            'clave' => '_Clave BDT: NO BDT FINALIZADA_',
            'ruta' => 'https://mail.google.com/'
        ];

        self::reporteSemanal($destinatario_mail, $data_mail);
        self::notificación($destinatario_tel, $data_whats);
    }

    public function reporteSemanal($destinatario_mail, $data_mail){
        $path = 'app/archivos/archivo.txt';

        Mail::to($destinatario_mail)->send(new ReporteSemanal($data_mail, $path));
    }

    public function notificación($destinatario_tel, $data_whats){
        $id_telefono = '373083419225618';
        $token = 'EABvGrmq3yZCoBO070vYK6Vmd9vqKN07zc57HKFE5wZBkI2WzCcAzdUhrIKnDTdvUKkECZAIMCOHmsjFykcepQnptmcVZCTKWiGuZB1HH2t1ZCtIgwRUoZBzImOTTvgTrZBguDBgCZAbrLigqZAH4KLZAWDG5sX7IVFweg77D2rsnXuRC0kIWhUS6DD7hFqWWZBJ4Wpz3igZDZD';
        $payload = [
            "messaging_product" => 'whatsapp',
            "recipient_type" => 'individual',
            "to" => $destinatario_tel,
            "type" => 'interactive',
            "interactive" => [
                "type" => 'cta_url',

                "header" => [
                    "type" => 'text',
                    "text" => 'REPORTES GENERADOS CORRECTAMENTE'
                ],

                "body" => [
                    "text" => '*_Correos Recibidos:_* %0A'. '* '.  $data_whats['contenido']
                ],

                "footer" => [
                    "text" => $data_whats['clave']
                ],

                "action" => [
                    "name" => 'cta_url',
                    "parameters" => [
                        "display_text" => 'Ver Datos',
                        "url" => $data_whats['ruta']
                    ],
                ]
            ]

        ];

        // ajustar al formato de envio
        $payload = json_encode($payload);

        // permitir saltos de linea
        $payload = str_replace('%0A','\n', $payload);

        // Envio del mensaje via Curl
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://graph.facebook.com/v20.0/'. $id_telefono . '/messages',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>$payload,

            CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $token
                ),
            ));

        $response = curl_exec($curl);

        curl_close($curl);
    }
}
