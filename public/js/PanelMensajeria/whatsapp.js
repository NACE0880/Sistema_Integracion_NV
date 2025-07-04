// BLOQUEOS //
    $("#checkbox").change(function() {
        if(this.checked) {
            chequeada = true;
        }
        else{
            chequeada = false;
        }
    });

    function bloquear(){
        if (chequeada) {
            alert('MENSAJES BLOQUEADOS: Manualmente');
            return true

        } else if(costos > limiteCostos){
            alert('MENSAJES BLOQUEADOS: Costo Excedido');
            return true

        }else if(conversaciones == limiteConversaciones){
            alert('MENSAJES BLOQUEADOS: Conversaciones Excedidas');
            return true
        }

        return false;
    }


// BLOQUEOS //
//  MENSAJES //
//  EJEMPLOS ------------------------------------------------------------------------
var hello_world = {
    "url": "https://graph.facebook.com/v20.0/373083419225618/messages",
    "method": "POST",
    "timeout": 0,
    "headers": {
        "Content-Type": "application/json",
        "Authorization": "Bearer EABvGrmq3yZCoBO070vYK6Vmd9vqKN07zc57HKFE5wZBkI2WzCcAzdUhrIKnDTdvUKkECZAIMCOHmsjFykcepQnptmcVZCTKWiGuZB1HH2t1ZCtIgwRUoZBzImOTTvgTrZBguDBgCZAbrLigqZAH4KLZAWDG5sX7IVFweg77D2rsnXuRC0kIWhUS6DD7hFqWWZBJ4Wpz3igZDZD"
    },
    "data": JSON.stringify({
        "messaging_product": "whatsapp",
        "to": "",
        "type": "template",
        "template": {
        "name": "hello_world",
        "language": {
            "code": "en_US"
        }
        }
    }),
};


var notificacion_diaria = {
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
        "type": "template",
        "template": {
        "name": "notificacion_diaria",
        "language": {
            "code": "es_MX"
        },
        "components": [
            {
            "type": "body",
            "parameters": [
                {
                "type": "text",
                "text": "----"
                }
            ]
            }
        ]
        }
    }),
};


var reporte = {
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
                "text": "REPORTE DE INCIDENCIAS"
            },
            "body": {
                "text": "*_Cuerpo del reporte_*\nConsideraciones:\n* texto\n* texto\n* texto "
            },
            "footer": {
                "text": "_Clave BDT: 123_"
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

//  SOLICITUDES ------------------------------------------------------------------------
function actualizacion_tutoria(estado){
    var mensaje_1 = {
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
            "type": "text",
            "text": {
                "body": '*_- ACTUALIZACION DE TUTORIAS -_*\n\n' + estado
            }
        }),
    };

    var mensaje_2 = {
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
            "type": "text",
            "text": {
                "body": '*_- ACTUALIZACION DE TUTORIAS -_*\n\n_PRIM clave_ : ' + 'Tutoria completada'
            }
        }),
    };
    $.ajax(mensaje_1).done();
    $.ajax(mensaje_2).done();
}
// ------------------------------------------------------------------------
function reporte_atencion_1(){
    var mensaje = {
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
                    "text": "REPORTE DE ATENCIÓN"
                },
                "body": {
                    "text": "*_BDT Asignadas:_* \n* PRIM _clave._\n* PRIM _clave._\n* PRIM _clave._\n"
                },
                "footer": {
                    "text": "_Inicio Tutorias_"
                },
                "action": {
                    "name": "cta_url",
                    "parameters": {
                    "display_text": "DETALLES",
                    "url": "https://drive.google.com/"
                    }
                }
            }
        }),
    };

    $.ajax(mensaje).done();
}
// ------------------------------------------------------------------------
function reporte_atencion_2(){
    var mensaje = {
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
                    "text": "REPORTE DE AVANCE"
                },
                "body": {
                    "text": "*_SEMANA #:_* \n"+
                    "* Tutorías Efectuadas: \t\t#\n"+
                    "* Tutorías Pendientes: \t\t#\n"+
                    "* Para Cierre: \t\t\t\t\t\t\t\t\t#\n"+
                    "* Fallas de Internet: \t\t\t\t#\n"+
                    "* Registro de Usuarios: \t#\n"
                },
                "footer": {
                    "text": "_Resumen Semanal_"
                },
                "action": {
                    "name": "cta_url",
                    "parameters": {
                    "display_text": "DETALLES",
                    "url": "https://drive.google.com/"
                    }
                }
            }
        }),
    };

    $.ajax(mensaje).done();
}

// ------------------------------------------------------------------------
function reporte_mediciones(){
    var mensaje = {
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
                    "text": "MEDICIONES DE INTERNET"
                },
                "body": {
                    "text": "*_RESULTADOS OBTENIDOS:_* \n"+
                    "* LINEAS ROJO : \t\t\t\t\t#\n"+
                    "* LINEAS NARANJA: \t\t#\n"+
                    "* LINEAS VERDE: \t\t\t\t#\n"
                },
                "action": {
                    "name": "cta_url",
                    "parameters": {
                    "display_text": "SEGUIMIENTOS",
                    "url": "https://mail.google.com/"
                    }
                }
            }
        }),
    };

    $.ajax(mensaje).done();
}
// ------------------------------------------------------------------------
function incidencias(incidencias){
    let lista = ''
    incidencias.forEach(element => {
        lista += '* ' + element + '\n'
    });

    var mensaje = {
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
                    "text": "REPORTE DE INCIDENCIAS"
                },
                "body": {
                    "text":lista
                },
                "footer": {
                    "text": "_Clave BDT:123456_"
                },
                "action": {
                    "name": "cta_url",
                    "parameters": {
                    "display_text": "DETALLE",
                    "url": "https://mail.google.com/"
                    }
                }
            }
        }),
    };

    $.ajax(mensaje).done();
}
// MENSAJES //


// BOTONES //
$( "#hello_world" ).on( "click", function() {
    if ( bloquear() ){}
    else{
        $.ajax(hello_world).done();
    }
});


$( "#notificacion_diaria" ).on( "click", function() {
    if ( bloquear() ){}
    else{
        $.ajax(notificacion_diaria).done();
    }
});


$( "#reporte" ).on( "click", function() {
    if ( bloquear() ){}
    else{
        $.ajax(reporte).done();
    }
});

$( "#actualizacion_tutoria" ).on( "click", function() {
    if ( bloquear() ){}
    else{
        let estado = '_PRIM clave_ : ' + 'Nuevo seguimiento registrado'
        actualizacion_tutoria(estado)
    }
});

$( "#reporte_atencion_1" ).on( "click", function() {
    if ( bloquear() ){}
    else{
        reporte_atencion_1()
    }
});

$( "#reporte_atencion_2" ).on( "click", function() {
    if ( bloquear() ){}
    else{
        reporte_atencion_2()
    }
});

$( "#reporte_mediciones" ).on( "click", function() {
    if ( bloquear() ){}
    else{
        reporte_mediciones()
    }
});

$( "#incidencias" ).on( "click", function() {
    if ( bloquear() ){}
    else{
        let arr_incidencias = ['Equipos Robados: #',
            'Fallas de internet: _Linea Nombre_', 'Solicitud Equipos: _Dependencia_'
        ]
        incidencias(arr_incidencias)
    }
});

// BOTONES //

