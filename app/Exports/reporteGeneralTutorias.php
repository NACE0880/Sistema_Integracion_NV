<?php

namespace App\Exports;

use DB;
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

                    /*
                    'total_tipo_uso_aula' => usos::whereIn('ID_ADT', $adtsAbiertos)
                    ->where('TIPO_USO', 'Aula')->count(),
                    'total_tipo_uso_maestros' => usos::whereIn('ID_ADT', $adtsAbiertos)
                    ->where('TIPO_USO', 'Maestros')->count(),
                    'total_tipo_navegación_libre' => usos::whereIn('ID_ADT', $adtsAbiertos)
                    ->where('TIPO_USO', 'Navegación Libre')->count(),

                    'total_mayoría_poblacion_ninos' => usos::whereIn('ID_ADT', $adtsAbiertos)
                    ->where('MAYORIA_POBLACION', 'Niños')->count(),
                    'total_mayoría_poblacion_adolescentes' => usos::whereIn('ID_ADT', $adtsAbiertos)
                    ->where('MAYORIA_POBLACION', 'Adolescentes')->count(),
                    'total_mayoría_poblacion_adultos' => usos::whereIn('ID_ADT', $adtsAbiertos)
                    ->where('MAYORIA_POBLACION', 'Adultos')->count(),
                    */

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

                    /*
                    'total_pc_funcional' => equipamientos::whereIn('ID_ADT', $adtsAbiertos)->where('TIPO', 'FUNCIONAL')->sum('PC'),
                    'total_pc_danado' => equipamientos::whereIn('ID_ADT', $adtsAbiertos)->where('TIPO', 'DAÑADO')->sum('PC'),
                    'total_pc_faltante' => equipamientos::whereIn('ID_ADT', $adtsAbiertos)->where('TIPO', 'FALTANTE')->sum('PC'),
                    'total_pc_baja' => equipamientos::whereIn('ID_ADT', $adtsAbiertos)->where('TIPO', 'BAJA')->sum('PC'),

                    'total_laptop_funcional' => equipamientos::whereIn('ID_ADT', $adtsAbiertos)->where('TIPO', 'FUNCIONAL')->sum('LAPTOP'),
                    'total_laptop_danado' => equipamientos::whereIn('ID_ADT', $adtsAbiertos)->where('TIPO', 'DAÑADO')->sum('LAPTOP'),
                    'total_laptop_faltante' => equipamientos::whereIn('ID_ADT', $adtsAbiertos)->where('TIPO', 'FALTANTE')->sum('LAPTOP'),
                    'total_laptop_baja' => equipamientos::whereIn('ID_ADT', $adtsAbiertos)->where('TIPO', 'BAJA')->sum('LAPTOP'),

                    'total_netbook_funcional' => equipamientos::whereIn('ID_ADT', $adtsAbiertos)
                    ->where('TIPO', 'FUNCIONAL')->sum('NETBOOK'),
                    'total_netbook_danado' => equipamientos::whereIn('ID_ADT', $adtsAbiertos)->where('TIPO', 'DAÑADO')->sum('NETBOOK'),
                    'total_netbook_faltante' => equipamientos::whereIn('ID_ADT', $adtsAbiertos)->where('TIPO', 'FALTANTE')->sum('NETBOOK'),
                    'total_netbook_baja' => equipamientos::whereIn('ID_ADT', $adtsAbiertos)->where('TIPO', 'BAJA')->sum('NETBOOK')
                    */

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

            /*
            $excel->sheet('Detalle', function($sheet) {

                $adtsAbiertos = DB::table('adts')->where('ESTATUS_ACTUAL', 'ABIERTA')->pluck('ID_ADT');

                foreach($adtsAbiertos as $adt) {

                    $total = [

                        'total_senalizacion_colocada' => infraestructuras::where('ID_ADT', $adt)
                        ->where('KIT_SENALIZACION', 'Colocada')->value(),
                        'total_senalizacion_despegada' => infraestructuras::where('ID_ADT', $adt)
                        ->where('KIT_SENALIZACION', 'Despegada')->value(),

                        'total_electricidad_funcional' => infraestructuras::where('ID_ADT', $adt)
                        ->where('ELECTRICIDAD', 'Funcional')->value(),
                        'total_electricidad_intermitente' => infraestructuras::where('ID_ADT', $adt)
                        ->where('ELECTRICIDAD', 'Intermitente')->value(),
                        'total_electricidad_sin_servicio' => infraestructuras::where('ID_ADT', $adt)
                        ->where('ELECTRICIDAD', 'Sin Servicio')->value(),

                        'total_pintura_interior_sin_cambios' => infraestructuras::where('ID_ADT', $adt)
                        ->where('PINTURA_INTERIOR', 'Sin Cambios')->value(),
                        'total_pintura_interior_danado' => infraestructuras::where('ID_ADT', $adt)
                        ->where('PINTURA_INTERIOR', 'Dañado')->value(),
                        'total_pintura_interior_filtracion' => infraestructuras::where('ID_ADT', $adt)
                        ->where('PINTURA_INTERIOR', 'Filtración')->value(),

                        'total_pintura_exterior_sin_cambios' => infraestructuras::where('ID_ADT', $adt)
                        ->where('PINTURA_EXTERIOR', 'Sin Cambios')->value(),
                        'total_pintura_exterior_danado' => infraestructuras::where('ID_ADT', $adt)
                        ->where('PINTURA_EXTERIOR', 'Dañado')->value(),
                        'total_pintura_exterior_filtracion' => infraestructuras::where('ID_ADT', $adt)
                        ->where('PINTURA_EXTERIOR', 'Filtración')->value(),

                        //
                        'total_equipamiento_funcional' => equipamientos::where('ID_ADT', $adt)->where('TIPO', 'FUNCIONAL')
                        ->selectRaw('SUM(PC + LAPTOP + NETBOOK) as total_e_funcional')
                        ->value('total_e_funcional'),
                        'total_equipamiento_danado' => equipamientos::where('ID_ADT', $adt)->where('TIPO', 'DAÑADO')
                        ->selectRaw('SUM(PC + LAPTOP + NETBOOK) as total_e_danado')
                        ->value('total_e_danado'),
                        'total_equipamiento_faltante' => equipamientos::where('ID_ADT', $adt)->where('TIPO', 'FALTANTE')
                        ->selectRaw('SUM(PC + LAPTOP + NETBOOK) as total_e_faltante')
                        ->value('total_e_faltante'),
                        'total_equipamiento_baja' => equipamientos::where('ID_ADT', $adt)->where('TIPO', 'BAJA')
                        ->selectRaw('SUM(PC + LAPTOP + NETBOOK) as total_e_baja')
                        ->value('total_e_baja'),
                        //

                        'total_pc_funcional' => equipamientos::where('ID_ADT', $adt)->where('TIPO', 'FUNCIONAL')->sum('PC'),
                        'total_pc_danado' => equipamientos::where('ID_ADT', $adt)->where('TIPO', 'DAÑADO')->sum('PC'),
                        'total_pc_faltante' => equipamientos::where('ID_ADT', $adt)->where('TIPO', 'FALTANTE')->sum('PC'),
                        'total_pc_baja' => equipamientos::where('ID_ADT', $adt)->where('TIPO', 'BAJA')->sum('PC'),

                        'total_laptop_funcional' => equipamientos::where('ID_ADT', $adt)->where('TIPO', 'FUNCIONAL')->sum('LAPTOP'),
                        'total_laptop_danado' => equipamientos::where('ID_ADT', $adt)->where('TIPO', 'DAÑADO')->sum('LAPTOP'),
                        'total_laptop_faltante' => equipamientos::where('ID_ADT', $adt)->where('TIPO', 'FALTANTE')->sum('LAPTOP'),
                        'total_laptop_baja' => equipamientos::where('ID_ADT', $adt)->where('TIPO', 'BAJA')->sum('LAPTOP'),

                        'total_netbook_funcional' => equipamientos::where('ID_ADT', $adt)
                        ->where('TIPO', 'FUNCIONAL')->sum('NETBOOK'),
                        'total_netbook_danado' => equipamientos::where('ID_ADT', $adt)->where('TIPO', 'DAÑADO')->sum('NETBOOK'),
                        'total_netbook_faltante' => equipamientos::where('ID_ADT', $adt)->where('TIPO', 'FALTANTE')->sum('NETBOOK'),
                        'total_netbook_baja' => equipamientos::where('ID_ADT', $adt)->where('TIPO', 'BAJA')->sum('NETBOOK'),

                        'total_mesa_rectangular_grande_funcional' => mobiliarios::where('ID_ADT', $adt)->where('TIPO', 'FUNCIONAL')
                        ->where('MESA_RECTANGULAR_GRANDE')->value(),
                        'total_mesa_rectangular_mediana_funcional' => mobiliarios::where('ID_ADT', $adt)->where('TIPO', 'FUNCIONAL')
                        ->where('MESA_RECTANGULAR_MEDIANA')->value(),
                        'total_mesa_circular_funcional' => mobiliarios::where('ID_ADT', $adt)->where('TIPO', 'FUNCIONAL')
                        ->where('MESA_CIRCULAR')->value(),
                        'total_sillas_funcional' => mobiliarios::where('ID_ADT', $adt)->where('TIPO', 'FUNCIONAL')
                        ->where('SILLAS')->value(),
                        'total_mueble_resguardo_funcional' => mobiliarios::where('ID_ADT', $adt)->where('TIPO', 'FUNCIONAL')
                        ->where('MESA_RESGUARDO')->value(),

                        //
                        'total_mobiliario_funcional' => mobiliarios::where('ID_ADT', $adt)->where('TIPO', 'FUNCIONAL')
                        ->selectRaw('SUM(MESA_RECTANGULAR_GRANDE + MESA_RECTANGULAR_MEDIANA + MESA_CIRCULAR + SILLAS + 
                        MUEBLE_RESGUARDO) as total_e_funcional')->value('total_e_funcional'),

                        'total_mobiliario_danado' => mobiliarios::where('ID_ADT', $adt)
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
                        //

                    ];

                }
                

                $sheet->loadview('exports.reporteDetalladoTutorias', ['total' => $total]);

                $sheet->getStyle('A1:B18' , $sheet->getHighestRow())->getAlignment()->setWrapText(true);

            });
            */
            
        });

    }

    public function descargarReporteGeneralActual() {

        return $this->generarReporteGeneralActual()->download('xlsx');

    }

}