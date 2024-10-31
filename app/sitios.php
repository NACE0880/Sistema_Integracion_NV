<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sitios extends Model
{
    protected $fillable = [
        'ID_SITIO',
        'ID_ENTORNO',
        'SITIO'
    ];
    protected $primaryKey = 'ID_SITIO';
    public $timestamps = false;

}
