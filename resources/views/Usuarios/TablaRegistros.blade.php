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

@section('js')
    <script>
        let tabla = new DataTable('#TablaRegistroModificacionUsuarios',{
            dom: 'lrtip',
            ordering: false,
            lengthMenu: [
                [5, 10, 15, -1],
                [5, 10, 15, 'All']
            ],
            order: [[2, 'asc']],
            columnDefs: [
                {
                type: 'natural',
                target: 2
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

        $('#TablaRegistroModificacionUsuarios thead th').each(function(index) {
            const thStyles = window.getComputedStyle(this);

            // Si es la columna de fecha (tercera, índice 2)
            if (index === 2) {
                const $from = $('<input>', {
                    type: 'date',
                    css: { width: '45%', fontSize: thStyles.fontSize }
                });
                const $to = $('<input>', {
                    type: 'date',
                    css: { width: '45%', marginLeft: '5px', fontSize: thStyles.fontSize }
                });

                $(this).append('<br>').append($from).append($to);

                // Filtro personalizado para rango de fechas
                $.fn.dataTable.ext.search.push(function(settings, data) {
                    let min = $from.val();
                    let max = $to.val();
                    let fechaStr = data[2]; // columna 3 (index 2)

                    if (!fechaStr) return true;

                    // Parsear la fecha de la tabla (YYYY-MM-DD HH:mm:ss)
                    let f = new Date(fechaStr);

                    // Parsear los inputs del calendarito
                    let fMin = min ? new Date(min + " 00:00:00") : null;
                    let fMax = max ? new Date(max + " 23:59:59") : null;

                    if ((!fMin || f >= fMin) && (!fMax || f <= fMax)) {
                        return true;
                    }
                    return false;
                });

                // Redibujar tabla cuando cambien los inputs
                $from.on('change', function() { tabla.draw(); });
                $to.on('change', function() { tabla.draw(); });

            } else {
                // Para las demás columnas, input de texto normal
                const $input = $('<input>', {
                    type: 'text',
                    placeholder: 'Filtrar...',
                    css: {
                        width: '90%',
                        fontSize: thStyles.fontSize,
                        fontFamily: thStyles.fontFamily,
                        color: thStyles.color,
                        backgroundColor: thStyles.backgroundColor,
                        border: '1px solid #ccc',
                        padding: '2px',
                        marginTop: '4px',
                        boxSizing: 'border-box',
                        borderRadius: '4px'
                    }
                });

                $(this).off('click');
                $(this).append('<br>').append($input);

                $input.on('keyup change', function() {
                    tabla.column(index).search(this.value).draw();
                });
            }
        });
    </script>
@endsection