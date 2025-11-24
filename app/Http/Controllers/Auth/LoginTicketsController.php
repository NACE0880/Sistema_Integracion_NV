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

        if (!$usuario || empty($usuario->password)) {
            return redirect()->back()->withErrors(['usuario' => 'El usuario no existe aún']);
        }

        // Redirecccion en caso de usuario director
        if(Auth::guard('web')->attempt([
            'usuario'       => $request->input('usuario'),
            'password'      => $request->input('password'),
        ], $request->remember) ){
            //return self::autentificador2FA($usuario);
            return redirect()->intended(route('home'));
        }


        // Redirecccion en caso de credenciales erroneas
        return redirect()->back()
        ->withErrors(['usuario' => 'Credenciales erróneas'])
        ->withInput($request->only('usuario'));

        // return $request->all();
    }

    public function autentificador2FA($usuario) {
        session(['2fa:user:id' => $usuario->id]);
        session(['2fa:user:momentodecerradodesesion' => now()]);
        Auth::logout(); // Para evitar acceso sin 2FA

        $google2fa = new Google2FA();

        //Generar clave si no existe
        if (empty($usuario->google2fa_secret)) {
            $usuario->google2fa_secret = $google2fa->generateSecretKey();
            $usuario->save();
        }

        $urlDeGoogle2fa = $google2fa->getQRCodeUrl(
            'SistemaIntegraciónTelmex',
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

        return view('auth.pantallaVerificacionDeDosPasos', compact('codigoQr'));
    }

    public function verificar2FA(Request $request) {
        $codigoParaVerificar2FAArray = $request->input('codigoParaVerificar2FA');
        $codigoParaVerificar2FA = implode('', $codigoParaVerificar2FAArray);
        $google2fa = new Google2FA();
        $usuario = User::find(session('2fa:user:id'));
        $validacion2FA = $google2fa->verifyKey($usuario->google2fa_secret, $codigoParaVerificar2FA);

        if ($validacion2FA) {
            if (!$usuario->google2fa_enabled) {
                $usuario->google2fa_enabled = true;
                $usuario->save();
            }

            if (now()->diffInMinutes(session('2fa:user:momentodecerradodesesion')) > 5) {
                return redirect()->route('login.tickets')->withErrors(['usuario' => 'Sesión de 2FA expirada']);
            }

            Auth::login($usuario);
            return redirect()->intended(route('home'));
        }

        return redirect()->back()->withErrors(['usuario' => 'Código inválido']);
    }
}
