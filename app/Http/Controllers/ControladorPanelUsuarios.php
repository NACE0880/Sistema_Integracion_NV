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

    public function registrarUsuario(Request $request){

        dd($request);

        $casas = casas::all();
        $roles = (array) $request->rol;

        if (in_array('coordinador', $roles)){

            $datosActualizacionTablaCoordinadores = [];

            if ($request->filled('nombre')){
                $datosActualizacionTablaCoordinadores['NOMBRE'] = $request->input('nombre');
            }
            if ($request->filled('telegram')){
                $datosActualizacionTablaCoordinadores['TELEGRAM'] = $request->input('telegram');
            }
            if ($request->filled('correo')){
                $datosActualizacionTablaCoordinadores['CORREO'] = $request->input('correo');
            }
            if (in_array('gestor validacion tickets', $roles)){
                $datosActualizacionTablaCoordinadores['VALIDACION'] = 1;
            }

            $coordinador = coordinadores::updateOrCreate($datosActualizacionTablaCoordinadores);

            $datosActualizacionTablaUsuarios = [];  

            if ($request->filled('contrasena')){
                $datosActualizacionTablaUsuarios['password'] = bcrypt($request->input('contrasena'));
            }
            $datosActualizacionTablaUsuarios['userable_id'] = $coordinador->ID_COORDINADOR;
            $datosActualizacionTablaUsuarios['userable_type'] = COORDINADOR;

            $usuario = User::updateOrCreate($datosActualizacionTablaUsuarios);

            $usuario->usuario = 'BDT' . $usuario_id;
            $usuario->save();

            foreach ($casas as $casa) {
                coordinadores_casas::create([
                    'ID_COORDINADOR' => $coordinador->ID_COORDINADOR,
                    'ID_CASA' => $casa->ID_CASA,
                ]);
            }
        }

        //dd($request);

        $tipoUserableSeleccionado = $this->guardarTipoUserableSeleccionado($request);
        $ultimoUserableIdUsado = User::where('userable_type', $tipoUserableSeleccionado)->max('userable_id');

        $roles = (array) $request->rol;
        $digitoVerificadorValidacion = in_array('gestor validacion tickets', $roles) ? 1 : 0;

        $nuevaClaveUsuario = $this->generarNuevaClaveUsuario();

        User::create([
            // Se comprueba si existe el identificador usuario para crear una nueva entrada o actualizar una existente.
            'usuario' => $nuevaClaveUsuario,
            'password' => bcrypt($request->input('contrasena')),
            'userable_id' => $ultimoUserableIdUsado + 1,
            'userable_type' => $tipoUserableSeleccionado   
        ]);

        $identificadorUsuario = User::where('usuario', $nuevaClaveUsuario)->value('id');

        //Datos para actualizacion en tabla usuarios_roles
        foreach ($roles as $rol) {
            usuarios_roles::create([
                'ID_USUARIO' => $identificadorUsuario,
                'ID_ROL' => roles::where('NOMBRE', $rol)->first()->ID_ROL,
            ]);
        }

        if ($tipoUserableSeleccionado == '\\App\\coordinadores'){
            $coordinador = coordinadores::create([
                'NOMBRE' => $request->input('nombre'),
                'TELEGRAM' => $request->input('telegram'),
                'CORREO' => $request->input('correo'),
                'VALIDACION' => $digitoVerificadorValidacion,
            ]);
            //Datos para actualizacion en tabla coordinadores_casas
            foreach ($casas as $casa) {
                coordinadores_casas::create([
                    'ID_COORDINADOR' => $coordinador->ID_COORDINADOR,
                    'ID_CASA' => $casa->ID_CASA,
                ]);
            }
        } 
        
        if ($tipoUserableSeleccionado == '\\App\\directores' || in_array('director', $roles)){
            $datosActualizacionTablaDirectores =
            ([
                'ID_CASA' => casas::where('NOMBRE', $request->input('casa_director'))->first()->ID_CASA,
                'NOMBRE' => $request->input('nombre'),
                'CORREO' => $request->input('correo'),
            ]);
            directores::create($datosActualizacionTablaDirectores);
            //Datos para actualizacion en tabla usuarios_roles
        } 
        
        if ($tipoUserableSeleccionado == '\\App\\tutores' || in_array('tutor', $roles)){
            $datosActualizacionTablaTutores =
            ([
                'NOMBRE' => $request->input('nombre'),
                'CORREO' => $request->input('correo'),
            ]);
            tutores::create($datosActualizacionTablaTutores);
        }

        return redirect()->route('usuarios.inicio');
    }

    public function modificarUsuario(Request $request){

        //dd($request);

        $casas = casas::all();

        $claveUsuario = $request->input("nombre_clave_usuario");

        $identificadorUsuario = User::where('usuario', $claveUsuario)->value('id');

        $cargoUsuario = substr(User::where('usuario', $claveUsuario)->value('userable_type'), 5);

        $identificadorUserableUsuario = User::where('usuario', $claveUsuario)->value('userable_id');

        $roles = (array) $request->rol;
        $digitoVerificadorValidacion = in_array('gestor validacion tickets', $roles) ? 1 : 0;

        usuarios_roles::where('ID_USUARIO', $identificadorUsuario)->delete();

        if ($cargoUsuario == "coordinadores"){
            coordinadores::where('ID_COORDINADOR', $identificadorUserableUsuario)->delete();
        }

        if ($cargoUsuario == "directores"){
            directores::where('ID_DIRECTOR', $identificadorUserableUsuario)->delete();
        }

        if ($cargoUsuario == "tutores"){
            tutores::where('ID_TUTOR', $identificadorUserableUsuario)->delete();
        }

        $datosUsuarioAModificar = [];

        if ($request->filled('contrasena')) {
            $datosUsuarioAModificar['password'] = bcrypt($request->input('contrasena'));
        }

        if (in_array('coordinador', $roles)) {
            $datosUsuarioAModificar['userable_type'] = '\\App\\coordinadores';
        }
        if (in_array('director', $roles)) {
            $datosUsuarioAModificar['userable_type'] = '\\App\\directores';
        } 
        if (in_array('tutores', $roles)) {
            $datosUsuarioAModificar['userable_type'] = '\\App\\tutores';
        }

        User::where('usuario', $claveUsuario)->update($datosUsuarioAModificar);

        foreach ($roles as $rol) {
            usuarios_roles::create([
                'ID_USUARIO' => $identificadorUsuario,
                'ID_ROL' => roles::where('NOMBRE', $rol)->first()->ID_ROL,
            ]);
        }

        if (in_array('coordinador', $roles)){
            $datosUsuarioAModificar = [];

            if ($request->filled('nombre')) {
                $datosUsuarioAModificar['NOMBRE'] = $request->input('nombre');
            }

            if ($request->filled('telegram')) {
                $datosUsuarioAModificar['TELEGRAM'] = $request->input('telegram');
            }

            if ($request->filled('correo')) {
                $datosUsuarioAModificar['CORREO'] = $request->input('correo');
            }

            if (!empty($digitoVerificadorValidacion)) {
                $datosUsuarioAModificar['VALIDACION'] = $digitoVerificadorValidacion;
            }

            if (!empty($datosUsuarioAModificar)) {
                coordinadores::where('ID_COORDINADOR', $identificadorUserableUsuario)->update($datosUsuarioAModificar);
            }
            
            foreach ($casas as $casa) {
                coordinadores_casas::create([
                    'ID_COORDINADOR' => $identificadorUserableUsuario,
                    'ID_CASA' => $casa->ID_CASA,
                ]);
            }
        } 
        
        if (in_array('director', $roles)){
            $datosUsuarioAModificar = [];

            if ($request->filled('nombre')) {
                $datosUsuarioAModificar['NOMBRE'] = $request->input('nombre');
            }

            if ($request->filled('correo')) {
                $datosUsuarioAModificar['CORREO'] = $request->input('correo');
            }

            if ($request->filled('casa_director')) {
                $datosUsuarioAModificar['ID_CASA'] = casas::where('NOMBRE', $request->input('casa_director'))->first()->ID_CASA;
            }

            if (!empty($datosUsuarioAModificar)) {
                directores::where('ID_DIRECTOR', $identificadorUserableUsuario)->update($datosUsuarioAModificar);
            }
        } 
        
        if (in_array('tutor', $roles)){
            $datosUsuarioAModificar = [];

            if ($request->filled('nombre')) {
                $datosUsuarioAModificar['NOMBRE'] = $request->input('nombre');
            }

            if ($request->filled('correo')) {
                $datosUsuarioAModificar['CORREO'] = $request->input('correo');
            }

            if (!empty($datosUsuarioAModificar)) {
                tutores::where('ID_TUTOR', $identificadorUserableUsuario)->update($datosUsuarioAModificar);
            }
        }
    }
}
