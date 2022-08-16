<div class="modal fade" id="ver">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ver Datos de Inmueble</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"> 
            <form action="<?php echo constant('URL'); ?>Inmuebles/Nuevo_Inmueble" enctype="multipart/form-data"
                id="formulario" method="POST" name="formulario">
                <!-- card-body -->
                <div class="card-body">
                    <div class="card-block">
                        <div class="form-group row justify-content-center">

                            <div class="col-md-6 mt-2">
                                <label for="id_calle">
                                    Calle 
                                </label>
                                <div class="input-group">
                                <input disabled class="form-control mb-10" id="calle" name="datos[calle]"
                                        placeholder="" type="text"  />
                                </div>
                            </div>

                            <div class="col-md-6 mt-2">
                                <label for="nombre_inmueble">
                                    Nombre de Inmueble
                                </label>
                                <div class="input-group">
                                    <input disabled class="form-control mb-10" id="nombre_inmueble" name="datos[nombre_inmueble]"
                                        placeholder="Nombre de Inmueble" type="text" />
                                </div>
                            </div>

                            <div class="col-md-6 mt-2">
                                <label for="direccion">
                                    Direccion
                                </label>
                                <div class="input-group">
                                    <input disabled class="form-control mb-10" id="direccion" name="datos[direccion_inmueble]"
                                        placeholder="" type="text" />
                                </div>
                            </div>

                            <div class="col-md-6 mt-2">
                                <label for="tipo_inmueble">
                                    Tipo Inmueble
                                </label>
                                <div class="input-group">
                                <input disabled class="form-control mb-10" id="tipo_inmueble" name="datos[id_tipo_inmueble]"
                                        placeholder="" type="text" />
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <!-- /.card-body -->
                
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