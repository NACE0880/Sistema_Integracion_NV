<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4 mt-2">Usuarios</h2>
        <div class="table-responsive">
            <table id="ticketsTable" class="table table-striped table-bordered table-sm  table-hover" style="text-align:center;">
                <thead class="thead-dark ">
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
                                    <a href="www.google.com.mx">{{ $usuario->usuario }}</a>
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