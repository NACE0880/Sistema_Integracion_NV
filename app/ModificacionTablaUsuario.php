<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModificacionTablaUsuario extends Model
{
    protected $table = 'modificacion_tabla_usuarios';
    protected $primaryKey = 'ID_MODIFICACION';
    protected $fillable = [
        'ID_MODIFICACION',
        'NOMBRE',
        'MODIFICACION',
    ];
}
