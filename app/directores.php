<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class directores extends Model
{
    protected $fillable = [
        'ID_DIRECTOR',
        'ID_CASA',
        'NOMBRE',
        'CORREO'
    ];
    protected $primaryKey = 'ID_DIRECTOR';
    public $timestamps = false;

}
