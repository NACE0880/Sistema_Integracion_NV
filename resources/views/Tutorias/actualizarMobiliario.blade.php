{{-- vista extendida del layout --}}
@extends('layouts.tutorias')

@section('title')
    Actualizar Mobiliario
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
                <h2>Seguimiento de Mobiliario</h2>
                <h3>{{ $adt }}</h3>
            </div>


            <form action="{{ route('update.furniture.adt', $adt)}}" method="POST" enctype="multipart/form-data" onsubmit="showLoading()" class="row g-3">
                {{-- Redireccionar a rutas de actualizacion  --}}
                @csrf
                @method('PATCH')

                <div class="row g-3">

                    <div class="row g-3 justify-content-center">
                        <h4>Inventario Inicial</h4>

                        <div class="col-4">
                            <label for="mesa_circular_inicial" class="form-label">MESA CIRCULAR<br>(1.80 m)</label>
                            <input type="number" class="form-control" id="mesa_circular_inicial" name="mesa_circular_inicial" min="0"  step="1" value="1" readonly/>
                        </div>
                        <div class="col-4">
                            <label for="sillas_apilables_inicial" class="form-label">SILLAS<br>APILABLES</label>
                            <input type="number" class="form-control" id="sillas_apilables_inicial" name="sillas_apilables_inicial" min="0"  step="1" value="1" readonly/>
                        </div>
                        <div class="col-4">
                            <label for="mueble_resguardo_inicial" class="form-label">MUEBLE DE RESGUARDO<br>(4.80x.50 m)</label>
                            <input type="number" class="form-control" id="mueble_resguardo_inicial" name="mueble_resguardo_inicial" min="0"  step="1" value="1" readonly/>
                        </div>

                    </div>

                    <div class="row g-3 justify-content-center gap-5">

                        <div class="col-5 ">
                            <label for="mesa_rectangular_grande_inicial" class="form-label">MESA RECTANGULAR GRANDE<br>(1.20 x .90 m)</label>
                            <input type="number" class="form-control" id="mesa_rectangular_grande_inicial" name="mesa_rectangular_grande_inicial" min="0"  step="1" value="1" readonly/>
                        </div>
                        <div class="col-5">
                            <label for="mesa_rectangular_mediana_inicial" class="form-label">MESA RECTANGULAR MEDIANA<br>(.90x60 m)</label>
                            <input type="number" class="form-control" id="mesa_rectangular_mediana_inicial" name="mesa_rectangular_mediana_inicial" min="0"  step="1" value="1" readonly/>
                        </div>

                    </div>

                    <div class="row g-3 justify-content-center mt-5">
                        <h4>Inventario Actual Funcional</h4>

                        <div class="col-4">
                            <label for="mesa_circular_actual" class="form-label">MESA CIRCULAR<br>(1.80 m)</label>
                            <input type="number" class="form-control" id="mesa_circular_actual" name="mesa_circular_actual" min="0"  step="1" value="1" required/>
                        </div>
                        <div class="col-4">
                            <label for="sillas_apilables_actual" class="form-label">SILLAS<br>APILABLES</label>
                            <input type="number" class="form-control" id="sillas_apilables_actual" name="sillas_apilables_actual" min="0"  step="1" value="1" required/>
                        </div>
                        <div class="col-4">
                            <label for="mueble_resguardo_actual" class="form-label">MUEBLE DE RESGUARDO<br>(4.80x.50 m)</label>
                            <input type="number" class="form-control" id="mueble_resguardo_actual" name="mueble_resguardo_actual" min="0"  step="1" value="1" required/>
                        </div>

                    </div>

                    <div class="row g-3 justify-content-center gap-5">

                        <div class="col-5">
                            <label for="mesa_rectangular_grande_actual" class="form-label">MESA RECTANGULAR GRANDE<br>(1.20 x .90 m)</label>
                            <input type="number" class="form-control" id="mesa_rectangular_grande_actual" name="mesa_rectangular_grande_actual" min="0"  step="1" value="1" required/>
                        </div>
                        <div class="col-5">
                            <label for="mesa_rectangular_mediana_actual" class="form-label">MESA RECTANGULAR MEDIANA<br>(.90x60 m)</label>
                            <input type="number" class="form-control" id="mesa_rectangular_mediana_actual" name="mesa_rectangular_mediana_actual" min="0"  step="1" value="1" required/>
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
