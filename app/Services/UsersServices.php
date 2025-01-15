<?php

namespace App\Services;

use Auth;
use App\User;



class UsersServices
{
    public function __construct() {
    }

    public static function permisos(){
        $permisos = [];
        foreach(Auth::user()->roles as $rol) {
            foreach($rol->permisos as $permiso){
                // $permisos[] =  $permiso->NOMBRE;
                $permisos[] =  $permiso->ID_PERMISO;
            }
        }
        return $permisos;
    }

    public static function nombrePermisos(){
        $permisos = [];
        foreach(Auth::user()->roles as $rol) {
            foreach($rol->permisos as $permiso){
                $permisos[] =  $permiso->NOMBRE;
            }
        }
        return $permisos;
    }
}
