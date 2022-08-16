<div class="modal fade" id="ver_discapacidades">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Agregar discapacidades</h4>
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
                            Discapacidades
                            </label>
                            <div class="input-group">
                                <table style='width: 100%'><tr><td>
                                <input class="form-control mb-10" id="nombre_discapacidad" name="datos[nombre_discapacidad]"
                                    placeholder="Nombre de la discapacidad" type="text" list="discapacidades_creadas"/>

                                    <datalist id='discapacidades_creadas'>
                                        <?php foreach ($this->discapacidades as $d) { ?>
                                            <option value='<?php echo $d["nombre_discapacidad"]; ?>'></option>
                                       <?php } ?>
                                    </datalist>
                                </td>
                                <td>
                                    <input type="button" id='agregar_discapacidad' value='agregar' name="agregar_discapacidad" class="btn btn-info">
                                </td></tr></table>
                            </div>
                        </div>

                        <div class="col-md-6 mt-2">
                            <label for="condicion_calle">
                                Necesidades de la discapacidad
                            </label>
                            <textarea class="form-control" cols="5" id="necesidades_discapacidad" name="datos[necesidades_discapacidad]"
                                rows="5" placeholder="Necesidades de la discapacidad"></textarea>
                        </div>

                        <div class="col-md-6 mt-2">
                            <label for="condicion_calle">
                                Observaciones
                            </label>
                            <textarea class="form-control" cols="5" id="observaciones_discapacidad" name="datos[observaciones_discapacidad]"
                                rows="5" placeholder="Observaciones de la discapacidad"></textarea>
                        </div>

                        <div class="col-md-12 mt-2">
                            <label for="condicion_calle">
                                En cama
                            </label>
                           <select class='form-control' id='en_cama'>
                               <option value='vacio'>-Seleccione-</option>
                               <option value='1'>Si</option>
                               <option value='0'>No</option>
                           </select>
                        </div>

                         <div class="col-md-12 mt-2" id='div_discapacidades_agregadas' style='height:150px !important; width:100%;border-radius: 6px;background: #CFE3FE;overflow-y: scroll'>
                           
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