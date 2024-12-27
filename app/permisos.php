<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class permisos extends Model
{
    protected $fillable = [
        'ID_PERMISO',
        'NOMBRE'
    ];
    protected $primaryKey = 'ID_PERMISO';
    public $timestamps = false;

    public function roles(){
        return $this->belongsToMany('\App\roles', 'roles_permisos' ,'ID_PERMISO','ID_ROL');
    }

}
