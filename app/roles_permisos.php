<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class roles_permisos extends Model
{
    protected $fillable = [
        'ID_ROLES_PERMISOS',
        'ID_ROL',
        'ID_PERMISO'
    ];
    protected $primaryKey = 'ID_ROLES_PERMISOS';
    public $timestamps = false;

}
