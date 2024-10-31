<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class entornos extends Model
{
    protected $fillable = [
        'ID_ENTORNO',
        'ENTORNO'
    ];
    protected $primaryKey = 'ID_ENTORNO';
}
