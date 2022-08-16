<div class="modal fade" id="actualizar">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Actualizar Datos de Embarazada</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo constant('URL'); ?>" enctype="multipart/form-data" id="formulario"
                    method="POST" name="formulario">
                    <div class="form-group row justify-content-center">

                        <div class="col-md-6 mt-2">
                            <label for="cedula_persona">
                                Cedula de Persona
                            </label>
                            <div class="input-group">
                                <input disabled id="cedula_persona2" name="datos[cedula_persona]" class="form-control "
                                    placeholder="Cedula de Persona" />


                            </div>
                        </div>

                        <div class="col-md-6 mt-2">
                            <label for="recibe_micronutrientes">
                                Recibe Micronutrientes
                            </label>
                            <div class="input-group">
                                <select class="custom-select" id="recibe_micronutrientes2"
                                    name="datos[recibe_micronutrientes]">
                                    <option value="1">
                                        Si
                                    </option>
                                    <option value="0" selected>
                                        No
                                    </option>

                                </select>
                            </div>
                        </div>




                        <div class="col-md-6 mt-2">
                            <label for="tiempo_gestacion">
                                Tiempo de Gestacion
                            </label>
                            <div class="input-group">
                                <input class="form-control" placeholder="Tiempo de Gestacion" id="tiempo_gestacion2"
                                    name="datos[tiempo_gestacion]" type="text">
                            </div>
                        </div>

                        <div class="col-md-6 mt-2">
                            <label for="fecha_aprox_parto">
                                Fecha Aproximada de Parto
                            </label>
                            <div class="input-group">
                                <input class="form-control" id="fecha_aprox_parto2" name="datos[fecha_aprox_parto]"
                                    type="date">
                            </div>
                        </div>


                    </div>

                </form>
            </div>
            <div class="modal-footer ">
                <input type="button" class="btn  btn-success m-r-10" name="" id="enviar" value="Guardar">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->