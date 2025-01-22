<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class llamadas extends Model
{
    protected $fillable = [
        'ID_LLAMADA',
        'ID_ADT',

        'FECHA',
        'RESPONSABLE',
        'ESTATUS',
        'OBSERVACIONES',
        'VIDEO',
        'EXPEDIENTE',
    ];
    protected $primaryKey = 'ID_LLAMADA';
    public $timestamps = false;

}
