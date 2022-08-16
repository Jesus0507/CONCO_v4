<div class="modal fade" id="ver">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Información del evento</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style='overflow-y: scroll;height:400px'> 
            <form action="<?php echo constant('URL'); ?>Calles/Nueva_Calle" enctype="multipart/form-data"
                    id="formulario" method="POST" name="formulario">
                    <div class="form-group row justify-content-center">
                        <div class="col-md-12 mt-2" id="fechas_evento" style='color:white;width:100%;height:50px;background:#11A394;overflow-x: scroll;'>

                        </div>

                        <div class="col-md-12 mt-2">
                            <label for="nombre_calle">
                                Tipo de evento
                            </label>
                            <div class="input-group">
                                <input class="form-control mb-10" id="tipo_evento" name="tipo_evento"
                                    placeholder="Evento" type="text" />
                            </div>
                        </div>

                         <div class="col-md-6 mt-2">
                            <label for="nombre_calle">
                                Ubicación del evento
                            </label>
                            <div class="input-group">
                                <input class="form-control mb-10" id="ubicacion_evento" name="ubicacion_evento"
                                    placeholder="Ubicación" type="text" list='ubicaciones'/>
                                    <datalist id='ubicaciones'>
                                        <?php foreach ($this->datos["ubicaciones"] as $u) { ?>
                                                      <option value='<?php echo $u; ?>'></option>
                                       <?php  } ?>
                                    </datalist>
                            </div>
                        </div>
                         <div class="col-md-3 mt-2">
                            <label for="nombre_calle">
                                Desde
                            </label>
                            <div class="input-group">
                                <select class='form-control' id='hora_desde_evento'>
                                    <option value='0'>-Seleccione-</option>
                                    <option value='1'>08:00 AM</option>
                                    <option value='2'>09:00 AM</option>
                                    <option value='3'>10:00 AM</option>
                                    <option value='4'>11:00 AM</option>
                                    <option value='5'>12:00 PM</option>
                                    <option value='6'>01:00 PM</option>
                                    <option value='7'>02:00 PM</option>
                                    <option value='8'>03:00 PM</option>
                                    <option value='9'>04:00 PM</option>
                                    <option value='10'>05:00 PM</option>
                                    <option value='11'>06:00 PM</option>
                                    <option value='12'>07:00 PM</option>
                                </select>
                            </div>
                        </div>
                         <div class="col-md-3 mt-2">
                            <label for="nombre_calle">
                                Hasta
                            </label>
                            <div class="input-group">
                                <select class='form-control' id='hora_hasta_evento'>
                                    <option value='0'>-Seleccione-</option>
                                    <option value='2'>09:00 AM</option>
                                    <option value='3'>10:00 AM</option>
                                    <option value='4'>11:00 AM</option>
                                    <option value='5'>12:00 PM</option>
                                    <option value='6'>01:00 PM</option>
                                    <option value='7'>02:00 PM</option>
                                    <option value='8'>03:00 PM</option>
                                    <option value='9'>04:00 PM</option>
                                    <option value='10'>05:00 PM</option>
                                    <option value='11'>06:00 PM</option>
                                    <option value='12'>07:00 PM</option>
                                    <option value='13'>08:00 PM</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12 mt-2">
                            <label for="condicion_calle">
                                Detalles del evento (opcional)
                            </label>
                            <textarea class="form-control" cols="5" id="detalle_evento" name="detalle_evento"
                                rows="5" placeholder="Requisitos del evento, especificaciones, etc..."></textarea>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer ">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
             <button type="button" class="btn btn-primary" id="crear_evento_guardar">Guardar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->