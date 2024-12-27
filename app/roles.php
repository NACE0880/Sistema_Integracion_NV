<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class roles extends Model
{
    protected $fillable = [
        'ID_ROL',
        'NOMBRE'
    ];
    protected $primaryKey = 'ID_ROL';
    public $timestamps = false;


    public function usuario(){
        return $this->belongsToMany('\App\User');
    }

    public function permisos(){
        return $this->belongsToMany('\App\permisos', 'roles_permisos' ,'ID_ROL','ID_PERMISO');
    }
}
