<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte Semanal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #00458B;
            padding: 10px;
            text-align: center;
            color: #ffffff;
        }
        .header img {
            max-width: 150px;
        }
        h2 {
            color: #00458B;
            text-align: center;
            font-size: 24px;
            margin: 20px 0;
        }
        .content {
            font-size: 14px;
            line-height: 1.6;
            color: #555555;
        }
        .content p {
            margin: 10px 0;
            text-align: justify;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: center;
            font-size: 14px;
        }
        th {
            background-color: #f4f4f4;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
            color: #999999;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="https://bibliotecadigital.telmex.com/bibliotecaDigital/resources/img/LOGO_BDT_Flag.png" alt="Logo Telmex">
        </div>
        <h2>Resumen del Reporte Semanal de Tutorías</h2>
        <div class="content">
            <p>{{ $data['administrador'] }},</p>
            <p>A continuación, se presenta el resumen del reporte semanal de tutorías realizado durante el período del 00 al 00 de Mes:</p>
            <table>
                <thead>
                    <tr>
                        <th>Periodo</th>
                        <th>Tutorías Efectuadas</th>
                        <th>Tutorías Pendientes</th>
                        <th>Para Cierre</th>
                        <th>Fallas de Internet</th>
                        <th>Registro de Usuarios</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['resumen'] as $resumen)
                        <tr>
                            <td>{{ $resumen['periodo'] }}</td>
                            <td>{{ $resumen['efectuadas'] }}</td>
                            <td>{{ $resumen['pendientes'] }}</td>
                            <td>{{ $resumen['cierre'] }}</td>
                            <td>{{ $resumen['fallasinternet'] }}</td>
                            <td>{{ $resumen['registros'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <h4 style="color: #00458B; margin-top: 20px;">Sin Contacto las Siguientes BDT:</h4>
            <ul style="margin-left: 20px;">

                @foreach ($data['sincontacto_bdt']  as $sincontacto_bdt)
                    <li>{{ $sincontacto_bdt['clave'] }} – {{ $sincontacto_bdt['escuela'] }} {{ $sincontacto_bdt['nombre'] }} {{ $sincontacto_bdt['turno'] }}</li>
                @endforeach
            </ul>
            <p>Para cualquier aclaración o duda, por favor contacta a nuestro equipo de soporte.</p>
        </div>
        <div class="footer">
            Biblioteca Digital Telmex | Agosto 2024
        </div>
    </div>
</body>
</html>
