<body>    
    <div class="modal fade" id="modalGeneralUsuarios" tabindex="-1" role="dialog" aria-labelledby="label" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="label"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formularioModalUsuarios" method="POST">
                        @csrf
                        <!-- Input escondido para enviar la clave de usuario seleccionada al modificar usuario -->
                        <input type="hidden" id="nombre_clave_usuario" name="nombre_clave_usuario">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="nombre">Nombre</label>
                            </div>
                            <div class="form-group col-md-8 campo-wrapper" data-campo="#nombre">
                                <input type="text" class="form-control" id="nombre" name="nombre">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="correo">Correo</label>
                            </div>
                            <div class="form-group col-md-8 campo-wrapper" data-campo="#correo">
                                <input type="text" class="form-control" id="correo" name="correo">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="telegram">Telegram</label>
                            </div>
                            <div class="form-group col-md-8 campo-wrapper" data-campo="#telegram">
                                <input type="text" class="form-control" id="telegram" name="telegram">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="contrasena">Contraseña</label>
                            </div>
                            <div class="form-group col-md-8 campo-wrapper" data-campo="#contrasena">
                                <input type="text" class="form-control" id="contrasena" name="contrasena">
                            </div>
                        </div>  
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="rol">Rol</label>
                            </div>
                            <div class="form-group col-md-8">
                                <select class="form-control" id="rol" name="rol[]" multiple size="4">
                                    <option value="" selected disabled>
                                    </option>
                                    @foreach($roles as $rol)
                                        <option value="{{ $rol->NOMBRE }}">{{ $rol->NOMBRE }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div id="grupo_campos_casa_director" class="form-row">
                            <div class="form-group col-md-4">
                                <label for="casa_director">Casa</label>
                            </div>
                            <div class="form-group col-md-8">
                                <select class="form-control" id="casa_director" name="casa_director">
                                    <option value="" selected disabled>
                                    </option>
                                    @foreach($casas as $casa)
                                        <option value="{{ $casa->NOMBRE }}">{{ $casa->NOMBRE }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row mt-4">
                            <div class="col-12 text-right">
                                <button id="botonRegistrar" name="botonRegistrar" type="submit" class="btn btn-outline-success">Registrar</button>
                                <button id="botonModificar" name="botonModificar" type="submit" class="btn btn-outline-warning">Modificar</button>
                                <button id="botonCancelar" type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

