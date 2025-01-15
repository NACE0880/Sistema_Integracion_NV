<?php

namespace App\Http\Controllers;

// Controlador de Modelos
use DB;
use Auth;
use App\User;
use App\adts;
use App\llamadas;
use App\coordinadores;

use DateTime;

// Obtención de campos
use Illuminate\Http\Request;

// Dependencias de Excel
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\exportarBaseTickets;

// Namespace para fechas
use Carbon\Carbon;

// Namespace para encriptacióon de cadenas
use Illuminate\Support\Facades\Crypt;

// NameSpace clases
use App\Http\Controllers\TelegramController;
use App\Services\UsersServices;


class TutoriasController extends Controller
{
    public function __construct()
    {
        // $this->strroute = 'storage/app/public/tickets/evidencias/';
        $this->strroute = 'storage/tickets/evidencias/';
        // $this->middleware('auth');
    }

    public function consultar(){
        // $adts = adts::whereIn('ID_ADT', [774])->get();
        $adts = adts::all();
        $coordinadores = coordinadores::all();
        $adt = 'hola';
        return view('Tutorias.consultar', compact('adt', 'adts', 'coordinadores'));
    }

    public function actualizarContacto(adts $adt){

        return view('Tutorias.actualizarContacto', compact('adt'));
    }

    public function llamadaNoEfectiva(adts $adt){

        return view('Tutorias.llamadaNoEfectiva', compact('adt'));
    }

    public function panelLlamada(adts $adt){
        // echo Auth::User()->userable->NOMBRE;
        // print_r(UsersServices::nombrePermisos());

        return view('Tutorias.panelLlamada', compact('adt'));
    }

    public function actualizarInternet($adt){

        return view('Tutorias.actualizarInternet', compact('adt'));
    }

    public function actualizarInfraestructura($adt){

        return view('Tutorias.actualizarInfraestructura', compact('adt'));
    }

    public function actualizarMobiliario($adt){

        return view('Tutorias.actualizarMobiliario', compact('adt'));
    }

    public function actualizarUsoBdt($adt){

        return view('Tutorias.actualizarUsoBdt', compact('adt'));
    }

    public function actualizarEquipamiento(adts $adt){

        return view('Tutorias.actualizarEquipamiento', compact('adt'));
    }


    // FORMULARIOS
    // Telegram
    public function enviarContactosCoordinadores(Request $request, adts $adt){

        // Enviar contactos por telegram
        $coordinador = coordinadores::find($request->input('coordinador'));
        $telegram = new TelegramController();

        $payload = $adt->NOMBRE . '%0A';
        foreach ($adt->contactos as $contacto) {
            $payload.='%0A <b> • '.$contacto->TIPO. " • </b> %0A";
            $payload.='<i>NOMBRE:    '.$telegram->format(mb_strtolower($contacto->NOMBRE,'UTF-8'))."</i>%0A";
            $payload.='TELEFONO: '.$telegram->format($contacto->TELEFONO)."%0A";
            $payload.='CELULAR:    '.$telegram->format($contacto->CELULAR)."%0A";
            $payload.='<i>CARGO:        '.$telegram->format(mb_strtolower($contacto->CARGO,'UTF-8'))."</i>%0A";
            $payload.='CORREO:      '.$telegram->format($contacto->CORREO)."%0A";
        }
        $telegram->sendText($coordinador->TELEGRAM, $payload);

        return redirect()->route('consultar.tutoria');
    }

    public function validarCambiosEstatus(adts $adt){
        $telegram = new TelegramController();

        $users = User::all();
        $payload = [
            'mensaje' => 'Nuevo cambio de estatus - '. $adt->NOMBRE,
            'botones' => [
                // callback_data determina función del webhook
                ['text' => 'VALIDAR Apertura', 'callback_data' => 'VALIDAR APERTURA ADT_'.$adt->ID_ADT],
                ['text' => 'VALIDAR Cierre', 'callback_data' => 'VALIDAR CIERRE ADT_'.$adt->ID_ADT],
                ['text' => 'RECHAZAR', 'callback_data' => 'RECHAZAR CIERRE ADT']
            ],
        ];

        // Uso del método
        foreach ($users as $user) {
            foreach ($user->permisos() as $permiso) {
                ($permiso == 'validar cambio estatus adt') ? $telegram->sendButtons($user->userable->TELEGRAM, $payload) : false;
            }
        }

    }
    // Contacto
    public function actualizarContactoForm(Request $request, $adt){
        return $request->all();
    }

    public function llamadaNoEfectivaForm(Request $request, adts $adt){
        $llamada = new llamadas;

        $llamada->ID_ADT        = $adt->ID_ADT;
        $llamada->FECHA         = date("Y-m-d H:i");
        $llamada->RESPONSABLE   = Auth::user()->userable->NOMBRE;

        $llamada->ESTATUS       = $request->input('motivo');
        $llamada->OBSERVACIONES = $request->input('observaciones');
        $llamada->LIGA          = '';
        $llamada->EXPEDIENTE    = '';

        $llamada->save();

        return redirect()->route('consultar.tutoria');
    }

    public function panelLlamadaForm (Request $request, adts $adt){
        // $llamada = new llamadas;

        // $llamada->ID_ADT        = $adt->ID_ADT;
        // $llamada->FECHA         = date("Y-m-d H:i");
        // $llamada->RESPONSABLE   = Auth::user()->userable->NOMBRE;

        // $llamada->ESTATUS       = "Llamada Efectiva";
        // $llamada->OBSERVACIONES = $request->input('observaciones');
        // $llamada->LIGA          = $request->input('videollamada');
        // $llamada->EXPEDIENTE    = $request->input('expediente');

        // $llamada->save();

        // return redirect()->route('consultar.tutoria');

        self::validarCambiosEstatus($adt);
    }

    public function actualizarInternetForm(Request $request, $adt){

        return $request->all();
    }

    public function actualizarInfraestructuraForm(Request $request, $adt){

        return $request->all();
    }

    public function actualizarMobiliarioForm(Request $request, $adt){

        return $request->all();
    }

    public function actualizarUsoBdtForm(Request $request, $adt){

        return $request->all();
    }

    public function actualizarEquipamientoForm(Request $request, adts $adt){

        return $request->all();
    }

}
