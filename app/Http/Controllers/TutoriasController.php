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

        //Abiertas
        $adtsAbiertas = adts::with(['lineas'])
        ->whereIn('ESTATUS_ACTUAL', ['ABIERTA', 'ABIERTA INTERNA']);
        $adtsAbiertasExternas = (clone $adtsAbiertas)->whereIn('INICIATIVA', ['ADT', 'BDT MPAL']);
        $adtsAbiertasInternas = (clone $adtsAbiertas)->where('INICIATIVA', 'CASA TELMEX');
        $adtsCerradasInternas = adts::with(['lineas'])
        ->where('ESTATUS_ACTUAL', 'CERRADA INTERNAS');

        $adtsConLineas = (clone $adtsAbiertas)
        ->whereHas('lineas', function($colaDeConsulta) {
            $colaDeConsulta->where('LINEA', '<>', 'BAJA');
        });
        $lineasDeAdts = lineas::with(['adts'])
        ->whereHas('adts', function ($colaDeConsulta) {
            $colaDeConsulta->whereIn('ESTATUS_ACTUAL', ['ABIERTA', 'ABIERTA INTERNA']);
        });
        $adtsConLineasPagaEntidad = (clone $adtsConLineas)
        ->whereHas('lineas', function($colaDeConsulta) {
            $colaDeConsulta->where('PAGA', 'INSTITUCIÓN / GOBIERNO');
        });
        $lineasDeAdtsPagaEntidad = (clone $lineasDeAdts)
        ->where('PAGA', 'INSTITUCIÓN / GOBIERNO');
        $lineasDeAdtsCobreQuePagaEntidad = (clone $lineasDeAdtsPagaEntidad)
        ->where('TECNOLOGIA', 'IPDSLAM');
        $adtsConLineasPagaTelmex = (clone $adtsConLineas)
        ->whereHas('lineas', function($colaDeConsulta) {
            $colaDeConsulta->whereIn('PAGA', ['TELMEX CT', 'TELMEX BDT EXTERNAS', 'FUNDACION CARLOS SLIM']);
        });
        $lineasDeAdtsPagaTelmex = (clone $lineasDeAdts)
        ->whereIn('PAGA', ['TELMEX CT', 'TELMEX BDT EXTERNAS', 'FUNDACION CARLOS SLIM']);
        $lineasDeAdtsEnlaceQuePagaTelmex = (clone $lineasDeAdtsPagaTelmex)
        ->where('TECNOLOGIA', 'ENLACE');
        $costoLineasPagaEntidad = (clone $lineasDeAdtsPagaEntidad)
        ->sum('COSTO');
        $costoLineasPagaTelmex = (clone $lineasDeAdtsPagaTelmex)
        ->sum('COSTO');
        $lineasConsumoSinConsumo = (clone $lineasDeAdts)
        ->whereIn('SEMAFORO', ['-', 'NULO', 'NULL'])->orWhereNull('SEMAFORO');
        $lineasConsumoBajo = (clone $lineasDeAdts)
        ->where('SEMAFORO', 'BAJO');
        $lineasConsumoMedio = (clone $lineasDeAdts)
        ->where('SEMAFORO', 'MEDIO');
        $lineasConsumoAlto = (clone $lineasDeAdts)
        ->where('SEMAFORO', 'ALTO');
        $lineasConsumoHeavy = (clone $lineasDeAdts)
        ->where('SEMAFORO', 'HEAVY');
        $lineasConsumoAtipico = (clone $lineasDeAdts)
        ->where('SEMAFORO', 'ATIPICO');

        $equipamientoAdts = equipamientos::with('adts');
        $totalEquipamientoAdts = 
        equipamientos::where('TIPO', 'INICIAL')->sum('PC') +
        equipamientos::where('TIPO', 'INICIAL')->sum('LAPTOP') +
        equipamientos::where('TIPO', 'INICIAL')->sum('CLASSMATE') +
        equipamientos::where('TIPO', 'INICIAL')->sum('XO');
        $equipamientoInicialAdts = equipamientos::whereHas('adts', function ($colaDeConsulta) {
            $colaDeConsulta->whereIn('ESTATUS_ACTUAL', ['ABIERTA', 'ABIERTA INTERNA']);
        })
        ->where('TIPO', 'INICIAL')
        ->get();
        $totalEquipamientoInicialAdts =
        $equipamientoInicialAdts->sum('PC') +
        $equipamientoInicialAdts->sum('LAPTOP') +
        $equipamientoInicialAdts->sum('CLASSMATE') +
        $equipamientoInicialAdts->sum('XO');
        $equipamientoFuncionalAdts = equipamientos::whereHas('adts', function($colaDeConsulta) {
            $colaDeConsulta->whereIn('ESTATUS_ACTUAL', ['ABIERTA', 'ABIERTA INTERNA']);
        })
        ->where('TIPO', 'FUNCIONAL')
        ->get();
        $totalEquipamientoFuncionalAdts = 
        $equipamientoFuncionalAdts->sum('PC') +
        $equipamientoFuncionalAdts->sum('LAPTOP') +
        $equipamientoFuncionalAdts->sum('CLASSMATE') +
        $equipamientoFuncionalAdts->sum('XO');
        $relacionPorcentualEquipamientoFuncionalEntreInicial = 
        ($totalEquipamientoFuncionalAdts * 100) / ($totalEquipamientoInicialAdts);
        
        $mobiliarioAdts = mobiliarios::with('adts');
        $totalMobiliarioAdts =
        mobiliarios::where('TIPO', 'INICIAL')->sum('MESA_RECTANGULAR_GRANDE') +
        mobiliarios::where('TIPO', 'INICIAL')->sum('MESA_RECTANGULAR_MEDIANA') +
        mobiliarios::where('TIPO', 'INICIAL')->sum('MESA_CIRCULAR') +
        mobiliarios::where('TIPO', 'INICIAL')->sum('SILLAS') +
        mobiliarios::where('TIPO', 'INICIAL')->sum('MUEBLE_RESGUARDO');
        $mobiliarioInicialAdts = mobiliarios::whereHas('adts', function($colaDeConsulta) {
            $colaDeConsulta->whereIn('ESTATUS_ACTUAL', ['ABIERTA', 'ABIERTA INTERNA']);
        })
        ->where('TIPO', 'INICIAL')
        ->get();
        $totalMobiliarioInicialAdts =
        $mobiliarioInicialAdts->sum('MESA_RECTANGULAR_GRANDE') +        
        $mobiliarioInicialAdts->sum('MESA_RECTANGULAR_MEDIANA') +        
        $mobiliarioInicialAdts->sum('MESA_CIRCULAR') +   
        $mobiliarioInicialAdts->sum('SILLAS') +    
        $mobiliarioInicialAdts->sum('MUEBLE_RESGUARDO');
        $mobiliarioFuncionalAdts = mobiliarios::whereHas('adts', function($colaDeConsulta) {
            $colaDeConsulta->whereIn('ESTATUS_ACTUAL', ['ABIERTA', 'ABIERTA INTERNA']);
        })
        ->where('TIPO', 'FUNCIONAL')
        ->get();
        $totalMobiliarioFuncionalAdts =
        $mobiliarioFuncionalAdts->sum('MESA_RECTANGULAR_GRANDE') +        
        $mobiliarioFuncionalAdts->sum('MESA_RECTANGULAR_MEDIANA') +        
        $mobiliarioFuncionalAdts->sum('MESA_CIRCULAR') +    
        $mobiliarioFuncionalAdts->sum('SILLAS') +        
        $mobiliarioFuncionalAdts->sum('MUEBLE_RESGUARDO');
        $conveniosIndeterminadosAdts = 
        (clone $adtsAbiertas)->whereNull('FECHA_TERMINO_CONVENIO');
        $conveniosVencidosAdts = 
        (clone $adtsAbiertas)->whereNotNull('FECHA_TERMINO_CONVENIO')
        ->where('FECHA_TERMINO_CONVENIO', '<', Carbon::now()->toDateString());
        $conveniosVigentesAdts = 
        (clone $adtsAbiertas)->whereNotNull('FECHA_TERMINO_CONVENIO')
        ->where('FECHA_TERMINO_CONVENIO', '>=', Carbon::now()->toDateString());


        //Abiertas Internas
        $adtsInternasPropias = (clone $adtsAbiertasInternas)->where('ENTORNO', 'PROPIA');
        $numeroAdtsInternasPropias = $adtsInternasPropias->count();
        $adtsInternasExternas = (clone $adtsAbiertasInternas)->where('ENTORNO', 'EXTERNA');
        $numeroAdtsInternasExternas = $adtsInternasExternas->count();

        $adtsInternasExternasConLineas = (clone $adtsInternasExternas)
        ->whereHas('lineas', function($colaDeConsulta) {
            $colaDeConsulta->where('LINEA', '<>', 'BAJA')
            ->whereIn('PAGA', ['TELMEX CT', 'TELMEX BDT EXTERNAS', 'FUNDACION CARLOS SLIM']);
        });
        $adtsInternasPropiasConLineas = (clone $adtsInternasPropias)
        ->whereHas('lineas', function($colaDeConsulta) {
            $colaDeConsulta->where('LINEA', '<>', 'BAJA')
            ->whereIn('PAGA', ['TELMEX CT', 'TELMEX BDT EXTERNAS', 'FUNDACION CARLOS SLIM']);
        });
        $lineasDeAdtsInternas = lineas::with(['adts'])
        ->whereHas('adts', function ($colaDeConsulta) {
            $colaDeConsulta->where('ESTATUS_ACTUAL', 'ABIERTA INTERNA')
            ->where('INICIATIVA', 'CASA TELMEX');
        });
        $lineasDeAdtsInternasExternas = (clone $lineasDeAdtsInternas)
        ->whereHas('adts', function ($colaDeConsulta) {
            $colaDeConsulta->where('ENTORNO', 'EXTERNA');
        });
        $lineasDeAdtsInternasPropias = (clone $lineasDeAdtsInternas)
        ->whereHas('adts', function ($colaDeConsulta) {
            $colaDeConsulta->where('ENTORNO', 'PROPIA');
        });
        $costoLineasAdtsInternasExternasPagaTelmex = (clone $lineasDeAdtsInternasExternas)
        ->whereIn('PAGA', ['TELMEX CT', 'TELMEX BDT EXTERNAS', 'FUNDACION CARLOS SLIM'])
        ->sum('COSTO');
        $costoLineasAdtsInternasPropiasPagaTelmex = (clone $lineasDeAdtsInternasPropias)
        ->whereIn('PAGA', ['TELMEX CT', 'TELMEX BDT EXTERNAS', 'FUNDACION CARLOS SLIM'])
        ->sum('COSTO');
        $lineasAdtsInternasConsumoSinConsumo = (clone $lineasDeAdtsInternas)
        ->whereIn('SEMAFORO', ['-', 'NULO', 'NULL'])->orWhereNull('SEMAFORO');
        $lineasAdtsInternasConsumoBajo = (clone $lineasDeAdtsInternas)
        ->where('SEMAFORO', 'BAJO');
        $lineasAdtsInternasConsumoMedio = (clone $lineasDeAdtsInternas)
        ->where('SEMAFORO', 'MEDIO');
        $lineasAdtsInternasConsumoAlto = (clone $lineasDeAdtsInternas)
        ->where('SEMAFORO', 'ALTO');
        $lineasAdtsInternasConsumoHeavy = (clone $lineasDeAdtsInternas)
        ->where('SEMAFORO', 'HEAVY');
        $lineasAdtsInternasConsumoAtipico = (clone $lineasDeAdtsInternas)
        ->where('SEMAFORO', 'ATIPICO');

        $equipamientoAdtsInternas = equipamientos::with('adts')
        ->whereHas('adts', function($colaDeConsulta) {
            $colaDeConsulta->where('ESTATUS_ACTUAL', 'ABIERTA INTERNA')
            ->where('INICIATIVA', 'CASA TELMEX');
        });
        $totalEquipamientoAdtsInternas = 
        (clone $equipamientoAdtsInternas)->where('TIPO', 'INICIAL')->sum('PC') +
        (clone $equipamientoAdtsInternas)->where('TIPO', 'INICIAL')->sum('CLASSMATE') +
        (clone $equipamientoAdtsInternas)->where('TIPO', 'INICIAL')->sum('LAPTOP') +
        (clone $equipamientoAdtsInternas)->where('TIPO', 'INICIAL')->sum('XO');
        $equipamientoInicialAdtsInternas = (clone $equipamientoAdtsInternas)
        ->where('TIPO', 'INICIAL')
        ->get();
        $equipamientoFuncionalAdtsInternas = (clone $equipamientoAdtsInternas)
        ->where('TIPO', 'FUNCIONAL')
        ->get();
        $totalEquipamientoFuncionalAdtsInternas = 
        $equipamientoFuncionalAdtsInternas->sum('PC') +
        $equipamientoFuncionalAdtsInternas->sum('LAPTOP') +
        $equipamientoFuncionalAdtsInternas->sum('CLASSMATE') +
        $equipamientoFuncionalAdtsInternas->sum('XO');
        $totalEquipamientoInicialAdtsInternas =
        $equipamientoInicialAdtsInternas->sum('PC') +
        $equipamientoInicialAdtsInternas->sum('LAPTOP') +
        $equipamientoInicialAdtsInternas->sum('CLASSMATE') +
        $equipamientoInicialAdtsInternas->sum('XO');
        $totalEquipamientoBDOFAdtsInternas =
        ($equipamientoInicialAdtsInternas->sum('PC') 
        - $equipamientoFuncionalAdtsInternas->sum('PC')) +
        ($equipamientoInicialAdtsInternas->sum('LAPTOP') 
        - $equipamientoFuncionalAdtsInternas->sum('LAPTOP')) +
        ($equipamientoInicialAdtsInternas->sum('CLASSMATE') 
        - $equipamientoFuncionalAdtsInternas->sum('CLASSMATE')) +
        ($equipamientoInicialAdtsInternas->sum('XO')
        - $equipamientoFuncionalAdtsInternas->sum('XO'));
        $relacionPorcentualEquipamientoFuncionalEntreInicialAdtsInternas = 
        ($totalEquipamientoFuncionalAdtsInternas * 100) / ($totalEquipamientoInicialAdtsInternas);

        $conveniosIndeterminadosAdtsInternas = 
        (clone $adtsAbiertasInternas)->whereNull('FECHA_TERMINO_CONVENIO');
        $conveniosVencidosAdtsInternas = 
        (clone $adtsAbiertasInternas)->whereNotNull('FECHA_TERMINO_CONVENIO')
        ->where('FECHA_TERMINO_CONVENIO', '<', Carbon::now()->toDateString());
        $conveniosVigentesAdtsInternas = 
        (clone $adtsAbiertasInternas)->whereNotNull('FECHA_TERMINO_CONVENIO')
        ->where('FECHA_TERMINO_CONVENIO', '>=', Carbon::now()->toDateString());

        //Cerradas Internas
        $adtsInternasPropiasCerradas = (clone $adtsCerradasInternas)->where('ENTORNO', 'PROPIA');
        $adtsInternasExternasCerradas = (clone $adtsCerradasInternas)->where('ENTORNO', 'EXTERNA');

        $adtsInternasExternasCerradasConLineas = (clone $adtsInternasExternasCerradas)
        ->whereHas('lineas', function($colaDeConsulta) {
            $colaDeConsulta->where('LINEA', '<>', 'BAJA')
            ->whereIn('PAGA', ['TELMEX CT', 'TELMEX BDT EXTERNAS', 'FUNDACION CARLOS SLIM']);
        });
        $adtsInternasPropiasCerradasConLineas = (clone $adtsInternasPropiasCerradas)
        ->whereHas('lineas', function($colaDeConsulta) {
            $colaDeConsulta->where('LINEA', '<>', 'BAJA')
            ->whereIn('PAGA', ['TELMEX CT', 'TELMEX BDT EXTERNAS', 'FUNDACION CARLOS SLIM']);
        });
        $lineasDeAdtsInternasCerradas = lineas::with(['adts'])
        ->whereHas('adts', function ($colaDeConsulta) {
            $colaDeConsulta->where('ESTATUS_ACTUAL', 'CERRADA INTERNAS')
            ->where('INICIATIVA', 'CASA TELMEX');
        });
        $lineasDeAdtsInternasExternasCerradas = (clone $lineasDeAdtsInternasCerradas)
        ->whereHas('adts', function ($colaDeConsulta) {
            $colaDeConsulta->where('ENTORNO', 'EXTERNA');
        });
        $lineasDeAdtsInternasPropiasCerradas = (clone $lineasDeAdtsInternasCerradas)
        ->whereHas('adts', function ($colaDeConsulta) {
            $colaDeConsulta->where('ENTORNO', 'PROPIA');
        });
        $costoLineasAdtsInternasExternasCerradasPagaTelmex = (clone $lineasDeAdtsInternasExternasCerradas)
        ->whereIn('PAGA', ['TELMEX CT', 'TELMEX BDT EXTERNAS', 'FUNDACION CARLOS SLIM'])
        ->sum('COSTO');
        $costoLineasAdtsInternasPropiasCerradasPagaTelmex = (clone $lineasDeAdtsInternasPropiasCerradas)
        ->whereIn('PAGA', ['TELMEX CT', 'TELMEX BDT EXTERNAS', 'FUNDACION CARLOS SLIM'])
        ->sum('COSTO');
        $lineasAdtsInternasCerradasConsumoSinConsumo = (clone $lineasDeAdtsInternasCerradas)
        ->whereIn('SEMAFORO', ['-', 'NULO', 'NULL'])->orWhereNull('SEMAFORO');
        $lineasAdtsInternasCerradasConsumoBajo = (clone $lineasDeAdtsInternasCerradas)
        ->where('SEMAFORO', 'BAJO');
        $lineasAdtsInternasCerradasConsumoMedio = (clone $lineasDeAdtsInternasCerradas)
        ->where('SEMAFORO', 'MEDIO');
        $lineasAdtsInternasCerradasConsumoAlto = (clone $lineasDeAdtsInternasCerradas)
        ->where('SEMAFORO', 'ALTO');
        $lineasAdtsInternasCerradasConsumoHeavy = (clone $lineasDeAdtsInternasCerradas)
        ->where('SEMAFORO', 'HEAVY');
        $lineasAdtsInternasCerradasConsumoAtipico = (clone $lineasDeAdtsInternasCerradas)
        ->where('SEMAFORO', 'ATIPICO');

        $equipamientoAdtsInternasCerradas = equipamientos::with('adts')
        ->whereHas('adts', function($colaDeConsulta) {
            $colaDeConsulta->where('ESTATUS_ACTUAL', 'CERRADA INTERNAS')
            ->where('INICIATIVA', 'CASA TELMEX');
        });
        $totalEquipamientoAdtsInternasCerradas = 
        (clone $equipamientoAdtsInternasCerradas)->where('TIPO', 'INICIAL')->sum('PC') +
        (clone $equipamientoAdtsInternasCerradas)->where('TIPO', 'INICIAL')->sum('CLASSMATE') +
        (clone $equipamientoAdtsInternasCerradas)->where('TIPO', 'INICIAL')->sum('LAPTOP') +
        (clone $equipamientoAdtsInternasCerradas)->where('TIPO', 'INICIAL')->sum('XO');
        $equipamientoInicialAdtsInternasCerradas = (clone $equipamientoAdtsInternasCerradas)
        ->where('TIPO', 'INICIAL')
        ->get();
        $equipamientoFuncionalAdtsInternasCerradas = (clone $equipamientoAdtsInternasCerradas)
        ->where('TIPO', 'FUNCIONAL')
        ->get();
        $totalEquipamientoFuncionalAdtsInternasCerradas = 
        $equipamientoFuncionalAdtsInternasCerradas->sum('PC') +
        $equipamientoFuncionalAdtsInternasCerradas->sum('LAPTOP') +
        $equipamientoFuncionalAdtsInternasCerradas->sum('CLASSMATE') +
        $equipamientoFuncionalAdtsInternasCerradas->sum('XO');
        $totalEquipamientoInicialAdtsInternasCerradas =
        $equipamientoInicialAdtsInternasCerradas->sum('PC') +
        $equipamientoInicialAdtsInternasCerradas->sum('LAPTOP') +
        $equipamientoInicialAdtsInternasCerradas->sum('CLASSMATE') +
        $equipamientoInicialAdtsInternasCerradas->sum('XO');
        $totalEquipamientoBDOFAdtsInternasCerradas =
        ($equipamientoInicialAdtsInternasCerradas->sum('PC') 
        - $equipamientoFuncionalAdtsInternasCerradas->sum('PC')) +
        ($equipamientoInicialAdtsInternasCerradas->sum('LAPTOP') 
        - $equipamientoFuncionalAdtsInternasCerradas->sum('LAPTOP')) +
        ($equipamientoInicialAdtsInternasCerradas->sum('CLASSMATE') 
        - $equipamientoFuncionalAdtsInternasCerradas->sum('CLASSMATE')) +
        ($equipamientoInicialAdtsInternasCerradas->sum('XO')
        - $equipamientoFuncionalAdtsInternasCerradas->sum('XO'));

        $conveniosIndeterminadosAdtsInternasCerradas = 
        (clone $adtsCerradasInternas)->whereNull('FECHA_TERMINO_CONVENIO');
        $conveniosVencidosAdtsInternasCerradas = 
        (clone $adtsCerradasInternas)->whereNotNull('FECHA_TERMINO_CONVENIO')
        ->where('FECHA_TERMINO_CONVENIO', '<', Carbon::now()->toDateString());
        $conveniosVigentesAdtsInternasCerradas = 
        (clone $adtsCerradasInternas)->whereNotNull('FECHA_TERMINO_CONVENIO')
        ->where('FECHA_TERMINO_CONVENIO', '>=', Carbon::now()->toDateString());


        // Creamos el array con el conteo
        $datosAdts = [
            //Datos Abiertas Totales
            'numeroAdtsAbiertas' => $adtsAbiertas->count(),
            'numeroAdtsExternas' => $adtsAbiertasExternas->count(),
            'numeroAdtsInternas' => $adtsAbiertasInternas->count(),
            'numeroAdtsCerradasInternas' => $adtsCerradasInternas->count(),
            'numeroAdtsConLineasPagaEntidad' => $adtsConLineasPagaEntidad->count(),
            'numeroLineasPagaEntidad' => $lineasDeAdtsPagaEntidad->count(),
            'numeroLineasCobre' => $lineasDeAdtsCobreQuePagaEntidad->count(),
            'numeroAdtsConLineasPagaTelmex' => $adtsConLineasPagaTelmex->count(),
            'numeroLineasPagaTelmex' => $lineasDeAdtsPagaTelmex->count(),
            'numeroLineasEnlaceQuePagaTelmex' => $lineasDeAdtsEnlaceQuePagaTelmex->count(),
            'costoLineasPagaEntidad' => $costoLineasPagaEntidad,
            'costoLineasPagaTelmex' => $costoLineasPagaTelmex,
            'numeroLineasConsumoSinConsumo' => $lineasConsumoSinConsumo->count(),
            'numeroLineasConsumoBajo' => $lineasConsumoBajo->count(),
            'numeroLineasConsumoMedio' => $lineasConsumoMedio->count(),
            'numeroLineasConsumoAlto' => $lineasConsumoAlto->count(),
            'numeroLineasConsumoHeavy' => $lineasConsumoHeavy->count(),
            'numeroLineasConsumoAtipico' => $lineasConsumoAtipico->count(),
            'cantidadEquipamientoAdts' => $totalEquipamientoAdts,
            'cantidadEquipamientoInicialAdts' => $totalEquipamientoInicialAdts,
            'cantidadEquipamientoFuncionalAdts' => $totalEquipamientoFuncionalAdts,
            'cantidadRelacionPorcentualEquipamientoFuncionalEntreInicial' => 
            $relacionPorcentualEquipamientoFuncionalEntreInicial,
            'cantidadMobiliarioAdts' => $totalMobiliarioAdts,
            'cantidadMobiliarioInicialAdts' => $totalMobiliarioInicialAdts,
            'cantidadMobiliarioFuncionaAdts' => $totalMobiliarioFuncionalAdts,
            'numeroConveniosIndeterminadosAdts' => $conveniosIndeterminadosAdts->count(),
            'numeroConveniosVencidosAdts' => $conveniosVencidosAdts->count(),
            'conveniosVigentesAdts' => $conveniosVigentesAdts->get(),
            'numeroConveniosVigentesAdts' => $conveniosVigentesAdts->count(),

            //Datos Abiertas Internas
            'adtsInternasPropias' => $adtsInternasPropias->get(),
            'numeroAdtsInternasPropias' => $numeroAdtsInternasPropias,
            'adtsInternasExternas' => $adtsInternasExternas->get(),
            'numeroAdtsInternasExternas' => $numeroAdtsInternasExternas,
            'numeroLineasAdtsInternasExternas' => $adtsInternasExternasConLineas->count(),
            'numeroLineasAdtsInternasPropias' => $adtsInternasPropiasConLineas->count(),
            'costoLineasAdtsInternasExternasPagaTelmex' 
            => $costoLineasAdtsInternasExternasPagaTelmex,
            'costoLineasAdtsInternasPropiasPagaTelmex' 
            => $costoLineasAdtsInternasPropiasPagaTelmex,
            'numeroLineasAdtsInternasConsumoSinConsumo' => $lineasAdtsInternasConsumoSinConsumo->count(),
            'numeroLineasAdtsInternasConsumoBajo' => $lineasAdtsInternasConsumoBajo->count(),
            'numeroLineasAdtsInternasConsumoMedio' => $lineasAdtsInternasConsumoMedio->count(),
            'numeroLineasAdtsInternasConsumoAlto' => $lineasAdtsInternasConsumoAlto->count(),
            'numeroLineasAdtsInternasConsumoHeavy' => $lineasAdtsInternasConsumoHeavy->count(),
            'numeroLineasAdtsInternasConsumoAtipico' => $lineasAdtsInternasConsumoAtipico->count(),
            'cantidadEquipamientoAdtsInternas' => $totalEquipamientoAdtsInternas,
            'cantidadEquipamientoFuncionalAdtsInternas' => $totalEquipamientoFuncionalAdtsInternas,
            'cantidadEquipamientoBDOFAdtsInternas' => $totalEquipamientoBDOFAdtsInternas,
            'cantidadRelacionPorcentualEquipamientoFuncionalEntreInicialAdtsInternas' 
            => $relacionPorcentualEquipamientoFuncionalEntreInicialAdtsInternas,
            'numeroConveniosIndeterminadosAdtsInternas' => $conveniosIndeterminadosAdtsInternas->count(),
            'numeroConveniosVencidosAdtsInternas' => $conveniosVencidosAdtsInternas->count(),
            'conveniosVigentesAdtsInternas' => $conveniosVigentesAdtsInternas->get(),
            'numeroConveniosVigentesAdtsInternas' => $conveniosVigentesAdtsInternas->count(),

            //Datos Cerradas Internas
            'adtsCerradasInternas' => $adtsCerradasInternas->get(),
            'numeroLineasAdtsInternasExternasCerradas' => 
            $adtsInternasExternasCerradasConLineas->count(),
            'numeroLineasAdtsInternasPropiasCerradas' => 
            $adtsInternasPropiasCerradasConLineas->count(),
            'costoLineasAdtsInternasExternasCerradasPagaTelmex' 
            => $costoLineasAdtsInternasExternasCerradasPagaTelmex,
            'costoLineasAdtsInternasPropiasCerradasPagaTelmex' 
            => $costoLineasAdtsInternasPropiasCerradasPagaTelmex,
            'numeroLineasAdtsInternasCerradasConsumoSinConsumo' => 
            $lineasAdtsInternasCerradasConsumoSinConsumo->count(),
            'numeroLineasAdtsInternasCerradasConsumoBajo' => 
            $lineasAdtsInternasCerradasConsumoBajo->count(),
            'numeroLineasAdtsInternasCerradasConsumoMedio' => 
            $lineasAdtsInternasCerradasConsumoMedio->count(),
            'numeroLineasAdtsInternasCerradasConsumoAlto' => 
            $lineasAdtsInternasCerradasConsumoAlto->count(),
            'numeroLineasAdtsInternasCerradasConsumoHeavy' => 
            $lineasAdtsInternasCerradasConsumoHeavy->count(),
            'numeroLineasAdtsInternasCerradasConsumoAtipico' => 
            $lineasAdtsInternasCerradasConsumoAtipico->count(),
            'cantidadEquipamientoAdtsInternasCerradas' => $totalEquipamientoAdtsInternasCerradas,
            'cantidadEquipamientoFuncionalAdtsInternasCerradas' => 
            $totalEquipamientoFuncionalAdtsInternasCerradas,
            'cantidadEquipamientoBDOFAdtsInternasCerradas' => 
            $totalEquipamientoBDOFAdtsInternasCerradas,
            'conveniosVigentesAdtsInternasCerradas' =>
            $conveniosVigentesAdtsInternasCerradas->get(),
            'numeroConveniosVigentesAdtsInternasCerradas' => 
            $conveniosVigentesAdtsInternasCerradas->count(),
            'numeroConveniosVencidosAdtsInternasCerradas' => 
            $conveniosVencidosAdtsInternasCerradas->count(),
            'numeroConveniosIndeterminadosAdtsInternasCerradas' => 
            $conveniosIndeterminadosAdtsInternasCerradas->count()
        ];

        return view('Tutorias.consultarEstatusBdt', compact('datosAdts'));

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
