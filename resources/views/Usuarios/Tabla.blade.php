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
        <h2 class="text-center mb-4 mt-2">Usuarios</h2>
        <div class="table-responsive">
            <table id="ticketsTable" class="table" style="text-align:center;">
                <thead class="table">
                    <tr>
                        <th class="dt-center">ID</th>
                        <th class="dt-center">USUARIO</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $usuario)
                        <?php if(substr($usuario->usuario, 0, 1)!='N'){ ?>
                            <tr>
                                <td>
                                    <a href="#"
                                    class="btn btn-link text-decoration-none"
                                    data-toggle="modal"
                                    data-target="#modalGeneralUsuarios"
                                    data-nombre-clave-usuario="{{ $usuario->usuario }}"
                                    >
                                        {{ $usuario->usuario }}
                                    </a>
                                </td>
                                <td>{{ $usuario->userable->NOMBRE }}</td>
                            </tr>
                        <?php } ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>