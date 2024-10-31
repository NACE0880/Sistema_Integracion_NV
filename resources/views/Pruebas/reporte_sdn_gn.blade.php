
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte Aprende SEDENA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

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
            /* border-radius: 8px; */
            overflow: hidden;
        }
        .header {
            /* padding: 20px; */
            text-align: center;
        }
        .header .top {
            width: 100%;
            background-color: #0894dc;
            height: 10px;
        }
        .header table{
            width: 95%;
        }
        .header img {
            max-width: 90px;
        }
        .content{
            /* padding: 20px; */
            font-size: 11px;
        }
        .content a{
            color: #0874c4;
            text-decoration:none;
        }
        .content table{
            font-size: 10px;
            height: auto;
            border: 1px solid black;
            border-collapse: collapse;
            width: 100%;
        }
        .content td,.content th{
            font-size: 10px;
            height: auto;
            border: 1px solid black;
            border-collapse: collapse;
        }
        tr:nth-child(even) {
            background-color: #D6EEEE;
        }
        .content .registros{
            font-size: 11px;
            height: auto;
            border-color: white;

            /* Posicioamiento de tablas */
            padding: 0 15px;
            vertical-align:top
        }

        .content .anexo {
            margin-top: 10px;
            display: flex;

            justify-content: center;
            align-items:center;
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
            <div class="top"></div>
            <table>
                <tbody>
                    <tr>
                        <td colspan="50%">
                            <img src="https://bibliotecadigital.telmex.com/bibliotecaDigital/resources/img/LOGO_BDT_Flag.png" alt="Telmex">
                        </td>
                        <td colspan="50%" style="text-align: right;">
                            <h4><b>Biblioteca Digital TELMEX</b> <br> <b style="color: #0090d9">SEDENA</b></h4>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="content">
            <a href="https://SEDENA.aprende.org/"><p> <b style="color: 0090d9">Plataforma educativa Aprende SEDENA</b></p></a>


            <p>
                •	8 marzo de 2022 firma de convenio. <br>
                •	12 contenidos liberados.
            </p>

            <p><b>Acumulado de participantes inscritos por taller:</b></p>

            <table >
                <tbody>
                    <tr style="text-align: center">
                        <th>
                            Nombre
                        </th>

                        <th>
                            Guardia Nacional
                        </th>

                        <th>
                            SEDENA
                        </th>

                        <th>
                            Total
                        </th>
                    </tr>
                    @foreach ($chunk_CE as $dato)
                        <tr style="text-align: center;">
                            <td style="text-align: justify">
                                {{ $dato[1] }}
                            </td>
                            <td >
                                {{ $dato[2] }}
                            </td>
                            <td>
                                {{ $dato[3] }}
                            </td>
                            <td>
                                {{ $dato[4] }}
                            </td>
                        </tr>
                    @endforeach



                    <tr style="text-align: center;">
                        <td style="text-align: right">Total:</td>
                        <td>{{ $totales['sdn_CE'] }}</td>
                        <td>{{ $totales['gn_CE'] }}</td>
                        <td>{{ $totales['Contenidos_Especializados'] }}</td>
                    </tr>
                </tbody>
            </table>

            <br>
            <p>
                <b>Uso plataforma:</b> <br>
                <b>{{ $totales['sdn_GENERAL'] + $totales['gn_GENERAL']  }}</b> usuarios registrados ( {{ $totales['sdn_GENERAL'] }} SDN y {{ $totales['gn_GENERAL'] }} GN). <br>
                <b> {{ $totales['Contenidos_Especializados'] + $totales['Contenidos_Especializados'] }}</b> matriculaciones a todos los cursos disponibles en la plataforma SEDENA y TELMEX. <br>
                •	{{ $totales['Contenidos_Especializados'] }} matriculaciones a contenidos especializados: {{ $totales['sdn_CE'] }} SDN y {{ $totales['gn_CE'] }} GN. <br>
                •	{{ $totales['Contenidos_Especializados'] }} en cursos de la oferta educativa: 8,858 SDN y 2,329 GN.
            </p>

            <table>
                <tr>
                    <td colspan="50%" class="registros">
                        <table style="text-align: center">
                            <thead>
                                <tr>
                                    <th colspan="100%">Personal registrado de la Guardia Nacional</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>Estados</th>
                                    <th>Registros <br> PERIODO</th>
                                    <th>Acumulado <br>Histórico</th>
                                    <th>Total</th>
                                </tr>
                                <tr>
                                    <td>Aguascalientes</td>

                                    @if (@empty($chunk_GENERAL_GN['aguascalientes']))
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    @else
                                        <td> {{ $chunk_GENERAL_GN['aguascalientes'][1] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['aguascalientes'][2] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['aguascalientes'][3] }}</td>
                                    @endif

                                </tr>
                                <tr>
                                    <td>Baja California</td>
                                    @if (@empty($chunk_GENERAL_SDN['']))
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    @else
                                        <td> {{ $chunk_GENERAL_GN['baja california'][1] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['baja california'][2] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['baja california'][3] }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Baja California Sur</td>
                                    @if (@empty($chunk_GENERAL_GN['baja california sur']))
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    @else
                                        <td> {{ $chunk_GENERAL_GN['baja california sur'][1] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['baja california sur'][2] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['baja california sur'][3] }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Campeche</td>
                                    @if (@empty($chunk_GENERAL_GN['campeche']))
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    @else
                                        <td> {{ $chunk_GENERAL_GN['campeche'][1] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['campeche'][2] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['campeche'][3] }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Chiapas</td>
                                    @if (@empty($chunk_GENERAL_GN['chiapas']))
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    @else
                                        <td> {{ $chunk_GENERAL_GN['chiapas'][1] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['chiapas'][2] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['chiapas'][3] }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Chihuahua</td>
                                    @if (@empty($chunk_GENERAL_GN['chihuahua']))
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    @else
                                        <td> {{ $chunk_GENERAL_GN['chihuahua'][1] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['chihuahua'][2] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['chihuahua'][3] }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Coahuila</td>
                                    @if (@empty($chunk_GENERAL_GN['coahuila']))
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    @else
                                        <td> {{ $chunk_GENERAL_GN['coahuila'][1] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['coahuila'][2] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['coahuila'][3] }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Colima</td>
                                    @if (@empty($chunk_GENERAL_GN['colima']))
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    @else
                                        <td> {{ $chunk_GENERAL_GN['colima'][1] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['colima'][2] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['colima'][3] }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>CDMX</td>
                                    @if (@empty($chunk_GENERAL_GN['cdmx']))
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    @else
                                        <td> {{ $chunk_GENERAL_GN['cdmx'][1] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['cdmx'][2] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['cdmx'][3] }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Durango</td>
                                    @if (@empty($chunk_GENERAL_GN['durango']))
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    @else
                                        <td> {{ $chunk_GENERAL_GN['durango'][1] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['durango'][2] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['durango'][3] }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Guanajuato</td>
                                    @if (@empty($chunk_GENERAL_GN['guanajuato']))
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    @else
                                        <td> {{ $chunk_GENERAL_GN['guanajuato'][1] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['guanajuato'][2] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['guanajuato'][3] }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Guerrero</td>
                                    @if (@empty($chunk_GENERAL_GN['guerrero']))
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    @else
                                        <td> {{ $chunk_GENERAL_GN['guerrero'][1] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['guerrero'][2] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['guerrero'][3] }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Hidalgo</td>
                                    @if (@empty($chunk_GENERAL_GN['hidalgo']))
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    @else
                                        <td> {{ $chunk_GENERAL_GN['hidalgo'][1] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['hidalgo'][2] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['hidalgo'][3] }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Jalisco</td>
                                    @if (@empty($chunk_GENERAL_GN['jalisco']))
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    @else
                                        <td> {{ $chunk_GENERAL_GN['jalisco'][1] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['jalisco'][2] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['jalisco'][3] }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>México</td>
                                    @if (@empty($chunk_GENERAL_GN['mexico']))
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    @else
                                        <td> {{ $chunk_GENERAL_GN['mexico'][1] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['mexico'][2] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['mexico'][3] }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Michoacán</td>
                                    @if (@empty($chunk_GENERAL_GN['michoacan']))
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    @else
                                        <td> {{ $chunk_GENERAL_GN['michoacan'][1] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['michoacan'][2] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['michoacan'][3] }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Morelos</td>
                                    @if (@empty($chunk_GENERAL_GN['morelos']))
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    @else
                                        <td> {{ $chunk_GENERAL_GN['morelos'][1] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['morelos'][2] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['morelos'][3] }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Nayarit</td>
                                    @if (@empty($chunk_GENERAL_GN['nayarit']))
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    @else
                                        <td> {{ $chunk_GENERAL_GN['nayarit'][1] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['nayarit'][2] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['nayarit'][3] }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Nuevo León</td>
                                    @if (@empty($chunk_GENERAL_GN['nuevo leon']))
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    @else
                                        <td> {{ $chunk_GENERAL_GN['nuevo leon'][1] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['nuevo leon'][2] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['nuevo leon'][3] }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Oaxaca</td>
                                    @if (@empty($chunk_GENERAL_GN['oaxaca']))
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    @else
                                        <td> {{ $chunk_GENERAL_GN['oaxaca'][1] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['oaxaca'][2] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['oaxaca'][3] }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Puebla</td>
                                    @if (@empty($chunk_GENERAL_GN['puebla']))
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    @else
                                        <td> {{ $chunk_GENERAL_GN['puebla'][1] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['puebla'][2] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['puebla'][3] }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Querétaro</td>
                                    @if (@empty($chunk_GENERAL_GN['queretaro']))
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    @else
                                        <td> {{ $chunk_GENERAL_GN['queretaro'][1] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['queretaro'][2] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['queretaro'][3] }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Quintana Roo</td>
                                    @if (@empty($chunk_GENERAL_GN['quintana roo']))
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    @else
                                        <td> {{ $chunk_GENERAL_GN['quintana roo'][1] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['quintana roo'][2] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['quintana roo'][3] }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>San Luis Potosí</td>
                                    @if (@empty($chunk_GENERAL_GN['san luis potosi']))
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    @else
                                        <td> {{ $chunk_GENERAL_GN['san luis potosi'][1] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['san luis potosi'][2] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['san luis potosi'][3] }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Sinaloa</td>
                                    @if (@empty($chunk_GENERAL_GN['sinaloa']))
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    @else
                                        <td> {{ $chunk_GENERAL_GN['sinaloa'][1] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['sinaloa'][2] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['sinaloa'][3] }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Sonora</td>
                                    @if (@empty($chunk_GENERAL_GN['sonora']))
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    @else
                                        <td> {{ $chunk_GENERAL_GN['sonora'][1] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['sonora'][2] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['sonora'][3] }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Tabasco</td>
                                    @if (@empty($chunk_GENERAL_GN['tabasco']))
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    @else
                                        <td> {{ $chunk_GENERAL_GN['tabasco'][1] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['tabasco'][2] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['tabasco'][3] }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Tamaulipas</td>
                                    @if (@empty($chunk_GENERAL_GN['tamaulipas']))
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    @else
                                        <td> {{ $chunk_GENERAL_GN['tamaulipas'][1] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['tamaulipas'][2] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['tamaulipas'][3] }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Tlaxcala</td>
                                    @if (@empty($chunk_GENERAL_GN['tlaxcala']))
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    @else
                                        <td> {{ $chunk_GENERAL_GN['tlaxcala'][1] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['tlaxcala'][2] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['tlaxcala'][3] }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Veracruz</td>
                                    @if (@empty($chunk_GENERAL_GN['veracruz']))
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    @else
                                        <td> {{ $chunk_GENERAL_GN['veracruz'][1] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['veracruz'][2] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['veracruz'][3] }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Yucatán</td>
                                    @if (@empty($chunk_GENERAL_GN['yucatan']))
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    @else
                                        <td> {{ $chunk_GENERAL_GN['yucatan'][1] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['yucatan'][2] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['yucatan'][3] }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Zacatecas</td>
                                    @if (@empty($chunk_GENERAL_GN['zacatecas']))
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    @else
                                        <td> {{ $chunk_GENERAL_GN['zacatecas'][1] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['zacatecas'][2] }}</td>
                                        <td> {{ $chunk_GENERAL_GN['zacatecas'][3] }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Sin Estado</td>
                                    @if (@empty($chunk_GENERAL_GN['']))
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    @else
                                        <td> {{ $chunk_GENERAL_GN[''][1] }}</td>
                                        <td> {{ $chunk_GENERAL_GN[''][2] }}</td>
                                        <td> {{ $chunk_GENERAL_GN[''][3] }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td><b>Total</b></td>
                                    <td><b>{{ $totales['gn_periodo'] }}</b></td>
                                    <td><b>{{ $totales['gn_historico'] }}</b></td>
                                    <td><b>{{ $totales['gn_GENERAL'] }}</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>

                    <td colspan="50%" class="registros">
                        <table style="text-align: center">
                            <thead>
                                <tr>
                                    <th colspan="100%" style="text-align: center">Personal registrado de la SEDENA</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="text-align: center">
                                    <th>ZONA</th>
                                    <th>Estados</th>
                                    <th>Registros <br>agosto</th>
                                    <th>Acumulado <br>Histórico</th>
                                    <th>Total</th>
                                </tr>
                                <tr>
                                    <td>I</td>
                                    <td>CDMX, Edo. de Méx.,<br> Morelos e Hidalgo</td>
                                    @if (@empty($chunk_GENERAL_SDN['i']))
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    @else
                                        <td> {{ $chunk_GENERAL_SDN['i'][1] }}</td>
                                        <td> {{ $chunk_GENERAL_SDN['i'][2] }}</td>
                                        <td> {{ $chunk_GENERAL_SDN['i'][3] }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>II</td>
                                    <td>BJ, BC Sur y Sonora</td>
                                    @if (@empty($chunk_GENERAL_SDN['ii']))
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    @else
                                        <td> {{ $chunk_GENERAL_SDN['ii'][1] }}</td>
                                        <td> {{ $chunk_GENERAL_SDN['ii'][2] }}</td>
                                        <td> {{ $chunk_GENERAL_SDN['ii'][3] }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>III</td>
                                    <td>Durango y Sinaloa</td>
                                    @if (@empty($chunk_GENERAL_SDN['iii']))
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    @else
                                        <td> {{ $chunk_GENERAL_SDN['iii'][1] }}</td>
                                        <td> {{ $chunk_GENERAL_SDN['iii'][2] }}</td>
                                        <td> {{ $chunk_GENERAL_SDN['iii'][3] }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>IV</td>
                                    <td>NL, Tamaulipas y SLP</td>
                                    @if (@empty($chunk_GENERAL_SDN['iv']))
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    @else
                                        <td> {{ $chunk_GENERAL_SDN['iv'][1] }}</td>
                                        <td> {{ $chunk_GENERAL_SDN['iv'][2] }}</td>
                                        <td> {{ $chunk_GENERAL_SDN['iv'][3] }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>V</td>
                                    <td>Jalisco, Nayarit, Aguascalientes,<br> Zacatecas y Colima</td>
                                    @if (@empty($chunk_GENERAL_SDN['v']))
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    @else
                                        <td> {{ $chunk_GENERAL_SDN['v'][1] }}</td>
                                        <td> {{ $chunk_GENERAL_SDN['v'][2] }}</td>
                                        <td> {{ $chunk_GENERAL_SDN['v'][3] }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>VI</td>
                                    <td>Puebla, Tlaxcala <br> y Veracruz</td>
                                    @if (@empty($chunk_GENERAL_SDN['vi']))
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    @else
                                        <td> {{ $chunk_GENERAL_SDN['vi'][1] }}</td>
                                        <td> {{ $chunk_GENERAL_SDN['vi'][2] }}</td>
                                        <td> {{ $chunk_GENERAL_SDN['vi'][3] }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>VII</td>
                                    <td>Chiapas y Tabasco</td>
                                    @if (@empty($chunk_GENERAL_SDN['vii']))
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    @else
                                        <td> {{ $chunk_GENERAL_SDN['vii'][1] }}</td>
                                        <td> {{ $chunk_GENERAL_SDN['vii'][2] }}</td>
                                        <td> {{ $chunk_GENERAL_SDN['vii'][3] }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>VIII</td>
                                    <td>Oaxaca</td>
                                    @if (@empty($chunk_GENERAL_SDN['viii']))
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    @else
                                        <td> {{ $chunk_GENERAL_SDN['viii'][1] }}</td>
                                        <td> {{ $chunk_GENERAL_SDN['viii'][2] }}</td>
                                        <td> {{ $chunk_GENERAL_SDN['viii'][3] }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>IX</td>
                                    <td>Guerrero</td>
                                    @if (@empty($chunk_GENERAL_SDN['ix']))
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    @else
                                        <td> {{ $chunk_GENERAL_SDN['ix'][1] }}</td>
                                        <td> {{ $chunk_GENERAL_SDN['ix'][2] }}</td>
                                        <td> {{ $chunk_GENERAL_SDN['ix'][3] }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>X</td>
                                    <td>Yucatán, Quintana Roo <br> y Campeche</td>
                                    @if (@empty($chunk_GENERAL_SDN['x']))
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    @else
                                        <td> {{ $chunk_GENERAL_SDN['x'][1] }}</td>
                                        <td> {{ $chunk_GENERAL_SDN['x'][2] }}</td>
                                        <td> {{ $chunk_GENERAL_SDN['x'][3] }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>XI</td>
                                    <td>Chihuahua y Coahuila</td>
                                    @if (@empty($chunk_GENERAL_SDN['xi']))
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    @else
                                        <td> {{ $chunk_GENERAL_SDN['xi'][1] }}</td>
                                        <td> {{ $chunk_GENERAL_SDN['xi'][2] }}</td>
                                        <td> {{ $chunk_GENERAL_SDN['xi'][3] }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>XII</td>
                                    <td>Michoacán, Gto. <br>y Querétaro</td>
                                    @if (@empty($chunk_GENERAL_SDN['xii']))
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    @else
                                        <td> {{ $chunk_GENERAL_SDN['xii'][1] }}</td>
                                        <td> {{ $chunk_GENERAL_SDN['xii'][2] }}</td>
                                        <td> {{ $chunk_GENERAL_SDN['xii'][3] }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>-</td>
                                    <td>Sin datos</td>
                                    @if (@empty($chunk_GENERAL_SDN['']))
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    @else
                                        <td> {{ $chunk_GENERAL_SDN[''][1] }}</td>
                                        <td> {{ $chunk_GENERAL_SDN[''][2] }}</td>
                                        <td> {{ $chunk_GENERAL_SDN[''][3] }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Total</td>
                                    <td><b>{{ $totales['sdn_periodo'] }}</b></td>
                                    <td><b>{{ $totales['sdn_historico'] }}</b></td>
                                    <td><b>{{ $totales['sdn_GENERAL'] }}</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </table>

            <p style="text-align: center; margin-top:50px;">Anexo 1</p>
            <div class="anexo">
                <table style="width: 80%; text-align:center;">
                    <thead>
                        <tr>
                            <th>
                                Matriculaciones GN y SEDENA Oferta Educativa
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <th>Nombre</th>
                            <th>Inscritos GN</th>
                            <th>Inscritos SEDENA</th>
                            <th>Total</th>
                        </tr>

                        <tr>
                            <td style="text-align: justify;">-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>

                        <tr>
                            <th>Total</th>
                            <th>-</th>
                            <th>-</th>
                            <th>-</th>
                        </tr>
                    </tbody>
                </table>
            </div>

            <p style="text-align: center">*Contenidos añadidos en PERIODO</p>

        </div>

        <div class="footer">
            &copy; {{ date('Y') }} Telmex. Todos los derechos reservados.
        </div>
    </div>
</body>
</html>
