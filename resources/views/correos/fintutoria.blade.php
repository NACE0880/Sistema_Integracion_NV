
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe de Cambios en Tutoría</title>
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
            max-width: 600px;
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
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="https://bibliotecadigital.telmex.com/bibliotecaDigital/resources/img/LOGO_BDT_Flag.png" alt="Telmex">
        </div>
        <div class="content">
            <h1>Informe de Cambios Realizados en la Tutoría <br>{{ $data['bdt'] }}</h1>
            <p>Estimado/a {{ $data['responsable'] }},</p>
            <p>
                A continuación, se detalla el informe de los cambios realizados durante la última revisión de la tutoría.Se enfocaron en la situación actual del mobiliario, la funcionalidad de los equipos de cómputo, y la revisión del estado general del edificio y señalética.
            </p>
            <p>
                Detalle de los cambios:
            </p>
            <!-- Tabla de cambios realizados -->
            <table border="1" cellspacing="0" cellpadding="10" style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th style="background-color: #0058a3; color: #ffffff; text-align: center;">Área</th>
                        <th style="background-color: #0058a3; color: #ffffff; text-align: center;">Descripción del Cambio</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align: center;">Mobiliario</td>
                        <td style="text-align: justify;">Daño en {{ $data['mobiliario_dañado'] }} Sillas quedando un total de {{ $data['mobiliario_funcional'] }} funcionales. </td>

                    </tr>
                    <tr>
                        <td style="text-align: center;">Equipos de Cómputo</td>
                        <td style="text-align: justify;"> Equipos pc funcionales {{ $data['pc_funcional'] }},{{ $data['pc_dañado'] }} dañados,{{ $data['pc_faltante'] }} faltantes <br>Laptop {{ $data['lap_funcional'] }} funcionales, {{ $data['lap_dañado'] }} dañados,{{ $data['lap_faltante'] }} faltantes  </td>

                    </tr>
                    <tr>
                        <td style="text-align: center;">Edificio y Señalética</td>
                        <td style="text-align: justify;">Sin novedad en la señeletica</td>

                    </tr>
                        <tr>
                            <td style="text-align: center;">Internet</td>
                            <td style="text-align: justify;">Bajo consumo en el mes debido a vacaciones de verano</td>

                        </tr>
                    <tr>
                        <td style="text-align: center;">Observaciones</td>
                        <td style="text-align: justify;">Se sugirió mantener el modem siempre encendido.</td>

                    </tr>
                </tbody>
            </table>
            <p>
                Si tiene alguna pregunta o necesita más detalles sobre estos cambios, no dude en ponerse en contacto con nosotros. Agradecemos su colaboración continua para mejorar las condiciones de la tutoría.
            </p>
            <p>
               <h2 style="margin: 0;">Biblioteca Digital Telmex. </h2>
					<div class="MsoNormal" style="margin: 0cm 0.4pt 0cm 0cm; text-align: justify; border: none;"><strong style="mso-bidi-font-weight: normal;"><span style="color: black;">Mesa de ayuda para BDT</span></strong><span style="color: black;">: </span><strong style="mso-bidi-font-weight: normal;"><span style="color: rgb(0, 144, 204);">800 123 24 34</span></strong></div>
					<div class="MsoNormal" style="margin: 0cm 0.4pt 0cm 0cm; text-align: justify; border: none;"><strong style="mso-bidi-font-weight: normal;"><span style="color: rgb(0, 144, 204);"><span style="color: black;">Tutor</span><span style="color: black;">: <span style="color: rgb(0, 144, 204);">777 458 32 23</span></span></span></strong></div>
					<div class="MsoNormal" style="margin: 0cm 0.4pt 0cm 0cm; text-align: justify;"><span style="color: black;">Opiniones y sugerencias:</span><strong style="mso-bidi-font-weight: normal;"><span style="color: rgb(0, 144, 204);"> 800 122 12 12 Opción 2</span></strong></div>
					<div class="MsoNormal" style="margin: 0cm 0.4pt 0cm 0cm; text-align: justify;"><strong style="mso-bidi-font-weight: normal;">Correo:</strong> <a href="mailto:bdigital@telmex.com"><span style="color: rgb(5, 99, 193);">bdigital@telmex.com</span></a></div>
								</p>
        </div>
        <div class="footer">
            &copy; 2024 Telmex. Todos los derechos reservados.
        </div>
    </div>
</body>
</html>
