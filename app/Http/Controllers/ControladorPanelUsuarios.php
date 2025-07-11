<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\casas;
use App\roles;

class ControladorPanelUsuarios extends Controller
{
    public function __construct()
    {

    }

    public function mostrarInicioUsuarios(){
        $usuarios=User::all();
        $casas=casas::all();
        $roles=roles::all();
        return view('Usuarios.Inicio', compact('usuarios', 'casas', 'roles'));
    }

    public function registrarUsuario(Request $request){
        return $request->all();
    }
}
