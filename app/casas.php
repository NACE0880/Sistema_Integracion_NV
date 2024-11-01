<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class casas extends Model
{
    protected $fillable = [
        'ID_CASA',
        'NOMBRE',
        'ESTATUS',
        'CORREO',

    ];
    protected $primaryKey = 'ID_CASA';
    public $timestamps = false;


    public function encargados_casa(){
        return $this->belongsToMany('\App\encargados', 'encargados_casas', 'ID_CASA', 'ID_ENCARGADO');
    }

    public function supervisor_casa(){
        return $this->belongsToMany('\App\encargados', 'encargados_casas', 'ID_CASA', 'ID_ENCARGADO')->where('PUESTO', 'SUPERVISOR');
    }

    public function subgerente_casa(){
        return $this->belongsToMany('\App\encargados', 'encargados_casas', 'ID_CASA', 'ID_ENCARGADO')->where('PUESTO', 'SUBGERENTE');
    }

    public function gerente_casa(){
        return $this->belongsToMany('\App\encargados', 'encargados_casas', 'ID_CASA', 'ID_ENCARGADO')->where('PUESTO', 'GERENTE');
    }


}
