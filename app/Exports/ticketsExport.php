<?php

namespace App\Exports;

use App\tickets;
use DB;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;



class ticketsExport implements  FromView, WithTitle {

    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    public function __construct($dateStart, $dateEnd){
        $this->dateStart = $dateStart;
        $this->dateEnd = $dateEnd;
    }

    public function title():string{
        return 'Detalle General';
    }

    // public function query()
    // {
    //     return tickets::query();
    // }

    public function view(): View
    {
        return view('exports.tickets', [
            'tickets' => tickets::query()->whereBetween('FECHA_INICIO', [$this->dateStart,$this->dateEnd])->get()
        ]);
    }
// public function headings(): array {
    //     return [
    //         'FOLIO',
    //         'FECHA_INICIO',
    //         'ESTATUS_INICIAL',
    //         'CASA',
    //         'DIRECTOR',
    //         'AFECCION',
    //         'AREA_RESPONSABLE',
    //         'SUPERVISOR',
    //         'SUBGERENTE',
    //         'GERENTE',
    //         'PRIORIDAD',
    //         'REINCIDENCIA',
    //         'ENTORNO',
    //         'SITIO',
    //         'OBJETO',
    //         'ESPACIO',
    //         'ELEMENTO',
    //         'DAÑO',
    //         'FOTO_OBLIGATORIA',
    //         'FOTO_2',
    //         'FOTO_3',
    //         'DRIVE',
    //         'DETALLE',
    //         'FECHA_FIN',
    //         'AREA_ATENCION',
    //         'PERSONA_ATENCION',
    //         'ESTATUS_ACTUAL',
    //         'OBSERVACIONES',
    //         'EVIDENCIA'
    //     ];
    // }
    // public function collection()
    // {
    //     $tickets = DB::table('tickets')->select(
    //         'FOLIO',
    //         'FECHA_INICIO',
    //         'ESTATUS_INICIAL',
    //         'CASA',
    //         'DIRECTOR',
    //         'AFECCION',
    //         'AREA_RESPONSABLE',
    //         'SUPERVISOR',
    //         'SUBGERENTE',
    //         'GERENTE',
    //         'PRIORIDAD',
    //         'REINCIDENCIA',
    //         'ENTORNO',
    //         'SITIO',
    //         'OBJETO',
    //         'ESPACIO',
    //         'ELEMENTO',
    //         'DAÑO',
    //         'FOTO_OBLIGATORIA',
    //         'FOTO_2',
    //         'FOTO_3',
    //         'DRIVE',
    //         'DETALLE',
    //         'FECHA_FIN',
    //         'AREA_ATENCION',
    //         'PERSONA_ATENCION',
    //         'ESTATUS_ACTUAL',
    //         'OBSERVACIONES',
    //         'EVIDENCIA'
    //     )->get();
    //     return $tickets;

    // }
}
