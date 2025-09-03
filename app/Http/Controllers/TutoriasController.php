<?php

namespace App\Http\Controllers;

// Controlador de Modelos
use DB;
use Auth;
use App\User;
use App\adts;
use App\llamadas;
use App\coordinadores;
use App\equipamientos;
use App\lineas;
use App\mobiliarios;
use App\infraestructuras;
use App\usos;
use App\contactos;

use DateTime;

// Obtención de campos
use Illuminate\Http\Request;

// Dependencias de Excel
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\adtExport;
use App\Exports\reporteGeneralTutorias;

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

    public function actualizarInternet(adts $adt){

        return view('Tutorias.actualizarInternet', compact('adt'));
    }

    public function actualizarInfraestructura(adts $adt){

        return view('Tutorias.actualizarInfraestructura', compact('adt'));
    }

    public function actualizarMobiliario(adts $adt){

        return view('Tutorias.actualizarMobiliario', compact('adt'));
    }

    public function actualizarUsoBdt(adts $adt){

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

    public function validarCambiosEstatus(adts $adt, $tipo){
        $telegram = new TelegramController();

        $users = User::all();
        switch ($tipo) {
            // callback_data determina función del webhook
            case 'ABIERTA':
                $botones = [
                    ['text' => 'VALIDAR Apertura', 'callback_data' => 'VALIDAR APERTURA ADT_'.$adt->ID_ADT],
                    ['text' => 'RECHAZAR', 'callback_data' => 'RECHAZAR APERTURA ADT_'.$adt->ID_ADT]
                ];
                break;
            case 'CERRADA':
                $botones = [
                    ['text' => 'VALIDAR Cierre', 'callback_data' => 'VALIDAR CIERRE ADT_'.$adt->ID_ADT],
                    ['text' => 'RECHAZAR', 'callback_data' => 'RECHAZAR CIERRE ADT_'.$adt->ID_ADT]
                ];
                break;
        }

        $payload = [
            'mensaje' => 'Nuevo cambio de estatus - '. $adt->NOMBRE,
            'botones' => $botones,
        ];

        // Notificar Encargados de Validacion
        foreach ($users as $user) {
            foreach ($user->permisos() as $permiso) {
                ($permiso == 'validar cambio estatus adt') ? $telegram->sendButtons($user->userable->TELEGRAM, $payload) : false;
            }
        }

    }
    // Contacto
    public function actualizarContactoForm(Request $request, adts $adt){
        
        $contacto = ['ID_ADT' => $adt->ID_ADT, 'TIPO' => 'RESPONSABLE AULA'];
        $actualizacionContacto = 
        [
            'ID_ADT' => $adt->ID_ADT, 'NOMBRE' => $request->input('r1_nombre'), 
            'CARGO' => $request->input('r1_cargo'), 'TELEFONO' => $request->input('r1_telefono'),
            'CELULAR' => $request->input('r1_celular'), 'CORREO' => $request->input('r1_correo'),
            'TIPO' => 'RESPONSABLE AULA'
        ];
        contactos::updateOrCreate($contacto, $actualizacionContacto);

        $contactoExtra = ['ID_ADT' => $adt->ID_ADT, 'TIPO' => 'RESPONSABLE AULA EXTRA'];
        $actualizacionContactoExtra = 
        [
            'ID_ADT' => $adt->ID_ADT, 'NOMBRE' => $request->input('r2_nombre'), 
            'CARGO' => $request->input('r2_cargo'), 'TELEFONO' => $request->input('r2_telefono'),
            'CELULAR' => $request->input('r2_celular'), 'CORREO' => $request->input('r2_correo'),
            'TIPO' => 'RESPONSABLE AULA EXTRA'
        ];
        contactos::updateOrCreate($contactoExtra, $actualizacionContactoExtra);

        $contactoMunicipal = ['ID_ADT' => $adt->ID_ADT, 'TIPO' => 'CONTACTO MUNICIPAL'];
        $actualizacionContactoMunicipal = 
        [
            'ID_ADT' => $adt->ID_ADT, 'NOMBRE' => $request->input('md_nombre'), 
            'CARGO' => $request->input('md_cargo'), 'TELEFONO' => $request->input('md_telefono'),
            'CELULAR' => $request->input('md_celular'), 'CORREO' => $request->input('md_correo'),
            'TIPO' => 'CONTACTO MUNICIPAL'
        ];
        contactos::updateOrCreate($contactoMunicipal, $actualizacionContactoMunicipal);

        return redirect()->route('consultar.tutoria');
        //return $request->all();
    }

    public function llamadaNoEfectivaForm(Request $request, adts $adt){
        $llamada = new llamadas;

        $llamada->ID_ADT        = $adt->ID_ADT;
        $llamada->FECHA         = date("Y-m-d H:i");
        $llamada->RESPONSABLE   = Auth::user()->userable->NOMBRE;

        $llamada->ESTATUS       = $request->input('motivo');
        $llamada->OBSERVACIONES = $request->input('observaciones');
        $llamada->VIDEO         = '';
        $llamada->EXPEDIENTE    = '';

        $llamada->save();

        return redirect()->route('consultar.tutoria');
    }

    public function panelLlamadaForm (Request $request, adts $adt){
        $llamada = new llamadas;

        $llamada->ID_ADT        = $adt->ID_ADT;
        $llamada->FECHA         = date("Y-m-d H:i");
        $llamada->RESPONSABLE   = Auth::user()->userable->NOMBRE;

        $llamada->ESTATUS       = "Llamada Efectiva";
        $llamada->VIDEO         = $request->input('videollamada');       //self::cargaVideoConferencia($request->file('videollamada'));
        $llamada->OBSERVACIONES = $request->input('observaciones');
        $llamada->EXPEDIENTE    = $request->input('expediente');       //self::cargaExpediente($request->file('expediente'));

        $llamada->save();
        ($request->input('estatus_adt'))? self::validarCambiosEstatus($adt,$request->input('estatus_adt')): false;

        return redirect()->route('consultar.tutoria');
    }

    public function actualizarInternetForm(Request $request,adts $adt){

        $linea=lineas::where('ID_ADT', $adt->ID_ADT)->first();
        $linea->LINEA = $request->input('linea');
        $linea->APORTA = $request->input('dependencia');
        $linea->PAGA = $request->input('dependencia_pago');
        $linea->ANCHO_BANDA = $request->input('ancho_banda');
        $linea->TECNOLOGIA = $request->input('tecnologia');
        $linea->SEMAFORO = $request->input('semaforo');
        $linea->OBSERVACIONES = $request->input('observaciones');
        $linea->save();

        return redirect()->route('panel.llamada.adt', $adt);

        //return $request->all();
    }

    public function actualizarInfraestructuraForm(Request $request,adts $adt){
        
        $infraestructura = ['ID_ADT' => $adt->ID_ADT];
        $actualizacionInfraestructura = 
        [
            'ID_ADT' => $adt->ID_ADT, 'KIT_SENALIZACION' => $request->input('kit_señalizacion'), 
            'ELECTRICIDAD' => $request->input('electricidad'), 'PINTURA_INTERIOR' => $request->input('pintura_interior'),
            'PINTURA_EXTERIOR' => $request->input('pintura_exterior'), 'OBSERVACIONES' => $request->input('observaciones')
        ];
        infraestructuras::updateOrCreate($infraestructura, $actualizacionInfraestructura);

        return redirect()->route('panel.llamada.adt', $adt);

    }

    public function actualizarMobiliarioForm(Request $request,adts $adt){

        $mobiliario=mobiliarios::where('ID_ADT', $adt->ID_ADT)->where('TIPO', 'FUNCIONAL')->first();
        $mobiliario->MESA_CIRCULAR = $request->input('mesaCircular_funcional');
        $mobiliario->SILLAS = $request->input('sillas_funcional');
        $mobiliario->MUEBLE_RESGUARDO = $request->input('muebleResguardo_funcional');
        $mobiliario->MESA_RECTANGULAR_GRANDE = $request->input('mesaRectangularGrande_funcional');
        $mobiliario->MESA_RECTANGULAR_MEDIANA = $request->input('mesaRectangularMediana_funcional');
        $mobiliario->OBSERVACIONES = $request->input('observaciones');
        $mobiliario->save();

        return redirect()->route('panel.llamada.adt', $adt);

        //return $request->all();
    }

    public function actualizarUsoBdtForm(Request $request,adts $adt){

        $uso = ['ID_ADT' => $adt->ID_ADT];
        $actualizacionUso = 
        [
            'ID_ADT' => $adt->ID_ADT, 'ESTATUS_REGISTRO' => $request->input('estatus_registro'), 
            'ESTATUS_OFERTA' => $request->input('estatus_curso'), 'TIPO_USO' => $request->input('tipo_uso'),
            'MAYORIA_POBLACION' => $request->input('poblacion'), 'HORA_INICIO' => $request->input('hora_inicio'),
            'HORA_FINAL' => $request->input('hora_final'), 'USUARIOS_SEMANALES' => $request->input('usuarios_semanales'),
            'OBSERVACIONES' => $request->input('observaciones')
        ];
        usos::updateOrCreate($uso, $actualizacionUso);

        return redirect()->route('panel.llamada.adt', $adt);

    }

    public function actualizarEquipamientoForm(Request $request, adts $adt){

        $equipamiento=equipamientos::where('ID_ADT', $adt->ID_ADT)->where('TIPO', 'FUNCIONAL')->first();
        $equipamiento->PC=$request->input('pc_funcional');
        $equipamiento->LAPTOP=$request->input('laptop_funcional');
        $equipamiento->NETBOOK=$request->input('netbook_funcional');
        $equipamiento->CLASSMATE=$request->input('classmate_funcional');
        $equipamiento->XO=$request->input('xo_funcional');
        $equipamiento->OBSERVACIONES=$request->input('observaciones');
        $equipamiento->save();

        $equipamiento=equipamientos::where('ID_ADT', $adt->ID_ADT)->where('TIPO', 'DAÑADO')->first();
        $equipamiento->PC=$request->input('pc_dañado');
        $equipamiento->LAPTOP=$request->input('laptop_dañado');
        $equipamiento->NETBOOK=$request->input('netbook_dañado');
        $equipamiento->CLASSMATE=$request->input('classmate_dañado');
        $equipamiento->XO=$request->input('xo_dañado');
        $equipamiento->save();

        $equipamiento=equipamientos::where('ID_ADT', $adt->ID_ADT)->where('TIPO', 'FALTANTE')->first();
        $equipamiento->PC=$request->input('pc_faltante');
        $equipamiento->LAPTOP=$request->input('laptop_faltante');
        $equipamiento->NETBOOK=$request->input('netbook_faltante');
        $equipamiento->CLASSMATE=$request->input('classmate_faltante');
        $equipamiento->XO=$request->input('xo_faltante');
        $equipamiento->save();

        $equipamiento=equipamientos::where('ID_ADT', $adt->ID_ADT)->where('TIPO', 'BAJA')->first();
        $equipamiento->PC=$request->input('pc_baja');
        $equipamiento->LAPTOP=$request->input('laptop_baja');
        $equipamiento->NETBOOK=$request->input('netbook_baja');
        $equipamiento->CLASSMATE=$request->input('classmate_baja');
        $equipamiento->XO=$request->input('xo_baja');
        $equipamiento->save();

        return redirect()->route('panel.llamada.adt', $adt);
        //return $request->all();
    }

    public function exportReporte(adts $adt){
        $archivo = new adtExport($adt);
        $archivo->descargar();
    }

    public function exportarReporteGeneral(Request $request){

        $reporteGeneralTutorias = new reporteGeneralTutorias();
        $reporteGeneralTutorias->descargarReporteGeneralActual($request);

    }

    public function consultarEstatusBdt(){

        $bdts = adts::with(['lineas', 'equipamientos', 'mobiliarios']);
        $bdtsAbiertas = (clone $bdts)->whereIn('ESTATUS_ACTUAL', ['ABIERTA', 'ABIERTA INTERNA']);
        $bdtsExternas = $bdtsAbiertas
        ->whereIn('ESPECIFICAS', ['ENTIDADES', 'SEDENA', 'UNAM', 'GUARDERIA TELMEX', 'NO']);
        $bdtsInternas = (clone $bdts)->where('ESTATUS_ACTUAL', 'ABIERTA INTERNA');


        $datosPorBdt = [];

        $datosPorBdt = [

            'bdtsAbiertas' => $bdtsAbiertas->count(),
            'bdtsExternas' => $bdtsExternas->count(),
            'bdtsInternas' => $bdtsInternas->count()

        ];

        

        return view('Tutorias.consultarEstatusBdt', compact('datosPorBdt'));

    }

    /* // CARGA/BAJA IMAGENES y OBTENCION NOMBRE
    public function cargaVideoConferencia($file){
        if (is_null($file)){
            return null;
        }else{
            //obtenemos el nombre del archivo
            $nombre_archivo =  time()."_".$file->getClientOriginalName();
            //indicamos que queremos guardar un nuevo archivo en el disco local
            \Storage::disk('tutorias_videollamadas')->put($nombre_archivo,  \File::get($file));

            return $nombre_archivo;
        }
    } 

    public function cargaExpediente($file){
        if (is_null($file)){
            return null;
        }else{
            //obtenemos el nombre del archivo
            $nombre_archivo =  time()."_".$file->getClientOriginalName();
            //indicamos que queremos guardar un nuevo archivo en el disco local
            \Storage::disk('tutorias_expedientes')->put($nombre_archivo,  \File::get($file));

            return $nombre_archivo;
        }
    }*/

}
