// FUNCIONES
function obtenerFecha(){
    let ahora = new Date();
    let fecha = '';

    dia = ahora.getDate().toString();
    mes = (ahora.getMonth()+1).toString();
    año = ahora.getFullYear().toString();

    fecha = dia + '-' + mes + '-' + año;

    return fecha;
}
function obtenerHora(){
    let ahora = new Date();
    let hora = '';

    h = ahora.getHours().toString();
    m = ahora.getMinutes().toString();
    s = ahora.getSeconds().toString();

    hora = h + ':' + m + ':' + s;

    return hora;
}


// VARIABLES DEL INTERVALO
let alarma = '';
let intervaloMensajes = setInterval(enviar, 1000);

function enviar() {
    let hora_actual = obtenerHora();

    console.log(hora_actual);
    // WHATSAPP
    let fecha_hora = '[' + obtenerFecha() + '] ' + obtenerHora();

    let msj_programado_whatsapp = {
        "url": "https://graph.facebook.com/v20.0/373083419225618/messages",
        "method": "POST",
        "timeout": 0,
        "headers": {
            "Content-Type": "application/json",
            "Authorization": "Bearer EABvGrmq3yZCoBO070vYK6Vmd9vqKN07zc57HKFE5wZBkI2WzCcAzdUhrIKnDTdvUKkECZAIMCOHmsjFykcepQnptmcVZCTKWiGuZB1HH2t1ZCtIgwRUoZBzImOTTvgTrZBguDBgCZAbrLigqZAH4KLZAWDG5sX7IVFweg77D2rsnXuRC0kIWhUS6DD7hFqWWZBJ4Wpz3igZDZD"
        },
        "data": JSON.stringify({
            "messaging_product": "whatsapp",
            "recipient_type": "individual",
            "to": "",
            "type": "interactive",
            "interactive": {
                "type": "cta_url",
                "header": {
                    "type": "text",
                    "text": "REPORTE PROGRAMADO"
                },
                "body": {
                    "text": "Muy buen día Miguel ANGEL \n¿Desea otener los incidentes del día de hoy?"
                },
                "footer": {
                    "text": fecha_hora
                },
                "action": {
                    "name": "cta_url",
                    "parameters": {
                        "display_text": "Ver Datos",
                        "url": "https://drive.google.com/"
                    }
                }
            }
        }),
    };
    // TELEGRAM
    let access_token = '7251630970:AAFvn3K2be2mFh-bi_i-o5PAUk1E1rgZA28';
    let chat_id = '';
    let text = '<b>REPORTE PROGRAMADO</b>%0AMuy buen día Miguel ANGEL%0A<blockquote expandable><b><i>Pendientes:</i></b>%0A- Biblioteca 1: 00:30:00%0A- Biblioteca 2: 2días 00:00:00 %0A- Biblioteca 3: 03:30:00%0A- Biblioteca 4: 2días 00:00:00 %0A- <s>Biblioteca 5: 00:00:00</s></blockquote>';
    let parse_mode = 'HTML';

    let msj_programado_telegram = {
        "url":"https://api.telegram.org/bot"+ access_token +"/sendMessage?chat_id="+ chat_id +"&parse_mode="+ parse_mode +"&link_preview_options[is_disabled]=true&text=" + text,
        "method": "POST",
        "timeout": 0,
    };


    if (hora_actual == alarma) {

        $.ajax(msj_programado_whatsapp).done();
        $.ajax(msj_programado_telegram).done();
        console.log('Envio Exitoso');

        clearInterval(intervaloMensajes)
    }
}

$('#btn_alarma').on( "click", function(){
    horas = $('#horas').val();
    minutos = $('#minutos').val();
    segundos = $('#segundos').val();

    alarma = horas + ':' + minutos + ':' + segundos;
})
