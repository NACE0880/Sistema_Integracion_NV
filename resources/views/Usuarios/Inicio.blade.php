@extends('layouts.usuarios')

@section('title')
    Usuarios
@endsection

@section('css')
    <style>
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

        .wave-loader {
            display: flex;
            gap: 4px;
            justify-content: center;
            align-items: center;
        }

        .wave-loader span {
            display: block;
            width: 6px;
            height: 20px;
            background: #007bff; /* color Bootstrap primary */
            border-radius: 4px;
            animation: wave 1s infinite ease-in-out;
        }

        .wave-loader span:nth-child(1) { animation-delay: 0s; }
        .wave-loader span:nth-child(2) { animation-delay: 0.1s; }
        .wave-loader span:nth-child(3) { animation-delay: 0.2s; }
        .wave-loader span:nth-child(4) { animation-delay: 0.3s; }
        .wave-loader span:nth-child(5) { animation-delay: 0.4s; }

        @keyframes wave {
            0%, 100% { height: 10px; }
            50% { height: 25px; }
        }

    </style>
@endsection

@section('contenido')
    @include('Usuarios.Tabla')
    <div class="col-12 text-center mt-4">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalGeneralUsuarios" data-titulo="Nuevo Usuario">
            Registrar Usuario
        </button>
    </div>
    @include('Usuarios.modal')
    <div id="overlayBloqueo" style="
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255,255,255,0.4);
        backdrop-filter: blur(2px);
        z-index: 9999;
        display: none;
        justify-content: center;
        align-items: center;
    ">
        <div class="text-center">
            <div class="wave-loader">
                <span></span><span></span><span></span><span></span><span></span>
            </div>
            <div style="font-size: 1.3rem; margin-top: 10px; font-weight: bold;">
                Cargando...
            </div>
        </div>
    </div>
@endsection

@section('js')
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
                $('#overlayBloqueo').css('display', 'flex');

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
                    $('#overlayBloqueo').hide();
                    return;
                }

                $('#formularioModalUsuarios').attr('action', '{{ route("usuarios.registro") }}');
            });

            $('#botonModificar').on('click', function (e) {
                $('#overlayBloqueo').css('display', 'flex');

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
                    $('#overlayBloqueo').hide();
                    return;
                }

                $('#formularioModalUsuarios').attr('action', baseUrlModificacion + '/' + nombreClaveUsuario);
            });

            $('#botonEliminar').on('click', function (e) {
                $('#overlayBloqueo').css('display', 'flex');

                $('#formularioModalUsuarios').attr('action', baseUrlEliminacion + '/' + nombreClaveUsuario);
            });

            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
        });
    </script>
@endsection

