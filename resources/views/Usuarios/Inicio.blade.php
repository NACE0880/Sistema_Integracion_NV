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

        .campo-wrapper.activo::after {
            display: none;
        }

        .nombre_clave_usuario {
            pointer-events: none;
        }

        .linea-advertencia-gruesa {
            border-bottom: 2px solid #dc3545;
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
            <div class="col-12 text-center mt-4">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalGeneralUsuarios" data-titulo="Nuevo Usuario">
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
        let nombreDelEvento = '';
        let correoDelEvento = '';
        let telegramDelEvento = '';
        const baseUrlModificacion = @json(url('/usuarios/inicio/modificacion'));
        const baseUrlEliminacion = @json(url('/usuarios/inicio/eliminacion'));

        $('.campo-wrapper').on('click', function (e) {
            e.stopPropagation();

            const wrapper = $(this);
            const nombreCampoSeleccionado = $(this).data('campo');
            const campoSeleccionado = $(nombreCampoSeleccionado);

            if (campoSeleccionado.prop('disabled')) {
                campoSeleccionado.prop('disabled', false).focus();
            }

            wrapper.addClass('activo');
        });

        $('.campo-wrapper input').on('click', function (e) {
            e.stopPropagation();
        });

        $('#modalGeneralUsuarios').on('show.bs.modal', function (event) {
            const evento = $(event.relatedTarget);
            const modalActualizacionUsuarios = $(this);
            const tipoDeEventoLink = evento.is('a');

            const tituloDelEvento = evento.data('titulo');
            nombreDelEvento = evento.data('nombre');
            correoDelEvento = evento.data('correo');
            telegramDelEvento = evento.data('telegram-coordinador');
            nombreClaveUsuario = evento.data('nombre-clave-usuario') || '';
            const cargoUsuarioSeleccionado = evento.data('cargo-usuario') || '';

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

            if (nombreClaveUsuario.startsWith('N')){
                modalActualizacionUsuarios.find('#botonRegistrar').hide();
                modalActualizacionUsuarios.find('#advertencia').hide();
                modalActualizacionUsuarios.find('#lineaAdvertencia').hide();
                modalActualizacionUsuarios.find('#botonModificar').hide();
                modalActualizacionUsuarios.find('#botonEliminar').hide();
                modalActualizacionUsuarios.find('#opcionesConCargos').hide();
                modalActualizacionUsuarios.find('#opcionesSinCargos').hide();
            } else {
                modalActualizacionUsuarios.find('#botonRegistrar').toggle(!existenciaNombreClaveUsuario);
                modalActualizacionUsuarios.find('#advertencia').toggle(existenciaNombreClaveUsuario);
                modalActualizacionUsuarios.find('#lineaAdvertencia').toggle(existenciaNombreClaveUsuario);
                modalActualizacionUsuarios.find('#botonModificar').toggle(existenciaNombreClaveUsuario);
                modalActualizacionUsuarios.find('#botonEliminar').toggle(existenciaNombreClaveUsuario);
                modalActualizacionUsuarios.find('#opcionesConCargos').toggle(!existenciaNombreClaveUsuario);
                modalActualizacionUsuarios.find('#opcionesSinCargos').toggle(existenciaNombreClaveUsuario);
            }

            if (cargoUsuarioSeleccionado === "coordinadores" || cargoUsuarioSeleccionado === "tutores") {
                $('#rolSinCargos option[value="tutor"]').hide();
            } else {
                $('#rolSinCargos option[value="tutor"]').show();
            }
            
            if (cargoUsuarioSeleccionado === "coordinadores") {
                modalActualizacionUsuarios.find('#grupo_campos_telegram').show();
            }

            if (cargoUsuarioSeleccionado === "directores") {
                modalActualizacionUsuarios.find('#grupo_campos_casa_director').show();
            }
        });

        $('#rolConCargos').on('change', function () {
            const valoresRolesSeleccionados = $(this).val();
            const grupoCamposTelegram = $('#grupo_campos_telegram');
            const grupoCamposCasaDirector = $('#grupo_campos_casa_director');

            if (Array.isArray(valoresRolesSeleccionados) && valoresRolesSeleccionados.includes('coordinador')) {
                grupoCamposTelegram.show();
            } else {
                grupoCamposTelegram.hide();
            }

            if (Array.isArray(valoresRolesSeleccionados) && valoresRolesSeleccionados.includes('director')) {
                grupoCamposCasaDirector.show();
            } else {
                grupoCamposCasaDirector.hide();
            }
        });

        $('#modalGeneralUsuarios').on('hidden.bs.modal', function () {
            const modalActualizacionUsuarios = $(this);
            nombreClaveUsuario = '';

            $('.campo-wrapper').removeClass('activo');
            document.getElementById('formularioModalUsuarios').reset();
            modalActualizacionUsuarios.find('#botonRegistrar').show();
            modalActualizacionUsuarios.find('#advertencia').hide();
            modalActualizacionUsuarios.find('#lineaAdvertencia').hide();
            modalActualizacionUsuarios.find('#botonModificar').hide();
            modalActualizacionUsuarios.find('#botonEliminar').hide();
            modalActualizacionUsuarios.find('#nombre, #correo, #telegram, #contrasena').prop('disabled', false);
            modalActualizacionUsuarios.find('#opcionesConCargos').show();
            modalActualizacionUsuarios.find('#opcionesSinCargos').hide();
        });

        $('#contrasena').on('input', function () {
            const valorCampo = $(this).val();
            const limpiar = valorCampo.replace(/[^a-zA-Z0-9]/g, '');
            if (valorCampo !== limpiar) {
                $(this).val(limpiar);
            }
        });

        $('#botonRegistrar').on('click', function (e) {
            const modalActualizacionUsuarios = $('#modalGeneralUsuarios');
            const valorAlRegistrarNombre = modalActualizacionUsuarios.find('#nombre').val();
            const valorAlRegistrarCorreo = modalActualizacionUsuarios.find('#correo').val();
            const valorAlRegistrarTelegram = modalActualizacionUsuarios.find('#telegram').val();
            const valorAlRegistrarContrasena = modalActualizacionUsuarios.find('#contrasena').val();

            const camposTelefonoVisiblesHabilitados = $(
                '#formularioModalUsuarios input[type="tel"]:visible:enabled'
            );
            const camposSeleccionadoresVisiblesHabilitados = $(
                '#formularioModalUsuarios select:visible:enabled'
            );
            let nombreCamposLlenosSelect = [];
            let nombreCamposLlenosSelectMultiple = [];

            camposSeleccionadoresVisiblesHabilitados.each(function () {
                const campo = $(this);

                if (!campo.prop('multiple') && campo[0].selectedIndex) {
                    nombreCamposLlenosSelect.push($(this).attr('name') || 'campo sin nombre');
                }

                if (campo.prop('multiple') && campo.val() && campo.val().length > 0) {
                    nombreCamposLlenosSelectMultiple.push($(this).attr('name') || 'campo sin nombre');
                }
            });
            
            if (
            (!valorAlRegistrarNombre || valorAlRegistrarNombre.trim() === '') ||
            (!valorAlRegistrarCorreo || valorAlRegistrarCorreo.trim() === '') ||
            (!valorAlRegistrarContrasena || valorAlRegistrarContrasena.trim() === '') ||
            ((!valorAlRegistrarTelegram || valorAlRegistrarTelegram === '') && (camposTelefonoVisiblesHabilitados.is('[name="telegram"]'))) || 
            (nombreCamposLlenosSelect.length === 0 && camposSeleccionadoresVisiblesHabilitados.length > 1) || 
            nombreCamposLlenosSelectMultiple.length === 0
            ) {
                e.preventDefault();
                alert('Por favor rellene todos los campos requeridos.');
                return;
            }

            $('#formularioModalUsuarios').attr('action', '{{ route("usuarios.registro") }}');
        });

        $('#botonModificar').on('click', function (e) {
            const modalActualizacionUsuarios = $('#modalGeneralUsuarios');
            const valorAlModificarNombre = modalActualizacionUsuarios.find('#nombre').val();
            const valorAlModificarCorreo = modalActualizacionUsuarios.find('#correo').val();
            const valorAlModificarTelegram = modalActualizacionUsuarios.find('#telegram').val();
            const valorAlModificarContrasena = modalActualizacionUsuarios.find('#contrasena').val();

            const camposSeleccionadoresVisiblesHabilitados = $(
                '#formularioModalUsuarios select:visible:enabled'
            );
            
            let nombreCamposLlenosSelect = [];
            let nombreCamposLlenosSelectMultiple = [];

            camposSeleccionadoresVisiblesHabilitados.each(function () {
                const campo = $(this);

                if (!campo.prop('multiple') && campo[0].selectedIndex) {
                    nombreCamposLlenosSelect.push($(this).attr('name') || 'campo sin nombre');
                }

                if (campo.prop('multiple') && campo.val() && campo.val().length > 0) {
                    nombreCamposLlenosSelectMultiple.push($(this).attr('name') || 'campo sin nombre');
                }
            });
            
            if (
            nombreDelEvento === valorAlModificarNombre && 
            correoDelEvento === valorAlModificarCorreo &&
            (!valorAlModificarContrasena || valorAlModificarContrasena.trim() === '') &&
            (String(telegramDelEvento) === valorAlModificarTelegram) && 
            nombreCamposLlenosSelect.length === 0 && 
            nombreCamposLlenosSelectMultiple.length === 0
            ) {
                e.preventDefault();
                alert('Modifique algún campo primero.');
                return;
            }

            $('#formularioModalUsuarios').attr('action', baseUrlModificacion + '/' + nombreClaveUsuario);
        });

        $('#botonEliminar').on('click', function (e) {
            $('#formularioModalUsuarios').attr('action', baseUrlEliminacion + '/' + nombreClaveUsuario);
        });

        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    });
</script>

