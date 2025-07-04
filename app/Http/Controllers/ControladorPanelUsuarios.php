<?php

namespace App\Http\Controllers;

use App\User;

class ControladorPanelUsuarios extends Controller
{
    public function __construct()
    {

    }

    public function mostrarInicioUsuarios(){
        $usuarios=User::all();
        return view('Usuarios.Inicio', compact('usuarios'));
    }
}
