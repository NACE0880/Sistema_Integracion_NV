<!--<style>
    .tabla-estilo-azul {
        background-color: #e0eeffff;
        color: black;
    }

    .tabla-estilo-azul th,
    .tabla-estilo-azul td {
        border-color: #ffffffff;
        color: white;
    }

    .tabla-estilo-azul tbody tr:nth-child(odd) {
        background-color: #7d96b7ff;
    }

    .tabla-estilo-azul tbody tr:hover {
        background-color: #31465c;
    }

    esto va en la class class="table tabla-estilo-azul table-bordered table-sm table-hover col-md-6"
</style>-->
<body>
    <div class="container mt-5">
        <!--<h2 class="text-center mb-5 mt-2">Usuarios</h2>-->
        <div class="table-responsive mb-1">
            <table id="TablaInicioUsuarios" class="table" style="text-align:center;">
                <thead class="table">
                    <tr>
                        <th class="dt-center">ID</th>
                        <th class="dt-center">USUARIO</th>
                        <th class="dt-center">ROLES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $usuario)
                        <tr 
                            @if(\Illuminate\Support\Str::startsWith($usuario->usuario, 'N')) 
                                class="table-danger"
                                data-toggle="tooltip" 
                                data-placement="top" 
                                title="Este usuario está inactivo" 
                            @endif
                        >
                            <td>
                                <a href="#"
                                class="btn btn-link text-decoration-none"
                                data-toggle="modal"
                                data-target="#modalGeneralUsuarios"
                                data-titulo="{{ $usuario->userable->NOMBRE }}"
                                data-nombre="{{ $usuario->userable->NOMBRE }}"
                                data-correo="{{ $usuario->userable->CORREO ?? ''}}"
                                data-telegram-coordinador="{{ $usuario->userable->TELEGRAM ?? ''}}"
                                data-nombre-clave-usuario="{{ $usuario->usuario }}"
                                data-cargo-usuario="{{ class_basename($usuario->userable_type) }}"
                                >
                                    {{ $usuario->usuario }}
                                </a>
                            </td>
                            <td>{{ $usuario->userable->NOMBRE }}</td>
                            <td>
                                @foreach($usuario->roles as $rol)
                                    {{ $rol->NOMBRE }}<br>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>