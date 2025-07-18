{{-- vista extendida del layout --}}
@extends('layouts.tutorias')

@section('title')
    Actualizar Contacto
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

    </style>
@endsection


@section('contenido')
    <div class="container form-container">
            <div class="form-header">
                <h2>Actualizar Contacto</h2>
            </div>

            <form action="{{ route('update.contact.adt', $adt)}}" method="POST" enctype="multipart/form-data" onsubmit="showLoading()" class="row g-3">

                {{-- Redireccionar a rutas de actualizacion  --}}
                @csrf
                @method('PATCH')
                {{-- Responsable Aula 1 --}}
                <div class="row g-3">
                    <h4>Responsable del Aula</h4>
                    <div class="row g-1">
                        <div class="col-4">
                            <label for="r1_nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="r1_nombre" name="r1_nombre" value="{{ $adt->responsableAula($adt->ID_ADT)->NOMBRE }}" required>
                        </div>

                        <div class="col-4">
                            <label for="r1_cargo" class="form-label">Cargo</label>
                            <input type="text" class="form-control" id="r1_cargo" name="r1_cargo" value="{{ $adt->responsableAula($adt->ID_ADT)->CARGO }}" required>
                        </div>

                    </div>

                    <div class="row g-1">
                        <div class="col-4">
                            <label for="r1_telefono" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="r1_telefono" name="r1_telefono" value="{{ $adt->responsableAula($adt->ID_ADT)->TELEFONO }}" required>
                        </div>

                        <div class="col-4">
                            <label for="r1_celular" class="form-label">Celular</label>
                            <input type="text" class="form-control" id="r1_celular" name="r1_celular" value="{{ $adt->responsableAula($adt->ID_ADT)->CELULAR }}" required>
                        </div>

                    </div>
                    <div class="row g-1">
                        <div class="col-4">
                            <label for="r1_correo" class="form-label">Correo</label>
                            <input type="email" class="form-control" id="r1_correo" name="r1_correo" value="{{ $adt->responsableAula($adt->ID_ADT)->CORREO }}" required>
                        </div>
                    </div>
                </div>

                {{-- Responsable Aula 2 Opcional --}}
                <div class="row g-3">
                    <h4>Responsable del Aula Adicional (Opcional)</h4>
                    <div class="row g-1">
                        <div class="col-4">
                            <label for="r2_nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="r2_nombre" name="r2_nombre" value="{{ $adt->responsableAulaExtra($adt->ID_ADT)->NOMBRE }}">
                        </div>

                        <div class="col-4">
                            <label for="r2_cargo" class="form-label">Cargo</label>
                            <input type="text" class="form-control" id="r2_cargo" name="r2_cargo" value="{{ $adt->responsableAulaExtra($adt->ID_ADT)->CARGO }}">
                        </div>

                    </div>

                    <div class="row g-1">
                        <div class="col-4">
                            <label for="r2_telefono" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="r2_telefono" name="r2_telefono" value="{{ $adt->responsableAulaExtra($adt->ID_ADT)->TELEFONO }}">
                        </div>

                        <div class="col-4">
                            <label for="r2_celular" class="form-label">Celular</label>
                            <input type="text" class="form-control" id="r2_celular" name="r2_celular" value="{{ $adt->responsableAulaExtra($adt->ID_ADT)->CELULAR }}">
                        </div>

                    </div>
                    <div class="row g-1">
                        <div class="col-4">
                            <label for="r2_correo" class="form-label">Correo</label>
                            <input type="email" class="form-control" id="r2_correo" name="r2_correo" value="{{ $adt->responsableAulaExtra($adt->ID_ADT)->CORREO }}">
                        </div>

                    </div>
                </div>

                {{-- Contacto Municipal/Director  --}}
                <div class="row g-3">
                    <h4>Contacto Municipal/Director</h4>
                    <div class="row g-1">
                        <div class="col-4">
                            <label for="md_nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="md_nombre" name="md_nombre" value="{{ $adt->contactoMunicipal($adt->ID_ADT)->NOMBRE }}" required>
                        </div>

                        <div class="col-4">
                            <label for="md_cargo" class="form-label">Cargo</label>
                            <input type="text" class="form-control" id="md_cargo" name="md_cargo" value="{{ $adt->contactoMunicipal($adt->ID_ADT)->CARGO }}" required>
                        </div>

                    </div>

                    <div class="row g-1">
                        <div class="col-4">
                            <label for="md_telefono" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="md_telefono" name="md_telefono" value="{{ $adt->contactoMunicipal($adt->ID_ADT)->TELEFONO }}" required>
                        </div>

                        <div class="col-4">
                            <label for="md_celular" class="form-label">Celular</label>
                            <input type="text" class="form-control" id="md_celular" name="md_celular" value="{{ $adt->contactoMunicipal($adt->ID_ADT)->CELULAR }}" required>
                        </div>

                    </div>
                    <div class="row g-1">
                        <div class="col-4">
                            <label for="md_correo" class="form-label">Correo</label>
                            <input type="email" class="form-control" id="md_correo" name="md_correo" value="{{ $adt->contactoMunicipal($adt->ID_ADT)->CORREO }}" required>
                        </div>

                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-6">
                        <button type="submit" class="btn btn-primary btn-custom">Guardar</button>
                    </div>
                    <div class="col-6">
                        <a  class="btn btn-danger btn-custom" href="{{ route('consultar.tutoria') }}">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
@endsection