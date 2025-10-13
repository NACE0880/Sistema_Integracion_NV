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
use App\usuarios_roles;

class ControladorPanelUsuarios extends Controller
{

    const COORDINADOR = "\\App\\Coordinadores";
    const DIRECTOR = "\\App\\Directores";
    const TUTOR = "\\App\\Tutores";

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

    function crearUsuario($claveUsuario, $identificadorUserableUsuarioActual, $roles, $datosAActualizar, $request) {
        //$entidadDeDatos = $modeloDeDatos::updateOrCreate($claveUsuario, $datosAActualizar);

        $datosActualizarTablaUsuarios = [];

        if ($request->filled('contrasena')){
            $datosActualizarTablaUsuarios['password'] = bcrypt($request->input('contrasena'));
        }
        if ($request->filled('telegram')){
            $datosActualizarTablaUsuarios['TELEGRAM'] = $request->input('telegram');
        }
        if ($request->filled('correo')){
            $datosActualizarTablaUsuarios['CORREO'] = $request->input('correo');
        }

        $usuario = User::updateOrCreate($claveUsuario, [
            'password' => $request->filled('contrasena') ? bcrypt($request->input('contrasena')) : bcrypt('12345678'),
            'userable_id' => $entidadDeDatos->{$tipoIdentificador},
            'userable_type' => $cargo,
        ]);

        $usuario->usuario = 'BDT' . $usuario->id;
        $usuario->save();

        foreach ($roles as $rol) {
            usuarios_roles::create([
                'ID_USUARIO' => $usuario->id,
                'ID_ROL' => roles::where('NOMBRE', $rol)->first()->ID_ROL,
            ]);
        }

        return $entidadDeDatos;
    }


    public function registrarUsuario(Request $request){

        if (in_array('coordinador', $roles)) {
            $datosActualizarTablaCargo = [];

            if ($request->filled('nombre')){
                $datosActualizarTablaCargo['NOMBRE'] = $request->input('nombre');
            }
            if ($request->filled('telegram')){
                $datosActualizarTablaCargo['TELEGRAM'] = $request->input('telegram');
            }
            if ($request->filled('correo')){
                $datosActualizarTablaCargo['CORREO'] = $request->input('correo');
            }
            if (in_array('gestor validacion tickets', $roles)){
                $datosActualizarTablaCargo['VALIDACION'] = 1;
            }

            $coordinador = coordinadores::create($datosActualizarTablaCargo);
            
            $datosActualizarTablaUsuario = [];

            $datosActualizarTablaUsuario = [
                'password' => bcrypt($request->input('contrasena')),
                'userable_id' => $coordinador->ID_COORDINADOR,
                'userable_type' => COORDINADOR,
            ];
            
            $usuario = User::create($datosActualizarTablaUsuario);
            $usuario->usuario = 'BDT' . $usuario->id;
            $usuario->save();

            foreach ($roles as $rol) {
                usuarios_roles::create([
                    'ID_USUARIO' => $usuario->id,
                    'ID_ROL' => roles::where('NOMBRE', $rol)->first()->ID_ROL,
                ]);
            }

            foreach (casas::all() as $casa) {
                coordinadores_casas::create([
                    'ID_COORDINADOR' => $coordinador->ID_COORDINADOR,
                    'ID_CASA' => $casa->ID_CASA,
                ]);
            }
        }
        //aca
        if (in_array('director', $roles)) {
            $datosAActualizar = [];

            if (($request)->has('rol') && !empty($request->rol)){
                $datosAActualizar['ID_CASA'] = $request->input('casa_director');
            }
            if ($request->filled('nombre')){
                $datosAActualizar['NOMBRE'] = $request->input('nombre');
            }
            if ($request->filled('correo')){
                $datosAActualizar['CORREO'] = $request->input('correo');
            }

            crearUsuario($claveUsuario, directores::class, $datosAActualizar, 'ID_DIRECTOR', DIRECTOR, $roles, $request);
        }

        if (in_array('tutor', $roles)) {
            $datosAActualizar = [];

            if ($request->filled('nombre')){
                $datosAActualizar['NOMBRE'] = $request->input('nombre');
            }
            if ($request->filled('correo')){
                $datosAActualizar['CORREO'] = $request->input('correo');
            }

            crearUsuario($claveUsuario, tutores::class, $datosAActualizar, 'ID_TUTOR', TUTOR, $roles, $request);
        }

        return redirect()->route('usuarios.inicio');
    }

