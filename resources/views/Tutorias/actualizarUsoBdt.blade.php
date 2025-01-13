{{-- vista extendida del layout --}}
@extends('layouts.tutorias')

@section('title')
    Actualizar Equipamiento
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

            text-align:center;
        }

    </style>

@endsection


@section('contenido')
    <div class="container form-container mt-5">
            <div class="form-header">
                <h2>Seguimiento del Uso de la BDT</h2>
                <h3>{{ $adt }}</h3>
            </div>


            <form action="{{ route('update.use.adt', $adt)}}" method="POST" enctype="multipart/form-data" onsubmit="showLoading()" class="row g-3">
                {{-- Redireccionar a rutas de actualizacion  --}}
                @csrf
                @method('PATCH')

                <div class="row g-3">

                    <div class="row g-3 justify-content-center gap-5">

                        <div class="col-md-5">
                            <label for="estatus_registro" class="form-label">Registra Usuarios en Sistema</label>
                            <select id="estatus_registro" name="estatus_registro" class="form-select" required>
                                <option value="">Selecciona...</option>
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                            </select>
                        </div>

                        <div class="col-md-5">
                            <label for="estatus_curso" class="form-label">Aplica Cursos de Oferta Educativa</label>
                            <select id="estatus_curso" name="estatus_curso" class="form-select" required>
                                <option value="">Selecciona...</option>
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                            </select>
                        </div>

                    </div>

                    <div class="row g-3 justify-content-center gap-5">

                        <div class="col-md-5">
                            <label for="tipo_uso" class="form-label">Tipo de Uso</label>
                            <select id="tipo_uso" name="tipo_uso" class="form-select" required>
                                <option value="">Selecciona...</option>
                                <option value="Aula">Aula</option>
                                <option value="Maestros">Maestros</option>
                                <option value="Navegación Libre">Navegación Libre</option>
                            </select>
                        </div>

                        <div class="col-md-5">
                            <label for="poblacion" class="form-label">Mayoría de Población</label>
                            <select id="poblacion" name="poblacion" class="form-select" required>
                                <option value="">Selecciona...</option>
                                <option value="Niños">Niños</option>
                                <option value="Adolecentes">Adolecentes</option>
                                <option value="Adultos">Adultos</option>
                            </select>
                        </div>

                    </div>

                    <div class="row g-3 justify-content-center gap-5">

                        <div class="col-2">
                            <label for="hora_inicio" class="form-label">Hora Inicio</label>
                            <input type="time" class="form-control" id="hora_inicio" name="hora_inicio" required>
                        </div>

                        <div class="col-2">
                            <label for="hora_final" class="form-label">Hora Final</label>
                            <input type="time" class="form-control" id="hora_final" name="hora_final" required>
                        </div>

                        <div class="col-3">
                            <label for="usuarios_semanales" class="form-label">Usuarios Semanales</label>
                            <input type="number" class="form-control" id="usuarios_semanales" name="usuarios_semanales" min="0"  step="1" value="1" required/>
                        </div>

                    </div>

                    <div class="row g-3 justify-content-center">
                        <div class="col-6">
                            <label for="observaciones" class="form-label">Observaciones</label>
                            <textarea class="form-control" id="observaciones" name="observaciones" rows="3" maxlength="200" placeholder="Max 200 caracteres" required></textarea>
                        </div>
                    </div>

                </div>


                <div class="row g-3 justify-content-center">
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-custom">Guardar</button>
                    </div>
                    <div class="col-4">
                        <a  class="btn btn-danger btn-custom" href="{{ route('panel.llamada.adt', $adt) }}">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
@endsection


@section('js')


@endsection
