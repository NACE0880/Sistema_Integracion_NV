{{-- vista extendida del layout --}}
@extends('layouts.base')

{{-- introducir solo titulo --}}
@section('title', 'INDEX')

@section('css')

@endsection


@section('contenido')
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Panel General</h2>
                <h5>Estatus Mensual de la API-Whatsapp</h5>
            </div>
        </div>
        <hr />

        <!-- REACUADROS INICIALES  -->
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="panel panel-back noti-box">
                    <span class="icon-box bg-color-blue set-icon">
                        <i class="fa fa-envelope-o"></i>
                    </span>
                    <div class="text-box" >
                        <p class="main-text">{{ $msjenviados_totales }}</p>
                        <p class="text-muted">MENSAJES ENVIADOS</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="panel panel-back noti-box">
                    <span class="icon-box bg-color-darkgray set-icon">
                        <i class="fa fa-envelope-open-o" aria-hidden="true"></i>
                    </span>
                    <div class="text-box" >
                        <p class="main-text">{{ $msjentregados_totales }}</p>
                        <p class="text-muted">MENSAJES ENTREGADOS</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="panel panel-back noti-box">
                    <span class="icon-box bg-color-purple set-icon">
                        <i class="fa fa-bars"></i>
                    </span>
                    <div class="text-box" >
                        <p class="main-text">{{ $conversaciones_totales }}</p>
                        <p class="text-muted">CONVERSACIONES TOTALES</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="panel panel-back noti-box">
                    <span class="icon-box bg-color-green set-icon">
                        <i class="fa fa-credit-card" aria-hidden="true"></i>
                    </span>
                    <div class="text-box" >
                        <p class="main-text">{{ $costo_total }}</p>
                        <p class="text-muted">COSTOS TOTALES</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- ALERTAS  -->
        <hr />
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-back noti-box">
                    <span class="icon-box bg-color-orange">
                        <i class="fa fa-warning"></i>
                    </span>
                    <div class="text-box-simple" >
                        <p class="main-text">ALERTAS API </p>
                        <p class="text-muted">Sin alertas...</p>
                        <hr />
                        <p class="text-muted">Tiempo restante: 00:00:00</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- /. ROW  -->

        <!-- GRAFICO CONVERSACIONES  -->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        HISTORICO DE CONVERSACIONES
                    </div>
                    <div class="panel-body">
                        <span class="label label-primary">MSJ ENVIADOS</span>
                        <span class="label label-default">MSJ ENTREGADOS</span>
                        <span class="label label-info bg-color-purple">CONVERSACIONES</span>
                        <span class="label label-success">COSTOS</span>

                    </div>
                </div>
            </div>
        </div>
        <!-- ./ ROW  -->

        <!-- RECUADROS GRAFICO  -->
        <div class="row">
            <div class="col-md-9 col-sm-12 col-xs-12">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <div id="morris-line-chart"></div>
                    </div>
                </div>
            </div>



            <div class="col-md-3 col-sm-12 col-xs-12">
                <div class="panel panel-primary text-center no-boder bg-color-gray">
                    <div class="panel-body">
                        <i class="fa fa-comments-o fa-5x" aria-hidden="true"></i>
                        <h3>{{ 1000 - $conversaciones_totales }}</h3>
                    </div>
                    <div class="panel-footer back-footer-green">
                        CONVERSACIONES DISPONIBLES
                    </div>
                </div>
                <div class="panel panel-primary text-center no-boder bg-color-gray">
                    <div class="panel-body">
                        <i class="fa fa-mobile fa-5x" aria-hidden="true"></i>
                        <h3>3</h3>
                    </div>
                    <div class="panel-footer back-footer-green">
                        CONTACTOS REGISTRADOS
                    </div>
                </div>
            </div>
        </div>
        <!-- /. ROW  -->

        <!-- /. TABLA CONTACTOS  -->
        <div class="row" >
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Tabla de Contactos Registrados
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombres</th>
                                        <th>Apellidos</th>
                                        <th>Telefono</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Miguel Angel</td>
                                        <td>Jimenez Vazquez</td>
                                        <td>525518794743</td>

                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Jose Alfredo</td>
                                        <td>Valladares Villanueva</td>
                                        <td>527774583223</td>

                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Saul Ivan</td>
                                        <td>Delgadillo</td>
                                        <td>525523237721</td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ./ ROW  -->

    </div>
    <!-- /. PAGE INNER  -->
