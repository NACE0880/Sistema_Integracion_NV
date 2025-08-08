<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mobiliarios extends Model
{
    protected $fillable = [
        'ID_MOBILIARIO',
        'ID_ADT',

        'MESA_RECTANGULAR_GRANDE',
        'MESA_RECTANGULAR_MEDIANA',
        'MESA_CIRCULAR',
        'SILLAS',
        'MUEBLE_RESGUARDO',
        'OBSERVACIONES',
        'TIPO',
    ];
    protected $primaryKey = 'ID_MOBILIARIO';
    public $timestamps = false;

    public function adts() {
        return $this->belongsTo(\App\adts::class, 'ID_ADT', 'ID_ADT');
    }

}
