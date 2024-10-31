<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class TelegramController extends Controller
{
    public function mensajeriaTelegram(){

        $client = new Client();
        $headers = [
            'Content-Type' => 'application/json'
        ];
        $res = $client->request('GET', 'https://api.telegram.org/bot7251630970:AAFvn3K2be2mFh-bi_i-o5PAUk1E1rgZA28/getMe', $headers);
        $resultado = response()->json(['type'=> true, 'message' => 'informacion obtenida exitosamente!', 'informacion' => json_decode($res->getBody())]);

        // Comprobación del estatus del bot
        // echo $resultado;


        return view('Panel.mensajeriatelegram',compact('res'));
    }

}
