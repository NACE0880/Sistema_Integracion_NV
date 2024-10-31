<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use DateTime;
use DateTimeZone;

class WhatsappController extends Controller
{
    public function mesCorte(){
        // inicio del mes actual
        $mes_corte = date("Y") . '-' . date("m") . '-01T06:00:00.000Z';

        // conversion a formato UNIX
        $mes_corte_unix = strtotime($mes_corte);

        // return "1719813600";
        return $mes_corte_unix;
    }

    public function añoCorte(){
        // inicio del mes actual
        $año_corte = date("Y") . '-01-' . '01T06:00:00.000Z';

        // conversion a formato UNIX
        $año_corte_unix = strtotime($año_corte);

        // return "1719813600";
        return $año_corte_unix;
    }

    public function estatusActualMensajes(){

        $curl = curl_init();

        // Inicio del Mes UNIX
        $fecha_inicio = self::mesCorte();
        // Fecha de Hoy UNIX
        $fecha_final = strtotime("now");
        // $fecha_final = '1722405600';

        $granuralidad = 'HALF_HOUR';
        $token_acceso = 'EABvGrmq3yZCoBO070vYK6Vmd9vqKN07zc57HKFE5wZBkI2WzCcAzdUhrIKnDTdvUKkECZAIMCOHmsjFykcepQnptmcVZCTKWiGuZB1HH2t1ZCtIgwRUoZBzImOTTvgTrZBguDBgCZAbrLigqZAH4KLZAWDG5sX7IVFweg77D2rsnXuRC0kIWhUS6DD7hFqWWZBJ4Wpz3igZDZD';

        $url = 'https://graph.facebook.com/v20.0/332786329927298?fields=analytics.start(' . $fecha_inicio . ').end(' . $fecha_final . ').granularity(' . $granuralidad . ')&access_token=' . $token_acceso;

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer EABvGrmq3yZCoBO070vYK6Vmd9vqKN07zc57HKFE5wZBkI2WzCcAzdUhrIKnDTdvUKkECZAIMCOHmsjFykcepQnptmcVZCTKWiGuZB1HH2t1ZCtIgwRUoZBzImOTTvgTrZBguDBgCZAbrLigqZAH4KLZAWDG5sX7IVFweg77D2rsnXuRC0kIWhUS6DD7hFqWWZBJ4Wpz3igZDZD'
            ),
        ));

        $data = json_decode(curl_exec($curl));


        $estadisticas = 'NO OBTENIDAS';
        $msjenviados_totales = 0;
        $msjentregados_totales = 0;

        if (isset($data->analytics->data_points)) {
            // Obtener solo los mensajes por su granuralidad
            $estadisticas = $data->analytics->data_points;

            // Obtener total de mensajes
            foreach ($estadisticas as $dia) {
                $msjenviados_totales += $dia->sent;
                $msjentregados_totales += $dia->delivered;
            }
        }


        curl_close($curl);

        return [$estadisticas, $msjenviados_totales, $msjentregados_totales];
    }

    public function estatusActualConversaciones(){

        $curl = curl_init();

        // Inicio del Mes UNIX
        $fecha_inicio = self::mesCorte();
        // Fecha de Hoy UNIX
        $fecha_final = strtotime("now");
        // $fecha_final = '1722405600';

        $granuralidad = 'HALF_HOUR';
        $token_acceso = 'EABvGrmq3yZCoBO070vYK6Vmd9vqKN07zc57HKFE5wZBkI2WzCcAzdUhrIKnDTdvUKkECZAIMCOHmsjFykcepQnptmcVZCTKWiGuZB1HH2t1ZCtIgwRUoZBzImOTTvgTrZBguDBgCZAbrLigqZAH4KLZAWDG5sX7IVFweg77D2rsnXuRC0kIWhUS6DD7hFqWWZBJ4Wpz3igZDZD';

        $url = 'https://graph.facebook.com/v20.0/332786329927298?fields=conversation_analytics.start(' . $fecha_inicio . ').end(' . $fecha_final . ').granularity(' . $granuralidad . ')&access_token=' . $token_acceso;

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer EABvGrmq3yZCoBO070vYK6Vmd9vqKN07zc57HKFE5wZBkI2WzCcAzdUhrIKnDTdvUKkECZAIMCOHmsjFykcepQnptmcVZCTKWiGuZB1HH2t1ZCtIgwRUoZBzImOTTvgTrZBguDBgCZAbrLigqZAH4KLZAWDG5sX7IVFweg77D2rsnXuRC0kIWhUS6DD7hFqWWZBJ4Wpz3igZDZD'
            ),
        ));

        $data = json_decode(curl_exec($curl));

        $estadisticas = "NO OBTENIDO";
        $conversaciones_totales = 0;
        $costo_total = 0;
        if (isset($data->conversation_analytics->data[0]->data_points)) {
            // Obtener solo las conversaciones por su granuralidad
            $estadisticas = $data->conversation_analytics->data[0]->data_points;

            // Obtener total de conversaciones
            foreach ($estadisticas as $dia) {
                $conversaciones_totales += $dia->conversation;
                $costo_total += $dia->cost;
            }
        }

        curl_close($curl);

        return [$estadisticas, $conversaciones_totales, $costo_total];
    }

    public function estatusAnualMensajes(){

        $curl = curl_init();

        // Inicio del Mes UNIX
        $fecha_inicio = self::añoCorte();
        // Fecha de Hoy UNIX
        $fecha_final = strtotime("now");
        // $fecha_final = '1722405600';

        $granuralidad = 'MONTH';
        $token_acceso = 'EABvGrmq3yZCoBO070vYK6Vmd9vqKN07zc57HKFE5wZBkI2WzCcAzdUhrIKnDTdvUKkECZAIMCOHmsjFykcepQnptmcVZCTKWiGuZB1HH2t1ZCtIgwRUoZBzImOTTvgTrZBguDBgCZAbrLigqZAH4KLZAWDG5sX7IVFweg77D2rsnXuRC0kIWhUS6DD7hFqWWZBJ4Wpz3igZDZD';

        $url = 'https://graph.facebook.com/v20.0/332786329927298?fields=analytics.start(' . $fecha_inicio . ').end(' . $fecha_final . ').granularity(' . $granuralidad . ')&access_token=' . $token_acceso;

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer EABvGrmq3yZCoBO070vYK6Vmd9vqKN07zc57HKFE5wZBkI2WzCcAzdUhrIKnDTdvUKkECZAIMCOHmsjFykcepQnptmcVZCTKWiGuZB1HH2t1ZCtIgwRUoZBzImOTTvgTrZBguDBgCZAbrLigqZAH4KLZAWDG5sX7IVFweg77D2rsnXuRC0kIWhUS6DD7hFqWWZBJ4Wpz3igZDZD'
            ),
        ));

        $data = json_decode(curl_exec($curl));

        $estadisticas = "NO OBTENIDAS";
        $historico_enviados = [];
        $historico_entregados = [];

        if (isset($data->analytics->data_points)) {
            // Obtener solo los mensajes por su granuralidad
            $estadisticas = $data->analytics->data_points;

            // Obtener total de mensajes y enviarlo en un arreglo de arreglos
            $enviados_total_mes = [];
            $entregados_total_mes = [];

            foreach ($estadisticas as $mes) {
                array_push($enviados_total_mes, intval(date("m", $mes->start)), $mes->sent);
                array_push($entregados_total_mes, intval(date("m", $mes->start)), $mes->delivered);

                array_push($historico_enviados,$enviados_total_mes);
                array_push($historico_entregados,$entregados_total_mes);

                $enviados_total_mes = [];
                $entregados_total_mes = [];
            }
        }

        curl_close($curl);

        return [$estadisticas, $historico_enviados, $historico_entregados];
    }

    public function estatusAnualConversaciones(){

        $curl = curl_init();

        // Inicio del Mes UNIX
        $fecha_inicio = self::añoCorte();
        // Fecha de Hoy UNIX
        $fecha_final = strtotime("now");
        // $fecha_final = '1722405600';

        $granuralidad = 'MONTHLY';
        $token_acceso = 'EABvGrmq3yZCoBO070vYK6Vmd9vqKN07zc57HKFE5wZBkI2WzCcAzdUhrIKnDTdvUKkECZAIMCOHmsjFykcepQnptmcVZCTKWiGuZB1HH2t1ZCtIgwRUoZBzImOTTvgTrZBguDBgCZAbrLigqZAH4KLZAWDG5sX7IVFweg77D2rsnXuRC0kIWhUS6DD7hFqWWZBJ4Wpz3igZDZD';

        $url = 'https://graph.facebook.com/v20.0/332786329927298?fields=conversation_analytics.start(' . $fecha_inicio . ').end(' . $fecha_final . ').granularity(' . $granuralidad . ')&access_token=' . $token_acceso;

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer EABvGrmq3yZCoBO070vYK6Vmd9vqKN07zc57HKFE5wZBkI2WzCcAzdUhrIKnDTdvUKkECZAIMCOHmsjFykcepQnptmcVZCTKWiGuZB1HH2t1ZCtIgwRUoZBzImOTTvgTrZBguDBgCZAbrLigqZAH4KLZAWDG5sX7IVFweg77D2rsnXuRC0kIWhUS6DD7hFqWWZBJ4Wpz3igZDZD'
            ),
        ));

        $data = json_decode(curl_exec($curl));

        $estadisticas = "NO OBTENIDAS";
        $historico_conversaciones = [];
        $historico_costos = [];

        if (isset($data->conversation_analytics->data[0]->data_points)) {
            // Obtener solo las conversaciones por su granuralidad
            $estadisticas = $data->conversation_analytics->data[0]->data_points;

            // Obtener total de conversaciones y enviarlo en un arreglo de arreglos
            $conversaciones_total_mes = [];
            $costo_total_mes = [];

            foreach ($estadisticas as $mes) {
                array_push($conversaciones_total_mes, intval(date("m", $mes->start)), $mes->conversation);
                array_push($costo_total_mes, intval(date("m", $mes->start)), $mes->cost);

                array_push($historico_conversaciones,$conversaciones_total_mes);
                array_push($historico_costos,$costo_total_mes);

                $conversaciones_total_mes = [];
                $costo_total_mes = [];
            }
        }

        curl_close($curl);

        return [$estadisticas, $historico_conversaciones, $historico_costos];
    }

    public function panelControl(){
        // Mensual
        list($estadisticas_mensajes_mensual, $msjenviados_totales, $msjentregados_totales) = self::estatusActualMensajes();
        list($estadisticas_conversacion_mensual, $conversaciones_totales, $costo_total) = self::estatusActualConversaciones();

        // Anual
        list($estadisticas_mensajes_anual, $historico_enviados, $historico_entregados) = self::estatusAnualMensajes();
        list($estadisticas_conversaciones_anual, $historico_conversaciones, $historico_costos) = self::estatusAnualConversaciones();

        return view('Panel.index',compact(
            'msjenviados_totales','msjentregados_totales',
            'conversaciones_totales','costo_total',
            'historico_enviados','historico_entregados',
            'historico_conversaciones','historico_costos'
        ));
    }

    public function mensajeriaWhatsapp(){
        list($estadisticas_mensajes_mensual, $msjenviados_totales, $msjentregados_totales) = self::estatusActualMensajes();
        list($estadisticas_conversacion_mensual, $conversaciones_totales, $costo_total) = self::estatusActualConversaciones();

        $limite_conversaciones = 900;
        $limite_costos = 0;
        return view('Panel.mensajeriawhats',compact('msjenviados_totales','msjentregados_totales','conversaciones_totales','costo_total', 'limite_conversaciones', 'limite_costos'));
    }

}
