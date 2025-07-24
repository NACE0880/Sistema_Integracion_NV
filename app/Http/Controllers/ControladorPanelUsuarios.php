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

    public function guardarTipoUserable(Request $request){

        switch ($request->rol){
            case 0:
                $tipoUserable = \App\coordinadores;
                break;
            case 3:
                $tipoUserable = \App\directores;
                break;
            case 4:
                $tipoUserable = \App\tutores;
                break;
        }  
        
    }

    public function registrarUsuario(Request $request){
        
        dd($request);

        $numeroMasAltoClaveBDT = User::where('usuario', 'like', 'BDT%')
            ->selectRaw('MAX(CAST(SUBSTRING(usuario, 4) AS UNSIGNED)) as numeroClaveMasAltaBDT')
            ->value('numeroClaveMasAltaBDT');
        $nuevoNumeroClaveBDT = $numeroMasAltoClaveBDT ? $numeroMasAltoClaveBDT + 1 : 1;
        $claveConsecutivaAUltimoRegistroBDT = 'BDT' . $nuevoNumeroClaveBDT;

        User::create([
            'usuario' => $claveConsecutivaAUltimoRegistroBDT
        ]);

        return $request->all();
    }
}
