<html>
    <body>    
        <div class="modal fade" id="modalGeneralUsuarios" tabindex="-1" role="dialog" aria-labelledby="label" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="{{ route('usuarios.registro') }}" method="POST">
                    @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="label"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="nombre">Nombre</label>
                                </div>
                                <div class="form-group col-md-8">
                                    <input type="text" class="form-control" id="nombre" name="nombre" value="">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="correo">Correo</label>
                                </div>
                                <div class="form-group col-md-8">
                                    <input type="text" class="form-control" id="correo" name="correo" value="">
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
                            <div class="form-row">
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
                                    <button type="submit" class="btn btn-outline-success">Registrar</button>
                                    <button id="botonCancelar" name="botonCancelar" type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
