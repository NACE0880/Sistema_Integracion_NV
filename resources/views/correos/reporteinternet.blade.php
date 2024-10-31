<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Estatus de Líneas</title>
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
            <h1>Reporte de Estatus de Líneas con Problemas de Internet</h1>
            <p>Estimado/a {{ $data['responsable'] }},</p>
            <p>
                Este es un reporte actualizado sobre las líneas que actualmente presentan problemas de conexión a internet. Nuestro equipo está trabajando arduamente para resolver estos inconvenientes a la brevedad posible.
            </p>
            <p>
                A continuación, se detalla la información de las líneas afectadas:
            </p>
            <!-- Tabla de datos de ejemplo -->
            <table border="1" cellspacing="0" cellpadding="10" style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th style="background-color: #0058a3; color: #ffffff; text-align: center;">Número de Línea</th>
                        <th style="background-color: #0058a3; color: #ffffff; text-align: center;">Estatus</th>
                        <th style="background-color: #0058a3; color: #ffffff; text-align: center;">Número de Reporte</th>
                    </tr>
                </thead>
                <tbody>

                    {{-- lineas data --}}
                    @foreach ($data['linea'] as $linea)
                        <tr>
                            <td style="text-align: center;">{{ $linea['numero_linea'] }}</td>
                            <td style="text-align: center;">{{ $linea['estatus'] }}</td>
                            <td style="text-align: center;">{{ $linea['numero_reporte'] }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            <p>
                Le mantendremos informado sobre cualquier cambio en la situación. Agradecemos su paciencia y comprensión.
            </p>
            <p>
                Atentamente,<br>
                Equipo de Biblioteca Digital<br>
                Telmex
            </p>
        </div>
        <div class="footer">
            &copy; 2024 Telmex. Todos los derechos reservados.
        </div>
    </div>
</body>
</html>
