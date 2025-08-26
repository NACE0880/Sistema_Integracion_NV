{{-- vista extendida del layout --}}
@extends('layouts.tutorias')

@section('title')
    Consultar Estado
@endsection

@section('css')
    <style>

        .container {
            max-width: 90%;
            /* margin: 50px auto; */
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

        }
        /*
        h2 {
            background-color: #004080;
            color: white;
            padding: 10px;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #e0e0e0;
        }*/

    </style>
@endsection


@section('contenido')
    <body>
        <div class="container mt-5">
            <h1>Estatus BDT</h1>

            <div>
                <ul class="nav nav-pills justify-content-end">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="tab-bdt-abiertas" data-bs-toggle="tab" data-bs-target="#tabBdtAbiertas" type="button" role="tab" aria-controls="tabBdtAbiertas" aria-selected="true">
                            Abiertas
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-bdt-cerradas" data-bs-toggle="tab" data-bs-target="#tabBdtCerradas" type="button" role="tab" aria-controls="tabBdtCerradas" aria-selected="true">
                            Cerradas
                        </button>
                    </li>
                </ul>
            </div>

            <div class="tab-content mt-4" id="miTabContent">
                <div class="tab-pane fade show active" id="tabBdtAbiertas" role="tabpanel" aria-labelledby="tab-bdt-abiertas">
                    <table class="table">
                        <thead class="bg-info">
                            <tr>
                                <th class="text-center" colspan="9">
                                    95 ABIERTAS
                                </th>
                            </tr>
                        </thead>
                        <tr class="table-info">
                            <th class="text-center" colspan="5">
                                95 Totales
                            </th>
                            <th class="text-center" colspan="2">
                                Cerradas del mes
                            </th>
                            <th class="text-center" colspan="2">
                                Abiertas del mes
                            </th>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="5">
                                92 Externas
                            </td>
                            <td class="text-center" colspan="2">
                                -
                            </td>
                            <td class="text-center" colspan="2">
                                -
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="5">
                                3 Internas
                            </td>
                            <td class="text-center" colspan="2">
                                -
                            </td>
                            <td class="text-center" colspan="2">
                                -
                            </td>
                        </tr>
                        <tr class="table-info">
                            <th class="text-center" colspan="9">
                                1. Internet
                            </th>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="5">
                                86 BDT con 97 líneas paga la entidad (4 en cobre)
                            </td>
                            <td class="text-center" colspan="4">
                                9 BDT con 19 líneas y 2 enlaces de paga Telmex
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="5">
                                52 pesito
                            </td>
                            <td class="text-center" colspan="4">
                                40 pesito
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                Sin consumo
                            </td>
                            <td class="text-center" colspan="2">
                                Bajo
                            </td>
                            <td class="text-center" colspan="2">
                                Medio
                            </td>
                            <td class="text-center">
                                Alto
                            </td>
                            <td class="text-center" colspan="2">
                                Heavy
                            </td>
                            <td class="text-center">
                                Atípico
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                -
                            </td>
                            <td class="text-center" colspan="2">
                                43
                            </td>
                            <td class="text-center" colspan="2">
                                32
                            </td>
                            <td class="text-center">
                                8
                            </td>
                            <td class="text-center" colspan="2">
                                11
                            </td>
                            <td class="text-center">
                                1
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center table-info" colspan="9">
                                2. Equipamiento
                            </th>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="2">
                                Total del proyecto
                            </td>
                            <td class="text-center" colspan="2">
                                Abiertas Inicial
                            </td>
                            <td class="text-center" colspan="2">
                                Abiertas Funcional
                            </td>
                            <td class="text-center" colspan="3">
                                % funcional contra inicial
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="2">
                                45
                            </td>
                            <td class="text-center" colspan="2">
                                27
                            </td>
                            <td class="text-center" colspan="2">
                                114114
                            </td>
                            <td class="text-center" colspan="3">
                                0
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center table-info" colspan="9">
                                3. Mobiliario BDT Externas
                            </th>
                        </tr>
                        <tr>
                            <td class="text-center" style="vertical-align: middle;" colspan="2" rowspan="2">
                                Total del proyecto
                            </td>
                            <td class="text-center" colspan="7">
                                BDT Abiertas
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="4">
                                Inicial
                            </td>
                            <td class="text-center" colspan="3">
                                Funcional
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="2">
                                21165
                            </td>
                            <td class="text-center" colspan="4">
                                3913
                            </td>
                            <td class="text-center" colspan="3">
                                3893
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center table-info" colspan="9">
                                4. Estatus convenio
                            </th>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="2">
                                Indeterminado
                            </td>
                            <td class="text-center" colspan="3">
                                Vencido
                            </td>
                            <td class="text-center" colspan="4">
                                Vigente
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="2">
                                90
                            </td>
                            <td class="text-center" colspan="3">
                                2
                            </td>
                            <td class="text-center" colspan="4">
                                3<br>
                                (Iztapalapa oct/2046)<br>
                                (CT SEDENA jun/2027)
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center table-info" colspan="9">
                                5. Usuarios BDT
                            </th>
                        </tr>
                        <tr>
                            <td class="text-center">
                                BDT's
                            </td>
                            <td class="text-center" colspan="2">
                                Resgistros
                            </td>
                            <td class="text-center" colspan="3">
                                Inscritos
                            </td>
                            <td class="text-center" colspan="3">
                                Constancias
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                50
                            </td>
                            <td class="text-center" colspan="2">
                                27
                            </td>
                            <td class="text-center" colspan="3">
                                100
                            </td>
                            <td class="text-center" colspan="3">
                                200
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center table-info" colspan="9">
                                6. Oferta educativa
                            </th>
                        </tr>
                        <tr>
                            <td class="text-center">
                                Nuevos
                            </td>
                            <td class="text-center" colspan="2">
                                Talleres
                            </td>
                            <td class="text-center" colspan="3">
                                En línea
                            </td>
                            <td class="text-center" colspan="3">
                                En desarrollo
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                3
                            </td>
                            <td class="text-center" colspan="2">
                                447
                            </td>
                            <td class="text-center" colspan="3">
                                393
                            </td>
                            <td class="text-center" colspan="3">
                                53
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center table-info" colspan="9">
                                7. Nuevas Solicitudes 2025 (21 recibidas)
                            </th>
                        </tr>
                        <tr>
                            <td colspan="7"> 
                                Solicitud BDT o donación de equipos
                            </td>
                            <td class="text-center" colspan="2">
                                9
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7"> 
                                Solicitud BDT de reequipamiento
                            </td>
                            <td class="text-center" colspan="2">
                                4
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7"> 
                                Retiro de equipos
                            </td>
                            <td class="text-center" colspan="2">
                                3
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7"> 
                                Otros (visitas a museo, acuario, etc.)
                            </td>
                            <td class="text-center" colspan="2">
                                5
                            </td>
                        </tr>
                    </table>

                    
                    
                </div>
                <div class="tab-pane fade" id="tabBdtCerradas" role="tabpanel" aria-labelledby="ta-bdt-cerradas">
                    
                    <table class="table">
                        <thead class="bg-info">
                            <tr>
                                <th class="text-center" colspan="9">
                                    95 ABIERTAS
                                </th>
                            </tr>
                        </thead>
                        <tr class="table-info">
                            <th class="text-center" colspan="5">
                                95 Totales
                            </th>
                            <th class="text-center" colspan="2">
                                Cerradas del mes
                            </th>
                            <th class="text-center" colspan="2">
                                Abiertas del mes
                            </th>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="5">
                                92 Externas
                            </td>
                            <td class="text-center" colspan="2">
                                -
                            </td>
                            <td class="text-center" colspan="2">
                                -
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="5">
                                3 Internas
                            </td>
                            <td class="text-center" colspan="2">
                                -
                            </td>
                            <td class="text-center" colspan="2">
                                -
                            </td>
                        </tr>
                        <tr class="table-info">
                            <th class="text-center" colspan="9">
                                1. Internet
                            </th>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="5">
                                86 BDT con 97 líneas paga la entidad (4 en cobre)
                            </td>
                            <td class="text-center" colspan="4">
                                9 BDT con 19 líneas y 2 enlaces de paga Telmex
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="5">
                                52 pesito
                            </td>
                            <td class="text-center" colspan="4">
                                40 pesito
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                Sin consumo
                            </td>
                            <td class="text-center" colspan="2">
                                Bajo
                            </td>
                            <td class="text-center" colspan="2">
                                Medio
                            </td>
                            <td class="text-center">
                                Alto
                            </td>
                            <td class="text-center" colspan="2">
                                Heavy
                            </td>
                            <td class="text-center">
                                Atípico
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                -
                            </td>
                            <td class="text-center" colspan="2">
                                43
                            </td>
                            <td class="text-center" colspan="2">
                                32
                            </td>
                            <td class="text-center">
                                8
                            </td>
                            <td class="text-center" colspan="2">
                                11
                            </td>
                            <td class="text-center">
                                1
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center table-info" colspan="9">
                                2. Equipamiento
                            </th>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="2">
                                Total del proyecto
                            </td>
                            <td class="text-center" colspan="2">
                                Abiertas Inicial
                            </td>
                            <td class="text-center" colspan="2">
                                Abiertas Funcional
                            </td>
                            <td class="text-center" colspan="3">
                                % funcional contra inicial
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="2">
                                45
                            </td>
                            <td class="text-center" colspan="2">
                                27
                            </td>
                            <td class="text-center" colspan="2">
                                114114
                            </td>
                            <td class="text-center" colspan="3">
                                0
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center table-info" colspan="9">
                                3. Mobiliario BDT Externas
                            </th>
                        </tr>
                        <tr>
                            <td class="text-center" style="vertical-align: middle;" colspan="2" rowspan="2">
                                Total del proyecto
                            </td>
                            <td class="text-center" colspan="7">
                                BDT Abiertas
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="4">
                                Inicial
                            </td>
                            <td class="text-center" colspan="3">
                                Funcional
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="2">
                                21165
                            </td>
                            <td class="text-center" colspan="4">
                                3913
                            </td>
                            <td class="text-center" colspan="3">
                                3893
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center table-info" colspan="9">
                                4. Estatus convenio
                            </th>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="2">
                                Indeterminado
                            </td>
                            <td class="text-center" colspan="3">
                                Vencido
                            </td>
                            <td class="text-center" colspan="4">
                                Vigente
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="2">
                                90
                            </td>
                            <td class="text-center" colspan="3">
                                2
                            </td>
                            <td class="text-center" colspan="4">
                                3<br>
                                (Iztapalapa oct/2046)<br>
                                (CT SEDENA jun/2027)
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center table-info" colspan="9">
                                5. Usuarios BDT
                            </th>
                        </tr>
                        <tr>
                            <td class="text-center">
                                BDT's
                            </td>
                            <td class="text-center" colspan="2">
                                Resgistros
                            </td>
                            <td class="text-center" colspan="3">
                                Inscritos
                            </td>
                            <td class="text-center" colspan="3">
                                Constancias
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                50
                            </td>
                            <td class="text-center" colspan="2">
                                27
                            </td>
                            <td class="text-center" colspan="3">
                                100
                            </td>
                            <td class="text-center" colspan="3">
                                200
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center table-info" colspan="9">
                                6. Oferta educativa
                            </th>
                        </tr>
                        <tr>
                            <td class="text-center">
                                Nuevos
                            </td>
                            <td class="text-center" colspan="2">
                                Talleres
                            </td>
                            <td class="text-center" colspan="3">
                                En línea
                            </td>
                            <td class="text-center" colspan="3">
                                En desarrollo
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                3
                            </td>
                            <td class="text-center" colspan="2">
                                447
                            </td>
                            <td class="text-center" colspan="3">
                                393
                            </td>
                            <td class="text-center" colspan="3">
                                53
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center table-info" colspan="9">
                                7. Nuevas Solicitudes 2025 (21 recibidas)
                            </th>
                        </tr>
                        <tr>
                            <td colspan="7"> 
                                Solicitud BDT o donación de equipos
                            </td>
                            <td class="text-center" colspan="2">
                                9
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7"> 
                                Solicitud BDT de reequipamiento
                            </td>
                            <td class="text-center" colspan="2">
                                4
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7"> 
                                Retiro de equipos
                            </td>
                            <td class="text-center" colspan="2">
                                3
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7"> 
                                Otros (visitas a museo, acuario, etc.)
                            </td>
                            <td class="text-center" colspan="2">
                                5
                            </td>
                        </tr>
                    </table>
                </div>

            <div class="d-flex mt-5">
                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modalReporte" data-bs-titulo="Nuevo Reporte">
                    Generar Reporte
                </button>
            </div>
            
        </div>

    </body>

@endsection