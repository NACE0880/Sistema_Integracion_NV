<?php

namespace App\Exports;

use App\tickets;
use DB;

use Carbon\Carbon;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;

class consultaCompuestaTickets implements  WithMultipleSheets, SkipsUnknownSheets{

    /**
    * @return \Illuminate\Support\Collection
    */
    use WithConditionalSheets;

    public function __construct($dateStart, $dateEnd){
        $this->dateStart = $dateStart;
        $this->dateEnd = $dateEnd;
    }

    public function conditionalSheets():array{

        return[
            'Resumen'                   => new ticketResumenGeneral($this->dateStart, $this->dateEnd),
            'Estatus Detalle'           => new ticketEstatusDetalle($this->dateStart, $this->dateEnd),
            'Detalle General'           => new ticketsExport($this->dateStart, $this->dateEnd),
        ];
    }

    public function onUnknownSheet($sheetName){
        // Mostrar pagina no econtrada
        info("Pagina {$sheetName} omitida.");
    }


}
