<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsuariosEstadoTutoriasAbiertasInternas extends Model
{
    public $timestamps = false;
    protected $table = 'usuarios_estado_tutorias_abiertas_internas';
    protected $primaryKey = 'id';
    protected $fillable = [
            'NOMBRE',
            'META',
            'REAL',
    ];
}
