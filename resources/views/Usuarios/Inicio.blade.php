<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
            Usuarios
        </title>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- Bootstrap CSS -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <style>
        .container {
            max-width: 100%;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 8px;
        }

        .campo-wrapper {
            position: relative;
        }

        .campo-wrapper::after {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            cursor: pointer;
            pointer-events: auto;
            z-index: 2;
        }

        .campo-wrapper input { 
            position: relative; 
            z-index: 1; 
        }
    </style>
    <body>
        <div class="container mt-2 mb-2">
            @auth
            <ul class="nav nav-tabs justify-content-center">
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('usuarios.inicio') ? 'active' : '' }}" href="{{ route('usuarios.inicio') }}"> <i class="fa-solid fa-house"></i> Usuarios </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
                        {{ Auth::user()->userable->NOMBRE }} <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('home') }}">
                                Menu
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            Cerrar Sesión
                        </a>
                    </div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
            @endauth
            @include('Usuarios.Tabla')
            <div class="col-12 text-center">
                <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modalGeneralUsuarios" data-titulo="Nuevo Usuario">
                    Registrar Usuario
                </button>
            </div>
            @include('Usuarios.modal')
            <!-- Bootstrap JS and dependencies -->
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        </div>
    </body>
</html>
<script>
    $(document).ready(function () {
        let nombreClaveUsuario = '';
        const baseUrlModificacion = @json(url('/usuarios/inicio/modificacion'));
        const baseUrlEliminacion = @json(url('/usuarios/inicio/eliminacion'));

        $('.campo-wrapper').on('click', function () {
            const nombreCampoSeleccionado = $(this).data('campo');
            const campoSeleccionado = $(nombreCampoSeleccionado);

            if (campoSeleccionado.prop('disabled')) {
                campoSeleccionado.prop('disabled', false).focus();
            }
        });

        $('#modalGeneralUsuarios').on('show.bs.modal', function (event) {
            const evento = $(event.relatedTarget);
            const modalActualizacionUsuarios = $(this);
            const tipoDeEventoLink = evento.is('a');

            const tituloDelEvento = evento.data('titulo');
            const nombreDelEvento = evento.data('nombre');
            const correoDelEvento = evento.data('correo');
            const telegramDelEvento = evento.data('telegram-coordinador');
            nombreClaveUsuario = evento.data('nombre-clave-usuario') || '';

            modalActualizacionUsuarios.find('#grupo_campos_telegram').hide();
            modalActualizacionUsuarios.find('#grupo_campos_casa_director').hide();

            if (tipoDeEventoLink) {
                modalActualizacionUsuarios.find('#nombre, #correo, #telegram, #contrasena').prop('disabled', true);
            }

            modalActualizacionUsuarios.find('.modal-title').text(tituloDelEvento);
            modalActualizacionUsuarios.find('#nombre').val(nombreDelEvento);
            modalActualizacionUsuarios.find('#correo').val(correoDelEvento);
            modalActualizacionUsuarios.find('#telegram').val(telegramDelEvento);
            modalActualizacionUsuarios.find('#nombre_clave_usuario').val(nombreClaveUsuario);

            const existenciaNombreClaveUsuario = !!nombreClaveUsuario;
            //modalActualizacionUsuarios.find('#nombre').prop('disabled', existenciaNombreClaveUsuario);
            //modalActualizacionUsuarios.find('#correo').prop('disabled', existenciaNombreClaveUsuario);
            modalActualizacionUsuarios.find('#botonRegistrar').toggle(!existenciaNombreClaveUsuario);
            modalActualizacionUsuarios.find('#botonModificar').toggle(existenciaNombreClaveUsuario);
            modalActualizacionUsuarios.find('#botonEliminar').toggle(existenciaNombreClaveUsuario);
        });

        $('#rol').on('change', function () {
            const valoresRolesSeleccionados = $(this).val();
            const grupoCamposTelegram = $('#grupo_campos_telegram');
            const grupoCamposCasaCoordinador = $('#grupo_campos_casa_director');

            if (Array.isArray(valoresRolesSeleccionados) && valoresRolesSeleccionados.includes('coordinador')) {
                grupoCamposTelegram.show();
            } else {
                grupoCamposTelegram.hide();
            }

            if (Array.isArray(valoresRolesSeleccionados) && valoresRolesSeleccionados.includes('director')) {
                grupoCamposCasaCoordinador.show();
            } else {
                grupoCamposCasaCoordinador.hide();
            }
        });

        $('#modalGeneralUsuarios').on('hidden.bs.modal', function () {
            const modalActualizacionUsuarios = $(this);
            nombreClaveUsuario = '';

            modalActualizacionUsuarios.find('#nombre_clave_usuario').val('');
            //modalActualizacionUsuarios.find('#nombre').prop('disabled', false);
            //modalActualizacionUsuarios.find('#correo').prop('disabled', false);
            modalActualizacionUsuarios.find('#botonRegistrar').show();
            modalActualizacionUsuarios.find('#botonModificar').hide();
            modalActualizacionUsuarios.find('#botonEliminar').hide();
            modalActualizacionUsuarios.find('#nombre, #correo, #telegram, #contrasena').prop('disabled', false);
        });

        $('#contrasena').on('input', function () {
            const valorCampo = $(this).val();
            const limpiar = valorCampo.replace(/[^a-zA-Z0-9]/g, '');
            if (valorCampo !== limpiar) {
                $(this).val(limpiar);
            }
        });

        $('#botonRegistrar').on('click', function (e) {
            const camposVisiblesHabilitados = $('#formularioModalUsuarios input[type="text"]:visible:enabled, #formularioModalUsuarios input[type="tel"]:visible:enabled');
            let camposVacios =[];

            camposVisiblesHabilitados.each(function () {
                if (!$(this).val().trim()) {
                    camposVacios.push($(this).attr('name') || 'campo sin nombre');
                }
            });

            if (camposVacios.length > 0) {
                e.preventDefault();
                alert('Por favor rellene todos los campos requeridos.');
                return;
            }

            $('#formularioModalUsuarios').attr('action', '{{ route("usuarios.registro") }}');
        });

        $('#botonModificar').on('click', function (e) {
            const camposVisiblesHabilitados = $('#formularioModalUsuarios input[type="text"]:visible:enabled, #formularioModalUsuarios input[type="tel"]:visible:enabled');

            if (camposVisiblesHabilitados.length === 0) {
                e.preventDefault();
                alert('No hay nada que modificar.');
                return;
            }

            let camposVacios =[];

            camposVisiblesHabilitados.each(function () {
                if (!$(this).val().trim()) {
                    camposVacios.push($(this).attr('name') || 'campo sin nombre');
                }
            });

            if (camposVacios.length > 0) {
                e.preventDefault();
                alert('Por favor rellene todos los campos requeridos.');
                return;
            }

            $('#formularioModalUsuarios').attr('action', baseUrlModificacion + '/' + nombreClaveUsuario);
        });

        $('#botonEliminar').on('click', function (e) {
            $('#formularioModalUsuarios').attr('action', baseUrlEliminacion + '/' + nombreClaveUsuario);
        });
    });
</script>

