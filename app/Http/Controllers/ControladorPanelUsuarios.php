<?php

namespace App\Http\Controllers;

use Auth;

use Illuminate\Support\Facades\DB;
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
use App\ModificacionTablaUsuario;

use PragmaRX\Google2FA\Google2FA;

use App\Http\Controllers\TelegramController;

class ControladorPanelUsuarios extends Controller
{

    const COORDINADOR = "\\App\\coordinadores";
    const DIRECTOR = "\\App\\directores";
    const TUTOR = "\\App\\tutores";

    public function __construct()
    {

    }

    public function mostrarInicioUsuarios(){
        
        $usuarios=User::all();
        $casas=casas::all();
        $roles=roles::all();

        return view('Usuarios.Inicio', compact('usuarios', 'casas', 'roles'));
    }

    public function mostrarRegistroModificaciones(){
        
        $modificaciones = ModificacionTablaUsuario::all();

        return view('Usuarios.TablaRegistros', compact('modificaciones'));
    }

    public function registrarUsuario(Request $request){
        $roles = (array) $request->rolConCargos;
        DB::beginTransaction();

        try{
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

                $google2fa = new Google2FA();
                $claveSecreta2fa = $google2fa->generateSecretKey();

                $datosActualizarTablaUsuario = [];

                $datosActualizarTablaUsuario = [
                    'usuario' => 'TEMP',
                    'password' => bcrypt($request->input('contrasena')),
                    'userable_id' => $coordinador->ID_COORDINADOR,
                    'userable_type' => self::COORDINADOR,
                    'google2fa_secret' => $claveSecreta2fa,
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
            } elseif (in_array('director', $roles)) {
                $datosActualizarTablaCargo = [];

                if ($request->filled('nombre')){
                    $datosActualizarTablaCargo['NOMBRE'] = $request->input('nombre');
                }
                if ($request->filled('correo')){
                    $datosActualizarTablaCargo['CORREO'] = $request->input('correo');
                }
                if (($request)->has('casa_director') && !empty($request->casa_director)){
                    $datosActualizarTablaCargo['ID_CASA'] = casas::where('NOMBRE', $request->input('casa_director'))->first()->ID_CASA;
                }

                $director = directores::create($datosActualizarTablaCargo);

                $google2fa = new Google2FA();
                $claveSecreta2fa = $google2fa->generateSecretKey();

                $datosActualizarTablaUsuario = [];

                $datosActualizarTablaUsuario = [
                    'usuario' => 'TEMP',
                    'password' => bcrypt($request->input('contrasena')),
                    'userable_id' => $director->ID_DIRECTOR,
                    'userable_type' => self::DIRECTOR,
                    'google2fa_secret' => $claveSecreta2fa,
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
            } elseif (in_array('tutor', $roles)) {
                $datosActualizarTablaCargo = [];

                if ($request->filled('nombre')){
                    $datosActualizarTablaCargo['NOMBRE'] = $request->input('nombre');
                }
                if ($request->filled('correo')){
                    $datosActualizarTablaCargo['CORREO'] = $request->input('correo');
                }

                $tutor = tutores::create($datosActualizarTablaCargo);

                $google2fa = new Google2FA();
                $claveSecreta2fa = $google2fa->generateSecretKey();

                $datosActualizarTablaUsuario = [];

                $datosActualizarTablaUsuario = [
                    'usuario' => 'TEMP',
                    'password' => bcrypt($request->input('contrasena')),
                    'userable_id' => $tutor->ID_TUTOR,
                    'userable_type' => self::TUTOR,
                    'google2fa_secret' => $claveSecreta2fa,
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
            }
            $usuarioConSesionIniciada = Auth::user();
            ModificacionTablaUsuario::create([
                'NOMBRE' => $usuarioConSesionIniciada->userable->NOMBRE,
                'MODIFICACION' => 'Registro de: ' . $request->input('nombre'),
            ]);
            DB::commit();
            $mensaje = ', agregó al sistema a: ';
            self::notificarCoordinadores($mensaje, $usuario);
            return redirect()->route('usuarios.inicio');
        } catch (\Exception $e){
            DB::rollback();
            dd('Entró al catch', $e->getMessage());
            return back()->with('error', 'Error al registrar usuario: ' . $e->getMessage());
        }
    }

    public function modificarUsuario(Request $request){
        $roles = (array) $request->rolSinCargos;
        $claveUsuario = $request->input("nombre_clave_usuario");
        $cargoAnteriorUsuario = substr(User::where('usuario', $claveUsuario)->value('userable_type'), 5);
        $identificadorUserableAnteriorUsuario = User::where('usuario', $claveUsuario)->value('userable_id');
        $usuario = User::where('usuario', $claveUsuario)->first();
        $nombreAnteriorUsuario = $usuario->userable->NOMBRE;
        $correoAnteriorUsuario = $usuario->userable->CORREO;
        $telegramAnteriorUsuario = $usuario->userable->TELEGRAM ? $usuario->userable->TELEGRAM : '-';
        $casaAnteriorUsuario = $usuario->userable->ID_CASA ? casas::where('ID_CASA', $usuario->userable->ID_CASA)->Value('NOMBRE') : '-';
        
        DB::beginTransaction();

        try{
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

                $usuario = User::where('usuario', $claveUsuario)->first();
                $usuario->update($datosActualizarTablaUsuario);

                if (($request)->has('rolSinCargos') && !empty($roles)){
                    usuarios_roles::where('ID_USUARIO', $usuario->id)->where('ID_ROL', '!=', 1)->delete();

                    foreach ($roles as $rol) {
                        usuarios_roles::create([
                            'ID_USUARIO' => $usuario->id,
                            'ID_ROL' => roles::where('NOMBRE', $rol)->first()->ID_ROL,
                        ]);
                    }
                }
            }
            
            $datosActualizarTablaCargo = [];
            $datosActualizarTablaUsuario = [];

            if ($cargoAnteriorUsuario == "directores"){
                if ($request->filled('nombre')){
                    $datosActualizarTablaCargo['NOMBRE'] = $request->input('nombre');
                }
                if ($request->filled('correo')){
                    $datosActualizarTablaCargo['CORREO'] = $request->input('correo');
                }
                if (($request)->has('casa_director') && !empty($request->casa_director)){
                    $datosActualizarTablaCargo['ID_CASA'] = casas::where('NOMBRE', $request->input('casa_director'))->first()->ID_CASA;
                }

                if ($request->filled('contrasena')){
                    $datosActualizarTablaUsuario['password'] = bcrypt($request->input('contrasena'));
                }
                
                $director = directores::where('ID_DIRECTOR', $identificadorUserableAnteriorUsuario)->first();
                $director->update($datosActualizarTablaCargo);

                $usuario = User::where('usuario', $claveUsuario)->first();
                $usuario->update($datosActualizarTablaUsuario);

                if (($request)->has('rolSinCargos') && !empty($roles)){
                    usuarios_roles::where('ID_USUARIO', $usuario->id)->where('ID_ROL', '!=', 4)->delete();

                    foreach ($roles as $rol) {
                        usuarios_roles::create([
                            'ID_USUARIO' => $usuario->id,
                            'ID_ROL' => roles::where('NOMBRE', $rol)->first()->ID_ROL,
                        ]);
                    }
                }
            }
            
            $datosActualizarTablaCargo = [];
            $datosActualizarTablaUsuario = [];

            if ($cargoAnteriorUsuario == "tutores"){
                if ($request->filled('nombre')){
                    $datosActualizarTablaCargo['NOMBRE'] = $request->input('nombre');
                }
                if ($request->filled('correo')){
                    $datosActualizarTablaCargo['CORREO'] = $request->input('correo');
                }

                if ($request->filled('contrasena')){
                    $datosActualizarTablaUsuario['password'] = bcrypt($request->input('contrasena'));
                }
                
                $tutor = tutores::where('ID_TUTOR', $identificadorUserableAnteriorUsuario)->first();
                $tutor->update($datosActualizarTablaCargo);

                $usuario = User::where('usuario', $claveUsuario)->first();
                $usuario->update($datosActualizarTablaUsuario);

                if (($request)->has('rolSinCargos') && !empty($roles)){
                    usuarios_roles::where('ID_USUARIO', $usuario->id)->where('ID_ROL', '!=', 5)->delete();

                    foreach ($roles as $rol) {
                        usuarios_roles::create([
                            'ID_USUARIO' => $usuario->id,
                            'ID_ROL' => roles::where('NOMBRE', $rol)->first()->ID_ROL,
                        ]);
                    }
                }
            }
            
            $mensajeModificacion = '';
            if ($request->has('nombre')){
                $mensajeModificacion .= "\n" . $nombreAnteriorUsuario . ' -> ' . $request->input('nombre') . "\n";
            } 
            if($request->has('telegram')){
                $mensajeModificacion .= "\n" . $telegramAnteriorUsuario . ' -> ' . $request->input('telegram') . "\n";
            } 
            if($request->has('correo')){
                $mensajeModificacion .= "\n" . $correoAnteriorUsuario . ' -> ' . $request->input('correo') . "\n";
            } 
            if($request->has('casa_director')){
                $mensajeModificacion .= "\n" . $casaAnteriorUsuario . ' -> ' . $request->input('casa_director') . "\n";
            }
            if($mensajeModificacion){
                $mensaje = ' modificó: ' . "\n" . $mensajeModificacion . "\n" . "del usuario de: ";
            } else{
                $mensaje = ' realizó una modificación al usuario: ';
            }
            //$mensajeModificacionBase = ;
            $usuarioConSesionIniciada = Auth::user();
            ModificacionTablaUsuario::create([
                'NOMBRE' => $usuarioConSesionIniciada->userable->NOMBRE,
                'MODIFICACION' => trim($mensajeModificacion, "\n"),
            ]);
            DB::commit();
            
            self::notificarCoordinadores($mensaje, $usuario);
            return redirect()->route('usuarios.inicio');
        } catch (\Exception $e) {
            DB::rollback();
            dd('Entró al catch', $e->getMessage());
            return back()->with('error', 'Error al modificar usuario: ' . $e->getMessage());
        }
    }

    public function eliminarUsuario(Request $request){
        DB::beginTransaction();
        try{
            $claveUsuario = $request->nombre_clave_usuario;
            $usuario = User::where('usuario', $claveUsuario)->first();
            $nombreUsuario = $usuario->userable->NOMBRE;
            $datosActualizarTablaUsuario = [
                'usuario' => 'N' . $claveUsuario,
                'password' => bcrypt('NoDisponible'),
                'google2fa_secret' => null,
                'google2fa_enabled' => 0,
            ];
            $datosActualizarTablaCargo = [
                'TELEGRAM' => '100000000000001',
                'CORREO' => 'no-disponible@example.com',
            ];
            User::where('usuario', $claveUsuario)->update($datosActualizarTablaUsuario);
            $usuario->userable->update($datosActualizarTablaCargo);
            $usuarioConSesionIniciada = Auth::user();
            ModificacionTablaUsuario::create([
                'NOMBRE' => $usuarioConSesionIniciada->userable->NOMBRE,
                'MODIFICACION' => 'Eliminación de: ' . $nombreUsuario,
            ]);
            DB::commit();
            $mensaje = ', eliminó del sistema a: ';
            self::notificarCoordinadores($mensaje, $usuario);
            return redirect()->route('usuarios.inicio');
        } catch (\Exception $e) {
            DB::rollback();
            dd('Entró al catch', $e->getMessage());
            return back()->with('error', 'Error al modificar usuario: ' . $e->getMessage());
        }
    }

    public function notificarCoordinadores($mensaje, $usuarioRegistrado) {
        $telegram = new TelegramController();
        $usuarioConSesionIniciada = Auth::user();

        $coordinadores = User::with('userable')
            ->where('userable_type', '\\App\\coordinadores')
            ->get();

        foreach ($coordinadores as $usuario) {
            if ($usuario->userable && !empty($usuario->userable->TELEGRAM)) {
                $chat_id = $usuario->userable->TELEGRAM;
                $payload = "<i>{$usuarioConSesionIniciada->userable->NOMBRE}</i>{$mensaje}{$usuarioRegistrado->userable->NOMBRE}";
                try {
                    if ($chat_id == '100000000000001') {
                        continue;
                    }

                    $telegram->sendText($chat_id, $payload, ['parse_mode' => 'HTML']);
                } catch (\Exception $e) {
                    \Log::error('Error enviando a Telegram: ' . $e->getMessage());
                }
            }
        }
    }

}
