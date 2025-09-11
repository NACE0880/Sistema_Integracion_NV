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

        table {
            width: 100%;
            table-layout: fixed;
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
                        <button class="nav-link" id="tab-bdt-abiertas-internas" data-bs-toggle="tab" data-bs-target="#tabBdtAbiertasInternas" type="button" role="tab" aria-controls="tabBdtAbiertasInternas" aria-selected="true">
                            Abiertas Internas
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-bdt-cerradas" data-bs-toggle="tab" data-bs-target="#tabBdtCerradas" type="button" role="tab" aria-controls="tabBdtCerradas" aria-selected="true">
                            Cerradas
                        </button>
                    </li>
                </ul>
            </div>

            <!-- Tabla BDT Abiertas Totales -->
            <div class="tab-content mt-4" id="miTabContent">
                <div class="tab-pane fade show active" id="tabBdtAbiertas" role="tabpanel" aria-labelledby="tab-bdt-abiertas">
                    <table class="table">
                        <thead class="bg-info">
                            <tr>
                                <th class="text-center" colspan="9">
                                    {{ $datosBdts['numeroAdtsAbiertas'] ?? '-' }} ABIERTAS
                                </th>
                            </tr>
                        </thead>
                        <tr class="table-info">
                            <th class="text-center" colspan="5">
                                {{ $datosBdts['numeroAdtsAbiertas'] ?? '-' }} Totales
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
                                {{ $datosBdts['numeroAdtsExternas'] ?? '-' }} Externas
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
                                {{ $datosBdts['numeroAdtsInternas'] ?? '-' }} Internas
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
                                {{ $datosBdts['numeroAdtsConLineasPagaEntidad'] ?? '-' }} BDT con {{ $datosBdts['numeroLineasPagaEntidad'] ?? '-' }} líneas paga la entidad ({{ $datosBdts['numeroLineasCobre'] ?? '-'}} en cobre)
                            </td>
                            <td class="text-center" colspan="4">
                                {{ $datosBdts['numeroAdtsConLineasPagaTelmex'] ?? '-'}} BDT con {{ $datosBdts['numeroLineasPagaTelmex'] ?? '-'}} líneas y {{ $datosBdts['numeroLineasEnlaceQuePagaTelmex'] ?? '-' }} enlaces que paga Telmex
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="5">
                                {{ isset($datosBdts['costoLineasPagaEntidad']) ? '$' . number_format($datosBdts['costoLineasPagaEntidad'], 2) : '-' }}
                            </td>
                            <td class="text-center" colspan="4">
                                {{ isset($datosBdts['costoLineasPagaTelmex']) ? '$' . number_format($datosBdts['costoLineasPagaTelmex'], 2) : '-' }}
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
                                {{ $datosBdts['numeroLineasConsumoSinConsumo'] ?? '-' }}
                            </td>
                            <td class="text-center" colspan="2">
                                {{ $datosBdts['numeroLineasConsumoBajo'] ?? '-' }}
                            </td>
                            <td class="text-center" colspan="2">
                                {{ $datosBdts['numeroLineasConsumoMedio'] ?? '-' }}
                            </td>
                            <td class="text-center">
                                {{ $datosBdts['numeroLineasConsumoAlto'] ?? '-' }}
                            </td>
                            <td class="text-center" colspan="2">
                                {{ $datosBdts['numeroLineasConsumoHeavy'] ?? '-' }}
                            </td>
                            <td class="text-center">
                                {{ $datosBdts['numeroLineasConsumoAtipico'] ?? '-' }}
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
                                {{ $datosBdts['cantidadEquipamientoAdts'] ?? '-' }}
                            </td>
                            <td class="text-center" colspan="2">
                                {{ $datosBdts['cantidadDeEquipamientoInicialBdtsAbiertas'] ?? '-' }}
                            </td>
                            <td class="text-center" colspan="2">
                                {{ $datosBdts['cantidadDeEquipamientoFuncionaBdtsAbiertas'] ?? '-'}}
                            </td>
                            <td class="text-center" colspan="3">
                                {{ isset($datosBdts['cantidadPorcentualCantidadEquipamientoFuncionalEntreEquipamientoFuncional']) ? number_format($datosBdts['cantidadPorcentualCantidadEquipamientoFuncionalEntreEquipamientoFuncional'], 2) . "%" : '-' }}
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
                            <td class="text-center" style="vertical-align: middle;" colspan="2">
                                {{ $datosBdts['cantidadDeMobiliarioBdtsAbiertas'] ?? '-' }}
                            </td>
                            <td class="text-center" style="vertical-align: middle;" colspan="4">
                                {{ $datosBdts['cantidadDeMobiliarioInicialBdtsAbiertas'] ?? '-' }}
                            </td>
                            <td class="text-center" style="vertical-align: middle;" colspan="3">
                                {{ $datosBdts['cantidadDeMobiliarioFuncionaBdtsAbiertas'] ?? '-' }}
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
                                {{ $datosBdts['numeroConveniosIndeterminadosBdtsAbiertas'] ?? '-' }}
                            </td>
                            <td class="text-center" colspan="3">
                                {{ $datosBdts['numeroConveniosVencidosBdtsAbiertas'] ?? '-' }}
                            </td>
                            <td class="text-center" colspan="4">
                                {{ $datosBdts['numeroConveniosVigentesBdtsAbiertas'] ?? '-' }}
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
                                Registros
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
                        <tr>
                            <th class="bg-secondary text-white text-center" colspan="9">
                                Solicitudes relevantes del mes:
                            </th>
                        </tr>
                        <tr class="table-secondary">
                            <th class="text-center" colspan="9">
                                -
                            </th>
                        </tr>
                    </table>

                </div>

                <!-- Tabla BDT Abiertas Internas -->
                <div class="tab-pane fade" id="tabBdtAbiertasInternas" role="tabpanel" aria-labelledby="tab-bdt-abiertas-internas">
                    <table class="table">
                        <thead class="bg-info">
                            <tr>
                                <th class="text-center" colspan="9">
                                    3 Internas
                                </th>
                            </tr>
                        </thead>
                        <tr>
                            <td class="text-center" colspan="9">
                                1 con personal interno (Aldea Digital Iztapalapa)
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="9">
                                2 con personal interno (CT Sedena y CT Semar)
                            </td>
                        </tr>
                        <tr class="table-info">
                            <th class="text-center" colspan="9">
                                1. Internet
                            </th>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="5">
                                2 CT con 13 infinitum y 4 de voz (paga Telmex)
                            </td>
                            <td class="text-center" colspan="4">
                                1 con CT con 1 enlace y 2 de voz (paga Telmex)
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
                            <td class="text-center" colspan="3">
                                Medio
                            </td>
                            <td class="text-center" colspan="2">
                                Alto
                            </td>
                            <td class="text-center">
                                Heavy
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                -
                            </td>
                            <td class="text-center" colspan="2">
                                -
                            </td>
                            <td class="text-center" colspan="3">
                                -
                            </td>
                            <td class="text-center" colspan="2">
                                -
                            </td>
                            <td class="text-center">
                                3
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center table-info" colspan="9">
                                2. Equipamiento
                            </th>
                        </tr>
                        <tr>
                            <td class="text-center">
                                Total del proyecto
                            </td>
                            <td class="text-center" colspan="2">
                                Funcional
                            </td>
                            <td class="text-center" colspan="4">
                                Baja, Dañado, Obsoleto o Faltante
                            </td>
                            <td class="text-center" colspan="2">
                                % funcional contra inicial
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                393
                            </td>
                            <td class="text-center" colspan="2">
                                325
                            </td>
                            <td class="text-center" colspan="4">
                                114114
                            </td>
                            <td class="text-center" colspan="2">
                                82.7%
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center table-info" colspan="9">
                                3. Mobiliario y gadgets funcionales
                            </th>
                        </tr>
                        <tr>
                            <td class="text-center">
                                Mesas
                            </td>
                            <td class="text-center" colspan="5">
                                Sillas, bancos y puff
                            </td>
                            <td class="text-center" colspan="2">
                                Libreros
                            </td>
                            <td class="text-center">
                                Tv
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                239
                            </td>
                            <td class="text-center" colspan="5">
                                643
                            </td>
                            <td class="text-center" colspan="2">
                                9
                            </td>
                            <td class="text-center">
                                39
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="2">
                                Archivos y lockers
                            </td>
                            <td class="text-center" colspan="4">
                                Racks
                            </td>
                            <td class="text-center" colspan="3">
                                Carrito cargador
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="2">
                                11
                            </td>
                            <td class="text-center" colspan="4">
                                24
                            </td>
                            <td class="text-center" colspan="3">
                                8
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
                                -
                            </td>
                            <td class="text-center" colspan="3">
                                -
                            </td>
                            <td class="text-center" colspan="4">
                                3<br>
                                (Iztapalapa oct/2046)<br>
                                (CT SEDENA jun/2027)
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center table-info" colspan="9">
                                5. Usuarios
                            </th>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="4">
                                CT Abiertas
                            </td>
                            <td class="text-center" colspan="2">
                                Meta
                            </td>
                            <td class="text-center" colspan="2">
                                Real
                            </td>
                            <td class="text-center">
                                %
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="4">
                                Aldea Digital Iztapalapa
                            </td>
                            <td class="text-center" colspan="2">
                                53,495
                            </td>
                            <td class="text-center" colspan="2">
                                14,219
                            </td>
                            <td class="text-center">
                                26%
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="4">
                                CT Sedena
                            </td>
                            <td class="text-center" colspan="2">
                                53,495
                            </td>
                            <td class="text-center" colspan="2">
                                14,219
                            </td>
                            <td class="text-center">
                                26%
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="4">
                                CT Semar
                            </td>
                            <td class="text-center" colspan="2">
                                53,495
                            </td>
                            <td class="text-center" colspan="2">
                                14,219
                            </td>
                            <td class="text-center">
                                26%
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center table-info" colspan="9">
                                6. Gasto mensual $306,274 / acumulado 2025 $1,735,332
                            </th>
                        </tr>
                        <tr>
                            <td class="text-center">
                                Renta
                            </td>
                            <td class="text-center" colspan="2">
                                Aseo
                            </td>
                            <td class="text-center" colspan="3">
                                Luz
                            </td>
                            <td class="text-center" colspan="3">
                                Vigilancia
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                -
                            </td>
                            <td class="text-center" colspan="2">
                                $26,729.20
                            </td>
                            <td class="text-center" colspan="3">
                                -
                            </td>
                            <td class="text-center" colspan="3">
                                -
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                Renta
                            </td>
                            <td class="text-center" colspan="2">
                                Aseo
                            </td>
                            <td class="text-center" colspan="3">
                                Luz
                            </td>
                            <td class="text-center" colspan="3">
                                Vigilancia
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                -
                            </td>
                            <td class="text-center" colspan="2">
                                -
                            </td>
                            <td class="text-center" colspan="3">
                                -
                            </td>
                            <td class="text-center" colspan="3">
                                -
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center table-info">
                                Mantenimientos:
                            </th>
                            <th class="text-center table-info" colspan="3">
                                Total:
                            </th>
                            <td class="text-center" colspan="2">
                                $138,420.36
                            </td>
                            <th class="text-center table-info" colspan="2">
                                Ejercicio:
                            </th>
                            <th class="text-center table-info">
                                -
                            </th>
                        </tr>
                        <tr>
                            <th class="bg-secondary text-white text-center" colspan="9">
                                Solicitudes relevantes del mes:
                            </th>
                        </tr>
                        <tr class="table-secondary">
                            <th class="text-center" colspan="9">
                                -
                            </th>
                        </tr>
                    </table>
                </div>
                
                <!-- Tabla BDT Cerradas -->
                <div class="tab-pane fade" id="tabBdtCerradas" role="tabpanel" aria-labelledby="tab-bdt-cerradas">
                    <table class="table">
                        <thead class="bg-secondary">
                            <tr>
                                <th class="text-center" colspan="9">
                                    7 CERRADAS
                                </th>
                            </tr>
                        </thead>
                        <tr class="table-secondary">
                            <th class="text-center" colspan="9">
                                7 Internas
                            </th>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="9">
                                BDT FCS Veracruz, CT Campeche, CT Cuautla, CT Saltillo, CT Tapachula y CT Tuxtla (se entregó CT Mérida a Aldeca)
                            </td>
                        </tr>
                        <tr class="table-secondary">
                            <th class="text-center" colspan="9">
                                1. Internet
                            </th>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="5">
                                7 Ct con 9 Infinitum y 4 de voz (paga Telmex)
                            </td>
                            <td class="text-center" colspan="4">
                                0 enlace
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="5">
                                $4,389.35
                            </td>
                            <td class="text-center" colspan="4">
                                -
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
                            <td class="text-center" colspan="2">
                                Alto
                            </td>
                            <td class="text-center" colspan="2">
                                Heavy
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                -
                            </td>
                            <td class="text-center" colspan="2">
                                4
                            </td>
                            <td class="text-center" colspan="2">
                                2
                            </td>
                            <td class="text-center" colspan="2">
                                1
                            </td>
                            <td class="text-center" colspan="2">
                                -
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center table-secondary" colspan="9">
                                2. Equipamiento
                            </th>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="2">
                                Total del proyecto
                            </td>
                            <td class="text-center" colspan="4">
                                Abiertas Funcional
                            </td>
                            <td class="text-center" colspan="3">
                                Baja, Dañado, Obsoleto o Faltante
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="2">
                                1788
                            </td>
                            <td class="text-center" colspan="4">
                                440
                            </td>
                            <td class="text-center" colspan="3">
                                114114
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center table-secondary" colspan="9">
                                3. Mobiliario y gadgets
                            </th>
                        </tr>
                        <tr>
                            <td class="text-center">
                                Mesas
                            </td>
                            <td class="text-center" colspan="5">
                                Sillas, bancos y puff
                            </td>
                            <td class="text-center" colspan="2">
                                Libreros
                            </td>
                            <td class="text-center">
                                Tv
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                479
                            </td>
                            <td class="text-center" colspan="5">
                                1,613
                            </td>
                            <td class="text-center" colspan="2">
                                32
                            </td>
                            <td class="text-center">
                                38
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="2">
                                Archiveros y Lockers
                            </td>
                            <td class="text-center" colspan="2">
                                Racks
                            </td>
                            <td class="text-center" colspan="5">
                                Carrito Cargador
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="2">
                                51
                            </td>
                            <td class="text-center" colspan="2">
                                56
                            </td>
                            <td class="text-center" colspan="5">
                                3
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center table-secondary" colspan="9">
                                4. Estatus convenio
                            </th>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="2">
                                Vigente
                            </td>
                            <td class="text-center" colspan="3">
                                Vencido
                            </td>
                            <td class="text-center" colspan="4">
                                Sin convenio
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="2">
                                6
                            </td>
                            <td class="text-center" colspan="3">
                                -
                            </td>
                            <td class="text-center" colspan="4">
                                1 (Veracruz)
                                <br>
                                Contrato (vigencia 31 de dic de 2025) Notificar continuidad
                                <br>
                                120 días antes
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center table-secondary" colspan="9">
                                5. Usuarios
                            </th>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="2">
                                BDT (7 Cerradas)
                            </td>
                            <td class="text-center" colspan="3">
                                ene-jun 2025
                            </td>
                            <td class="text-center">
                                543
                            </td>
                            <td class="text-center" colspan="2">
                                Del mes
                            </td>
                            <td class="text-center">
                                30
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="2">
                                FILIALES
                            </td>
                            <td class="text-center" colspan="3">
                                ene-jun 2025
                            </td>
                            <td class="text-center">
                                10750
                            </td>
                            <td class="text-center" colspan="2">
                                Del mes
                            </td>
                            <td class="text-center">
                                2433
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="9">
                                SANBORNS, SEARS, Global Hitss, Sección Amarilla, TELCEL, Bienestar Social, SCITUM, RED UNO, Guarderías Telmex, INBURSA, TELESITES
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center table-secondary" colspan="9">
                                6. Gasto mensual $378,357.95 / acumulado 2025 $ 2,346,651
                            </th>
                        </tr>
                        <tr>
                            <td class="text-center">
                                Renta
                            </td>
                            <td class="text-center" colspan="2">
                                Aseo
                            </td>
                            <td class="text-center" colspan="3">
                                Luz
                            </td>
                            <td class="text-center" colspan="3">
                                Vigilancia
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                $16,975.89
                            </td>
                            <td class="text-center" colspan="2">
                                $7,604.57
                            </td>
                            <td class="text-center" colspan="3">
                                -
                            </td>
                            <td class="text-center" colspan="3">
                                $200,695.74
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                Agua Potable
                            </td>
                            <td class="text-center" colspan="5">
                                Nómina operación
                            </td>
                            <td class="text-center" colspan="3">
                                Nómina total
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                $4,033.56
                            </td>
                            <td class="text-center" colspan="5">
                                $207,064.19
                            </td>
                            <td class="text-center" colspan="3">
                                $486,609.32
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center table-secondary" colspan="2">
                                Mantenimientos:
                            </th>
                            <th class="text-center table-secondary" colspan="2">
                                Total:
                            </th>
                            <td class="text-center" colspan="2">
                                $2,219,655.77
                            </td>
                            <th class="text-center table-secondary" colspan="2">
                                Ejercicio:
                            </th>
                            <td class="text-center">
                                -
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-secondary text-white text-center" colspan="9">
                                Solicitudes relevantes del mes:
                            </th>
                        </tr>
                        <tr class="table-secondary">
                            <th class="text-center" colspan="9">
                                -
                            </th>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="d-flex mt-5">
                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modalReporte" data-bs-titulo="Nuevo Reporte">
                    Generar Reporte
                </button>
            </div>
            
        </div>

    </body>

@endsection