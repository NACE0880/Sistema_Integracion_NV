<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class prioridades extends Model
{
    protected $fillable = [
        'ID_PRIORIDAD',
        'NOMBRE'
    ];
    protected $primaryKey = 'ID_PRIORIDAD';
    public $timestamps = false;

}
