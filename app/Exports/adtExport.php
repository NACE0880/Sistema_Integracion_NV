<?php

namespace App\Exports;

use App\adts;

use Maatwebsite\Excel\Facades\Excel;

class adtExport {

    /**
    * @return \Illuminate\Support\Collection
    */
    // use Exportable;

    public function __construct(adts $adt){
        $this->adt = $adt;
    }

    public function descargar(){

        return Excel::create($this->adt->NOMBRE, function($excel)  {

            $excel->sheet('Detalle General', function($sheet)  {

                $sheet->loadView('exports.adtsReporte', [
                    'adt' => $this->adt
                ]);

                // AJUSTAR AL CONTENIDO
                // $sheet->getStyle('A1:G40' , $sheet->getHighestRow())->getAlignment()->setWrapText(true);


            });

        })->download('xlsx');

    }

}
