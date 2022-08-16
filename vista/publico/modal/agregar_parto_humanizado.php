<div class="modal fade" id="ver_parto">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Parto humanizado</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"> 
            <form action="<?php echo constant('URL'); ?>Calles/Nueva_Calle" enctype="multipart/form-data"
                    id="formulario" method="POST" name="formulario">
                    <div class="form-group row justify-content-center">

                        <div class="col-md-6 mt-2">
                            <label for="nombre_calle">
                                Micronutrientes
                            </label>
                            <select class='form-control' id='micronutrientes'>
                                <option value='vacio'>-Seleccione-</option>
                                <option value='1'>Si</option>
                                <option value='0'>No</option>
                            </select>
                        </div>

                        <div class="col-md-6 mt-2">
                            <label for="condicion_calle">
                                Teléfono familia
                            </label>
                            <input type="number" class='form-control' id='tlf_familia' name="tlf_familia" placeholder="Teléfono de algún familiar">
                        </div>

                         <div class="col-md-12 mt-2">
                            <label for="condicion_calle">
                                Tiempo de gestación
                            </label>
                            <input type="text" class='form-control' id='tiempo_gestacion' name="tiempo_gestacion" placeholder="Tiempo de gestación">
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