<?php

namespace App\Exports;

use App\tickets;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class ticketEstatusDetalle implements  FromView, WithTitle, WithStyles, ShouldAutoSize{

    /**
    * @return \Illuminate\Support\Collection
    */


    public function __construct($dateStart, $dateEnd){
        $this->dateStart = $dateStart;
        $this->dateEnd = $dateEnd;
    }

    public function title():string{
        return 'Estatus Detalle';
    }

    public function styles(Worksheet $sheet){
        return [

            'A' => ['font' => ['size' => 8]],

            'B' => ['font' => ['size' => 8]],

            'C' => ['font' => ['size' => 8]],

            'D' => ['font' => ['size' => 8]],

            'E' => ['font' => ['size' => 8]],

            'F' => ['font' => ['size' => 8]],

            'G' => ['font' => ['size' => 8]],

            'H' => ['font' => ['size' => 8]],

        ];
    }

    public function view(): View{

        $tickets_pendientes = tickets::whereBetween('FECHA_INICIO', [$this->dateStart,$this->dateEnd])->where('ESTATUS_ACTUAL', 'PENDIENTE')->orderBy('ESTATUS_CASA', 'ASC')->get();
        $tickets_procesados = tickets::whereBetween('FECHA_INICIO', [$this->dateStart,$this->dateEnd])->where('ESTATUS_ACTUAL', 'EN PROCESO')->orderBy('ESTATUS_CASA', 'ASC')->get();
        $tickets_finalizados = tickets::whereBetween('FECHA_INICIO', [$this->dateStart,$this->dateEnd])->where('ESTATUS_ACTUAL', 'FINALIZADO')->orderBy('ESTATUS_CASA', 'ASC')->get();

        $resultado = [
            'pendientes' => $tickets_pendientes,
            'procesados' => $tickets_procesados,
            'finalizados' => $tickets_finalizados,
        ];
        return view('exports.ticketEstatusDetalle', [
            'resultado' => $resultado
        ]);
    }
    }
