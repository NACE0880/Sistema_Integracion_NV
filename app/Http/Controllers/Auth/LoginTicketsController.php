<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\User;

use PragmaRX\Google2FA\Google2FA;

use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Writer;

class LoginTicketsController extends Controller
{
    use AuthenticatesUsers;


    public function mostrarLogin()
    {
        return view('auth.loginTickets');
    }

    public function login(Request $request)
    {
        // Validar contenido de los inputs
        $this->validate($request, [
            'usuario' => 'required',
            'password' => 'required',
        ]);

        // Busca en base de datos Usuarios la primer coincidencia del valor recuperado del campo usuario
        $usuario = User::where('usuario', $request->usuario)->first();

        if (!$usuario) {
            return redirect()->back()->withErrors(['usuario' => 'El usuario no existe']);
        }

        if (empty($usuario->password)) {
            return redirect()->back()->withErrors(['usuario' => 'Este usuario aún no tiene contraseña aún']);
        }

        // Redirecccion en caso de usuario director
        if(Auth::guard('web')->attempt([
            'usuario'       => $request->input('usuario'),
            'password'      => $request->input('password'),
        ], $request->remember) ){
            self::autentificador2FA($usuario);
            
            //return redirect()->intended(route('home'));
        }


        // Redirecccion en caso de credenciales erroneas
        return redirect()->back()->withInput($request->only('usuario'));
        // return $request->all();
    }

    public function autentificador2FA($usuario) {
        if ($usuario->google2fa_enabled) {
                session(['2fa:user:id' => $usuario->id]);
                Auth::logout(); // Para evitar acceso sin 2FA
                return redirect()->route('poner nombre ruta para verificar 2fa');
            } /*elseif !($usuario->google2fa_enabled) {
                 $urlDeGoogle2fa = $google2fa->getQRCodeUrl(
                    'Sistema Integraciòn Telmex',
                    $usuario->userable->CORREO,
                    $usuario->google2fa_secret
                );

                $generadorQr = new Writer(
                    new ImageRenderer(
                        new RendererStyle(400),
                        new SvgImageBackEnd()
                    )
                );

                $codigoQr = $generadorQr->writeString($urlDeGoogle2fa);

                return redirect()->route('ruta para activar');
            }*/
    }
}
