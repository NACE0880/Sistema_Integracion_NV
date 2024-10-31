<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

// Clases de los correos
use App\Mail\MailController;
use App\Mail\FinTutoria;
use App\Mail\ReporteInternet;
use App\Mail\ReporteSemanal;



class RegistrosEjecucion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'registros:txt';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prueba de tareas programadas por tiempo en un txt.';

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
        $destinatario = 'miguelangelzz2900@gmail.com';
        $cc = 'reportes.bdt@gmail.com';
        $path_xlsx = 'app\archivos\archivo.xlsx';
        $path_pdf = 'app\archivos\archivo.pdf';

        $texto = '[' . date('Y-m-d H:i:s') . ']: Ejecucion';
        // $payload = [
        //     "messaging_product" => 'whatsapp',
        //     "recipient_type" => 'individual',
        //     "to" => $destinatario,
        //     "type" => 'template',
        //     "template" => [
        //         "name" => 'notificacion_diaria',
        //         "language" => [
        //             "code"=> "es_MX"
        //             ],
        //             "components" => [
        //                 [
        //                     "type" => "body",
        //                     "parameters" => [
        //                         [
        //                             "type" =>"text",
        //                             "text" => "----"
        //                         ]
        //                     ]
        //                 ]
        //             ]
        //     ]

        // ];
        // // ajustar al formato de envio
        // $payload = json_encode($payload,JSON_PRETTY_PRINT);

        // // permitir saltos de linea
        // $payload = str_replace('%0A','\n', $payload);

        Storage::append('archivos\archivo.txt', $texto);
        // self::pruebas($destinatario, $cc);

        // self::finTutoria($destinatario);
        // self::reporteInternet($destinatario, $path_xlsx);

    }

    public function pruebas($destinatario, $cc){
        $data = [
            'titulo' => 'Titulo',
            'mensaje' => 'Mensaje CON COPIA a si mismo',

        ];

        Mail::to($destinatario)->cc($cc)->send(new MailController($data));
    }

    public function finTutoria($destinatario){
        $nombre_bdt = 'NOMBRE BDT';
        $responsable = 'NOMBRE DE RESPONSABLE';

        $mobiliario_dañado = 1;
        $mobiliario_funcional = 2;

        $pc_funcional = 3;
        $pc_dañado = 4;
        $pc_faltante = 5;

        $lap_funcional = 6;
        $lap_dañado = 7;
        $lap_faltante = 8;

        $data = [
            'bdt' => $nombre_bdt,
            'responsable' => $responsable,
            'mobiliario_dañado' => $mobiliario_dañado,
            'mobiliario_funcional' => $mobiliario_funcional,
            'pc_funcional' => $pc_funcional,
            'pc_dañado' => $pc_dañado,
            'pc_faltante' => $pc_faltante,
            'lap_funcional' => $lap_funcional,
            'lap_dañado' => $lap_dañado,
            'lap_faltante' => $lap_faltante,
        ];

        Mail::to($destinatario)->send(new FinTutoria($data));
    }

    public function reporteInternet($destinatario, $path){
        $responsable = 'NOMBRE DE RESPONSABLE';

        $linea = [
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
        ];

        $data = [
            'responsable' => $responsable,
            'linea' => $linea,
        ];

        Mail::to($destinatario)->send(new ReporteInternet($data, $path));
    }
}
