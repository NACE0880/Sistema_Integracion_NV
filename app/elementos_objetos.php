<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class elementos_objetos extends Model
{
    protected $fillable = [
        'ID_ELEMENTO_OBJ',
        'ID_OBJETO',
        'NOMBRE'
    ];
    public $timestamps = false;

}
