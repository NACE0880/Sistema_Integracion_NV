@extends('layouts.usuarios')

@section('title')
    Registro
@endsection

@section('contenido')
    <body>
        <div class="container mt-5">
            <div class="table-responsive mb-1">
                <table id="TablaRegistroModificacionUsuarios" class="table" style="text-align:center;">
                    <thead class="table">
                        <tr>
                            <th class="dt-center">NOMBRE</th>
                            <th class="dt-center">MODIFICACION</th>
                            <th class="dt-center">FECHA DE MODIFICACION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($modificaciones as $modificacion)
                            <tr>
                                <td>{{ $modificacion->NOMBRE }}</td>
                                <td>{{ $modificacion->MODIFICACION }}</td>
                                <td>{{ $modificacion->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </body>
@endsection