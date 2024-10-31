<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class encargados_casas extends Model
{
    protected $fillable = [
        'ID_ENCARGADOS_CASAS',
        'ID_ENCARGADO',
        'ID_CASA'
    ];
    protected $primaryKey = 'ID_ENCARGADOS_CASAS';
    public $timestamps = false;

    public function encargado(){
        return $this->belongsTo('\App\encargados',  'ID_ENCARGADO');
    }

    public function encargado_area(){

        return $this->encargado->belongsTo('\App\areas','ID_AREA');
    }

    public function casa(){
        return $this->belongsTo('\App\casas',  'ID_CASA');
    }

}
