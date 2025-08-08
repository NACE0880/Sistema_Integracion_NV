<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class equipamientos extends Model
{
    protected $fillable = [
        'ID_EQUIPAMIENTO',
        'ID_ADT',

        'PC',
        'LAPTOP',
        'NETBOOK',
        'CLASSMATE',
        'XO',
        'OBSERVACIONES',
        'TIPO',
    ];
    protected $primaryKey = 'ID_EQUIPAMIENTO';
    public $timestamps = false;

    public function adts() {
        return $this->belongsTo(\App\adts::class, 'ID_ADT', 'ID_ADT');
    }

}
