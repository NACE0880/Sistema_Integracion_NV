<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class usuarios_roles extends Model
{
    protected $fillable = [
        'ID_USUARIOS_ROLES',
        'ID_USUARIO',
        'ID_ROL'
    ];
    protected $primaryKey = 'ID_USUARIOS_ROLES';
    public $timestamps = false;

}
