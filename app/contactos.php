<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class contactos extends Model
{
    protected $fillable = [
        'ID_CONTACTO',
        'ID_ADT',

        'NOMBRE',
        'CARGO',
        'TELEFONO',
        'CELULAR',
        'CORREO',
        'TIPO',
    ];
    protected $primaryKey = 'ID_CONTACTO';
    public $timestamps = false;

}
