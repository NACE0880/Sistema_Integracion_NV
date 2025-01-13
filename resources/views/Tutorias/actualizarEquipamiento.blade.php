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


            <form action="{{ route('update.equipment.adt', $adt)}}" method="POST" enctype="multipart/form-data" onsubmit="showLoading()" class="row g-3">
                {{-- Redireccionar a rutas de actualizacion  --}}
                @csrf
                @method('PATCH')

                <div class="">
                    <div class="row g-3 justify-content-center">
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
                                    <input type="number" class="form-control" id="pc_funcional" name="pc_funcional" min="0" max="{{ $adt->equipamientoInicial($adt->ID_ADT)->PC }}"  step="1" value="{{ $adt->equipamientoFuncional($adt->ID_ADT)->PC }}" required/>
                                </div>
                                <div class="col-2">
                                    <label for="laptop_funcional" class="form-label">Laptop</label>
                                    <input type="number" class="form-control" id="laptop_funcional" name="laptop_funcional" min="0" max="{{ $adt->equipamientoInicial($adt->ID_ADT)->LAPTOP }}"  step="1" value="{{ $adt->equipamientoFuncional($adt->ID_ADT)->LAPTOP }}" required/>
                                </div>
                                <div class="col-2">
                                    <label for="netbook_funcional" class="form-label">Netbook</label>
                                    <input type="number" class="form-control" id="netbook_funcional" name="netbook_funcional" min="0" max="{{ $adt->equipamientoInicial($adt->ID_ADT)->NETBOOK }}"  step="1" value="{{ $adt->equipamientoFuncional($adt->ID_ADT)->NETBOOK }}" required/>
                                </div>
                                <div class="col-2">
                                    <label for="classmate_funcional" class="form-label">Classmate</label>
                                    <input type="number" class="form-control" id="classmate_funcional" name="classmate_funcional" min="0" max="{{ $adt->equipamientoInicial($adt->ID_ADT)->CLASSMATE  }}"  step="1" value="{{ $adt->equipamientoFuncional($adt->ID_ADT)->CLASSMATE }}" required/>
                                </div>
                                <div class="col-2">
                                    <label for="xo_funcional" class="form-label">XO</label>
                                    <input type="number" class="form-control" id="xo_funcional" name="xo_funcional" min="0" max="{{ $adt->equipamientoInicial($adt->ID_ADT)->XO }}"  step="1" value="{{ $adt->equipamientoFuncional($adt->ID_ADT)->XO }}" required/>
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
                                    <input type="number" class="form-control" id="pc_dañado" name="pc_dañado" min="0" max="{{ $adt->equipamientoInicial($adt->ID_ADT)->PC }}"  step="1" value="{{ $adt->equipamientoDañado($adt->ID_ADT)->PC }}" required/>
                                </div>
                                <div class="col-2">
                                    <label for="laptop_dañado" class="form-label">Laptop</label>
                                    <input type="number" class="form-control" id="laptop_dañado" name="laptop_dañado" min="0" max="{{ $adt->equipamientoInicial($adt->ID_ADT)->LAPTOP }}"  step="1" value="{{ $adt->equipamientoDañado($adt->ID_ADT)->LAPTOP }}" required/>
                                </div>
                                <div class="col-2">
                                    <label for="netbook_dañado" class="form-label">Netbook</label>
                                    <input type="number" class="form-control" id="netbook_dañado" name="netbook_dañado" min="0" max="{{ $adt->equipamientoInicial($adt->ID_ADT)->NETBOOK }}"  step="1" value="{{ $adt->equipamientoDañado($adt->ID_ADT)->NETBOOK }}" required/>
                                </div>
                                <div class="col-2">
                                    <label for="classmate_dañado" class="form-label">Classmate</label>
                                    <input type="number" class="form-control" id="classmate_dañado" name="classmate_dañado" min="0" max="{{ $adt->equipamientoInicial($adt->ID_ADT)->CLASSMATE }}"  step="1" value="{{ $adt->equipamientoDañado($adt->ID_ADT)->CLASSMATE }}" required/>
                                </div>
                                <div class="col-2">
                                    <label for="xo_dañado" class="form-label">XO</label>
                                    <input type="number" class="form-control" id="xo_dañado" name="xo_dañado" min="0" max="{{ $adt->equipamientoInicial($adt->ID_ADT)->XO }}"  step="1" value="{{ $adt->equipamientoDañado($adt->ID_ADT)->XO }}" required/>
                                </div>

                            </div>
                        </div>
                        {{-- EQUIPAMIENTO FALTANTE --}}
                        <div class="col-6">
                            <div class="row g-3 justify-content-center">
                                <h4>Equipamiento Faltante</h4>

                                <div class="col-2">
                                    <label for="pc_faltante" class="form-label">PC</label>
                                    <input type="number" class="form-control" id="pc_faltante" name="pc_faltante" min="0" max="{{ $adt->equipamientoInicial($adt->ID_ADT)->PC }}"  step="1" value="{{ $adt->equipamientoFaltante($adt->ID_ADT)->PC }}" required/>
                                </div>
                                <div class="col-2">
                                    <label for="laptop_faltante" class="form-label">Laptop</label>
                                    <input type="number" class="form-control" id="laptop_faltante" name="laptop_faltante" min="0" max="{{ $adt->equipamientoInicial($adt->ID_ADT)->LAPTOP }}"  step="1" value="{{ $adt->equipamientoFaltante($adt->ID_ADT)->LAPTOP }}" required/>
                                </div>
                                <div class="col-2">
                                    <label for="netbook_faltante" class="form-label">Netbook</label>
                                    <input type="number" class="form-control" id="netbook_faltante" name="netbook_faltante" min="0" max="{{ $adt->equipamientoInicial($adt->ID_ADT)->NETBOOK }}"  step="1" value="{{ $adt->equipamientoFaltante($adt->ID_ADT)->NETBOOK }}" required/>
                                </div>
                                <div class="col-2">
                                    <label for="classmate_faltante" class="form-label">Classmate</label>
                                    <input type="number" class="form-control" id="classmate_faltante" name="classmate_faltante" min="0" max="{{ $adt->equipamientoInicial($adt->ID_ADT)->CLASSMATE }}"  step="1" value="{{ $adt->equipamientoFaltante($adt->ID_ADT)->CLASSMATE }}" required/>
                                </div>
                                <div class="col-2">
                                    <label for="xo_faltante" class="form-label">XO</label>
                                    <input type="number" class="form-control" id="xo_faltante" name="xo_faltante" min="0" max="{{ $adt->equipamientoInicial($adt->ID_ADT)->XO }}"  step="1" value="{{ $adt->equipamientoFaltante($adt->ID_ADT)->XO }}" required/>
                                </div>

                            </div>
                        </div>
                    </div>

                    {{-- EQUIPAMIENTO BAJA OPCIONAL --}}
                    <div class="row g-3 justify-content-center mt-5">
                        <h4>Equipamiento Baja Opcional</h4>

                        <div class="col-2">
                            <label for="pc_baja" class="form-label">PC</label>
                            <input type="number" class="form-control" id="pc_baja" name="pc_baja" min="0" max="{{ $adt->equipamientoInicial($adt->ID_ADT)->PC }}"  step="1" value="{{ $adt->equipamientoBaja($adt->ID_ADT)->PC }}" />
                        </div>
                        <div class="col-2">
                            <label for="laptop_baja" class="form-label">Laptop</label>
                            <input type="number" class="form-control" id="laptop_baja" name="laptop_baja" min="0" max="{{ $adt->equipamientoInicial($adt->ID_ADT)->LAPTOP }}"  step="1" value="{{ $adt->equipamientoBaja($adt->ID_ADT)->LAPTOP }}" />
                        </div>
                        <div class="col-2">
                            <label for="netbook_baja" class="form-label">Netbook</label>
                            <input type="number" class="form-control" id="netbook_baja" name="netbook_baja" min="0" max="{{ $adt->equipamientoInicial($adt->ID_ADT)->NETBOOK }}"  step="1" value="{{ $adt->equipamientoBaja($adt->ID_ADT)->NETBOOK }}" />
                        </div>
                        <div class="col-2">
                            <label for="classmate_baja" class="form-label">Classmate</label>
                            <input type="number" class="form-control" id="classmate_baja" name="classmate_baja" min="0" max="{{ $adt->equipamientoInicial($adt->ID_ADT)->CLASSMATE }}"  step="1" value="{{ $adt->equipamientoBaja($adt->ID_ADT)->CLASSMATE }}" />
                        </div>
                        <div class="col-2">
                            <label for="xo_baja" class="form-label">XO</label>
                            <input type="number" class="form-control" id="xo_baja" name="xo_baja" min="0" max="{{ $adt->equipamientoInicial($adt->ID_ADT)->XO }}"  step="1" value="{{ $adt->equipamientoBaja($adt->ID_ADT)->XO }}" />
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
    {{-- Desabilitar entrada por teclado --}}
    <script>
        $("[type='number']").keypress(function (evt) {
            evt.preventDefault();
        });
    </script>

    {{-- Regla contra absurdos --}}
    <script>
        var pcInicial = document.querySelector('#pc_inicial');
        // alert(pcInicial.value)

        var pcFuncional = document.querySelector('#pc_funcional');
        var pcDañado = document.querySelector('#pc_dañado');
        var pcFaltante = document.querySelector('#pc_faltante');
        var pcBaja = document.querySelector('#pc_baja');

        pcFuncional.addEventListener("change", (event) => {
            result = Number(pcFuncional.value) + Number(pcDañado.value) + Number(pcFaltante.value) + Number(pcBaja.value)
            alert(result)
        });

        function 
    </script>

@endsection
