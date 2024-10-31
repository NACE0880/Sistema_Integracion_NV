@extends('layouts.tickets')

@section('title')
    Actualizar Personal
@endsection

@section('css')

@endsection


@section('contenido')
        {{-- BARRA DE NAVEGACIÓN --}}
        <ul class="nav nav-tabs justify-content-center">

            <li class="nav-item">
                <a class="nav-link " href="{{ route('consultar.ticket') }}"> <i class="fa-solid fa-house"></i> Panel </a>
            </li>


            <li class="nav-item">
                <a class="nav-link " href="{{ route('reporte.ticket') }}"> <i class="fa-regular fa-file-excel"></i> Reportes</a>
            </li>


            <li class="nav-item">
                <a class="nav-link active" href="{{ route('modificar.personal') }}"> <i class="fa-solid fa-users"></i></i> Personal</a>
            </li>
        </ul>

        <div class="container form-container mt-5" style="width: 70%">
            <div class="form-header">
                <h2>Asignar Personal</h2>
            </div>


            <form action=" {{ route('consult.ticket') }}" method="POST">
            {{-- <form> --}}

                {{-- Redireccionar a rutas de actualizacion  --}}
                @csrf

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="area_asignada"> Area Asignada</label>
                        <input type="text" id="area_asignada" name="area_asignada" class="form-control" readonly></input>
                    </div>

                    <div class="form-group col-md-6 ">

                        <div class="form-check form-switch">
                            <label for="casas_asignadas"> Casas Asignadas</label>
                            <textarea id="casas_asignadas" name="casas_asignadas" class="form-control" rows="1" readonly></textarea>

                        </div>
                        {{-- <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                        <label class="form-check-label" for="casas_asignadas">ALDEA</label> --}}


                    </div>
                </div>

                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label for="casas">Casas</label>
                        <select id="casas" name="casas" class="form-control" onchange="cagarEncargadosCasas(this)" required>
                            <option value=""> Selecciones una casa...</option>

                            @foreach ($casas as $casa)
                                <option value="{{ $casa->ID_CASA }}"> {{ $casa->NOMBRE }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group col-md-4">
                        <label for="areas">Areas</label>
                        <select id="areas" name="areas" class="form-control" onchange="cargarDependenciasAreas(this)" required>
                            <option value=""> Seleciones una area...</option>

                            @foreach ($areas as $area)
                                <option value="{{ $area->ID_AREA }}">{{ $area->NOMBRE }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="encargados">Encargados</label>
                        <select id="encargados" name="encargados"  class="form-control" onchange="cargarDetallesEncargado(this)" required>
                            <option value="">Seleccione un encargado...</option>

                            @foreach ($encargados as $encargado)
                                <option value="{{ $encargado->ID_ENCARGADO}}" data-area= "{{ $encargado->ID_AREA }}">{{ $encargado->NOMBRE }} </option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <button type="submit" class="btn btn-primary">Actualizar</button>
            </form>

            {{-- <div class="text-center">
                <a href="{{ route('tickets.consulta') }}" class="btn btn-success btn-custom-end-dataTable">
                    <i class="fa-regular fa-file-excel"></i>
                    Exportar Consulta
                </a>
            </div> --}}
        </div>

@endsection


@section('js')
<script>
// RECURSOS DE LIMPIEZA DE SELECTS
    function limpiarElemento(element){
        element.value = "";
    }

    function limpiarSelect(select){
        while (select.options.length > 1){
            select.remove(1);
        }
    }
// CASAS
    function cargarDetallesEncargado(encargadoSelect) {
        let id = encargadoSelect.value;
        let area = encargadoSelect.options[encargadoSelect.selectedIndex].dataset.area;

        // Cargar colecciones de las dependencias de las casas
        fetch(`/tickets/creacion/${id}/Encargados`)
            .then(response => response.json())
            .then(jsonData => crearDetalles(jsonData))

    }

    function crearDetalles(jsonDetalles){
        let casasTextArea = document.getElementById('casas_asignadas');
        let areasInput = document.getElementById('area_asignada');

        limpiarElemento(casasTextArea);
        limpiarElemento(areasInput);

        jsonDetalles['casas'].forEach(casa => {
            casasTextArea.value += casa.NOMBRE + '\n'
        });

        areasInput.value = jsonDetalles['area'];

    }


</script>
@endsection
