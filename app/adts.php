<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class adts extends Model
{
    protected $fillable = [
        'ID_ADT',

        'INICIATIVA',
        'ESTATUS_ACTUAL',
        'CLAVE_SITIO',
        'CLAVE_MATUTINO',
        'CLAVE_VESPERTINO',

        'DOMICILIO',
        'CP',
        'PCC',
        'ESPECIFICAS',

        'ENTORNO',
        'ESCOLARIZACION',
        'SERVICIO',

        'NOMBRE',
        'ESTADO',
        'MUNICIPIO',
        'LOCALIDAD',
        'FECHA_ENTREGA',

        'CONVENIO',
        'FECHA_INICIO_CONVENIO',
        'FECHA_TERMINO_CONVENIO',
        'CONVENIO_VENCIDO',
        'SITUACION_LEGAL_EQUIPO',
        'DEPENDENCIA_AIRE',

    ];
    protected $primaryKey = 'ID_ADT';
    public $timestamps = false;

// LLAMADAS
    public function llamadas(){
        return $this->hasMany('\App\llamadas',  'ID_ADT', 'ID_ADT')->orderBy('ID_LLAMADA', 'desc');
    }

    public function ultimoContacto($id){
        $fecha = llamadas::where('ID_ADT', $id)->orderBy('FECHA', 'desc')->first();
        (!empty($fecha)) ? $response = $fecha->FECHA: $response = "SIN REGISTROS";

        return $response;
    }
    public function observacionesUltimoContacto($id){
        $observaciones = llamadas::where('ID_ADT', $id)->orderBy('FECHA', 'desc')->first();
        (!empty($observaciones)) ? $response = $observaciones->OBSERVACIONES: $response = "SIN REGISTROS";

        return $response;
    }

// CONTACTOS
    public function contactos(){
        return $this->hasMany('\App\contactos',  'ID_ADT', 'ID_ADT');
    }

    public function responsableAula($id){
        $responsable = contactos::where([['ID_ADT', $id],['TIPO', 'RESPONSABLE AULA']])->first();
        (!empty($responsable)) ? $response = $responsable: $response = (object)['NOMBRE' => null,'CARGO' => null,'TELEFONO' => null,'CELULAR' => null,'CORREO' => null];
        return $response;
    }
    public function responsableAulaExtra($id){
        $responsable = contactos::where([['ID_ADT', $id],['TIPO', 'RESPONSABLE AULA EXTRA']])->first();
        (!empty($responsable)) ? $response = $responsable: $response = (object)['NOMBRE' => null,'CARGO' => null,'TELEFONO' => null,'CELULAR' => null,'CORREO' => null];
        return $response;
    }
    public function contactoMunicipal($id){
        $responsable = contactos::where([['ID_ADT', $id],['TIPO', 'CONTACTO MUNICIPAL']])->first();
        (!empty($responsable)) ? $response = $responsable: $response = (object)['NOMBRE' => null,'CARGO' => null,'TELEFONO' => null,'CELULAR' => null,'CORREO' => null];
        return $response;
    }
// EQUIPAMIENTO
    public function equipamientoInicial($id){
        $equipamiento = equipamientos::where([['ID_ADT', $id],['TIPO', 'INICIAL']])->first();
        return $equipamiento;
    }
    public function equipamientoFuncional($id){
        $equipamiento = equipamientos::where([['ID_ADT', $id],['TIPO', 'FUNCIONAL']])->first();
        return $equipamiento;
    }
    public function equipamientoDañado($id){
        $equipamiento = equipamientos::where([['ID_ADT', $id],['TIPO', 'DAÑADO']])->first();
        return $equipamiento;
    }
    public function equipamientoFaltante($id){
        $equipamiento = equipamientos::where([['ID_ADT', $id],['TIPO', 'FALTANTE']])->first();
        return $equipamiento;
    }
    public function equipamientoBaja($id){
        $equipamiento = equipamientos::where([['ID_ADT', $id],['TIPO', 'BAJA']])->first();
        return $equipamiento;
    }
// MOBILIARIO
    public function mobiliarioInicial($id){
        $mobiliario = mobiliarios::where([['ID_ADT', $id],['TIPO', 'INICIAL']])->first();
        return $mobiliario;
    }
    public function mobiliarioFuncional($id){
        $mobiliario = mobiliarios::where([['ID_ADT', $id],['TIPO', 'FUNCIONAL']])->first();
        return $mobiliario;
    }

// INFRAESTRUCTURA
    public function infraestructura($id){
        $infraestructura = infraestructuras::where('ID_ADT', $id)->first();
        (!empty($infraestructura)) ? $response = $infraestructura: $response = (object)['KIT_SENALIZACION' => null,'ELECTRICIDAD' => null,'PINTURA_INTERIOR' => null,'PINTURA_EXTERIOR' => null,'OBSERVACIONES' => null];
        return $response;
    }
// INTERNET
    public function linea(){
        return $this->belongsTo('\App\lineas',  'ID_ADT');
    }

}
