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
                <h3>{{ $adt->NOMBRE }}</h3>
            </div>


            <form id="formularioMobiliario" action="{{ route('update.furniture.adt', $adt)}}" method="POST" enctype="multipart/form-data" onsubmit="showLoading()" class="row g-3">
                {{-- Redireccionar a rutas de actualizacion  --}}
                @csrf
                @method('PATCH')

                <div class="row g-3">

                    <div class="row g-3 justify-content-center">
                        <h4>Inventario Inicial</h4>

                        <div class="col-4">
                            <label for="mesaCircular_inicial" class="form-label">MESA CIRCULAR<br>(1.80 m)</label>
                            <input type="number" class="form-control" id="mesaCircular_inicial" name="mesaCircular_inicial" min="0"  step="1" value="{{ $adt->mobiliarioInicial($adt->ID_ADT)->MESA_CIRCULAR }}" readonly/>
                        </div>
                        <div class="col-4">
                            <label for="sillas_inicial" class="form-label">SILLAS<br>APILABLES</label>
                            <input type="number" class="form-control" id="sillas_inicial" name="sillas_inicial" min="0"  step="1" value="{{ $adt->mobiliarioInicial($adt->ID_ADT)->SILLAS }}" readonly/>
                        </div>
                        <div class="col-4">
                            <label for="muebleResguardo_inicial" class="form-label">MUEBLE DE RESGUARDO<br>(4.80x.50 m)</label>
                            <input type="number" class="form-control" id="muebleResguardo_inicial" name="muebleResguardo_inicial" min="0"  step="1" value="{{ $adt->mobiliarioInicial($adt->ID_ADT)->MUEBLE_RESGUARDO }}" readonly/>
                        </div>

                    </div>

                    <div class="row g-3 justify-content-center gap-5">

                        <div class="col-5 ">
                            <label for="mesaRectangularGrande_inicial" class="form-label">MESA RECTANGULAR GRANDE<br>(1.20 x .90 m)</label>
                            <input type="number" class="form-control" id="mesaRectangularGrande_inicial" name="mesaRectangularGrande_inicial" min="0"  step="1" value="{{ $adt->mobiliarioInicial($adt->ID_ADT)->MESA_RECTANGULAR_GRANDE }}" readonly/>
                        </div>
                        <div class="col-5">
                            <label for="mesaRectangularMediana_inicial" class="form-label">MESA RECTANGULAR MEDIANA<br>(.90x60 m)</label>
                            <input type="number" class="form-control" id="mesaRectangularMediana_inicial" name="mesaRectangularMediana_inicial" min="0"  step="1" value="{{ $adt->mobiliarioInicial($adt->ID_ADT)->MESA_RECTANGULAR_MEDIANA }}" readonly/>
                        </div>

                    </div>

                    <div class="row g-3 justify-content-center mt-5">
                        <h4>Inventario Actual Funcional</h4>

                        <div class="col-4">
                            <label for="mesaCircular_funcional" class="form-label">MESA CIRCULAR<br>(1.80 m)</label>
                            <input type="number" class="form-control" id="mesaCircular_funcional" name="mesaCircular_funcional" min="0"  step="1" value="{{ $adt->mobiliarioFuncional($adt->ID_ADT)->MESA_CIRCULAR }}" onchange="bloquearIncrementos(this)" required/>
                        </div>
                        <div class="col-4">
                            <label for="sillas_funcional" class="form-label">SILLAS<br>APILABLES</label>
                            <input type="number" class="form-control" id="sillas_funcional" name="sillas_funcional" min="0"  step="1" value="{{ $adt->mobiliarioFuncional($adt->ID_ADT)->SILLAS }}" onchange="bloquearIncrementos(this)" required/>
                        </div>
                        <div class="col-4">
                            <label for="muebleResguardo_funcional" class="form-label">MUEBLE DE RESGUARDO<br>(4.80x.50 m)</label>
                            <input type="number" class="form-control" id="muebleResguardo_funcional" name="muebleResguardo_funcional" min="0"  step="1" value="{{ $adt->mobiliarioFuncional($adt->ID_ADT)->MUEBLE_RESGUARDO }}" onchange="bloquearIncrementos(this)" required/>
                        </div>

                    </div>

                    <div class="row g-3 justify-content-center gap-5">

                        <div class="col-5">
                            <label for="mesaRectangularGrande_funcional" class="form-label">MESA RECTANGULAR GRANDE<br>(1.20 x .90 m)</label>
                            <input type="number" class="form-control" id="mesaRectangularGrande_funcional" name="mesaRectangularGrande_funcional" min="0"  step="1" value="{{ $adt->mobiliarioFuncional($adt->ID_ADT)->MESA_RECTANGULAR_GRANDE }}" onchange="bloquearIncrementos(this)" required/>
                        </div>
                        <div class="col-5">
                            <label for="mesaRectangularMediana_funcional" class="form-label">MESA RECTANGULAR MEDIANA<br>(.90x60 m)</label>
                            <input type="number" class="form-control" id="mesaRectangularMediana_funcional" name="mesaRectangularMediana_funcional" min="0"  step="1" value="{{ $adt->mobiliarioFuncional($adt->ID_ADT)->MESA_RECTANGULAR_MEDIANA }}" onchange="bloquearIncrementos(this)" required/>
                        </div>

                    </div>



                    <div class="row g-3 justify-content-center">
                        <div class="col-6">
                            <label for="observaciones_previas" class="form-label">Observaciones</label>
                            <textarea class="form-control" id="observaciones_previas" name="observaciones_previas" rows="3" placeholder="{{ $adt->mobiliarioFuncional($adt->ID_ADT)->OBSERVACIONES }}" readonly></textarea>
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

