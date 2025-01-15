<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TelegramWebhookController extends Controller
{
    public function __construct() {
        $this->token = \Config::get('services.telegram-bot-token');
    }
    public function handleWebhook(Request $request)
    {
        // Obtener los datos enviados por Telegram
        $update = $request->all();

        // Verificar si hay un callback_query
        if (isset($update['callback_query'])) {
            $callbackQuery = $update['callback_query'];
            $callbackId = $callbackQuery['id'];
            $chatId = $callbackQuery['from']['id'];
            $data = $callbackQuery['data'];

            // Procesar la opción seleccionada
            // $responseText = match($data) {
            //     'opcion_1' => '¡Elegiste la opción 1! ',
            //     'opcion_2' => '¡Elegiste la opción 2! ',
            //     default => 'Opción no válida. ',
            // };
            switch($data){
                case 'opcion_1':
                    $responseText = '¡Elegiste la opción 1!';
                case 'opcion_2':
                    $responseText = '¡Elegiste la opción 2!';
                default:
                    $responseText = 'Opción no válida. ';
            }

            // Enviar respuesta al usuario
            $this->sendMessage($chatId, $responseText);

            // Confirmar el callback_query
            $this->answerCallbackQuery($callbackId, 'Tu selección fue procesada.');
        }

        return response()->json(['status' => 'success']);
    }

    private function sendMessage($chatId, $text)
    {
        $token =  $this->token;
        $url = "https://api.telegram.org/bot$token/sendMessage";

        $data = [
            'chat_id' => $chatId,
            'text' => $text,
        ];

        $this->sendRequest($url, $data);
    }

    private function answerCallbackQuery($callbackId, $text)
    {
        $token =  $this->token;
        $url = "https://api.telegram.org/bot$token/answerCallbackQuery";

        $data = [
            'callback_query_id' => $callbackId,
            'text' => $text,
            'show_alert' => false,
        ];

        $this->sendRequest($url, $data);
    }

    private function sendRequest($url, $data)
    {
        $client = new \GuzzleHttp\Client();
        $client->post($url, [
            'json' => $data,
        ]);
    }
}
