<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class afecciones extends Model
{
    protected $fillable = [
        'ID_AFECCION',
        'ID_AREA',
        'NOMBRE'
    ];
    protected $primaryKey = 'ID_AFECCION';
    public $timestamps = false;


    public function area_afeccion(){
        return $this->belongsTo('\App\areas', 'ID_AREA');
    }
}
