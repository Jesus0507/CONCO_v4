<div class="modal fade" id="ver_roles">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header"> 
                <h4 class="modal-title">Modificar Roles</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" enctype="multipart/form-data" id="change-rol" method="POST" name="registro">
                    <input type="hidden" name="" id="cedulaOculta">
                    <input type="hidden" name="" id="rolOculto">
                    <div class="form-group">

                        <div class="col-md-12 ">
                            <div class="form-group">

                                <label for="ro">Rol del usuario</label>
                                <div class="input-group">
                                    <select class='form-control' id="rol_user">
                                        <option value='0'>Seleccione...</option>
                                        <option value='Habitante'>Habitante</option>
                                        <option value='Super Usuario'>Super Usuario</option>
                                        <option value='Administrador'>Administrador</option>

                                    </select>
                                    </input>
                                </div>

                                <br>
                                <label for="contrasenia">
                                    Contraseña del usuario
                                </label>
                                <div class="input-group">
                                    <input id="contrasenia-editar" class="form-control" placeholder="Contraseña"
                                        type="password">
                                    <div style="cursor: pointer" class="input-group-addon"
                                       >
                                        <button type='button' id="botonVer" class='btn btn-default'><i  style="font-size:22px" class="fa fa-eye">
                                        </i></button>
                                    </div>
                                </div>


                            </div>
                        </div>


                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="submit" class="btn  btn-success m-r-10" name="" id="enviar" value="Guardar">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->