<?php

namespace App\Exports;

use DB;
use App\adts;
use App\lineas;
use App\infraestructuras;
use App\usos;
use App\equipamientos;
use App\mobiliarios;

use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;

class reporteGeneralTutorias {
    
    public function __construct() {

    }

    public function generarReporteGeneralActual(Request $request){

        return Excel::create('Reporte General Actual de Tutorías', function($excel) use ($request){

            $excel->sheet('Resumen', function($sheet) use (&$request) {

            $adtsAbiertos = DB::table('adts')->where('ESTATUS_ACTUAL', 'ABIERTA');
            $tipoReporte = (array) $request->input('tipo_reporte_especifico', []);
            $tipoReportePorEstado = (array) $request->input('tipo_reporte_por_estado', []);

            if ($request->filled('tipo_reporte_especifico') && $request->filled('tipo_reporte_por_estado')) {
                $adtsAbiertos = $adtsAbiertos->whereIn('ESPECIFICAS', $tipoReporte)->whereIn('ESTADO', $tipoReportePorEstado);
            }elseif ($request->filled('tipo_reporte_especifico') && !$request->filled('tipo_reporte_por_estado')) {
                $adtsAbiertos = $adtsAbiertos->whereIn('ESPECIFICAS', $tipoReporte);
            }elseif (!$request->filled('tipo_reporte_especifico') && $request->filled('tipo_reporte_por_estado')) {
                $adtsAbiertos = $adtsAbiertos->whereIn('ESTADO', $tipoReportePorEstado);
            }

            $adtsAbiertos = $adtsAbiertos->pluck('ID_ADT');
            
                $total = [

                    'total_senalizacion_colocada' => infraestructuras::whereIn('ID_ADT', $adtsAbiertos)
                    ->where('KIT_SENALIZACION', 'Colocada')->count(),
                    'total_senalizacion_despegada' => infraestructuras::whereIn('ID_ADT', $adtsAbiertos)
                    ->where('KIT_SENALIZACION', 'Despegada')->count(),

                    'total_electricidad_funcional' => infraestructuras::whereIn('ID_ADT', $adtsAbiertos)
                    ->where('ELECTRICIDAD', 'Funcional')->count(),
                    'total_electricidad_intermitente' => infraestructuras::whereIn('ID_ADT', $adtsAbiertos)
                    ->where('ELECTRICIDAD', 'Intermitente')->count(),
                    'total_electricidad_sin_servicio' => infraestructuras::whereIn('ID_ADT', $adtsAbiertos)
                    ->where('ELECTRICIDAD', 'Sin Servicio')->count(),

                    'total_pintura_interior_sin_cambios' => infraestructuras::whereIn('ID_ADT', $adtsAbiertos)
                    ->where('PINTURA_INTERIOR', 'Sin Cambios')->count(),
                    'total_pintura_interior_danado' => infraestructuras::whereIn('ID_ADT', $adtsAbiertos)
                    ->where('PINTURA_INTERIOR', 'Dañado')->count(),
                    'total_pintura_interior_filtracion' => infraestructuras::whereIn('ID_ADT', $adtsAbiertos)
                    ->where('PINTURA_INTERIOR', 'Filtración')->count(),

                    'total_pintura_exterior_sin_cambios' => infraestructuras::whereIn('ID_ADT', $adtsAbiertos)
                    ->where('PINTURA_EXTERIOR', 'Sin Cambios')->count(),
                    'total_pintura_exterior_danado' => infraestructuras::whereIn('ID_ADT', $adtsAbiertos)
                    ->where('PINTURA_EXTERIOR', 'Dañado')->count(),
                    'total_pintura_exterior_filtracion' => infraestructuras::whereIn('ID_ADT', $adtsAbiertos)
                    ->where('PINTURA_EXTERIOR', 'Filtración')->count(),

                    'total_equipamiento_funcional' => equipamientos::whereIn('ID_ADT', $adtsAbiertos)->where('TIPO', 'FUNCIONAL')
                    ->selectRaw('SUM(PC + LAPTOP + NETBOOK) as total_e_funcional')
                    ->value('total_e_funcional'),
                    'total_equipamiento_danado' => equipamientos::whereIn('ID_ADT', $adtsAbiertos)->where('TIPO', 'DAÑADO')
                    ->selectRaw('SUM(PC + LAPTOP + NETBOOK) as total_e_danado')
                    ->value('total_e_danado'),
                    'total_equipamiento_faltante' => equipamientos::whereIn('ID_ADT', $adtsAbiertos)->where('TIPO', 'FALTANTE')
                    ->selectRaw('SUM(PC + LAPTOP + NETBOOK) as total_e_faltante')
                    ->value('total_e_faltante'),
                    'total_equipamiento_baja' => equipamientos::whereIn('ID_ADT', $adtsAbiertos)->where('TIPO', 'BAJA')
                    ->selectRaw('SUM(PC + LAPTOP + NETBOOK) as total_e_baja')
                    ->value('total_e_baja'),

                    'total_mobiliario_funcional' => mobiliarios::whereIn('ID_ADT', $adtsAbiertos)->where('TIPO', 'FUNCIONAL')
                    ->selectRaw('SUM(MESA_RECTANGULAR_GRANDE + MESA_RECTANGULAR_MEDIANA + MESA_CIRCULAR + SILLAS + 
                    MUEBLE_RESGUARDO) as total_e_funcional')->value('total_e_funcional'),

                    'total_mobiliario_danado' => mobiliarios::whereIn('ID_ADT', $adtsAbiertos)
                    ->selectRaw("
                        (
                            SUM(CASE WHEN TIPO = 'INICIAL' THEN MESA_RECTANGULAR_GRANDE ELSE 0 END) +
                            SUM(CASE WHEN TIPO = 'INICIAL' THEN MESA_RECTANGULAR_MEDIANA ELSE 0 END) +
                            SUM(CASE WHEN TIPO = 'INICIAL' THEN MESA_CIRCULAR ELSE 0 END) +
                            SUM(CASE WHEN TIPO = 'INICIAL' THEN SILLAS ELSE 0 END) +
                            SUM(CASE WHEN TIPO = 'INICIAL' THEN MUEBLE_RESGUARDO ELSE 0 END)
                        ) -
                        (
                            SUM(CASE WHEN TIPO = 'FUNCIONAL' THEN MESA_RECTANGULAR_GRANDE ELSE 0 END) +
                            SUM(CASE WHEN TIPO = 'FUNCIONAL' THEN MESA_RECTANGULAR_MEDIANA ELSE 0 END) +
                            SUM(CASE WHEN TIPO = 'FUNCIONAL' THEN MESA_CIRCULAR ELSE 0 END) +
                            SUM(CASE WHEN TIPO = 'FUNCIONAL' THEN SILLAS ELSE 0 END) +
                            SUM(CASE WHEN TIPO = 'FUNCIONAL' THEN MUEBLE_RESGUARDO ELSE 0 END)
                        ) AS total_m_danado
                    ")
                    ->value('total_m_danado')

                ];

                $sheet->loadview('exports.reporteGeneralTutorias', ['total' => $total]);

                $sheet->getStyle('A1:B18' , $sheet->getHighestRow())->getAlignment()->setWrapText(true);

            });

            $excel->sheet('Detalle', function($sheet) use (&$request) {

                $adtsAbiertos = adts::with(['lineas', 'infraestructuras', 'equipamientos', 'mobiliarios'])
                ->where('ESTATUS_ACTUAL', 'ABIERTA');
                $tipoReporte = (array) $request->input('tipo_reporte_especifico', []);
                $tipoReportePorEstado = (array) $request->input('tipo_reporte_por_estado', []);

                if ($request->filled('tipo_reporte_especifico') && $request->filled('tipo_reporte_por_estado')) {
                    $adtsAbiertos = $adtsAbiertos->whereIn('ESPECIFICAS', $tipoReporte)->whereIn('ESTADO', $tipoReportePorEstado);
                }elseif ($request->filled('tipo_reporte_especifico') && !$request->filled('tipo_reporte_por_estado')) {
                    $adtsAbiertos = $adtsAbiertos->whereIn('ESPECIFICAS', $tipoReporte);
                }elseif (!$request->filled('tipo_reporte_especifico') && $request->filled('tipo_reporte_por_estado')) {
                    $adtsAbiertos = $adtsAbiertos->whereIn('ESTADO', $tipoReportePorEstado);
                }

                $adtsAbiertos = $adtsAbiertos->get();

                $datosPorAdt = [];

                foreach ($adtsAbiertos as $adt) { 

                    $equiposFuncionales = $adt->equipamientos->where('TIPO', 'FUNCIONAL');
                    $equiposDanados = $adt->equipamientos->where('TIPO', 'DAÑADO');
                    $equiposFaltantes = $adt->equipamientos->where('TIPO', 'FALTANTE');
                    $equiposBaja = $adt->equipamientos->where('TIPO', 'BAJA');

                    $mobiliarioInicial = $adt->mobiliarios->where('TIPO', 'INICIAL')->sum('MESA_RECTANGULAR_GRANDE');
                    $mobiliarioFuncional = $adt->mobiliarios->where('TIPO', 'FUNCIONAL')->sum('MESA_RECTANGULAR_GRANDE');

                    $datosPorAdt[$adt->ID_ADT] = [

                        'sede' => $adt->NOMBRE,
                        'clave' => $adt->CLAVE_SITIO,
                        'estado' => $adt->ESTADO,
                        'tipo' => $adt->ESPECIFICAS,

                        'internet_tecnologia' => optional($adt->lineas->first())->TECNOLOGIA ?? '-',
                        'internet_semaforo' => optional($adt->lineas->first())->SEMAFORO ?? '-',
                        'internet_observaciones' => optional($adt->lineas->first())->OBSERVACIONES ?? '-',

                        'senalizacion' => optional($adt->infraestructuras->first())->KIT_SENALIZACION ?? '-',
                        'electricidad' => optional($adt->infraestructuras->first())->ELECTRICIDAD ?? '-',
                        'pintura_interior' => optional($adt->infraestructuras->first())->PINTURA_INTERIOR ?? '-',
                        'pintura_exterior' => optional($adt->infraestructuras->first())->PINTURA_EXTERIOR ?? '-',

                        'pc_funcional' => optional($equiposFuncionales->first())->PC ?? '-',
                        'pc_danado' => optional($equiposDanados->first())->PC ?? '-',
                        'pc_faltante' => optional($equiposFaltantes->first())->PC ?? '-',
                        'pc_baja' => optional($equiposBaja->first())->PC ?? '-',

                        'laptop_funcional' => optional($equiposFuncionales->first())->LAPTOP ?? '-',
                        'laptop_danado' => optional($equiposDanados->first())->LAPTOP ?? '-',
                        'laptop_faltante' => optional($equiposFaltantes->first())->LAPTOP ?? '-',
                        'laptop_baja' => optional($equiposBaja->first())->LAPTOP ?? '-',

                        'netbook_funcional' => optional($equiposFuncionales->first())->NETBOOK ?? '-',
                        'netbook_danado' => optional($equiposDanados->first())->NETBOOK ?? '-',
                        'netbook_faltante' => optional($equiposFaltantes->first())->NETBOOK ?? '-',
                        'netbook_baja' => optional($equiposBaja->first())->NETBOOK ?? '-',

                        'mobiliario_funcional' => $mobiliarioFuncional,
                        'mobiliario_danado' => $mobiliarioInicial - $mobiliarioFuncional

                    ];
                    
                }

                $sheet->loadview('exports.reporteDetalladoTutorias', ['datosPorAdt' => $datosPorAdt]);

                $sheet->getStyle('A1:A25' , $sheet->getHighestRow())->getAlignment()->setWrapText(true);

            });

            /*$excel->sheet('Detalle Tutorías SEDENA', function($sheet) use ($request) {

                $adtsAbiertosSedena = adts::with(['lineas', 'infraestructuras', 'equipamientos', 'mobiliarios'])
                ->where('ESTATUS_ACTUAL', 'ABIERTA')->where('ESPECIFICAS', '%SEDENA%');

                if ($request->filled('tipo_reporte_especifico') && $request->filled('tipo_reporte_por_estado')) {
                    $adtsAbiertosSedena = $adtsAbiertosSedena->whereIn('ESTADO', $request->input('tipo_reporte_por_estado'))
                    ->whereIn('ESPECIFICAS', $request->input('tipo_reporte_especifico'))->get();
                }elseif ($request->filled('tipo_reporte_especifico') && !$request->filled('tipo_reporte_por_estado')) {
                    $adtsAbiertosSedena = $adtsAbiertosSedena->whereIn('ESPECIFICAS', $request->input('tipo_reporte_especifico'))->get();
                }elseif (!$request->filled('tipo_reporte_especifico') && $request->filled('tipo_reporte_por_estado')) {
                    $adtsAbiertosSedena = $adtsAbiertosSedena->whereIn('ESTADO', $request->input('tipo_reporte_por_estado'))->get();
                }

                $adtsAbiertosSedena = $adtsAbiertosSedena->get();

                $datosPorAdtSedena = [];

                foreach ($adtsAbiertosSedena as $adt) { 

                    $equiposFuncionales = $adt->equipamientos->where('TIPO', 'FUNCIONAL');
                    $equiposDanados = $adt->equipamientos->where('TIPO', 'DANADO');
                    $equiposFaltantes = $adt->equipamientos->where('TIPO', 'FALTANTE');
                    $equiposBaja = $adt->equipamientos->where('TIPO', 'BAJA');

                    $mobiliarioInicial = $adt->mobiliarios->where('TIPO', 'INICIAL')->sum('MESA_RECTANGULAR_GRANDE');
                    $mobiliarioFuncional = $adt->mobiliarios->where('TIPO', 'FUNCIONAL')->sum('MESA_RECTANGULAR_GRANDE');

                    $datosPorAdtSedena[$adt->ID_ADT] = [

                        'sede' => $adt->NOMBRE,
                        'clave' => $adt->CLAVE_SITIO,
                        'estado' => $adt->ESTADO,
                        'tipo' => $adt->ESPECIFICAS,

                        'internet_tecnologia' => optional($adt->lineas->first())->TECNOLOGIA ?? '-',
                        'internet_semaforo' => optional($adt->lineas->first())->SEMAFORO ?? '-',
                        'internet_observaciones' => optional($adt->lineas->first())->OBSERVACIONES ?? '-',

                        'senalizacion' => optional($adt->infraestructuras->first())->KIT_SENALIZACION ?? '-',
                        'electricidad' => optional($adt->infraestructuras->first())->ELECTRICIDAD ?? '-',
                        'pintura_interior' => optional($adt->infraestructuras->first())->PINTURA_INTERIOR ?? '-',
                        'pintura_exterior' => optional($adt->infraestructuras->first())->PINTURA_EXTERIOR ?? '-',

                        'pc_funcional' => optional($equiposFuncionales->first())->PC ?? '-',
                        'pc_danado' => optional($equiposDanados->first())->PC ?? '-',
                        'pc_faltante' => optional($equiposFaltantes->first())->PC ?? '-',
                        'pc_baja' => optional($equiposBaja->first())->PC ?? '-',

                        'laptop_funcional' => optional($equiposFuncionales->first())->LAPTOP ?? '-',
                        'laptop_danado' => optional($equiposDanados->first())->LAPTOP ?? '-',
                        'laptop_faltante' => optional($equiposFaltantes->first())->LAPTOP ?? '-',
                        'laptop_baja' => optional($equiposBaja->first())->LAPTOP ?? '-',

                        'netbook_funcional' => optional($equiposFuncionales->first())->NETBOOK ?? '-',
                        'netbook_danado' => optional($equiposDanados->first())->NETBOOK ?? '-',
                        'netbook_faltante' => optional($equiposFaltantes->first())->NETBOOK ?? '-',
                        'netbook_baja' => optional($equiposBaja->first())->NETBOOK ?? '-',

                        'mobiliario_funcional' => $mobiliarioFuncional,
                        'mobiliario_danado' => $mobiliarioInicial - $mobiliarioFuncional

                    ];
                    
                }

                $sheet->loadview('exports.reporteDetalladoTutoriasSedena', ['datosPorAdtSedena' => $datosPorAdtSedena]);

                $sheet->getStyle('A1:A25' , $sheet->getHighestRow())->getAlignment()->setWrapText(true);

            });*/
            
        });

    }

    public function descargarReporteGeneralActual(Request $request) {

        return $this->generarReporteGeneralActual($request)->download('xlsx');

    }

}