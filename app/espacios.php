<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class espacios extends Model
{
    protected $fillable = [
        'ID_ESPACIO',
        'ID_SITIO',
        'NOMBRE'
    ];
    
    protected $primaryKey = 'ID_ESPACIO';
    public $timestamps = false;

}
