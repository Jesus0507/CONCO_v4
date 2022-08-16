<div class="modal fade" id="ver">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ver Datos de Agricola</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo constant('URL'); ?>Calles/Editar_Calle" enctype="multipart/form-data"
                    id="formulario" method="POST" name="formulario">
                    <div class="form-group row justify-content-center">

                        <div class="col-md-6 mt-2">
                            <label for="cedula_persona">
                                Cedula de Persona
                            </label>
                            <div class="input-group">
                                <input id="cedula_persona" name="datos[cedula_persona]" disabled class="form-control "
                                    placeholder="Cedula de Persona" />


                            </div>
                        </div>

                        <div class="col-md-6 mt-2">
                            <label for="nombre_apellido">
                                Nombre y Apellido
                            </label>
                            <div class="input-group">
                                <input list="cedula_p" id="nombre_apellido" name="datos[nombre_apellido]"
                                    disabled class="form-control " placeholder="Cedula de Persona" />
                            </div>
                        </div>

                        <div class="col-md-12 mt-2">
                            <label for="org_agricola">
                                Pertenece a una Organizacion Agricola
                            </label>
                            <div class="input-group">
                                <input disabled class="form-control mb-10" id="org_agricola" name="datos[org_agricola]"
                                    placeholder="Organizacion Agricola" type="text" />
                            </div>
                        </div>

                        <div class="col-md-6 mt-2">
                            <label for="area_produccion">
                                Area de Produccion
                            </label>
                            <div class="input-group">
                                <input disabled class="form-control mb-10" id="area_produccion" name="datos[area_produccion]"
                                    placeholder="Area de Produccion" type="text" />
                            </div>
                        </div>

                        <div class="col-md-6 mt-2">
                            <label for="anios_experiencia">
                                Años de Experiencia
                            </label>
                            <div class="input-group">
                                <input disabled class="form-control mb-10" id="anios_experiencia" name="datos[anios_experiencia]"
                                    placeholder="Años de Experiencia" type="number" />
                            </div>
                        </div>

                        <div class="col-md-6 mt-2">
                            <label for="rubro_principal">
                                Rubro Principal
                            </label>
                            <div class="input-group">
                                <input disabled class="form-control mb-10" id="rubro_principal" name="datos[rubro_principal]"
                                    placeholder="Rubro Principal" type="text" />
                            </div>
                        </div>

                        <div class="col-md-6 mt-2">
                            <label for="rubro_alternativo">
                                Rubro Alternativo
                            </label>
                            <div class="input-group">
                                <input disabled class="form-control mb-10" id="rubro_alternativo" name="datos[rubro_alternativo]"
                                    placeholder=" Rubro Alternativo" type="text" />
                            </div>
                        </div>

                        <div class="col-md-4 mt-2">
                            <label for="financiado">
                                Financiamiento
                            </label>
                            <div class="input-group">
                                <input disabled class="form-control mb-10 dinero" id="financiado" name="datos[financiado]"
                                    placeholder="Financiado" type="text" />
                            </div>
                        </div>

                        <div class="col-md-4 mt-2">
                            <label for="registro_INTI">
                                Posee Registro INTI
                            </label>
                            <div class="input-group">
                                <select disabled class="custom-select" id="registro_INTI" name="datos[registro_INTI]">
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
                                <select disabled class="custom-select" id="constancia_productor"
                                    name="datos[constancia_productor]">
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
                                <select disabled class="custom-select" id="senial_hierro" name="datos[senial_hierro]">
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
                                <select disabled class="custom-select" id="agua_riego" name="datos[agua_riego]">
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
                                <select disabled class="custom-select" id="produccion_actual" name="datos[produccion_actual]">
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
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->