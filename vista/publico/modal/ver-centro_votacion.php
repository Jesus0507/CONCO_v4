<div class="modal fade" id="ver">
    <div class="modal-dialog modal-lg">
        <div class="modal-content"> 
            <div class="modal-header">
                <h4 class="modal-title">Ver Datos de Votantes</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> 
            <div class="modal-body">
                <form action="" enctype="multipart/form-data" id="formulario" method="POST" name="formulario">
                    <div class="form-group row justify-content-center">

                            <div class="col-md-6 mt-2">
                                <label for="cedula_persona">
                                    Cedula de Persona
                                </label>
                                <div class="input-group">
                                    <input disabled list="cedula_p" id="cedula_persona" name="datos[cedula_persona]"
                                        class="form-control " placeholder="Cedula de Persona"/>

                                </div>
                            </div>

                            <div class="col-md-6 mt-2">
                                <label for="nombre_apellido">
                                    Nombre y Apellidp
                                </label>
                                <div class="input-group">
                                    <input disabled list="cedula_p" id="nombre_apellido" name="datos[nombre_apellido]"
                                        class="form-control " placeholder="Nombre Y Apellido"/>

                                </div>
                            </div>
                        
                            <div class="col-md-6 mt-2">
                                <label for="nombre_centro">
                                    Centro de Votacion
                                </label>
                                <div class="input-group">
                                    <input disabled list="centro" id="nombre_centro" name="datos[nombre_centro]" class="form-control " placeholder="Centro de Votacion" />
                                    
                                </div>
                            </div>

                            <div class="col-md-6 mt-2">
                                <label for="id_parroquia ">
                                    Parroquia
                                </label>
                                <div class="input-group">
                                    <input disabled list="centro" id="id_parroquia" name="datos[id_parroquia]" class="form-control " placeholder="Centro de Votacion" />
                        
                                </div>
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