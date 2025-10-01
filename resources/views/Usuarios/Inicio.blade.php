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
    <body>
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
        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modalGeneralUsuarios" data-titulo="Nuevo Usuario">
            Registrar Usuario
        </button>
        @include('Usuarios.modal')
        <!-- Bootstrap JS and dependencies -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </body>
</html>
<script>
    $(document).ready(function () {
        $('#modalGeneralUsuarios').on('show.bs.modal', function (event) {
            var evento = $(event.relatedTarget);
            var modalActualizacionUsuarios = $(this);

            var tituloDelEvento = evento.data('titulo');
            modalActualizacionUsuarios.find('.modal-title').text(tituloDelEvento);

            var nombreClaveUsuario = evento.data('nombre-clave-usuario');
            if(nombreClaveUsuario) {
                //Se envía la clave de usuario seleccionada en un input escondido
                modalActualizacionUsuarios.find('#nombre_clave_usuario').val(nombreClaveUsuario);
                modalActualizacionUsuarios.find('#nombre').prop('disabled', true);
                modalActualizacionUsuarios.find('#correo').prop('disabled', true);
                modalActualizacionUsuarios.find('#botonRegistrar').hide();
                modalActualizacionUsuarios.find('#botonModificar').show();
            } else {
                modalActualizacionUsuarios.find('#nombre').prop('disabled', false);
                modalActualizacionUsuarios.find('#correo').prop('disabled', false);
                modalActualizacionUsuarios.find('#botonModificar').hide();
                modalActualizacionUsuarios.find('#botonRegistrar').show();
            }

            //Generar la ruta del modal dinámicamente
            $('#botonRegistrar').on('click', function () {
                $('#formularioModalUsuarios').attr('action', '{{ route("usuarios.registro") }}');
                //$('#formularioModalUsuarios').find('input[name="_method"]').remove();
            });

            $('#botonModificar').on('click', function () {
                $('#formularioModalUsuarios').attr('action', '/usuarios/inicio/modificacion' + nombreClaveUsuario);

                /*if ($('#formularioModalUsuarios').find('input[name="_method"]').length === 0) {
                    $('#formularioModalUsuarios').append('<input type="hidden" name="_method" value="PUT">');
                }*/
            });
            
        });

        $('#modalGeneralUsuarios').on('hidden.bs.modal', function () {
            var modalActualizacionUsuarios = $(this);
            modalActualizacionUsuarios.find('#nombre_clave_usuario').val('');
            modalActualizacionUsuarios.find('#nombre').prop('disabled', false);
            modalActualizacionUsuarios.find('#correo').prop('disabled', false);
            modalActualizacionUsuarios.find('#botonModificar').hide();
            modalActualizacionUsuarios.find('#botonRegistrar').show();
        });
    });
</script>