@endsection

@section('js')
    {{-- GRAFICO LINEAL --}}
    <script>

        (function ($) {
            "use strict";
            var mainApp = {

                main_fun: function () {


                    let hoy = new Date();
                    let mes = hoy.getMonth();
                    let año = hoy.getFullYear().toString();

                    // declaracion de meses en 0 en caso de no obtener data de la API
                    let data_api = [
                        {
                            m: año + '-01-01',
                            a: 0,
                            b: 0,
                            c: 0,
                            d: 0
                        }, {
                            m: año + '-02-01',
                            a: 0,
                            b: 0,
                            c: 0,
                            d: 0
                        }, {
                            m: año + '-03-01',
                            a: 0,
                            b: 0,
                            c: 0,
                            d: 0
                        }, {
                            m: año + '-04-01',
                            a: 0,
                            b: 0,
                            c: 0,
                            d: 0
                        }, {
                            m: año + '-05-01',
                            a: 0,
                            b: 0,
                            c: 0,
                            d: 0
                        }, {
                            m: año + '-06-01',
                            a: 0,
                            b: 0,
                            c: 0,
                            d: 0
                        },
                        {
                            m: año + '-07-01',
                            a: 0,
                            b: 0,
                            c: 0,
                            d: 0
                        }, {
                            m: año + '-08-01',
                            a: 0,
                            b: 0,
                            c: 0,
                            d: 0
                        }, {
                            m: año + '-09-01',
                            a: 0,
                            b: 0,
                            c: 0,
                            d: 0
                        }, {
                            m: año + '-10-01',
                            a: 0,
                            b: 0,
                            c: 0,
                            d: 0
                        }, {
                            m: año + '-11-01',
                            a: 0,
                            b: 0,
                            c: 0,
                            d: 0
                        }, {
                            m: año + '-12-01',
                            a: 0,
                            b: 0,
                            c: 0,
                            d: 0
                        }
                    ];

                    // Obtención de los historicos en un arreglo de meses [[enero,datos],[febrero,datos]]
                    let historicos_enviados = {{ json_encode($historico_enviados) }};
                    let historicos_entregados = {{ json_encode($historico_entregados) }};

                    let historicos_conversaciones = {{ json_encode($historico_conversaciones) }};
                    let historicos_costos = {{ json_encode($historico_costos) }};

                    // INFORMACION ACTUAL
                    data_api[mes].a = {{ $msjenviados_totales }}
                    data_api[mes].b = {{ $msjentregados_totales }}
                    data_api[mes].c = {{ $conversaciones_totales }}
                    data_api[mes].d = {{ $costo_total }}


                    // Edicion de los valores en el gráfico en función del mes
                    for (let i = 0; i < historicos_enviados.length; i++) {

                    // HISTORICOS DEL AÑO
                        // data [ mes-1].campo = historico[mes][datos]
                        data_api[historicos_enviados[i][0]-1].a = historicos_enviados[i][1]
                        data_api[historicos_entregados[i][0]-1].b = historicos_entregados[i][1]
                        data_api[historicos_conversaciones[i][0]-1].c = historicos_conversaciones[i][1]
                        data_api[historicos_costos[i][0]-1].d = historicos_costos[i][1]

                    }

                    /*====================================
                        GRAFICO DE LINEA
                    ======================================*/
                    Morris.Line({
                        element: 'morris-line-chart',
                        data: data_api,
                        xkey: 'm',
                        ykeys: ['a', 'b',  'c',  'd'],
                        labels: ['MSJ ENVIADOS', 'MSJ ENTREGADOS', 'CONVERSACIONES', 'COSTOS'],
                        xLabels: "month",
                        lineColors: ['#428bca', '#999999','#A95DF0', '#00CE6F'],
                        hideHover: 'auto',
                        resize: true
                    });

                },

                initialization: function () {
                    mainApp.main_fun();

                }

            }
            // Inicializando ///

            $(document).ready(function () {
                mainApp.main_fun();
            });

        }(jQuery));

    </script>

@endsection
