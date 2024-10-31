<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class encargados extends Model
{
    protected $fillable = [
        'ID_ENCARGADO',
        'ID_AREA',

        'NOMBRE',
        'PUESTO',
        'CORREO'
    ];
    protected $primaryKey = 'ID_ENCARGADO';
    public $timestamps = false;


    public function encargados_casa(){
        return $this->belongsToMany('\App\casas', 'encargados_casas', 'ID_ENCARGADO', 'ID_CASA');
    }
}
