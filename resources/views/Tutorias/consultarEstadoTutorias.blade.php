@extends('layouts.tutorias')

@section('title')
    Consultar Estado
@endsection

@section('css')
    <style>

        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
        }
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
        }

    </style>
@endsection


@section('contenido')
    <body>
        <h1>📊 Reporte Quincenal BDT - Junio 2025</h1>

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

    </body>

@endsection