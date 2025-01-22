<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class lineas extends Model
{
    protected $fillable = [
        'ID_LINEA',
        'ID_ADT',

        'LINEA',
        'DIAN',
        'APORTA',
        'PAGA',
        'FACTURACION',
        'VIGENCIA',
        'CUENTA_MAESTRA',
        'NO_SERVICIOS',
        'ANCHO_BANDA',
        'TECNOLOGIA',
        'COSTO',
        'PAQUETE',
        'SEMAFORO',
        'GB_RECIBIDO',
        'GB_ENVIADOS',
        'OBSERVACIONES',

    ];
    protected $primaryKey = 'ID_LINEA';
    public $timestamps = false;

}
