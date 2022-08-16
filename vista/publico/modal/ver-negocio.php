<div class="modal fade" id="ver">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ver Datos de Negocio</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"> 
            <form action="<?php echo constant('URL'); ?>Negocios/Nuevo_Negocio" enctype="multipart/form-data"
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
                                <input class="form-control mb-10" id="calle" name="datos[calle]"
                                        placeholder="" type="text" disabled />
                                </div>
                            </div>

                           
                            <div class="col-md-6 mt-2">
                                <label for="direccion">
                                    Direccion de Negocio
                                </label>
                                <div class="input-group">
                                    <input class="form-control mb-10" id="direccion" name="datos[direccion_negocio]"
                                        placeholder="Direccion de Negocio" type="text" disabled />
                                </div>
                            </div>

                            <div class="col-md-12 mt-2">
                                <label for="nombre_negocio">
                                    Nombre de Negocio
                                </label>
                                <div class="input-group">
                                    <input class="form-control mb-10" id="nombre_negocio" name="datos[nombre_negocio]"
                                        placeholder="Nombre de Negocio" type="text" disabled/>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mt-2">
                                <label for="cedula_propietario">
                                    Cedula de Propietario
                                </label>
                                <div class="input-group">
                                    <input class="form-control mb-10" id="cedula_propietario" name="datos[cedula_propietario]"
                                        placeholder="Cedula de Propietario" type="text" disabled />
                                </div>
                            </div>

                            <div class="col-md-6 mt-2">
                                <label for="rif_negocio">
                                    Rif del Negocio
                                </label>
                                <div class="input-group">
                                    <input class="form-control mb-10" id="rif_negocio" name="datos[rif_negocio]"
                                        placeholder="Rif del Negocio" type="text" disabled />
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