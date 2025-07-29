<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;

use App\User;
use App\coordinadores;
use App\coordinadores_casas;
use App\directores;
use App\tutores;
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

        if (in_array('coordinador', $roles)){
            $tipoUserAble = '\\App\\coordinadores';
        }elseif (in_array('director', $roles)){
            $tipoUserAble = '\\App\\directores';
        }else {
            $tipoUserAble = '\\App\\tutores';
        }

        $ultimoUserableId = User::where('userable_type', $tipoUserAble)->max('userable_id');

        return [$tipoUserAble, $ultimoUserableId];

    }

    public function registrarUsuario(Request $request){

        $nuevaClaveUsuario = $this->generarNuevaClaveUsuario();
        
        $roles = (array) $request->rol;
        list($tipoUserAble, $ultimoUserableId) = $this->generarNuevoUserable($request);
        $digitoVerificadorValidacion = in_array($roles) == 'gestor validacion tickets' ? '1' : '0';
        
        dd($request);

        $identificadorUsuario = User::where('usuario', $nuevaClaveUsuario)->value('id');
        $datosActualizacionTablaUsuario = 
        [
            'usuario' => $identificadorUsuario == null? $nuevaClaveUsuario : null,
            'userable_id' => $identificadorUsuario == null ? $numeroMasAltoUserableId + 1 : null,
            'userable_type' => $identificadorUsuario == null ? $tipoUserAble : null   
        ];
        User::updateOrCreate($identificadorUsuario, array_filter($datosActualizacionTablaUsuario));

        //quivoy
        switch ($tipoUserAble){
            case '\\App\\coordinadores':
                $datosActualizacionTablaCoordinadores =
                ([
                    'NOMBRE' => $request->input('nombre'),
                    'CORREO' => $request->input('correo'),
                    'VALIDACION' => $digitoVerificadorValidacion
                ]);
                coordinadores_casas::create([
                    'ID_COORDINADOR' => coordinadores::max('ID_COORDINADOR'),
                    'ID_CASA' => casas::where('NOMBRE', $request->input('casa_coordinador'))->value('ID_CASA')
                ]);
                break;
            
        }

        //Mail::to

    }
}
