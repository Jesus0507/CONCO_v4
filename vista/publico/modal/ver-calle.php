<div class="modal fade" id="ver">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ver Datos de Calle</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"> 
            <form action="<?php echo constant('URL'); ?>Calles/Nueva_Calle" enctype="multipart/form-data"
                    id="formulario" method="POST" name="formulario">
                    <div class="form-group row justify-content-center">

                        <div class="col-md-12 mt-2">
                            <label for="nombre_calle">
                                Nombre de Calle
                            </label>
                            <div class="input-group">
                                <input class="form-control mb-10" id="nombre" name="datos[nombre_calle]"
                                    placeholder="Nombre de Calle" type="text" />
                            </div>
                        </div>

                        <div class="col-md-12 mt-2">
                            <label for="condicion_calle">
                                Condicion de calle
                            </label>
                            <textarea class="form-control" cols="5" id="condicion" name="datos[condicion_calle]"
                                rows="5" placeholder="Condicion de la Calle"></textarea>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer ">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->