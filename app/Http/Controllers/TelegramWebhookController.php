<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\adts;


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
            $data = explode("_", $callbackQuery['data']);

            $opcion_seleccionada = $data[0];
            $adt_id = $data[1];
            $messageId = $callbackQuery['message']['message_id'];

            $adt = adts::find($adt_id);

            // Procesar la opción seleccionada
            switch($opcion_seleccionada){

                case 'VALIDAR APERTURA ADT':
                    $responseText = '<i>'.$adt->NOMBRE.'</i>%0A %0A' . ' <b>APERTURA VALIDADA</b>';

                    // Actualización de registro
                    $this->actualizarEstatusAdt($adt, 'ABIERTA');
                    break;

                case 'VALIDAR CIERRE ADT':
                    $responseText = '<i>'.$adt->NOMBRE.'</i>%0A %0A' . ' <b>CIERRE VALIDADO</b>';

                    // Actualización de registro
                    $this->actualizarEstatusAdt($adt, 'CERRADA');
                    break;

                case "RECHAZAR CIERRE ADT":
                    $responseText = '<i>'.$adt->NOMBRE.'</i>%0A %0A' . ' <b>CIERRE RECHAZADO</b>';
                    break;

                default:
                    $responseText = 'Error de conectividad con el bot';
                    break;

            }
            // Enviar respuesta al usuario
            $this->enviarMensaje($chatId, $responseText);

            // Confirmar el callback_query
            $this->contestarCallbackQuery($callbackId, 'Tu selección fue procesada.');
            $this->eliminarMensaje($chatId, $messageId);
        }

        return response()->json(['status' => 'success']);
    }


    public function enviarMensaje($chat_id, $payload){

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

    private function contestarCallbackQuery($callbackId, $text){
        $token =  $this->token;
        $url = "https://api.telegram.org/bot$token/answerCallbackQuery";

        $data = [
            'callback_query_id' => $callbackId,
            'text' => $text,
            'show_alert' => false,
        ];

        $this->enviarSolicitud($url, $data);
    }

    private function enviarSolicitud($url, $data){
        $client = new \GuzzleHttp\Client();
        $client->post($url, [
            'json' => $data,
        ]);
    }

    private function eliminarMensaje($chatId, $messageId){
        $botToken = $this->token;
        $url = "https://api.telegram.org/bot{$botToken}/deleteMessage";

        // Datos para la solicitud
        $data = [
            'chat_id' => $chatId,
            'message_id' => $messageId,
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
    }

    // Acciones BD
    public function actualizarEstatusAdt(adts $adt, $estatus){
        $adt->ESTATUS_ACTUAL  = $estatus;
        $adt->save();
    }
}
