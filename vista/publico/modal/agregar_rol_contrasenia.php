<div class="modal fade" id="ver_seguridad">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Rol del usuario</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"> 
            <form  enctype="multipart/form-data"
                    id="formulario" method="POST" name="formulario">
                    <div class="form-group row justify-content-center">

                        <div class="col-md-12 mt-2">
                            <label for="nombre_calle">
                               Rol
                            </label>
                            <div class="input-group">
                                <select class='form-control' id='rol_usuario'>
                                    <option value='0'>-Seleccione-</option>
                                    <option value='Habitante'>Habitante</option>
                                     <option value='Super Usuario'>Super Usuario</option>
                                      <option value='Administrador'>Administrador</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer ">
            <button type="button" class="btn btn-info" data-dismiss="modal">Listo</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->