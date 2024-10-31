<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class objetos extends Model
{
    protected $fillable = [
        'ID_OBJETO',
        'ID_ENTORNO',
        'NOMBRE'
    ];
    protected $primaryKey = 'ID_OBJETO';
    public $timestamps = false;

}
