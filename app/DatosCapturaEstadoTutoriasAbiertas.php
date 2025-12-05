<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DatosCapturaEstadoTutoriasAbiertas extends Model
{
    public $timestamps = false;
    protected $table = 'datos_captura_estado_tutorias_abiertas';
    protected $primaryKey = 'id';
    protected $fillable = [
            'USUARIOS_BDTS_ACUMULADOS',
            'USUARIOS_BDTS_REGISTRARON',
            'USUARIOS_BDTS_TOTALES',
            'USUARIOS_BDTS_REGISTRADOS',
            'USUARIOS_BDTS_INSCRITOS',
            'USUARIOS_BDTS_CONSTANCIAS',
            'OFERTA_EDUCATIVA_NUEVOS_TALLERES',
            'OFERTA_EDUCATIVA_TALLERES',
            'OFERTA_EDUCATIVA_EN_LINEA',
            'OFERTA_EDUCATIVA_TALLERES_EN_DESARROLLO',
            'SOLICITUDES_RECIBIDAS',
            'SOLICITUD_BDT',
            'SOLICITUD_REEQUIPAMIENTO',
            'SOLICITUD_RETIRO',
            'SOLICITUD_OTROS',
    ];
}
