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

            <div class="tab-content" id="miTabContent">
                <div class="tab-pane fade show active" id="tabBdtAbiertas" role="tabpanel" aria-labelledby="tab-bdt-abiertas">
                    
                    <h2>🌐 Internet</h2>
                    
                    <table>
                        <tr><th colspan="6">INTERNET</th></tr>
                        <tr><th>BDT</th><th>Proveedor</th><th>Velocidad Contratada</th><th>Velocidad Real</th><th>Tipo de Conexión</th><th>Observaciones</th></tr>
                        <tr><td>BDT Aldea Digital Iztapalapa</td><td>Telmex</td><td>100 Mbps</td><td>95 Mbps</td><td>Fibra óptica</td><td>Sin incidencias</td></tr>
                        <tr><td>BDT CT Saltillo</td><td>Telmex</td><td>50 Mbps</td><td>48 Mbps</td><td>ADSL</td><td>Estable</td></tr>
                    </table>

                    <h2>🖥 Equipamiento</h2>
                    <table>
                        <tr><th colspan="6">EQUIPAMIENTO</th></tr>
                        <tr><th>BDT</th><th>Computadoras</th><th>Tabletas</th><th>Impresoras</th><th>Proyectores</th><th>Otros dispositivos</th></tr>
                        <tr><td>BDT Aldea Digital Iztapalapa</td><td>20</td><td>10</td><td>2</td><td>1</td><td>Scanner, bocinas</td></tr>
                        <tr><td>BDT CT Saltillo</td><td>15</td><td>5</td><td>1</td><td>0</td><td>TV inteligente</td></tr>
                    </table>
                    
                </div>
                <div class="tab-pane fade" id="tabBdtCerradas" role="tabpanel" aria-labelledby="ta-bdt-cerradas">
                    
                    <h2>🪑 Mobiliario</h2>

                    <table>
                        <tr><th colspan="6">MOBILIARIO</th></tr>
                        <tr><th>BDT</th><th>Mesas</th><th>Sillas</th><th>Estantes</th><th>Pizarras</th><th>Observaciones</th></tr>
                        <tr><td>BDT Aldea Digital Iztapalapa</td><td>10</td><td>25</td><td>3</td><td>2</td><td>Buen estado general</td></tr>
                        <tr><td>BDT CT Saltillo</td><td>8</td><td>20</td><td>2</td><td>1</td><td>Requiere mantenimiento en estantes</td></tr>
                    </table>

                    <h2>👥 Usuarios</h2>
                    <table>
                        <tr><th colspan="6">USUARIOS</th></tr>
                        <tr><th>BDT</th><th>Usuarios Totales</th><th>Escolares</th><th>Docentes</th><th>Adultos Mayores</th><th>Otros</th></tr>
                        <tr><td>BDT Aldea Digital Iztapalapa</td><td>320</td><td>180</td><td>25</td><td>30</td><td>85</td></tr>
                        <tr><td>BDT CT Saltillo</td><td>250</td><td>140</td><td>20</td><td>15</td><td>75</td></tr>
                    </table>

                    <h2>🤝 Convenios</h2>
                    <table>
                        <tr><th colspan="4">CONVENIOS</th></tr>
                        <tr><th>BDT</th><th>Institución Aliada</th><th>Tipo de Convenio</th><th>Vigencia</th></tr>
                        <tr><td>BDT Aldea Digital Iztapalapa</td><td>SEP</td><td>Educativo</td><td>2023–2026</td></tr>
                        <tr><td>BDT CT Saltillo</td><td>Gobierno Estatal</td><td>Infraestructura</td><td>2024–2027</td></tr>
                    </table>

                    <h2>🎨 Actividades</h2>
                    <table>
                        <tr><th colspan="5">ACTIVIDADES</th></tr>
                        <tr><th>BDT</th><th>Tipo de Actividad</th><th>Frecuencia</th><th>Participantes</th><th>Observaciones</th></tr>
                        <tr><td>BDT Aldea Digital Iztapalapa</td><td>Taller de robótica</td><td>Semanal</td><td>25</td><td>Alta demanda, cupo limitado</td></tr>
                        <tr><td>BDT CT Saltillo</td><td>Capacitación digital básica</td><td>Mensual</td><td>40</td><td>Dirigido a adultos mayores</td></tr>
                    </table>

                    <h2>🌍 Impacto Social</h2>
                    <table>
                        <tr><th colspan="4">IMPACTO SOCIAL</th></tr>
                        <tr><th>BDT</th><th>Logros Destacados</th><th>Beneficiarios</th><th>Comentarios</th></tr>
                        <tr><td>BDT Aldea Digital Iztapalapa</td><td>Reducción de brecha digital en jóvenes</td><td>+300</td><td>Reconocida por el municipio como modelo de inclusión</td></tr>
                        <tr><td>BDT CT Saltillo</td><td>Capacitación laboral para adultos mayores</td><td>+200</td><td>Alianza con DIF para continuidad educativa</td></tr>
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