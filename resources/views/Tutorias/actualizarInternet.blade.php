{{-- vista extendida del layout --}}
@extends('layouts.tutorias')

@section('title')
    Actualizar Internet
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
                <h2>Seguimiento de Internet</h2>
                <h3>{{ $adt->NOMBRE }}</h3>
            </div>


            <form action="{{ route('update.internet.adt', $adt)}}" method="POST" enctype="multipart/form-data" onsubmit="showLoading()" class="row g-3">
                {{-- Redireccionar a rutas de actualizacion  --}}
                @csrf
                @method('PATCH')


                <div class="row g-3">

                    <div class="row g-3 justify-content-center">

                        <div class="col-4">
                            <label for="linea" class="form-label">Linea Infinitum</label>
                            <input type="text" class="form-control" id="linea" name="linea" value="{{$adt->linea->LINEA}}" required/>

                        </div>
                        <div class="col-4">
                            <label for="dependencia" class="form-label">Aporta Conectividad</label>
                            <input type="text" class="form-control" id="dependencia" name="dependencia" value="{{$adt->linea->APORTA}}"  required>
                        </div>
                        <div class="col-4">
                            <label for="dependencia_pago" class="form-label">Paga Conectividad</label>
                            <input type="text" class="form-control" id="dependencia_pago" name="dependencia_pago" value="{{$adt->linea->PAGA}}"  required>
                        </div>

                    </div>

                    <div class="row g-3 justify-content-center">

                        <div class="col-4">
                            <label for="ancho_banda" class="form-label">Ancho de Banda (MB)</label>
                            <input type="number" class="form-control" id="ancho_banda" name="ancho_banda" min="0"  step="1" value="{{$adt->linea->ANCHO_BANDA}}" required/>

                        </div>
                        <div class="col-4">
                            <label for="tecnologia" class="form-label">Tecnología</label>
                            <input type="text" class="form-control" id="tecnologia" name="tecnologia" value="{{$adt->linea->TECNOLOGIA}}"  required>
                        </div>
                        <div class="col-4">
                            <label for="semaforo" class="form-label">Semáforo de Uso</label>
                            <input type="text" class="form-control" id="semaforo" name="semaforo" value="{{$adt->linea->SEMAFORO}}"  required>
                        </div>

                    </div>

                    <div class="row g-3 mt-5">
                        <div class="col-6">
                            <label for="observaciones_previas" class="form-label">Observaciones</label>
                            <textarea class="form-control" id="observaciones_previas" name="observaciones_previas" rows="3" placeholder="{{ $adt->linea->OBSERVACIONES }}" readonly></textarea>
                        </div>
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
