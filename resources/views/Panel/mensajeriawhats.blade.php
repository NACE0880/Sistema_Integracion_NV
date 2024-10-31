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
                <h2>Mensajes</h2>
                <p class=""></p>
                <h5>Envio de mensajes y Pruebas</h5>
            </div>
        </div>

        <hr />
        <!-- /. VARIABLES  -->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-back noti-box">
                    <span class="icon-box bg-color-red">
                        <i class="fa fa-warning"></i>
                    </span>
                    <div class="text-box-simple" >
                        <p class="main-text">BLOQUEAR MENSAJES</p>
                        <p class="text-muted">Variables a trabajar</p>
                        <hr />

                        <div class="panel panel-default">

                            <div class="panel-body">

                                <div class="col-md-3 col-sm-6 col-xs-6">
                                    <div class="panel panel-back noti-box">

                                        <div class="text-box" >
                                            <p class="main-text">{{ $msjenviados_totales }}</p>
                                            <p class="text-muted">MENSAJES ENVIADOS</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-6">
                                    <div class="panel panel-back noti-box">

                                        <div class="text-box" >
                                            <p class="main-text">{{ $msjentregados_totales }}</p>
                                            <p class="text-muted">MENSAJES ENTREGADOS</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-6">
                                    <div class="panel panel-back noti-box">

                                        <div class="text-box" >
                                            <p class="main-text">{{ $conversaciones_totales }} / {{ $limite_conversaciones }} </p>
                                            <p class="text-muted">CONVERSACIONES</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-6">
                                    <div class="panel panel-back noti-box">

                                        <div class="text-box" >
                                            <p class="main-text">{{ $costo_total }} / {{ $limite_costos }}</p>
                                            <p class="text-muted">COSTOS</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Rounded switch -->
                    <label class="switch">
                        <input type="checkbox" id="checkbox">
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>

        </div>
        <!-- /. ROW  -->
        <hr />

        <!-- /. PLANTILLAS  -->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        PLANTILLAS
                    </div>
                    <div class="panel-body">

                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="panel panel-back noti-box">
                                <div class="text-box" >

                                    <button class="button-send" id="hello_world">
                                        <i class="fa fa-paper-plane fa-2x" aria-hidden="true"></i>
                                    </button><br>

                                    <p class="main-text">hello <br>
                                        world</p>
                                    <p class="text-muted">
                                        Utilidad
                                        English (US)
                                    </p>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="panel panel-back noti-box">
                                <div class="text-box" >

                                    <button class="button-send" id="notificacion_diaria">
                                        <i class="fa fa-paper-plane fa-2x" aria-hidden="true"></i>
                                    </button><br>

                                    <p class="main-text">notificacion <br>
                                        diaria</p>
                                    <p class="text-muted">
                                        Utilidad
                                        Spanish (MEX)
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- ./ ROW  -->

        <!-- /. REPORTES  -->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        REPORTES
                    </div>
                    <div class="panel-body">
                        <div class="col-md-2 col-sm-6 col-xs-6">
                            <div class="panel panel-back noti-box">

                                <div class="text-box" >

                                    <p class="main-text-lg">Reporte</p>
                                    <p class="text-muted">
                                        header, body, footer, link
                                    </p>

                                    <button class="button-send-lg" id="reporte">
                                        <i class="fa fa-paper-plane fa-1x" aria-hidden="true"></i>
                                    </button><br>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-2 col-sm-6 col-xs-6">
                            <div class="panel panel-back noti-box">

                                <div class="text-box" >

                                    <p class="main-text-lg">Actualización Tutoría</p>
                                    <p class="text-muted">
                                        Estado: Completo - Seguimiento
                                    </p>

                                    <button class="button-send-lg" id="actualizacion_tutoria">
                                        <i class="fa fa-paper-plane fa-1x" aria-hidden="true"></i>
                                    </button><br>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-2 col-sm-6 col-xs-6">
                            <div class="panel panel-back noti-box">

                                <div class="text-box" >

                                    <p class="main-text-lg">Reporte Atención_1</p>
                                    <p class="text-muted">
                                        Listado BDT: primer dia habil del mes.
                                    </p>

                                    <button class="button-send-lg" id="reporte_atencion_1">
                                        <i class="fa fa-paper-plane fa-1x" aria-hidden="true"></i>
                                    </button><br>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-2 col-sm-6 col-xs-6">
                            <div class="panel panel-back noti-box">

                                <div class="text-box" >

                                    <p class="main-text-lg">Reporte Atención_2</p>
                                    <p class="text-muted">
                                        Semana 1 y 2 Jueves. <br>
                                        Semana 3 y 4 Martes, Jueves.
                                    </p>

                                    <button class="button-send-lg" id="reporte_atencion_2">
                                        <i class="fa fa-paper-plane fa-1x" aria-hidden="true"></i>
                                    </button><br>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-2 col-sm-6 col-xs-6">
                            <div class="panel panel-back noti-box">

                                <div class="text-box" >

                                    <p class="main-text-lg">Reporte Mediciones</p>
                                    <p class="text-muted">
                                        Mediciones y seguimientos en mail.
                                    </p>

                                    <button class="button-send-lg" id="reporte_mediciones">
                                        <i class="fa fa-paper-plane fa-1x" aria-hidden="true"></i>
                                    </button><br>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-2 col-sm-6 col-xs-6">
                            <div class="panel panel-back noti-box">

                                <div class="text-box" >

                                    <p class="main-text-lg">Incidencias</p>
                                    <p class="text-muted">
                                        Robos. Fallas de Internet, BDT Cerradas, Solicitudes, Equipos Dañados, Mesa Ayuda.
                                    </p>

                                    <button class="button-send-lg" id="incidencias">
                                        <i class="fa fa-paper-plane fa-1x" aria-hidden="true"></i>
                                    </button><br>

                                </div>
                            </div>
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
    {{-- MENSAJES --}}
    <script>
        let chequeada = false;
        let costos = {{ $costo_total }};
        let conversaciones = {{ $conversaciones_totales }};
        let limiteConversaciones = {{ $limite_conversaciones }};//900
        let limiteCostos = {{ $limite_costos }}
    </script><script src="{{ asset('js/PanelMensajeria/whatsapp.js') }}"></script>

@endsection
