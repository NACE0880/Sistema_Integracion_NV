<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tipos_danos extends Model
{
    protected $fillable = [
        'ID_TIPO_DANO',
        'ID_PRIORIDAD',
        'DETALLE'
    ];
    protected $primaryKey = 'ID_TIPO_DANO';
    public $timestamps = false;

}
