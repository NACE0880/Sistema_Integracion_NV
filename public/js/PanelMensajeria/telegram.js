// MENSAJES GRUPO //
$( "#reporte-grupo" ).on( "click", function() {
    let access_token = '7251630970:AAFvn3K2be2mFh-bi_i-o5PAUk1E1rgZA28';
    let chat_id = '-4216935814';
    let text = '<b>TITULO</b>%0ACuerpo del reporte...%0A<tg-spoiler>Datos cubiertos</tg-spoiler>%0A<a href="tg://user?id=7251630970">Usuario</a>%0A%0A<pre>BDT-123</pre>%0A<a href="https://drive.google.com/">MOSTRAR DATOS</a>';
    let parse_mode = 'HTML';

    let reporte = {
        "url":"https://api.telegram.org/bot"+ access_token +"/sendMessage?chat_id="+ chat_id +"&parse_mode="+ parse_mode +"&link_preview_options[is_disabled]=true&text=" + text,
        "method": "POST",
        "timeout": 0,
    };

    $.ajax(reporte).done();
});
// MENSAJES GRUPO //




// MENSAJES PRIVADOS //
$( "#reporte-individual-simple" ).on( "click", function() {
    let access_token = '7251630970:AAFvn3K2be2mFh-bi_i-o5PAUk1E1rgZA28';
    let chat_id = '906068930';
    let text = '<b>REPORTE SIMPLE</b>%0ACuerpo del reporte...%0ATexto%0AContactar a:<a href="tg://user?id=7251630970">Usuario</a>%0ARevisar:<tg-spoiler>Datos cubiertos</tg-spoiler>';
    let parse_mode = 'HTML';

    let reporte = {
        "url":"https://api.telegram.org/bot"+ access_token +"/sendMessage?chat_id="+ chat_id +"&parse_mode="+ parse_mode +"&link_preview_options[is_disabled]=true&text=" + text,
        "method": "POST",
        "timeout": 0,
    };

    $.ajax(reporte).done();
});


$( "#reporte-individual-lista" ).on( "click", function() {
    let access_token = '7251630970:AAFvn3K2be2mFh-bi_i-o5PAUk1E1rgZA28';
    let chat_id = '906068930';
    let text = '<b>TITULO</b>%0ACuerpo del reporte...%0A<blockquote expandable><b><i>Pendientes:</i></b>%0A- Biblioteca 1: 00:30:00%0A- Biblioteca 2: 2días 00:00:00 %0A- Biblioteca 3: 03:30:00%0A- Biblioteca 4: 2días 00:00:00 %0A- <s>Biblioteca 5: 00:00:00</s></blockquote>';
    let parse_mode = 'HTML';

    let reporte = {
        "url":"https://api.telegram.org/bot"+ access_token +"/sendMessage?chat_id="+ chat_id +"&parse_mode="+ parse_mode +"&link_preview_options[is_disabled]=true&text=" + text,
        "method": "POST",
        "timeout": 0,
    };

    $.ajax(reporte).done();
});


$( "#reporte-individual-claves" ).on( "click", function() {
    let access_token = '7251630970:AAFvn3K2be2mFh-bi_i-o5PAUk1E1rgZA28';
    let chat_id = '906068930';
    let text = '<b>TITULO</b>%0ACuerpo del reporte...%0<pre>BDT-123</pre>%0A<a href="https://drive.google.com/">MOSTRAR DATOS</a>';
    let parse_mode = 'HTML';

    let reporte = {
        "url":"https://api.telegram.org/bot"+ access_token +"/sendMessage?chat_id="+ chat_id +"&parse_mode="+ parse_mode +"&link_preview_options[is_disabled]=true&text=" + text,
        "method": "POST",
        "timeout": 0,
    };

    $.ajax(reporte).done();
});


$( "#reporte-individual-completo" ).on( "click", function() {
    let access_token = '7251630970:AAFvn3K2be2mFh-bi_i-o5PAUk1E1rgZA28';
    let chat_id = '906068930';
    let text = '<b>TITULO</b>%0ACuerpo del reporte...%0A<tg-spoiler>Cubierto</tg-spoiler>%0A<blockquote expandable><b><i>Pendientes:</i></b>%0A- Biblioteca 1: 00:30:00%0A- Biblioteca 2: 2días 00:00:00 %0A- Biblioteca 3: 03:30:00%0A- Biblioteca 4: 2días 00:00:00 %0A- <s>Biblioteca 5: 00:00:00</s></blockquote>%0A<pre>BDT-123</pre>%0A<a href=\"https://drive.google.com/\">MOSTRAR DATOS</a>';
    let parse_mode = 'HTML';

    let reporte = {
        "url":"https://api.telegram.org/bot"+ access_token +"/sendMessage?chat_id="+ chat_id +"&parse_mode="+ parse_mode +"&link_preview_options[is_disabled]=true&text=" + text,
        "method": "POST",
        "timeout": 0,
    };

    $.ajax(reporte).done();
});
// MENSAJES PRIVADOS //



