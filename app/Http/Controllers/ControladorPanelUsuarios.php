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

    public function generarNuevaClaveUsuario(){

        $numeroMasAltoClaveBDT = User::where('usuario', 'like', 'BDT%')
            ->selectRaw('MAX(CAST(SUBSTRING(usuario, 4) AS UNSIGNED)) as numeroClaveMasAltaBDT')
            ->value('numeroClaveMasAltaBDT');

        return 'BDT' . ($numeroMasAltoClaveBDT ? $numeroMasAltoClaveBDT + 1 : 1);

    }

    public function generarNuevoUserable(Request $request){
    
        $roles = (array) $request->rol;

        if (in_array('coordinador', $request->rol)){
            $tipoUserAble = '\\App\\coordinadores';
        }elseif (in_array('director', $request->rol)){
            $tipoUserAble = '\\App\\directores';
        }else {
            $tipoUserAble = '\\App\\tutores';
        }

        $ultimoUserableId = User::where('userable_type', $tipoUserAble)->max('userable_id');

        return [$tipoUserAble, $ultimoUserableId];

    }

    public function registrarUsuario(Request $request){

        list($tipoUserAble, $ultimoUserableId) = $this->generarNuevoUserable($request);

        dd($tipoUserAble, $ultimoUserableId);

        User::create([
            'usuario' => $this->generarNuevaClaveUsuario(),
            'userable_id' => $numeroMasAltoUserableId + 1,
            'userable_type' => $tipoUserAble
        ]);

    }
}
