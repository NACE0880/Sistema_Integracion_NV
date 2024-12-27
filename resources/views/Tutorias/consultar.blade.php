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

    </style>
@endsection


@section('contenido')
    <div class="container form-container">
        <div class="form-header">
            <h2>Modulo en Desarrollo</h2>

            <div class="form-row justify-content-center" >
                <div class="form-group col-md-4">
                    <a href="{{ redirect()->getUrlGenerator()->previous() }}">
                        <label class="btn btn-outline-danger btn-custom">
                            Modulo no Disponible
                        </label>
                    </a>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection

