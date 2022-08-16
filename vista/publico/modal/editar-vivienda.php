<div class="modal fade" id="editar_vivienda">
    <div class="modal-dialog modal-xl" style='min-width:95%'>
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ver Datos de Vivienda</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> 
            <div class="modal-body"> 
            <div class="card-body">
                    <div class="card-block">
                        <div class="form-group row justify-content-center">

                            <div class="col-md-6 mt-2">
                                <label for="id_calle">
                                    Calle
                                </label> <span id='valid_calle' style='color:red'></span>
                                <div class="input-group">
                                    <select class="custom-select" id="id_calle" name="datos[id_calle]">
                                        <?php foreach($this->datos["calle"] as $calles){   ?>
                                            <option value="<?php echo $calles["id_calle"];?>">
                                                <?php echo $calles["nombre_calle"];?>
                                            </option>
                                        <?php  }   ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 mt-2">
                                <label for="direccion_vivienda">
                                    Direccion de la Vivienda
                                </label> <span id='valid_direccion' style='color:red'></span>
                                <div class="input-group">
                                    <input class="form-control mb-10" id="direccion_vivienda"
                                    name="datos[direccion_vivienda]" placeholder="Direccion" type="text" />
                                </div>
                            </div>


                            <div class="col-md-6 mt-2">
                                <label for="numero_casa">
                                    Numero de vivienda
                                </label> <span id='valid_numero_casa' style='color:red'></span>
                                <div class="input-group">
                                    <input class="form-control mb-10" id="numero_casa" name="datos[numero_casa]"
                                    placeholder="Numero de vivienda" type="text" />
                                </div>
                            </div>



                            <div class="col-md-6 mt-2">
                                <label for="cantidad_habitaciones">
                                    Cantidad de Habitaciones
                                </label> <span id='valid_cantidad_habitaciones' style='color:red'></span>
                                <div class="input-group">
                                    <input class="form-control mb-10" id="cantidad_habitaciones"
                                    name="datos[cantidad_habitaciones]" placeholder="Cantidad Habitaciones"
                                    type="number" />
                                </div>
                            </div>

                            <div class="col-md-6 mt-2">
                                <label for="id_tipo_vivienda">
                                    Tipo de Vivienda
                                </label>
                                <span id='valid_tipo_vivienda' style='color:red'></span>
                                <div class="input-group">
                                    <input list="tipo_v" id="id_tipo_vivienda" name="datos[id_tipo_vivienda]"
                                    class="form-control " placeholder="Tipo de Vivienda" />
                                    <datalist id="tipo_v">
                                        <?php foreach($this->datos["tipo_vivienda"] as $T_VIVIENDA){   ?>
                                            <option value="<?php echo $T_VIVIENDA["nombre_tipo_vivienda"];?>">

                                            </option>
                                        <?php  }   ?>
                                    </datalist>
                                </div>
                            </div>



                            <div class="col-md-6 mt-2">
                                <label for="condicion">
                                    Condicion de la Vivienda
                                </label>
                                <span id='valid_condicion_vivienda' style='color:red'></span>
                                <div class="input-group">
                                    <select class="custom-select" id="condicion"
                                    name="datos[condicion]">
                                    <option value="Buena">
                                        Buena
                                    </option>
                                    <option value="Mala">
                                        Mala
                                    </option>
                                    <option value="Regular">
                                        Regular
                                    </option>
                                </select>
                            </div>
                        </div>



                        <div class="col-md-4     mt-2">
                            <label for="hacinamiento">
                                La vivienda es Hacinamiento
                            </label>
                            <div class="input-group">
                                <select class="custom-select" id="hacinamiento" name="datos[hacinamiento]">
                                    <option value="1">
                                        Si
                                    </option>
                                    <option value="0" selected>
                                        No
                                    </option>

                                </select>
                            </div>
                        </div>

                        <div class="col-md-4     mt-2">
                            <label for="espacio_siembra">
                                Posee Espacio de Siembra
                            </label>
                            <div class="input-group">
                                <select class="custom-select" id="espacio_siembra" name="datos[espacio_siembra]">
                                    <option value="1">
                                        Si
                                    </option>
                                    <option value="0" selected>
                                        No
                                    </option>

                                </select>
                            </div>
                        </div>

                        <div class="col-md-4     mt-2">
                            <label for="banio_sanitario">
                                Tiene Baño Sanitario
                            </label>
                            <div class="input-group">
                                <select class="custom-select" id="banio_sanitario" name="datos[banio_sanitario]">
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
                            <label for="agua_consumo">
                                Agua de Consumo
                            </label>
                            <span id='valid_agua_consumo' style='color:red'></span>
                            <div class="input-group">

                                <select class="custom-select" id="agua_consumo" name="datos[agua_consumo]">
                                    <option value="Acueducto">
                                        Acueducto
                                    </option>
                                    <option value="Cisterna">
                                        Cisterna
                                    </option>
                                    <option value="Pipa Publica">
                                        Pipa Publica
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 mt-2">
                            <label for="aguas_negras">
                                Aguas Negras
                            </label>
                            <span id='valid_aguas_negras' style='color:red'></span>
                            <div class="input-group">

                                <select class="custom-select" id="aguas_negras" name="datos[aguas_negras]">

                                    <option value="Cloacas">
                                        Cloacas
                                    </option>
                                    <option value="Letrina">
                                        Letrina
                                    </option>
                                    <option value="Alcantarillas">
                                        Alcantarillas
                                    </option>
                                    <option value="Pozo Septico">
                                        Pozo Septico
                                    </option>

                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 mt-2">
                            <label for="residuos_solidos">
                                Residuos Solidos
                            </label>
                            <span id='valid_residuos_solidos' style='color:red'></span>
                            <div class="input-group">

                                <select class="custom-select" id="residuos_solidos" name="datos[residuos_solidos]">
                                    <option value="Aseo Urbano">
                                        Aseo Urbano
                                    </option>
                                    <option value="Quema">
                                        Quema
                                    </option>
                                    <option value="Aire Libre">
                                        Aire Libre
                                    </option>
                                </select>
                            </div>
                        </div>



                        <div class="col-md-6 mt-2">
                            <label for="servicio_electrico">
                                Cableado Electrico
                            </label>
                            <div class="input-group">
                                <select class="custom-select" id="servicio_electrico" name="datos[servicio_electrico]">
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
                            <label for="cable_telefonico">
                                Cableado Telefonico
                            </label>
                            <div class="input-group">
                                <select class="custom-select" id="cable_telefonico" name="datos[cable_telefonico]">
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
                            <label for="internet">
                                Servicio de Internet
                            </label>
                            <div class="input-group">
                                <select class="custom-select" id="internet" name="datos[internet]">
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
                            <label for="gas">
                                Posee Servicio de Gas Domestico
                            </label>
                            <div class="input-group">
                                <select class="custom-select" id="gas" name="datos[gas]">
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
                            <label for="animales_domesticos">
                                Animales Domesticos
                            </label>
                            <div class="input-group">
                                <select class="custom-select" id="animales_domesticos"
                                name="datos[animales_domesticos]">
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
                        <label for="insectos_roedores">
                            Posee Plagas en la Vievienda
                        </label>
                        <div class="input-group">
                            <select class="custom-select" id="insectos_roedores" name="datos[insectos_roedores]">
                                <option value="1">
                                    Si
                                </option>
                                <option value="0" selected>
                                    No
                                </option>

                            </select>
                        </div>
                    </div>



                    <div class="col-md-12 mt-2">
                        <label for="descripcion">
                            Describir la Condicion de la Vivienda
                        </label>
                        <span id='valid_descripcion' style='color:red'></span>
                        <textarea class="form-control" cols="5" id="descripcion"
                        name="descripcion" rows="5" placeholder="Descripcion"></textarea>
                    </div>

                    <div class="col-md-4 mt-2">
                        <label for="">
                            Tipos de Techo en el Hogar
                        </label>
                        <table class="table table-bordered" >
                            <tr>
                                <td class="">
                                    <select type="text" id="tipo_techo" name="tipo_techo[]"  class="form-control">
                                        <option value='0'>-Seleccione-</option>
                                        <?php foreach($this->datos["tipo_techo"] as $techo){   ?>
                                            <option value="<?php echo $techo["id_tipo_techo"];?>">
                                            <?php echo $techo["techo"];?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                </td>
                                
                                <td class="col-2">
                                    <button type="button" name="agregar" id="agregar" class="btn btn-success">Agregar</button>
                                </td>
                            </tr>
                            <tbody id="tabla_techo">
                                
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-4 mt-2">
                        <label for="">
                            Tipos de Pared en el Hogar
                        </label>
                        <table class="table table-bordered" >
                            <tr>
                                <td class="">
                                    <select  type="text" id="tipo_pared" name="tipo_pared[]"  class="form-control" >
                                        <option value='0'>-Seleccione-</option>
                                        <?php foreach($this->datos["tipo_pared"] as $pared){   ?>
                                            <option value="<?php echo $pared["id_tipo_pared"];?>">
                                            <?php echo $pared["pared"];?>
                                            </option>
                                        <?php  }   ?>
                                        </select>
                                </td>
                                
                                <td class="col-2">
                                    <button type="button" name="agregar" id="agregar2" class="btn btn-success">Agregar</button>
                                </td>
                            </tr>
                            <tbody id="tabla_pared"></tbody>
                        </table>
                    </div>

                    <div class="col-md-4 mt-2">
                        <label for="">
                            Tipos de Piso en el Hogar
                        </label>
                        <table class="table table-bordered" >
                            <tr>
                                <td class="">
                                    <select id='tipo_piso' name="tipo_piso[]"  class="form-control" >
                                        <option value='0'>-Seleccione-</option>
                                        <?php foreach($this->datos["tipo_piso"] as $piso){   ?>
                                            <option value="<?php echo $piso["id_tipo_piso"];?>">
                                            <?php echo $piso["piso"];?>
                                            </option>
                                        <?php  }   ?>
                                        </select>
                                </td>
                                
                                <td class="col-2">
                                    <button type="button" name="agregar" id="agregar3" class="btn btn-success">Agregar</button>
                                </td>
                            </tr>
                            <tbody id="tabla_piso"></tbody>
                        </table>
                    </div>

                    <div class="col-md-12 mt-2">
                        <label for="">
                            <center>   Servicio de gas</center>
                        </label> <span id='valid_gases_agregados' style='color:red'></span>
                        <table style='width:100%'>
                            <tr>
                                <td >
                                  <select id='gas_select' class='form-control'>
                                      <option value='vacio'>-Compañia-</option>
                                      <?php foreach ($this->datos["servicios_gas"] as $gas) { ?>
                                          <option value='<?php  echo $gas['id_servicio_gas']?>'><?php echo $gas['nombre_servicio_gas']; ?></option>
                                      <?php   } ?>
                                  </select>
                                  <input type="text" maxlength='30' class='form-control' placeholder="Compañía de gas..." name="" id='gas_input' style='display:none'>
                              </td>
                              <td>  <select id='tipo_bombona' class='form-control'>
                                  <option value='vacio'>-Tipo de bombona-</option>
                                  <option value='10 Kg'>10 Kg</option>
                                  <option value='18 Kg'>18 Kg</option>
                                  <option value='43 Kg'>43 Kg</option>
                              </select></td>
                              <td>
                                  <select id='tiempo_duracion' class='form-control'>
                                      <option value='vacio'>-Tiempo de duración-</option>
                                      <option value='7'>7 días</option>
                                      <option value='15'>15 días</option>
                                      <option value='30'>30 días</option>
                                  </select>
                              </td>

                              <td >
                                <button type="button" name="agregar" id="agregar_gas" class="btn btn-success">Agregar</button>
                            </td>
                            <td >
                                <button type="button" name="agregar" id="agregar_servicio" class="btn btn-info">Nuevo servicio</button>
                            </td>
                        </tr>
                        <tr>
                            <td colspan='4'><br>
                                <div style='width:100%;height: 120px;background: #C6C5F3;overflow-y:scroll'><center><div id='gases_agregados' style='width:90%'></div></center></div>
                            </td>
                        </tr>
                    </table>
                </div>
                <br><br>
                <div class="col-md-12 mt-2">
                    <label for="">
                        <center>   Electrodomésticos</center>
                    </label> <span id='valid_electrodomesticos_agregados' style='color:red'></span>
                    <table style='width:100%'>
                        <tr>
                            <td >
                              <select id='electrodomestico_select' class='form-control'>
                                  <option value='vacio'>-Electrodoméstico-</option>
                                  <?php foreach ($this->datos["electrodomesticos"] as $e) { ?>
                                      <option value='<?php  echo $e['id_electrodomestico']?>'><?php echo $e['nombre_electrodomestico']; ?></option>
                                  <?php   } ?>
                              </select>
                              <input type="text" maxlength='30' class='form-control' placeholder="Nombre del electrodoméstico.." name="" id='electrodomestico_input' style='display:none'>
                          </td>
                          <td> <input type="number" id='cantidad_electrodomestico' placeholder="Cantidad" class="form-control" name=""></td>
                          <td >
                            <button type="button" name="agregar" id="agregar_electrodomestico" class="btn btn-success">Agregar</button>
                        </td>
                        <td >
                            <button type="button" name="agregar" id="nuevo_electrodomestico" class="btn btn-info">Nuevo electrodoméstico</button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='3'><br>
                            <div style='width:100%;height: 120px;background: #D3F3C5;overflow-y:scroll'><center><div id='electrodomesticos_agregados' style='width:90%'></div></center></div>
                        </td>
                    </tr>
                </table>
            </div>

        </div>
    </div>

</div>
            </div>
            <div class="modal-footer ">
            <button type="button" class="btn btn-default" id='guardar'>Guardar cambios</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->