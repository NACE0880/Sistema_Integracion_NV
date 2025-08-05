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
                ];

                $sheet->loadview('exports.reporteGeneralTutorias', ['total' => $total]);

                $sheet->getStyle('A1:B30' , $sheet->getHighestRow())->getAlignment()->setWrapText(true);

            });
            
        });

    }

    public function descargarReporteGeneralActual() {

        return $this->generarReporteGeneralActual()->download('xlsx');

    }

}