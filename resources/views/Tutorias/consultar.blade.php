{{-- vista extendida del layout --}}
@extends('layouts.tutorias')

@section('title')
    Consultar Entidad
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
        .text-sm{
            font-size: 13px;
        }
        .text-smin{
            font-size: 12px;
        }

        .historicTable{
            text-align:center;
        }

    </style>
@endsection


@section('contenido')
    <div class="container mt-5">
        <h2 class="text-center mb-4 mt-2">Listado de ADT</h2>
        <div class="table-responsive">
            <table id="adtTable" class="table table-striped table-bordered table-sm  table-hover" style="text-align:center;">
                <thead class="table-dark">
                    <tr>
                        <th class="dt-center">CLAVE</th>
                        <th class="dt-center">NOMBRE</th>
                        <th class="dt-center">ULTIMO CONTACTO</th>
                        <th class="dt-center">DETALLE</th>
                        <th class="dt-center">DATOS CONTACTO</th>
                        <th class="dt-center">CONTACTAR</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($adts as $sede)
                        <tr class="text-sm">
                            <td>{{ $sede->CLAVE }}</td>
                            <td >{{ $sede->NOMBRE }}</td>
                            <td>
                                @if ( DateTime::createFromFormat('Y-m-d H:i:s', $sede->ultimoContacto($sede->ID_ADT)) == FALSE )
                                    <a class="btn btn-outline-danger text-smin">
                                        {{ $sede->ultimoContacto($sede->ID_ADT) }}
                                    </a>
                                @else
                                    <a class="btn btn-outline-primary text-smin" data-bs-toggle="modal"  data-bs-target="#modalHistorico"
                                    data-adt="{{ $sede->NOMBRE }}" data-historico="{{$sede->llamadas}}">
                                        {{ $sede->ultimoContacto($sede->ID_ADT) }}
                                    </a>
                                @endif
                            </td>

                            {{-- Reporte --}}
                            <td>
                                <a href="{{ route('consultar.tutoria') }}" class="btn btn-outline-info">
                                    <i class="fa-solid fa-file-arrow-down"></i>
                                </a>
                            </td>
                            {{-- Contacto Sede --}}
                            <td>
                                <a href="{{ route('actualizar.contacto.adt', $sede) }}" class="btn btn-outline-dark">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </a>
                            </td>
                            <td>

                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"  data-bs-target="#modalContactar"
                                    data-adt="{{ $sede }}" data-contactos="{{$sede->contactos}}"
                                    data-ruta-si="{{ route('panel.llamada.adt', $sede)}}" data-ruta-no="{{ route('llamada.noefectiva.adt', $sede)}}"
                                    data-action="{{ route('send.contact.adt', $sede)}}"
                                >
                                    <i class="fa-solid fa-headset fa-beat-fade"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    {{-- MODAL HISTORICO --}}
    <div class="modal fade text-sm" id="modalHistorico" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false" aria-modal="true" >
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Histórico de llamadas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive" id="table">

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL CONTACTO--}}
    <div class="modal fade text-sm" id="modalContactar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false" aria-modal="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">CLAVE NO RECIBIDA</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive" id="table">

                    </div>
                    <form id="formSendContacts" action="" method="POST" class="row g-3">
                        {{-- Redireccionar a rutas de actualizacion  --}}
                        @csrf

                        <div class="input-group mb-3 mt-5">
                            <label class="input-group-text" for="coordinador">Enviar Contactos a:</label>
                            <select class="form-select" id="coordinador" name='coordinador'>
                                @foreach ( $coordinadores as $coordinador )
                                    <option value="{{ $coordinador->ID_COORDINADOR }}">{{ $coordinador->NOMBRE }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-outline-dark" type="submit" id="exportarContactos">Enviar</button>
                        </div>
                    </form>

                </div>
                <div class="modal-footer row d-flex justify-content-center align-content-center ">
                    <div class="text-center">
                        <p>¿Respondió la llamada?</p>
                        <a class="btn btn-primary" id="buttonYes">SI</a>
                        <a class="btn btn-secondary" id="buttonNo" >NO</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


@section('js')
    {{-- DATATABLE --}}
    <script>
        let tabla = new DataTable('#adtTable',{
            lengthMenu: [
                [5, 10, 15, -1],
                [5, 10, 15, 'All']
            ],
            order: [0, 'asc'],
            columnDefs: [
                {
                type: 'natural',
                target: 0
                }
            ],


            "pagingType": "full_numbers",
                "language": {
                    "search": "Buscar:",
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                    "paginate": {
                        "first": "<<",
                        "last": ">>",
                        "next": ">",
                        "previous": "<"
                    }
                }

        });
    </script>

    {{-- MODAL HISTORICO --}}
    <script>
        $('#modalHistorico').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var adt = button.data('adt')
            var historico = button.data('historico')

            var modal = $(this)

            modal.find('.modal-body #table').html(añadirFilasHistorico(historico));
        });


        function añadirFilasHistorico(historico) {
            // Creacion del cuerpo de la tabla
            var table = document.createElement('table');
            var thead = document.createElement('thead');
            var tbody = document.createElement('tbody');
            var row = document.createElement('tr');
            table.className="table table-striped table-bordered table-sm  table-hover dt-center historicTable";
            thead.className="table-dark";

            thead.innerHTML = '<tr><th>FECHA</th><th>RESPONSABLE</th><th>ESTATUS</th><th>OBSERVACIONES</th><th>LIGA</th></tr>'

            historico.forEach((llamada) =>{
                row.innerHTML = `
                    <td>${llamada.FECHA}</td>
                    <td>${llamada.RESPONSABLE}</td>
                    <td>${llamada.ESTATUS}</td>
                    <td>${llamada.OBSERVACIONES}</td>
                    <td>${llamada.LIGA}</td>
                `
                tbody.append(row);
                row = document.createElement('tr');

            });
            table.append(thead);
            table.append(tbody)

            return table;
        }

    </script>


    {{-- MODAL CONTACTO --}}
    <script>
        $('#modalContactar').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)

            var adt = button.data('adt')
            var contactos = button.data('contactos')
            var action = button.data('action')

            var ruta_si = button.data('ruta-si')
            var ruta_no = button.data('ruta-no')


            var modal = $(this)
            modal.find('.modal-title').text(adt.NOMBRE)
            modal.find('.modal-body #table').html(añadirFilasContacto(contactos));
            modal.find('.modal-body #formSendContacts').prop("action",action);

            modal.find('.modal-footer #buttonYes').prop("href",ruta_si);
            modal.find('.modal-footer #buttonNo').prop("href",ruta_no);
        });

        function añadirFilasContacto(contactos) {
            // Creacion del cuerpo de la tabla
            var table = document.createElement('table');
            var thead = document.createElement('thead');
            var tbody = document.createElement('tbody');
            var row = document.createElement('tr');
            table.className="table table-striped table-bordered table-sm  table-hover dt-center historicTable";
            thead.className="table-dark";

            thead.innerHTML = '<tr><th>NOMBRE</th><th>CARGO</th><th>TELEFONO</th><th>CELULAR</th><th>CORREO</th></tr>'

            contactos.forEach((contacto) =>{
                row.innerHTML = `
                    <td>${contacto.NOMBRE}</td>
                    <td>${contacto.CARGO}</td>
                    <td>${contacto.TELEFONO}</td>
                    <td>${contacto.CELULAR}</td>
                    <td>${contacto.CORREO}</td>
                `
                tbody.append(row);
                row = document.createElement('tr');

            });
            table.append(thead);
            table.append(tbody)

            return table;
        }
    </script>




@endsection
