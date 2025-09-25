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

        $numeroMasAltoClaveUsadaUsuario = User::where('usuario', 'like', 'BDT%')
            ->selectRaw('MAX(CAST(SUBSTRING(usuario, 4) AS UNSIGNED)) as numeroClaveUsuarioMasAlta')
            ->value('numeroClaveUsuarioMasAlta');

        return 'BDT' . ($numeroMasAltoClaveUsadaUsuario ? $numeroMasAltoClaveUsadaUsuario + 1 : 1);

    }

    public function guardarTipoUserableSeleccionado(Request $request){
    
        $roles = (array) $request->rol;

        if (in_array('coordinador', $roles)){
            $tipoUserableSeleccionado = '\\App\\coordinadores';
        }elseif (in_array('director', $roles)){
            $tipoUserableSeleccionado = '\\App\\directores';
        }else {
            $tipoUserableSeleccionado = '\\App\\tutores';
        }

        return $tipoUserableSeleccionado;

    }

    public function registrarUsuario(Request $request){

        dd($request);

        //Registrar nuevo usuario
        $nuevaClaveUsuario = $this->generarNuevaClaveUsuario();

        $identificadorUsuario = User::where('usuario', $nuevaClaveUsuario)->value('id');

        $tipoUserableSeleccionado = $this->guardarTipoUserableSeleccionado($request);
        $ultimoUserableIdUsado = User::where('userable_type', $tipoUserableSeleccionado)->max('userable_id');
        
        $datosActualizacionTablaUsuario = 
        [
            // Se comprueba si existe el identificador usuario para crear una nueva entrada o actualizar una existente.
            'usuario' => $identificadorUsuario == null ? $nuevaClaveUsuario : null,
            'userable_id' => $identificadorUsuario == null ? $ultimoUserableIdUsado + 1 : null,
            'userable_type' => $identificadorUsuario == null ? $tipoUserableSeleccionado : null   
        ];
        //dd($datosActualizacionTablaUsuario);
        User::updateOrCreate($identificadorUsuario, array_filter($datosActualizacionTablaUsuario));

        $roles = (array) $request->rol;
        $digitoVerificadorValidacion = in_array($roles) == 'gestor validacion tickets' ? 1 : 0;

        switch ($tipoUserableSeleccionado){
            case '\\App\\coordinadores':
                $datosActualizacionTablaCoordinadores =
                ([
                    'NOMBRE' => $request->input('nombre'),
                    'CORREO' => $request->input('correo'),
                    'VALIDACION' => $digitoVerificadorValidacion
                ]);
                $datosActualizacionTablaCoordinadoresCasas = ([
                    'ID_COORDINADOR' => $identificadorUsuario == null ? coordinadores::max('ID_COORDINADOR') : null,
                    'ID_CASA' => $identificadorUsuario == null ? casas::where('NOMBRE', $request->input('casa_coordinador'))->value('ID_CASA') : null
                ]);
                break;
            case '\\App\\directores':
                break;
            case '\\App\\tutores':
                break;
        }
    //Mail::to
    }
}
