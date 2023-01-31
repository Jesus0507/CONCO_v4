<?php include call . "Inicio.php";?>
<!-- Contenido de la pagina -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Registrar Viviendas</h1>
                </div><!-- /.col -->
                <!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
 
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Formulario de Registro</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <form action="" enctype="multipart/form-data" id="formulario" method="POST" name="formulario">
                <!-- card-body -->
                <div class="card-body">
                    <div class="card-block">
                        <div class="form-group row justify-content-center">
                        <div class="col-md-12 text-center">
                            <h2>
                             Información de la Vivienda
                                     </h2>
                                          </div>
                            <div class="col-md-6 mt-2">
                                <label for="id_calle">
                                    Calle
                                </label> <span id='valid_calle' style='color:red'></span>
                                <div class="input-group">
                                    <select class="custom-select" id="id_calle" name="datos[id_calle]">
                                        <option value='vacio'>
                                            ...
                                        </option>
                                        <?php foreach ($this->datos["calle"] as $calles) {?>
                                            <option value="<?php echo $calles["id_calle"]; ?>">
                                                <?php echo $calles["nombre_calle"]; ?>
                                            </option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 mt-2">
                                <label for="direccion_vivienda">
                                    Dirección de la vivienda
                                </label> <span id='valid_direccion' style='color:red'></span>
                                <div class="input-group">
                                    <input class="form-control mb-10" id="direccion_vivienda"
                                    name="datos[direccion_vivienda]" placeholder="Direccion" type="text" />
                                </div>
                            </div>



                            <div class="col-md-6 mt-2">
                                <label for="numero_casa">
                                    Nro de vivienda
                                </label> <span id='valid_numero_casa' style='color:red'></span>
                                <div class="input-group">
                                    <input class="form-control mb-10 casa" id="numero_casa" name="datos[numero_casa]"
                                    placeholder="Numero de vivienda" type="text" oninput="Limitar(this,6)"/>
                                </div>
                            </div>



                            <div class="col-md-6 mt-2">
                                <label for="cantidad_habitaciones">
                                    Cantidad de habitaciones
                                </label> <span id='valid_cantidad_habitaciones' style='color:red'></span>
                                <div class="input-group">
                                    <input class="form-control mb-10 solo-numeros" id="cantidad_habitaciones"
                                    name="datos[cantidad_habitaciones]" placeholder="Cantidad Habitaciones"
                                    type="number" oninput="Limitar(this,2)"/>
                                </div>
                            </div>

                            <div class="col-md-6 mt-2">
                                <label for="id_tipo_vivienda">
                                    Tipo de vivienda
                                </label>
                                <span id='valid_tipo_vivienda' style='color:red'></span>
                                <div class="input-group">
                                    <input list="tipo_v" id="id_tipo_vivienda" name="datos[id_tipo_vivienda]"
                                    class="form-control solo-letras" placeholder="Tipo de Vivienda" oninput="Limitar(this,20)"/>
                                    <datalist id="tipo_v">
                                        <?php foreach ($this->datos["tipo_vivienda"] as $T_VIVIENDA) {?>
                                            <option value="<?php echo $T_VIVIENDA["nombre_tipo_vivienda"]; ?>">

                                            </option>
                                        <?php }?>
                                    </datalist>
                                </div>
                            </div>



                            <div class="col-md-6 mt-2">
                                <label for="condicion">
                                    Condición de la vivienda
                                </label>
                                <span id='valid_condicion_vivienda' style='color:red'></span>
                                <div class="input-group">
                                    <select class="custom-select" id="condicion"
                                    name="datos[condicion]">
                                    <option value='0'>
                                        ...
                                    </option>
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



                        <div class="col-md-6     mt-2">
                            <label for="hacinamiento">
                                Vivienda en hacinamiento
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

                        <div class="col-md-6     mt-2">
                            <label for="espacio_siembra">
                                Espacio de siembra
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

                        <div class="col-md-6     mt-2">
                            <label for="banio_sanitario">
                                Tiene baño sanitario
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



                        <div class="col-md-6 mt-2">
                            <label for="agua_consumo">
                                Agua de consumo
                            </label>
                            <span id='valid_agua_consumo' style='color:red'></span>
                            <div class="input-group">

                                <select class="custom-select" id="agua_consumo" name="datos[agua_consumo]">
                                    <option value='vacio'>
                                        ...
                                    </option>
                                    <option value="Acueducto">
                                        Acueducto
                                    </option>
                                    <option value="Cisterna">
                                        Cisterna
                                    </option>
                                    <option value="Pipa Publica">
                                        Pipa Pública
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 mt-2">
                            <label for="aguas_negras">
                                Aguas negras
                            </label>
                            <span id='valid_aguas_negras' style='color:red'></span>
                            <div class="input-group">

                                <select class="custom-select" id="aguas_negras" name="datos[aguas_negras]">
                                    <option value="0">
                                        ...
                                    </option>
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

                        <div class="col-md-6 mt-2">
                            <label for="residuos_solidos">
                                Residuos sólidos
                            </label>
                            <span id='valid_residuos_solidos' style='color:red'></span>
                            <div class="input-group">

                                <select class="custom-select" id="residuos_solidos" name="datos[residuos_solidos]">
                                    <option value='0'>
                                        ...
                                    </option>
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
                                Cableado Eléctrico
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
                                Cableado Telefónico
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
                                Servicio de internet
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
                                Servicio de gas doméstico
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
                                Animales domésticos
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
                            Plagas en la vivienda
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
                            Describir la condición de la vivienda
                        </label>
                        <span id='valid_descripcion' style='color:red'></span>
                        <textarea class="form-control" cols="5" id="descripcion"
                        name="descripcion" rows="5" placeholder="Descripcion"></textarea>
                    </div>

                    <div class="col-md-12 mt-2">
                        <label for="">
                            Tipos de techo en el hogar <span id='valid_techos' style='color:red'>
                        </label>

                        <div class="input-group">
                            <input list="techo" type="text" id="tipo_techo" name="tipo_techo[]" placeholder="Tipo Techo" class="form-control cedula solo-letras" oninput="Limitar(this,50)"/>
                                <datalist id="techo">
                                    <?php foreach ($this->datos["tipo_techo"] as $techo) {?>
                                    <option value="<?php echo $techo["techo"]; ?>">
                                    </option>
                                    <?php }?>
                                </datalist>
                                
                            </div>
                            <button id='agregar_techo' class="btn btn-info mt-2" type="button">Agregar</button>
                    </div>

                    <div class="col-md-12 mt-2">
                        <label>Techos agregados

                        </label>

                        <div class="text-center" style='width:100%;height:200px;overflow-y: scroll;background: #C7F2EE'>
                            <center><div id='techos_agregados' style='width:100%;margin-top:10px;'></div></center>
                        </div>
                    </div>

                    <div class="col-md-12 mt-2">
                        <label for="">
                            Tipos de pared en el hogar <span id='valid_paredes' style='color:red'>
                        </label>

                        <div class="input-group">
                            <input list="pared" type="text" id="tipo_pared" name="tipo_pared[]" placeholder="Tipo Pared" class="form-control cedula solo-letras" oninput="Limitar(this,50)"/>
                                    <datalist id="pared">
                                        <?php foreach ($this->datos["tipo_pared"] as $pared) {?>
                                            <option value="<?php echo $pared["pared"]; ?>">
                                            </option>
                                        <?php }?>
                                    </datalist>
                                
                        </div>
                        <button id='agregar_pared' class="btn btn-info mt-2" type="button">Agregar</button>
                    </div>

                    <div class="col-md-12 mt-2">
                        <label>Paredes agregadas

                        </label>

                        <div class="text-center" style='width:100%;height:200px;overflow-y: scroll;background: #C7F2EE'>
                            <center><div id='paredes_agregados' style='width:100%;margin-top:10px;'></div></center>
                        </div>
                    </div>

                    <div class="col-md-12 mt-2">
                        <label for="">
                            Tipos de piso en el hogar <span id='valid_pisos' style='color:red'>
                        </label>

                        <div class="input-group">
                            <input list="piso" type="text" id="tabla_piso" name="tipo_piso[]" placeholder="Tipo Piso" class="form-control cedula solo-letras" oninput="Limitar(this,50)"/>
                                    <datalist id="piso">
                                        <?php foreach ($this->datos["tipo_piso"] as $piso) {?>
                                            <option value="<?php echo $piso["piso"]; ?>">
                                            </option>
                                        <?php }?>
                                    </datalist>
                                
                        </div>
                        <button id='agregar_piso' class="btn btn-info mt-2" type="button">Agregar</button>
                    </div>

                    <div class="col-md-12 mt-2">
                        <label>Pisos agregados

                        </label>

                        <div class="text-center" style='width:100%;height:200px;overflow-y: scroll;background: #C7F2EE'>
                            <center><div id='pisos_agregados' style='width:100%;margin-top:10px;'></div></center>
                        </div>
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
                                      <?php foreach ($this->datos["servicios_gas"] as $gas) {?>
                                          <option value='<?php echo $gas['id_servicio_gas'] ?>'><?php echo $gas['nombre_servicio_gas']; ?></option>
                                      <?php }?>
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

                              
                        </tr>
                        <tr>
                            <td >
                                <button type="button" name="agregar" id="agregar_gas" class="btn btn-info mt-2">Agregar</button>
                                <button type="button" name="agregar" id="agregar_servicio" class="btn btn-info mt-2">Nuevo servicio</button>
                            </td>
                            
                        </tr>
                        <tr>
                            <td colspan='5'><br>
                                <div style='width:100%;height: 200px;background: #C7F2EE;overflow-y:scroll'><center><div id='gases_agregados' style='width:100%'></div></center></div>
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
                                  <?php foreach ($this->datos["electrodomesticos"] as $e) {?>
                                      <option value='<?php echo $e['id_electrodomestico'] ?>'><?php echo $e['nombre_electrodomestico']; ?></option>
                                  <?php }?>
                              </select>
                              <input type="text" maxlength='30' class='form-control solo-letras' placeholder="Nombre del electrodoméstico.." name="" id='electrodomestico_input' style='display:none'>
                          </td>
                          <td> <input type="number" id='cantidad_electrodomestico' placeholder="Cantidad" class="form-control solo-numeros" name="" oninput="Limitar(this,15)"></td>
                          
                    </tr>
                    <tr>
                        <td >
                            <button type="button" name="agregar" id="agregar_electrodomestico" class="btn btn-info mt-2">Agregar</button>
                            <button type="button" name="agregar" id="nuevo_electrodomestico" class="btn btn-info mt-2">Nuevo electrodoméstico</button>
                        </td>
                        
                    </tr>
                    <tr>
                        <td colspan='3'><br>
                            <div style='width:100%;height: 200px;background: #C7F2EE;overflow-y:scroll'><center><div id='electrodomesticos_agregados' style='width:100%'></div></center></div>
                        </td>
                    </tr>
                </table>
            </div>

        </div>
    </div>

</div>
<!-- /.card-body -->
<div class="card-footer">
    <div class="text-center m-t-20">
        <div class="col-xs-12">
            <input type="button" class="btn  btn-info m-r-10" name="" id="guardar" value="Guardar">
            
        </div>
    </div>
</div>
</form>
<!-- /.card-footer-->
</div>
<!-- /.card -->

</section>
<!-- /.content -->
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include call . "Fin.php";?>
<?php include call . "Style-seguridad.php";?>

<script type="text/javascript" src="<?php echo constant('URL') ?>config/js/news/registrar-viviendas.js"></script>