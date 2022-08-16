<div class="modal fade" id="actualizar">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Editar Datos de Agricola</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span> 
                </button>
            </div>
            <div class="modal-body">
            <form action="<?php echo constant('URL'); ?>" enctype="multipart/form-data"
                    id="formulario" method="POST" name="formulario">
                    <div class="form-group row justify-content-center">

                            <div class="col-md-6 mt-2">
                                <label for="cedula_persona">
                                    Cedula de Persona
                                </label>
                                <div class="input-group">
                                    <input list="cedula_p" id="cedula_persona2" name="datos[cedula_persona]"
                                    disabled class="form-control " placeholder="Cedula de Persona"/>
                                

                                </div>
                            </div>

                            
                            <div class="col-md-6 mt-2">
                            <label for="org_agricola">
                                Pertenece a una Organizacion Agricola
                            </label>
                            <div class="input-group">
                                <input class="form-control mb-10" id="org_agricola2" name="datos[org_agricola]"
                                    placeholder="Organizacion Agricola" type="text" />
                            </div>
                        </div>
                            <div class="col-md-6 mt-2">
                                <label for="area_produccion">
                                    Area de Produccion
                                </label>
                                <div class="input-group">
                                    <input class="form-control mb-10" id="area_produccion2" name="datos[area_produccion]"
                                        placeholder="Area de Produccion" type="text" />
                                </div>
                            </div>

                            <div class="col-md-6 mt-2">
                                <label for="anios_experiencia">
                                    Años de Experiencia
                                </label>
                                <div class="input-group">
                                    <input class="form-control mb-10" id="anios_experiencia2" name="datos[anios_experiencia]"
                                        placeholder="Años de Experiencia" type="number" />
                                </div>
                            </div>
                            
                            <div class="col-md-6 mt-2">
                                <label for="rubro_principal">
                                    Rubro Principal
                                </label>
                                <div class="input-group">
                                    <input class="form-control mb-10" id="rubro_principal2" name="datos[rubro_principal]"
                                        placeholder="Rubro Principal" type="text" />
                                </div>
                            </div>

                            <div class="col-md-6 mt-2">
                                <label for="rubro_alternativo">
                                    Rubro Alternativo
                                </label>
                                <div class="input-group">
                                    <input class="form-control mb-10" id="rubro_alternativo2" name="datos[rubro_alternativo]"
                                        placeholder=" Rubro Alternativo" type="text" />
                                </div>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="financiado">
                                    Financiamiento
                                </label>
                                <div class="input-group">
                                    <input class="form-control mb-10 dinero" id="financiado2" name="datos[financiado]"
                                        placeholder="Financiado" type="text" />
                                </div>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="registro_INTI">
                                    Posee Registro INTI
                                </label>
                                <div class="input-group">
                                    <select class="custom-select" id="registro_INTI2" name="datos[registro_INTI]">
                                        <option value="1">
                                            Si
                                        </option>
                                        <option value="0" selected>
                                            No
                                        </option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="constancia_productor">
                                    Posee Constancia de Productor
                                </label>
                                <div class="input-group">
                                    <select class="custom-select" id="constancia_productor2" name="datos[constancia_productor]">
                                        <option value="1">
                                            Si
                                        </option>
                                        <option value="0" selected>
                                            No
                                        </option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="senial_hierro">
                                    Posee Señal de Hierro
                                </label>
                                <div class="input-group">
                                    <select class="custom-select" id="senial_hierro2" name="datos[senial_hierro]">
                                        <option value="1">
                                            Si
                                        </option>
                                        <option value="0" selected>
                                            No
                                        </option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="agua_riego">
                                    Posee Agua de Riego
                                </label>
                                <div class="input-group">
                                    <select class="custom-select" id="agua_riego2" name="datos[agua_riego]">
                                        <option value="1">
                                            Si
                                        </option>
                                        <option value="0" selected>
                                            No
                                        </option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="produccion_actual">
                                    Produce Actulmente
                                </label>
                                <div class="input-group">
                                    <select class="custom-select" id="produccion_actual2" name="datos[produccion_actual]">
                                        <option value="1">
                                            Si
                                        </option>
                                        <option value="0" selected>
                                            No
                                        </option>

                                    </select>
                                </div>
                            </div>

                        </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <input type="button" class="btn  btn-success m-r-10" name="" id="enviar" value="Guardar">
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog --> 
</div>
<!-- /.modal -->