{{-- Desabilitar entrada por teclado --}}
    <script>
        $("[type='number']").keypress(function (evt) {
            evt.preventDefault();
        });
        $("[type='number']").keydown(function(){
            return false;
        });
        $("[type='number']").on( "scroll",function(){
            return false;
        });
    </script>

    {{-- Regla contra absurdos --}}
    <script>

        function bloquearIncrementos(input){
            const elemento = input.id.split("_");

            var elementoInicial = document.querySelector(`#${elemento[0]}_inicial`);
            var elementoFuncional = document.querySelector(`#${elemento[0]}_funcional`);


            var resto =  Number(elementoInicial.value) - Number(elementoFuncional.value);

            if (Number(elementoFuncional.value) >= Number(elementoInicial.value)) {
                elementoFuncional.max = elementoFuncional.value;
            }else{
                elementoFuncional.max = (elementoFuncional.value + resto);
            }

            return {resto}
        }
        function calcularMaximos() {
            const elementos = ['mesaCircular', 'sillas','muebleResguardo', 'mesaRectangularGrande', 'mesaRectangularMediana'];
            const inputs = [];

            elementos.forEach(elemento =>{
                inputs.push( document.querySelector(`#${elemento}_inicial`));
            });

            inputs.forEach(input => bloquearIncrementos(input));
            bloquearIncrementos(input);
        }

        document.addEventListener("DOMContentLoaded", function () {
            const formulario = document.getElementById("formularioMobiliario");

            formulario.addEventListener("submit", function(event) {
                const elementos = ['mesaCircular', 'sillas','muebleResguardo', 'mesaRectangularGrande', 'mesaRectangularMediana'];
                let todoBien = true;

                elementos.forEach(elemento => {
                    const campo = document.querySelector(`#${elemento}_inicial`);
                    const resultado = bloquearIncrementos(campo);
                    if (!(resultado.resto >= 0)) {
                        todoBien = false;
                    }
                });

                if (!todoBien) {
                    event.preventDefault();
                    alert("El mobiliario capturado no coincide con el mobiliario resgistrado.");
                } else {
                    showLoading();
                }
            });
        });

        window.onload = calcularMaximos;
    </script>
@endsection