    public function modificarUsuario(Request $request){

        dd($request);

        $casas = casas::all();

        $claveUsuario = $request->input("nombre_clave_usuario");

        $identificadorUsuario = User::where('usuario', $claveUsuario)->value('id');

        $cargoUsuario = substr(User::where('usuario', $claveUsuario)->value('userable_type'), 5);

        $identificadorUserableUsuario = User::where('usuario', $claveUsuario)->value('userable_id');

        $roles = (array) $request->rol;
        $digitoVerificadorValidacion = in_array('gestor validacion tickets', $roles) ? 1 : 0;

        usuarios_roles::where('ID_USUARIO', $identificadorUsuario)->delete();

        if ($cargoUsuario == "coordinadores" && in_array('coordinador', $roles)){
            directores::where('ID_DIRECTOR', $identificadorUserableUsuario)->delete();
            tutores::where('ID_TUTOR', $identificadorUserableUsuario)->delete();
        }
        if ($cargoUsuario == "directores" && in_array('director', $roles)){
            coordinadores::where('ID_COORDINADOR', $identificadorUserableUsuario)->delete();
            tutores::where('ID_TUTOR', $identificadorUserableUsuario)->delete();
        }
        if ($cargoUsuario == "tutores" && in_array('tutor', $roles)){
            coordinadores::where('ID_COORDINADOR', $identificadorUserableUsuario)->delete();
            directores::where('ID_DIRECTOR', $identificadorUserableUsuario)->delete();
        }

        registrarUsuario($claveUsuario, $request);



        dd($request);

        $roles = (array) $request->rol;
        $claveUsuario = $request->input("nombre_clave_usuario");
        $cargoAnteriorUsuario = substr(User::where('usuario', $claveUsuario)->value('userable_type'), 5);
        $identificadorUserableAnteriorUsuario = User::where('usuario', $claveUsuario)->value('userable_id');

        if (in_array('coordinador', $roles)) {

            $datosActualizarTablaCargo = [];
            $datosActualizarTablaUsuario = [];

            if ($cargoAnteriorUsuario == "coordinadores"){
                if ($request->filled('nombre')){
                    $datosActualizarTablaCargo['NOMBRE'] = $request->input('nombre');
                }
                if ($request->filled('telegram')){
                    $datosActualizarTablaCargo['TELEGRAM'] = $request->input('telegram');
                }
                if ($request->filled('correo')){
                    $datosActualizarTablaCargo['CORREO'] = $request->input('correo');
                }
                if (in_array('gestor validacion tickets', $roles)){
                    $datosActualizarTablaCargo['VALIDACION'] = 1;
                }

                if ($request->filled('contrasena')){
                    $datosActualizarTablaUsuario['password'] = bcrypt($request->input('contrasena'));
                }
                
                $coordinador = coordinadores::where('ID_COORDINADOR', $identificadorUserableAnteriorUsuario)->first();
                $coordinador->update($datosActualizarTablaCargo);

                $usuario = User::where($claveUsuario, $datosActualizarTablaUsuario)->update($datosActualizarTablaUsuario);
            }
            
            $datosActualizarTablaUsuario = [];

            if ($cargoAnteriorUsuario != "coordinadores"){
                if ($cargoAnteriorUsuario == "directores" || $cargoAnteriorUsuario == "tutores"){
                    $datosActualizarTablaUsuario = [
                        'usuario' => 'N' . $claveUsuario,
                        'password' => bcrypt('NoDisponible'),
                    ];
                    User::where('usuario', $claveUsuario)->update($datosActualizarTablaUsuario);
                }
                registrarUsuario($request);
            }
        }

        if (in_array('director', $roles)) {
            $datosAActualizar = [];

            if (($request)->has('rol') && !empty($request->rol)){
                $datosAActualizar['ID_CASA'] = $request->input('casa_director');
            }
            if ($request->filled('nombre')){
                $datosAActualizar['NOMBRE'] = $request->input('nombre');
            }
            if ($request->filled('correo')){
                $datosAActualizar['CORREO'] = $request->input('correo');
            }

            crearUsuario($claveUsuario, directores::class, $datosAActualizar, 'ID_DIRECTOR', DIRECTOR, $roles, $request);
        }

        if (in_array('tutor', $roles)) {
            $datosAActualizar = [];

            if ($request->filled('nombre')){
                $datosAActualizar['NOMBRE'] = $request->input('nombre');
            }
            if ($request->filled('correo')){
                $datosAActualizar['CORREO'] = $request->input('correo');
            }

            crearUsuario($claveUsuario, tutores::class, $datosAActualizar, 'ID_TUTOR', TUTOR, $roles, $request);
        }

        return redirect()->route('usuarios.inicio');

    }
}
