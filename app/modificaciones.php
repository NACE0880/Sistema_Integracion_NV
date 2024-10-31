<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class modificaciones extends Model
{
    protected $fillable = [
        'ID_MODIFICACION',
        'ID_TICKET',
        'TIPO',
        'RESPONSABLE',
        'JUSTIFICACION',
        'FECHA',

    ];
    protected $primaryKey = 'ID_MODIFICACION';
    public $timestamps = false;

    public function ticket_cotizado(){
        return $this->belongsTo('\App\tickets', 'ID_TICKET');
    }
}
