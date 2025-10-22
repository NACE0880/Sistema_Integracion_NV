<?php

namespace App\Http\Controllers;

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

                $datosActualizarTablaUsuario = [];

                $datosActualizarTablaUsuario = [
                    'usuario' => 'TEMP',
                    'password' => bcrypt($request->input('contrasena')),
                    'userable_id' => $coordinador->ID_COORDINADOR,
                    'userable_type' => self::COORDINADOR,
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

                $datosActualizarTablaUsuario = [];

                $datosActualizarTablaUsuario = [
                    'usuario' => 'TEMP',
                    'password' => bcrypt($request->input('contrasena')),
                    'userable_id' => $director->ID_DIRECTOR,
                    'userable_type' => self::DIRECTOR,
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

                $datosActualizarTablaUsuario = [];

                $datosActualizarTablaUsuario = [
                    'usuario' => 'TEMP',
                    'password' => bcrypt($request->input('contrasena')),
                    'userable_id' => $tutor->ID_TUTOR,
                    'userable_type' => self::TUTOR,
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
            DB::commit();
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

                if (($request)->has('rolSinCargo') && !empty($roles)){
                    usuarios_roles::where('ID_USUARIO', $usuario->id)->where('ID_ROL', '!=', 5)->delete();

                    foreach ($roles as $rol) {
                        usuarios_roles::create([
                            'ID_USUARIO' => $usuario->id,
                            'ID_ROL' => roles::where('NOMBRE', $rol)->first()->ID_ROL,
                        ]);
                    }
                }
            }
            
            DB::commit();
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
            $datosActualizarTablaUsuario = [
                'usuario' => 'N' . $claveUsuario,
                'password' => bcrypt('NoDisponible'),
            ];
            User::where('usuario', $claveUsuario)->update($datosActualizarTablaUsuario);
            DB::commit();
            return redirect()->route('usuarios.inicio');
        } catch (\Exception $e) {
            DB::rollback();
            dd('Entró al catch', $e->getMessage());
            return back()->with('error', 'Error al modificar usuario: ' . $e->getMessage());
        }
    }
}
