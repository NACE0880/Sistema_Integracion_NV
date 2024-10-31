{{-- vista extendida del layout --}}
@extends('layouts.base')

{{-- introducir solo titulo --}}
@section('title', 'Telegram')

@section('css')

@endsection


@section('contenido')

    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2 class="telegram">Mensajes</h2>
                <h5 >Envio de mensajes y Pruebas</h5>
            </div>
        </div>

        <hr />

        <!-- GRUPOS  -->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        REPORTES GLOBALES
                    </div>
                    <div class="panel-body">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="panel panel-back noti-box">
                                <div class="text-box" >

                                    <button class="button-send-telegram" id="reporte-grupo">
                                        <i class="fa fa-paper-plane fa-2x" aria-hidden="true"></i>
                                    </button><br>

                                    <p class="main-text">GRUPO 1</p>
                                    <p class="text-muted">
                                        BDT 123
                                        INCIDENCIAS
                                    </p>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- ./ GRUPOS  -->
        <hr />

        <!-- PERSONALES  -->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        REPORTES INDIVIDUALES
                    </div>
                    <div class="panel-body">
                        <div class="col-md-3 col-sm-6 col-xs-6">
                            <div class="panel panel-back noti-box">

                                <div class="text-box" >

                                    <p class="main-text-lg">Simple</p>
                                    <p class="text-muted">
                                        Texto cubierto
                                    </p>

                                    <button class="button-send-telegram-lg" id="reporte-individual-simple">
                                        <i class="fa fa-paper-plane fa-1x" aria-hidden="true"></i>
                                    </button><br>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6 col-xs-6">
                            <div class="panel panel-back noti-box">

                                <div class="text-box" >

                                    <p class="main-text-lg">Lista</p>
                                    <p class="text-muted">
                                        Listado de Pendientes
                                    </p>

                                    <button class="button-send-telegram-lg" id="reporte-individual-lista">
                                        <i class="fa fa-paper-plane fa-1x" aria-hidden="true"></i>
                                    </button><br>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6 col-xs-6">
                            <div class="panel panel-back noti-box">

                                <div class="text-box" >

                                    <p class="main-text-lg">Claves</p>
                                    <p class="text-muted">
                                        Referencia a tutores y sitios.
                                    </p>

                                    <button class="button-send-telegram-lg" id="reporte-individual-claves">
                                        <i class="fa fa-paper-plane fa-1x" aria-hidden="true"></i>
                                    </button><br>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6 col-xs-6">
                            <div class="panel panel-back noti-box">

                                <div class="text-box" >

                                    <p class="main-text-lg">Completo</p>
                                    <p class="text-muted">
                                        Texto, lista, claves.
                                    </p>

                                    <button class="button-send-telegram-lg" id="reporte-individual-completo">
                                        <i class="fa fa-paper-plane fa-1x" aria-hidden="true"></i>
                                    </button><br>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- ./ PERSONALES  -->
    </div>
    <!-- /. PAGE INNER  -->
@endsection

@section('js')
    {{-- REPORTE GRUPO 1 --}}
    <script src="{{ asset('js/PanelMensajeria/telegram.js') }}"></script>
@endsection
