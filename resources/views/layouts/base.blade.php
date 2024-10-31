<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>
            @yield('title')
        </title>
        <!-- BOOTSTRAP STYLES-->
        <link href="{{ asset('css/PanelMensajeria/bootstrap.css') }}" rel="stylesheet" />

        <!-- FONTAWESOME STYLES-->
        <link href="{{ asset('css/PanelMensajeria/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet">

        <!-- MORRIS CHART STYLES-->
        <link href="{{ asset('css/PanelMensajeria/morris-0.4.3.min.css') }}" rel="stylesheet" />

        <!-- CUSTOM STYLES-->
        <link href="{{ asset('css/PanelMensajeria/custom.css') }}" rel="stylesheet" />

        <!-- GOOGLE FONTS-->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

        @yield('css')
    </head>
    <body>
        <div id="wrapper">
            <!-- /. NAV SIDE  -->
            <nav class="navbar-default navbar-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="main-menu">
                        <li class="text-center">
                            <img src="{{ asset('img/panel.png') }}" class="user-image img-responsive"/>
                            <p id="reloj" style="color: yellow">Texto</p>
                            <input type="number" id="horas" min="0" max="24" value="0">
                            <input type="number" id="minutos" min="0" max="59" value="0">
                            <input type="number" id="segundos" min="0" max="59" value="0">
                            <button class="button-alarm" id="btn_alarma">Fijar</button>

                        </li>

                        <li>
                            <a   href="{{ route('panel.whatsapp') }}"><i class="fa fa-dashboard fa-3x"></i> Panel General</a>
                        </li>

                        <li  >
                            <a   href="{{ route('mensajeria.whatsapp') }}"><i class="fa fa-whatsapp fa-3x" aria-hidden="true"></i> Whatsapp</a>
                        </li>
                        <li  id="telegram-list">
                            <a   href="{{ route('mensajeria.telegram') }}"><i class="fa fa-telegram fa-3x" aria-hidden="true"></i> Telegram</a>
                        </li>
                        <li  id="gmail-list">
                            <a   href="{{ route('mensajeria.gmail') }}"><i class="fa fa-envelope-o fa-3x" aria-hidden="true"></i>Gmail</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- /. NAV SIDE  -->

            <div id="page-wrapper" >
                <div id="page-inner">

                    @yield('contenido')

                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
        <!-- /. WRAPPER  -->

        <!-- JQUERY SCRIPTS -->
        <script src="{{ asset('js/PanelMensajeria/jquery-1.10.2.js') }}"></script>

        <!-- BOOTSTRAP SCRIPTS -->
        <script src="{{ asset('js/PanelMensajeria/bootstrap.min.js') }}"></script>

        <!-- METISMENU SCRIPTS -->
        <script src="{{ asset('js/PanelMensajeria/jquery.metisMenu.js') }}"></script>

        <!-- MORRIS CHART SCRIPTS -->
        <script src="{{ asset('js/PanelMensajeria/morris/raphael-2.1.0.min.js') }}"></script>
        <script src="{{ asset('js/PanelMensajeria/morris/morris.js') }}"></script>

        {{-- RELOJ --}}
        <script>
            let intervalo = setInterval(reloj, 1);

            function reloj(){
                let ahora = new Date();
                h = ahora.getHours().toString();
                m = ahora.getMinutes().toString();
                s = ahora.getSeconds().toString();
                ms = ahora.getMilliseconds().toString();

                horaActual = h + ':' + m + ':' + s + ':' + ms;
                document.getElementById('reloj').textContent = horaActual;

            }
        </script>

        {{-- ALARMA --}}
        <script src="{{ asset('js/PanelMensajeria/alarma.js') }}"></script>

    </body>

    @yield('js')
</html>
