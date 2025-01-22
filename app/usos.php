<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class usos extends Model
{
    protected $fillable = [
        'ID_USO',
        'ID_ADT',

        'ESTATUS_REGISTRO',
        'ESTATUS_OFERTA',
        'TIPO_USO',
        'MAYORIA_POBLACION',
        'HORA_INICIO',
        'HORA_FINAL',
        'USUARIOS_SEMANALES',
        'OBSERVACIONES',

    ];
    protected $primaryKey = 'ID_USO';
    public $timestamps = false;
}
