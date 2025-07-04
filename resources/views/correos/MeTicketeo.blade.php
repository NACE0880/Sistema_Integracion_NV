<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Asignado</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 700px;
            margin: 20px auto;
            background-color: #ffffff;
            border: 1px solid #dddddd;
            border-radius: 8px;
            overflow: hidden;
        }
        .header {
            background-color: #0058a3;
            padding: 20px;
            text-align: center;
        }
        .header img {
            max-width: 150px;
        }
        .content {
            padding: 20px;
            text-align: justify;
        }
        .content h1 {
            color: #0058a3;
            font-size: 24px;
            text-align: center;
        }
        .content p {
            font-size: 16px;
            line-height: 1.5;
            color: #666666;
        }

        .footer {
            background-color: #e0e0e0;
            padding: 10px;
            text-align: center;
            font-size: 12px;
            color: #999999;
        }
        /* Boton de Validación */
        button {
            border: 1px solid #24b4fb;
            background-color: #0058a3;
            border-radius: 0.7em;
            cursor: pointer;
            padding: 0.5em 1em 0.6em 0.8em;
            font-size: 10px;
        }

        button span {
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            font-weight: 500;
        }


    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="https://bibliotecadigital.telmex.com/bibliotecaDigital/resources/img/LOGO_BDT_Flag.png" alt="Telmex">
        </div>
        <div class="content">
            <h1>Informe de Nuevo Ticket <br>
                {{ $data['folio'] }} <br>
                {{ $data['casa'] }} -  {{ $data['area'] }}
            </h1>

            @if (@empty($data['destinatario']))
            @else
                <p>Estimado/a {{ $data['destinatario'] }}, pedimos de su apoyo para cotizar el ticket generado.</p>
            @endif
            
            @if ($data['validado'])
                <a href="{{ route('cotizar.ticket',
                    [
                        'ticket' => $data['ticket'],
                        'encargado' => $data['encript'],
                    ])
                }}">
                    <button>
                        <span>
                            Cotizar
                        </span>
                    </button>
                </a>
            @else
                <a href="{{ route('validar.ticket',
                    [
                        'ticket' => $data['ticket'],
                        'encargado' => $data['destinatario'],
                    ]) }}">
                    <button>
                        <span>
                            Validar
                        </span>
                    </button>
                </a>
            @endif

            <p>
                Si tiene alguna pregunta o necesita más detalles sobre estos cambios, no dude en ponerse en contacto con nosotros. Agradecemos su colaboración continua para mejorar las condiciones de la casa.
            </p>
            <p>
                <h2 style="margin: 0;">Biblioteca Digital Telmex.</h2>

                <div class="MsoNormal" style="margin: 0cm 0.4pt 0cm 0cm; text-align: justify; border: none;"><strong style="mso-bidi-font-weight: normal;"><span style="color: black;">Director(a): </span></strong><span style="color: black;">: </span><strong style="mso-bidi-font-weight: normal;"><span style="color: rgb(0, 144, 204);">{{ $data['director'] }}</span></strong></div>
                {{-- <div class="MsoNormal" style="margin: 0cm 0.4pt 0cm 0cm; text-align: justify; border: none;"><strong style="mso-bidi-font-weight: normal;"><span style="color: rgb(0, 144, 204);"><span style="color: black;">Tutor</span><span style="color: black;">: <span style="color: rgb(0, 144, 204);">777 458 32 23</span></span></span></strong></div> --}}
                {{-- <div class="MsoNormal" style="margin: 0cm 0.4pt 0cm 0cm; text-align: justify;"><span style="color: black;">Opiniones y sugerencias:</span><strong style="mso-bidi-font-weight: normal;"><span style="color: rgb(0, 144, 204);"> 800 122 12 12 Opción 2</span></strong></div> --}}
                <div class="MsoNormal" style="margin: 0cm 0.4pt 0cm 0cm; text-align: justify;"><strong style="mso-bidi-font-weight: normal;">{{ $data['casa'] }}</strong>
                    {{-- <a href="{{ $data['drive'] }}"><span style="color: rgb(5, 99, 193);">Link de carpeta de fotos.</span></a> --}}
                </div>
			</p>
        </div>
        <div class="footer">
            &copy; 2024 Telmex. Todos los derechos reservados.
        </div>
    </div>
</body>
</html>