<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class infraestructuras extends Model
{
    protected $fillable = [
        'ID_INFRAESTRUCTURA',
        'ID_ADT',

        'KIT_SENALIZACION',
        'ELECTRICIDAD',
        'PINTURA_INTERIOR',
        'PINTURA_EXTERIOR',
        'OBSERVACIONES',

    ];
    protected $primaryKey = 'ID_INFRAESTRUCTURA';
    public $timestamps = false;
}
