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
                <h2>Seguimiento de Equipamiento</h2>
                <h3>{{ $adt->NOMBRE }} - {{$adt->CLAVE}}</h3>

            </div>


            <form id="formularioEquipamiento" action="{{ route('update.equipment.adt', $adt)}}" method="POST" enctype="multipart/form-data" class="row g-3">
                {{-- Redireccionar a rutas de actualizacion  --}}
                @csrf
                @method('PATCH')

                <div class="">
                    <div class="row g-3 justify-content-center mt-5">
                        {{-- EQUIPAMIENTO INICIAL --}}
                        <div class="col-6">
                            <div class="row g-3 justify-content-center">
                                <h4>Equipamiento Inicial</h4>

                                <div class="col-2">
                                    <label for="pc_inicial" class="form-label">PC</label>
                                    <input type="number" class="form-control" id="pc_inicial" name="pc_inicial" min="0" step="1" value="{{ $adt->equipamientoInicial($adt->ID_ADT)->PC }}" readonly/>
                                </div>
                                <div class="col-2">
                                    <label for="laptop_inicial" class="form-label">Laptop</label>
                                    <input type="number" class="form-control" id="laptop_inicial" name="laptop_inicial" min="0" step="1" value="{{ $adt->equipamientoInicial($adt->ID_ADT)->LAPTOP }}" readonly/>
                                </div>
                                <div class="col-2">
                                    <label for="netbook_inicial" class="form-label">Netbook</label>
                                    <input type="number" class="form-control" id="netbook_inicial" name="netbook_inicial" min="0" step="1" value="{{ $adt->equipamientoInicial($adt->ID_ADT)->NETBOOK }}" readonly/>
                                </div>
                                <div class="col-2">
                                    <label for="classmate_inicial" class="form-label">Classmate</label>
                                    <input type="number" class="form-control" id="classmate_inicial" name="classmate_inicial" min="0" step="1" value="{{ $adt->equipamientoInicial($adt->ID_ADT)->CLASSMATE }}" readonly/>
                                </div>
                                <div class="col-2">
                                    <label for="xo_inicial" class="form-label">XO</label>
                                    <input type="number" class="form-control" id="xo_inicial" name="xo_inicial" min="0" step="1" value="{{ $adt->equipamientoInicial($adt->ID_ADT)->XO }}" readonly/>
                                </div>

                            </div>
                        </div>
                        {{-- EQUIPAMIENTO FUNCIONAL --}}
                        <div class="col-6">
                            <div class="row g-3 justify-content-center">
                                <h4>Equipamiento Funcional</h4>

                                <div class="col-2">
                                    <label for="pc_funcional" class="form-label">PC</label>
                                    <input type="number" class="form-control" id="pc_funcional" name="pc_funcional" min="0"  step="1" value="{{ $adt->equipamientoFuncional($adt->ID_ADT)->PC }}" onchange="bloquearIncrementos(this)" required/>
                                </div>
                                <div class="col-2">
                                    <label for="laptop_funcional" class="form-label">Laptop</label>
                                    <input type="number" class="form-control" id="laptop_funcional" name="laptop_funcional" min="0"   step="1" value="{{ $adt->equipamientoFuncional($adt->ID_ADT)->LAPTOP }}" onchange="bloquearIncrementos(this)" required/>
                                </div>
                                <div class="col-2">
                                    <label for="netbook_funcional" class="form-label">Netbook</label>
                                    <input type="number" class="form-control" id="netbook_funcional" name="netbook_funcional" min="0"  step="1" value="{{ $adt->equipamientoFuncional($adt->ID_ADT)->NETBOOK }}" onchange="bloquearIncrementos(this)" required/>
                                </div>
                                <div class="col-2">
                                    <label for="classmate_funcional" class="form-label">Classmate</label>
                                    <input type="number" class="form-control" id="classmate_funcional" name="classmate_funcional" min="0" max="{{ $adt->equipamientoInicial($adt->ID_ADT)->CLASSMATE  }}"  step="1" value="{{ $adt->equipamientoFuncional($adt->ID_ADT)->CLASSMATE }}" onchange="bloquearIncrementos(this)" required/>
                                </div>
                                <div class="col-2">
                                    <label for="xo_funcional" class="form-label">XO</label>
                                    <input type="number" class="form-control" id="xo_funcional" name="xo_funcional" min="0"  step="1" value="{{ $adt->equipamientoFuncional($adt->ID_ADT)->XO }}" onchange="bloquearIncrementos(this)" required/>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row g-3 justify-content-center mt-5">
                        {{-- EQUIPAMIENTO DAÑADO --}}
                        <div class="col-6">
                            <div class="row g-3 justify-content-center">
                                <h4>Equipamiento Dañado</h4>

                                <div class="col-2">
                                    <label for="pc_dañado" class="form-label">PC</label>
                                    <input type="number" class="form-control" id="pc_dañado" name="pc_dañado" min="0"  step="1" value="{{ $adt->equipamientoDañado($adt->ID_ADT)->PC }}" onchange="bloquearIncrementos(this)" required/>
                                </div>
                                <div class="col-2">
                                    <label for="laptop_dañado" class="form-label">Laptop</label>
                                    <input type="number" class="form-control" id="laptop_dañado" name="laptop_dañado" min="0"  step="1" value="{{ $adt->equipamientoDañado($adt->ID_ADT)->LAPTOP }}" onchange="bloquearIncrementos(this)" required/>
                                </div>
                                <div class="col-2">
                                    <label for="netbook_dañado" class="form-label">Netbook</label>
                                    <input type="number" class="form-control" id="netbook_dañado" name="netbook_dañado" min="0"  step="1" value="{{ $adt->equipamientoDañado($adt->ID_ADT)->NETBOOK }}" onchange="bloquearIncrementos(this)" required/>
                                </div>
                                <div class="col-2">
                                    <label for="classmate_dañado" class="form-label">Classmate</label>
                                    <input type="number" class="form-control" id="classmate_dañado" name="classmate_dañado" min="0" value="{{ $adt->equipamientoDañado($adt->ID_ADT)->CLASSMATE }}" onchange="bloquearIncrementos(this)" required/>
                                </div>
                                <div class="col-2">
                                    <label for="xo_dañado" class="form-label">XO</label>
                                    <input type="number" class="form-control" id="xo_dañado" name="xo_dañado" min="0"  step="1" value="{{ $adt->equipamientoDañado($adt->ID_ADT)->XO }}" onchange="bloquearIncrementos(this)" required/>
                                </div>

                            </div>
                        </div>
                        {{-- EQUIPAMIENTO FALTANTE --}}
                        <div class="col-6">
                            <div class="row g-3 justify-content-center">
                                <h4>Equipamiento Faltante</h4>

                                <div class="col-2">
                                    <label for="pc_faltante" class="form-label">PC</label>
                                    <input type="number" class="form-control" id="pc_faltante" name="pc_faltante" min="0"  step="1" value="{{ $adt->equipamientoFaltante($adt->ID_ADT)->PC }}" onchange="bloquearIncrementos(this)" required/>
                                </div>
                                <div class="col-2">
                                    <label for="laptop_faltante" class="form-label">Laptop</label>
                                    <input type="number" class="form-control" id="laptop_faltante" name="laptop_faltante" min="0"   step="1" value="{{ $adt->equipamientoFaltante($adt->ID_ADT)->LAPTOP }}" onchange="bloquearIncrementos(this)" required/>
                                </div>
                                <div class="col-2">
                                    <label for="netbook_faltante" class="form-label">Netbook</label>
                                    <input type="number" class="form-control" id="netbook_faltante" name="netbook_faltante" min="0"  step="1" value="{{ $adt->equipamientoFaltante($adt->ID_ADT)->NETBOOK }}" onchange="bloquearIncrementos(this)" required/>
                                </div>
                                <div class="col-2">
                                    <label for="classmate_faltante" class="form-label">Classmate</label>
                                    <input type="number" class="form-control" id="classmate_faltante" name="classmate_faltante" min="0" value="{{ $adt->equipamientoFaltante($adt->ID_ADT)->CLASSMATE }}" onchange="bloquearIncrementos(this)" required/>
                                </div>
                                <div class="col-2">
                                    <label for="xo_faltante" class="form-label">XO</label>
                                    <input type="number" class="form-control" id="xo_faltante" name="xo_faltante" min="0"  step="1" value="{{ $adt->equipamientoFaltante($adt->ID_ADT)->XO }}" onchange="bloquearIncrementos(this)" required/>
                                </div>

                            </div>
                        </div>
                    </div>

                    {{-- EQUIPAMIENTO BAJA OPCIONAL --}}
                    <div class="row g-3 justify-content-center mt-5">
                        <h4>Equipamiento Baja Opcional</h4>

                        <div class="col-2">
                            <label for="pc_baja" class="form-label">PC</label>
                            <input type="number" class="form-control" id="pc_baja" name="pc_baja" min="0"  step="1" value="{{ $adt->equipamientoBaja($adt->ID_ADT)->PC }}"  onchange="bloquearIncrementos(this)"/>
                        </div>
                        <div class="col-2">
                            <label for="laptop_baja" class="form-label">Laptop</label>
                            <input type="number" class="form-control" id="laptop_baja" name="laptop_baja" min="0"   step="1" value="{{ $adt->equipamientoBaja($adt->ID_ADT)->LAPTOP }}"  onchange="bloquearIncrementos(this)"/>
                        </div>
                        <div class="col-2">
                            <label for="netbook_baja" class="form-label">Netbook</label>
                            <input type="number" class="form-control" id="netbook_baja" name="netbook_baja" min="0"  step="1" value="{{ $adt->equipamientoBaja($adt->ID_ADT)->NETBOOK }}"  onchange="bloquearIncrementos(this)"/>
                        </div>
                        <div class="col-2">
                            <label for="classmate_baja" class="form-label">Classmate</label>
                            <input type="number" class="form-control" id="classmate_baja" name="classmate_baja" min="0" value="{{ $adt->equipamientoBaja($adt->ID_ADT)->CLASSMATE }}"  onchange="bloquearIncrementos(this)"/>
                        </div>
                        <div class="col-2">
                            <label for="xo_baja" class="form-label">XO</label>
                            <input type="number" class="form-control" id="xo_baja" name="xo_baja" min="0"  step="1" value="{{ $adt->equipamientoBaja($adt->ID_ADT)->XO }}"  onchange="bloquearIncrementos(this)"/>
                        </div>

                    </div>

                    <div class="row g-3 mt-5" >
                        <div class="col-6">
                            <label for="observaciones_previas" class="form-label">Observaciones</label>
                            <textarea class="form-control" id="observaciones_previas" name="observaciones_previas" rows="3" placeholder="{{ $adt->equipamientoFuncional($adt->ID_ADT)->OBSERVACIONES }}" readonly></textarea>
                        </div>
                         <div class="col-6">
                            <label for="observaciones" class="form-label">Observaciones</label>
                            <textarea class="form-control" id="observaciones" name="observaciones" rows="3" maxlength="200" placeholder="Máximo 200 caracteres." required></textarea>
                        </div>
                    </div>
                </div>


                <div class="row g-3 justify-content-center mt-5">
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
            var elementoDañado = document.querySelector(`#${elemento[0]}_dañado`);
            var elementoFaltante = document.querySelector(`#${elemento[0]}_faltante`);
            var elementoBaja = document.querySelector(`#${elemento[0]}_baja`);

            var suma = Number(elementoFuncional.value) + Number(elementoDañado.value) + Number(elementoFaltante.value) + Number(elementoBaja.value);
            var resto =  Number(elementoInicial.value) - suma;

            var elementoInicialNumero = Number(elementoInicial.value);

            if (suma >= Number(elementoInicial.value)) {
                elementoFuncional.max = elementoFuncional.value;
                elementoDañado.max = elementoDañado.value;
                elementoFaltante.max = elementoFaltante.value;
                elementoBaja.max = elementoBaja.value;
            }else{
                elementoFuncional.max = (elementoFuncional.value + resto);
                elementoDañado.max = (elementoDañado.value + resto);
                elementoFaltante.max = (elementoFaltante.value + resto);
                elementoBaja.max = (elementoBaja.value + resto);
            }

            return {suma, elementoInicialNumero};
        }
        
        function calcularMaximos() {
            const elementos = ['pc', 'laptop','netbook', 'classmate', 'xo'];
            const inputs = [];

            elementos.forEach(elemento =>{
                inputs.push( document.querySelector(`#${elemento}_inicial`));
            });

            inputs.forEach(input => bloquearIncrementos(input));
            //bloquearIncrementos(input);
        }

        document.addEventListener("DOMContentLoaded", function () {
            const formulario = document.getElementById("formularioEquipamiento");

            formulario.addEventListener("submit", function(event) {
                const elementos = ['pc', 'laptop','netbook', 'classmate', 'xo'];
                let todoBien = true;

                elementos.forEach(elemento => {
                    const campo = document.querySelector(`#${elemento}_inicial`);
                    const resultado = bloquearIncrementos(campo);
                    if (resultado.suma !== resultado.elementoInicialNumero) {
                        todoBien = false;
                    }
                });

                if (!todoBien) {
                    event.preventDefault();
                    alert("Los equipos capturados no coinciden con el equipamiento registrado.");
                } else {
                    showLoading();
                }
            });
        });

        window.onload = calcularMaximos;
    </script>

@endsection
