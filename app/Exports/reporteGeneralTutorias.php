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

class reporteGeneralTutorias {
    
    public function __construct() {

    }

    public function generarReporteGeneralActual(){

        return Excel::create('Reporte General Actual de Tutorías', function($excel){

            $excel->sheet('Resumen', function($sheet) {

                $adtsAbiertos = DB::table('adts')->where('ESTATUS_ACTUAL', 'ABIERTA')->pluck('ID_ADT');

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

            $excel->sheet('Detalle', function($sheet) {

                $adtsAbiertos = Adt::with(['lineas', 'infraestructura', 'equipamientos', 'mobiliarios'])
                ->where('ESTATUS_ACTUAL', 'ABIERTA')
                ->get();

                $datosPorAdt = [];

                foreach ($adtsAbiertos as $adt) { 

                    $equiposFuncionales = $adt->equipamientos->where('TIPO', 'FUNCIONAL');
                    $equiposDanados = $adt->equipamientos->where('TIPO', 'DANADO');
                    $equiposFaltantes = $adt->equipamientos->where('TIPO', 'FALTANTE');
                    $equiposBaja = $adt->equipamientos->where('TIPO', 'BAJA');

                    $mobiliarioInicial = $adt->mobiliarios->where('TIPO', 'INICIAL')->sum('MESA_RECTANGULAR_GRANDE');
                    $mobiliarioFuncional = $adt->mobiliarios->where('TIPO', 'FUNCIONAL')->sum('MESA_RECTANGULAR_GRANDE');

                    $datosPorAdt[$adt->ID_ADT] = [

                        'internet_tecnologia' => $adt->lineas->TECNOLOGIA,
                        'internet_semaforo' => $adt->lineas->SEMAFORO,
                        'internet_observaciones' => $adt->lineas->OBSERVACIONES,

                        'señalizacion' => $adt->infraestructura->KIT_SENALIZACION,
                        'electricidad' => $adt->infraestructura->ELECTRICIDAD,
                        'pintura_interior' => $adt->infraestructura->PINTURA_INTERIOR,
                        'pintura_exterior' => $adt->infraestructura->PINTURA_EXTERIOR,

                        'pc_funcional' => $equiposFuncionales->value('PC'),
                        'pc_danado' => $equiposDanados->value('PC'),
                        'pc_faltante' => $equiposFaltantes->value('PC'),
                        'pc_baja' => $equiposBaja->value('PC'),

                        'laptop_funcional' => $equiposFuncionales->value('LAPTOP'),
                        'laptop_danado' => $equiposDanados->value('LAPTOP'),
                        'laptop_faltante' => $equiposFaltantes->value('LAPTOP'),
                        'laptop_baja' => $equiposBaja->value('LAPTOP'),

                        'netbook_funcional' => $equiposFuncionales->value('NETBOOK'),
                        'netbook_danado' => $equiposDanados->value('NETBOOK'),
                        'netbook_faltante' => $equiposFaltantes->value('NETBOOK'),
                        'netbook_baja' => $equiposBaja->value('NETBOOK'),

                        'mobiliario_funcional' => $mobiliarioFuncional,
                        'mobiliario_danado' => $mobiliarioInicial - $mobiliarioFuncional

                    ];
                    
                }

                $sheet->loadview('exports.reporteDetalladoTutorias', ['datosPorAdt' => $datosPorAdt]);

                $sheet->getStyle('A1:B18' , $sheet->getHighestRow())->getAlignment()->setWrapText(true);

            });
            
        });

    }

    public function descargarReporteGeneralActual() {

        return $this->generarReporteGeneralActual()->download('xlsx');

    }

}