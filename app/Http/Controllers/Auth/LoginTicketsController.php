<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;



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

        // Redirecccion en caso de usuario director
        if(Auth::guard('web')->attempt([
            'usuario'       => $request->input('usuario'),
            'password'      => $request->input('password'),
        ], $request->remember) ){
            return redirect()->intended(route('home'));
        }


        // Redirecccion en caso de credenciales erroneas
        return redirect()->back()->withInput($request->only('usuario'));
        // return $request->all();
    }
}
