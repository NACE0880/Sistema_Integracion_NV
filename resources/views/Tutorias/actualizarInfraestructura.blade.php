{{-- vista extendida del layout --}}
@extends('layouts.tutorias')

@section('title')
    Actualizar Infraestructura
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
                <h2>Seguimiento de Infraestructura y Señalética</h2>
                <h3>{{ $adt->NOMBRE }}</h3>
            </div>


            <form action="{{ route('update.infrastructure.adt', $adt)}}" method="POST" enctype="multipart/form-data" onsubmit="showLoading()" class="row g-3">
                {{-- Redireccionar a rutas de actualizacion  --}}
                @csrf
                @method('PATCH')

                <div class="row g-3">

                    <div class="row g-3 justify-content-center">

                        <div class="col-md-5">
                            <label for="kit_señalizacion" class="form-label">Estatus Kit Señalización</label>
                            <input class="form-control mb-3" id="kit_señalizacion_previa" name="kit_señalizacion_previa" placeholder="{{ $adt->infraestructura($adt->ID_ADT)->KIT_SENALIZACION }}" readonly/>
                            <select id="kit_señalizacion" name="kit_señalizacion" class="form-select" required>
                                <option value="">Selecciona...</option>
                                <option value="Colocada">Colocada</option>
                                <option value="Despegada">Despegada</option>
                            </select>
                        </div>

                        <div class="col-md-5">
                            <label for="electricidad" class="form-label">Electricidad</label>
                            <input class="form-control mb-3" id="electricidad_historico_previa" name="electricidad_historico_previa" placeholder="{{ $adt->infraestructura($adt->ID_ADT)->ELECTRICIDAD }}" readonly/>
                            <select id="electricidad" name="electricidad" class="form-select" required>
                                <option value="">Selecciona...</option>
                                <option value="Funcional">Funcional</option>
                                <option value="Intermitente">Intermitente</option>
                                <option value="Sin Servicio">Sin Servicio</option>
                            </select>
                        </div>

                    </div>

                    <div class="row g-3 justify-content-center">

                        <div class="col-md-5">
                            <label for="pintura_interior" class="form-label">Pintura Interior</label>
                            <input class="form-control mb-3" id="pintura_interior_previa" name="pintura_interior_previa" placeholder="{{ $adt->infraestructura($adt->ID_ADT)->PINTURA_INTERIOR }}" readonly/>
                            <select id="pintura_interior" name="pintura_interior" class="form-select" required>
                                <option value="">Selecciona...</option>
                                <option value="Sin Cambios">Sin Cambios</option>
                                <option value="Dañado">Dañado</option>
                                <option value="Filtración">Filtración</option>
                            </select>
                        </div>

                        <div class="col-md-5">
                            <label for="pintura_exterior" class="form-label">Pintura Exterior</label>
                            <input class="form-control mb-3" id="pintura_exterior_previa" name="pintura_exterior_previa" placeholder="{{ $adt->infraestructura($adt->ID_ADT)->PINTURA_EXTERIOR }}" readonly/>
                            <select id="pintura_exterior" name="pintura_exterior" class="form-select" required>
                                <option value="">Selecciona...</option>
                                <option value="Sin Cambios">Sin Cambios</option>
                                <option value="Dañado">Dañado</option>
                                <option value="Filtración">Filtración</option>
                            </select>
                        </div>

                    </div>

                    <div class="row g-3 justify-content-center">
                        <div class="col-6">
                            <label for="observaciones" class="form-label">Observaciones</label>
                            <textarea class="form-control mb-3" id="observaciones_previas" name="observaciones_previas" rows="3" placeholder="{{ $adt->infraestructura($adt->ID_ADT)->OBSERVACIONES }}" readonly></textarea>
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
