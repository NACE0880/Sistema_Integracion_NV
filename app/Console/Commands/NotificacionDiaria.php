<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
// Clases de los correos
use Illuminate\Support\Facades\Mail;
use App\Mail\ReporteSemanal;
use App\Mail\FinTutoria;
use App\Mail\ReporteInternet;

class NotificacionDiaria extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'whatsapp:incidencias';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Aviso de incidencias diarias via whastsapp.';

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
        $destinatario = '525518794743';

        $data = [
            'contenido' => 'SIN ACTUALIZACIONES...',
            'clave' => '_Clave BDT: 123_',
            'ruta' => 'https://mail.google.com/'
        ];

    /* PRUEBAS
        for ($i=0; $i < 5 ; $i++) {
            self::notificacion_simple($destinatario, $data);
            sleep(2);
        }
        $data['contenido'] = ['Equipos Robados: #',
        'Fallas de internet: _Linea Nombre_',
        'Solicitud Equipos: _Dependencia_'];

        self::incidencias($destinatario, $data);

        $destinatario_mail = 'miguelangelzz2900@gmail.com';
        $data_mail_semanal = [
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

        $data_mail_finTutoria = [
            'bdt' => 'CLAVE BDT',
            'responsable' => 'ALFREDO VALLADARES',
            'mobiliario_dañado' => 5,
            'mobiliario_funcional' => 5,
            'pc_funcional' => 5,
            'pc_dañado' => 5,
            'pc_faltante' => 5,
            'lap_funcional' => 5,
            'lap_dañado' => 5,
            'lap_faltante' => 5,
        ];

        $data_mail_reporteInternet = [
            'responsable' => 'ALFREDO VALLADARES',
            'linea' => [
                [
                    'numero_linea' => '1234567890',
                    'estatus' => 'Intermitente',
                    'numero_reporte' => '001234',
                ],
                [
                    'numero_linea' => '0987654321',
                    'estatus' => 'Sin conexión',
                    'numero_reporte' => '001235',
                ]
            ],
        ];

        // SOLO PARA MOSTRAR FUNCIONAMIENTO EN TIEMPO REAL
        sleep(5);

        $data['contenido'] ='_- ACTUALIZACION DE TUTORIAS -_ %0A %0A* _PRIM clave_ : ' . 'Nuevo Seguimiento Registrado';
        self::reporteSemanal($destinatario_mail, $data_mail_semanal);
        self::notificacion_simple($destinatario, $data);
        sleep(5);

        self::finTutoria($destinatario_mail, $data_mail_finTutoria);
        $data['contenido'] ='_- ACTUALIZACION DE TUTORIAS -_ %0A %0A* _PRIM clave_ : ' . 'Tutoria completada';
        self::notificacion_simple($destinatario, $data);
        sleep(5);

        $data['contenido'] ='_- REPORTE DE INTERNET -_ %0A %0A_Lineas_ : %0A' . '* 1234567890 %0A* 0098765431';
        self::reporteInternet($destinatario_mail, $data_mail_reporteInternet);
        self::notificacion_simple($destinatario, $data);

        sleep(5);
        $data = [
            'contenido' => [
                'ACTUALIZACION DE TUTORIAS',
                'FIN DE TUTORIAS',
                'REPORTES DE INTERNET'],
            'clave' => '_Generación Correcta_',
            'ruta' => 'https://mail.google.com/'
        ];
        self::reportes($destinatario, $data);

    PRUEBAS*/
    }

    public function enviar($payload){
        $id_telefono = '373083419225618';
        $token = 'EABvGrmq3yZCoBO070vYK6Vmd9vqKN07zc57HKFE5wZBkI2WzCcAzdUhrIKnDTdvUKkECZAIMCOHmsjFykcepQnptmcVZCTKWiGuZB1HH2t1ZCtIgwRUoZBzImOTTvgTrZBguDBgCZAbrLigqZAH4KLZAWDG5sX7IVFweg77D2rsnXuRC0kIWhUS6DD7hFqWWZBJ4Wpz3igZDZD';

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

    public function notificacion_diaria($destinatario, $data){
        $payload = [
            "messaging_product" => 'whatsapp',
            "recipient_type" => 'individual',
            "to" => $destinatario,
            "type" => 'template',
            "template" => [
                "name" => 'notificacion_diaria',
                "language" => [
                    "code"=> "es_MX"
                    ],
                    "components" => [
                        [
                            "type" => "body",
                            "parameters" => [
                                [
                                    "type" =>"text",
                                    "text" => "----"
                                ]
                            ]
                        ]
                    ]
            ]

        ];

        // ajustar al formato de envio
        $payload = json_encode($payload);

        // permitir saltos de linea
        $payload = str_replace('%0A','\n', $payload);

        // Envio del mensaje via Curl
        self::enviar($payload);
    }

    public function notificacion_simple($destinatario_tel, $data_whats){
        $payload = [
            "messaging_product" => 'whatsapp',
            "recipient_type" => 'individual',
            "to" => $destinatario_tel,
            "type" => 'text',
            "text" => [
                "preview_url" => 'true',

                "body" =>  $data_whats['contenido'],
            ]
        ];

        // ajustar al formato de envio
        $payload = json_encode($payload);

        // permitir saltos de linea
        $payload = str_replace('%0A','\n', $payload);

        // Envio del mensaje via Curl
        self::enviar($payload);
    }

    public function incidencias($destinatario_tel, $data_whats){

        $lista = '';
        foreach ($data_whats['contenido'] as $incidencia) {
            $lista .= '* ' . $incidencia . '%0A';

        }

        $payload = [
            "messaging_product" => 'whatsapp',
            "recipient_type" => 'individual',
            "to" => $destinatario_tel,
            "type" => 'interactive',
            "interactive" => [
                "type" => 'cta_url',

                "header" => [
                    "type" => 'text',
                    "text" => 'REPORTE DE INCIDENCIAS'
                ],

                "body" => [
                    "text" => $lista
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
        self::enviar($payload);

    }

    public function reportes($destinatario_tel, $data_whats){

        $lista = '';
        foreach ($data_whats['contenido'] as $incidencia) {
            $lista .= '* ' . $incidencia . '%0A';
        }

        $payload = [
            "messaging_product" => 'whatsapp',
            "recipient_type" => 'individual',
            "to" => $destinatario_tel,
            "type" => 'interactive',
            "interactive" => [
                "type" => 'cta_url',

                "header" => [
                    "type" => 'text',
                    "text" => 'REPORTES GENERADOS'
                ],

                "body" => [
                    "text" => $lista
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
        self::enviar($payload);

    }

    public function reporteSemanal($destinatario_mail, $data_mail){
        $path ='app/archivos/archivo.txt';
        Mail::to($destinatario_mail)->send(new ReporteSemanal($data_mail, $path));
    }

    public function finTutoria($destinatario_mail, $data_mail){
        Mail::to($destinatario_mail)->send(new FinTutoria($data_mail));
    }

    public function reporteInternet($destinatario_mail, $data_mail){
        $path ='app/archivos/archivo.txt';
        Mail::to($destinatario_mail)->send(new ReporteInternet($data_mail, $path));
    }

}
