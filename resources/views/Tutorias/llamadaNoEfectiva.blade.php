{{-- vista extendida del layout --}}
@extends('layouts.tutorias')

@section('title')
    Llamada No Efectiva
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
                <h2>Llamada No Efectiva</h2>
                <h3>{{ $adt->NOMBRE }} - {{$adt->CLAVE}}</h3>
            </div>

            <form action="{{ route('call.fail.adt', $adt)}}" method="POST" enctype="multipart/form-data" onsubmit="showLoading()" class="row g-3">

                {{-- Redireccionar a rutas de actualizacion  --}}
                @csrf
                <div class="row g-3">
                    <div class="row g-1">
                        <div class="col-md-6">
                            <label for="motivo" class="form-label">Motivo</label>
                            <select id="motivo" name="motivo" class="form-select" required>
                                <option value="">Selecciona...</option>
                                <option value="No responde">No responde</option>
                                <option value="No localizado">No localizado</option>
                                <option value="Encargado ausente">Encargado ausente</option>
                            </select>
                        </div>


                        <div class="col-6">
                            <label for="observaciones" class="form-label">Observaciones</label>
                            <textarea class="form-control" id="observaciones" name="observaciones" rows="3" maxlength="200" placeholder="Max 200 caracteres" required></textarea>
                        </div>
                    </div>

                </div>


                <div class="row g-3">
                    <div class="col-6">
                        <button type="submit" class="btn btn-primary btn-custom">Finalizar</button>
                    </div>
                    <div class="col-6">
                        <a  class="btn btn-danger btn-custom" href="{{ route('consultar.tutoria') }}">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
@endsection


@section('js')




@endsection
