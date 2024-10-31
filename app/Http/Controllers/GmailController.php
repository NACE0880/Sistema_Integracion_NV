<?php

namespace App\Http\Controllers;
// clases de los Mail
use Illuminate\Support\Facades\Mail;
use App\Mail\MailController;
use App\Mail\ReporteSemanal;
use App\Mail\FinTutoria;
use App\Mail\ReporteInternet;
use Illuminate\Http\Request;



class GmailController extends Controller
{

    public function base(){
        $destinatario = 'jimenez.vazquez.miguel.a@gmail.com';
        $cc = 'reportes.bdt@gmail.com';

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


        // self::pruebas($destinatario, $cc);
        // self::reporteSemanal($destinatario, $data_mail_semanal);
        // self::finTutoria($destinatario, $data_mail_finTutoria);
        // self::reporteInternet($destinatario, $data_mail_reporteInternet);

        return view('Panel.mensajeriagmail');
    }

    public function pruebas($destinatario, $cc){
        $data = [
            'titulo' => 'Titulo',
            'mensaje' => 'Mensaje con archivo adjunto:',

        ];

        Mail::to($destinatario)->cc($cc)->send(new MailController($data));
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
