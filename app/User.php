<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'usuario', 'password',

        'userable_id', 'userable_type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public $timestamps = false;


    public function userable(){
        return $this->morphTo();
    }

    public function roles(){
        return $this->belongsToMany('\App\roles', 'usuarios_roles', 'ID_USUARIO', 'ID_ROL');
    }

    public function permisos(){
        $permisos = [];
        foreach($this->roles as $rol) {
            foreach($rol->permisos as $permiso){
                $permisos[] =  $permiso->NOMBRE;
            }
        }
        return $permisos;
    }

    // public function permisos($id){
    //     $roles
    //     $permisos = permisos::where([['ID_ADT', $id],['TIPO', 'CONTACTO MUNICIPAL']])->first();
    //     (!empty($responsable)) ? $response = $responsable: $response = (object)['NOMBRE' => null,'CARGO' => null,'TELEFONO' => null,'CELULAR' => null,'CORREO' => null];
    //     return $response;
    // }

}
