<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class TelegramController extends Controller
{
    public function __construct() {
        $this->token = \Config::get('services.telegram.token');
    }

    // NOTIFICACIONES TELEGRAM
    // Mensaje Simple
    public function sendText($chat_id, $payload){

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.telegram.org/bot'.$this->token.'/sendMessage?chat_id='.$chat_id.'&parse_mode=HTML&link_preview_options[is_disabled]=true'.'&text='.$payload,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
        ));

        $response = curl_exec($curl);

        curl_close($curl);

    }

    // Documentos Adjuntos
    public function sendDocument($chat_id, $ruta){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.telegram.org/bot'.$this->token.'/sendDocument',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'chat_id' => $chat_id,
                'document'=> new \CURLFILE($ruta,mime_content_type($ruta))
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }


    // Panel Mensajeria ESTATUS
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

    // Cadenas
    public function format($string){
        $string = trim($string);
        $string = preg_replace("/[\r\n|\n|\r]+/", " - ", $string);
        return $string;
    }

    // Pruebas
    public function sendButtons($chat_id, $payload){

        $url = "https://api.telegram.org/bot$this->token/sendMessage";

        $data = [
            'chat_id' => $chat_id,
            'text' => $payload['mensaje'],
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    $payload['botones']
                ]
            ])
        ];

        $options = [
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => ["Content-Type: application/json"],
            CURLOPT_POSTFIELDS => json_encode($data)
        ];

        $curl = curl_init();
        curl_setopt_array($curl, $options);
        $response = curl_exec($curl);
        curl_close($curl);

    }

    public function sendOneTimeKeyboard($chatId, $options){
        $botToken = $this->token;
        $url = "https://api.telegram.org/bot{$botToken}/sendMessage";

        // Construir el teclado personalizado con opciones de un solo uso
        $keyboard = [
            'keyboard' => array_map(function ($option) { return [['text' => $option]]; }, $options),
            'resize_keyboard' => true, // Ajustar el tamaño del teclado
            'one_time_keyboard' => true // Teclado de un solo uso
        ];

        // Datos para la solicitud
        $data = [
            'chat_id' => $chatId,
            'text' => 'Por favor, selecciona una opción:',
            'reply_markup' => json_encode($keyboard),
        ];

        // Configuración cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Ejecutar la solicitud y capturar la respuesta
        $response = curl_exec($ch);

        // Manejo de errores cURL
        if (curl_errno($ch)) {
            echo 'Error en cURL: ' . curl_error($ch);
        }

        // Cerrar cURL
        curl_close($ch);

        // Retornar la respuesta
        return $response;
    }

}
