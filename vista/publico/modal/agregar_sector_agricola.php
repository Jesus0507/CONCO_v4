<div class="modal fade" id="ver_sectorAgricola">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Sector agrícola</h4>
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
                               Área de producción
                            </label>
                           <input type="text" id='area_produccion' name="area_produccion" placeholder="Área de producción" class='form-control'>
                        </div>

                        <div class="col-md-6 mt-2">
                            <label for="condicion_calle">
                               Años de experiencia
                            </label>
                            <input type="number" class='form-control' id='anios_experiencia' name="anios_experiencia" placeholder="Años de experiencia">
                        </div>

                        <div class="col-md-6 mt-2">
                            <label for="nombre_calle">
                               Rubro principal
                            </label>
                           <input type="text" id='rubro_principal' name="rubro_principal" placeholder="Rubro principal" class='form-control'>
                        </div>

                        <div class="col-md-6 mt-2">
                            <label for="condicion_calle">
                               Rubro alternativo
                            </label>
                            <input type="text" class='form-control' id='rubro_alternativo' name="rubro_alternativo" placeholder="Rubro alternativo">
                        </div>

                         <div class="col-md-6 mt-2">
                            <label for="nombre_calle">
                              Registrado en INTI
                            </label>
                           <select class='form-control' id='registrado_inti' name='registrado_inti' >
                               <option value='vacio'>-Seleccione-</option>
                               <option value='1'>Si</option>
                               <option value='0'>No</option>
                           </select>
                        </div>

                        <div class="col-md-6 mt-2">
                            <label for="condicion_calle">
                               Constancia productor
                            </label>
                             <select class='form-control' id='constancia_productor' name='constancia_productor' >
                               <option value='vacio'>-Seleccione-</option>
                               <option value='1'>Si</option>
                               <option value='0'>No</option>
                           </select>
                        </div>
 <div class="col-md-6 mt-2">
                            <label for="nombre_calle">
                              Senial Hierro
                            </label>
                           <select class='form-control' id='senial_hierro' name='senial_hierro' >
                               <option value='vacio'>-Seleccione-</option>
                               <option value='1'>Si</option>
                               <option value='0'>No</option>
                           </select>
                        </div>

                        <div class="col-md-6 mt-2">
                            <label for="condicion_calle">
                               Financiado
                            </label>
                              <input type="text" class='form-control' id='financiado' name="financiado" placeholder="Financiado">
                        </div>
                                     <div class="col-md-6 mt-2">
                            <label for="condicion_calle">
                               Agua de Riego
                            </label>
                             <select class='form-control' id='agua_riego' name='agua_riego' >
                               <option value='vacio'>-Seleccione-</option>
                               <option value='1'>Si</option>
                               <option value='0'>No</option>
                           </select>
                        </div>
 <div class="col-md-6 mt-2">
                            <label for="nombre_calle">
                             Producción actual
                            </label>
                           <select class='form-control' id='produccion_actual' name='produccion_actual' >
                               <option value='vacio'>-Seleccione-</option>
                               <option value='1'>Si</option>
                               <option value='0'>No</option>
                           </select>
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