<?php include (call."Inicio_habitante.php"); ?>


<!-- Contenido de la pagina -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Consejo Comunal Prados de Occidente</h1>
                    
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item active">Módulo de habitantes</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->


        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" id='titulo_accion_habitante'>Calendario de Eventos</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                class="fas fa-expand"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button> -->
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                       <center  >
                        <div id='calendario_eventos_habitante'>
                          <table style="width:100%" >
                              <tr>
                                <td style="text-align:right;font-size:28px;cursor:pointer;color:#299287;" onmouseover="this.style.color='#49C5B8'" onmouseout="this.style.color='#299287'">
                                    <em class="fas fa-arrow-circle-left" id="back-mes"></em>
                                </td>
                                <td style="text-align:center;font-size:26px;font-weight: bold">
                                 <span id="mes-name">Mes</span> <span id="anio-name">Año</span>
                             </td>
                             <td style="text-align:left;font-size:28px;cursor:pointer;color:#299287;" onmouseover="this.style.color='#49C5B8'" onmouseout="this.style.color='#299287'">
                                <em class="fas fa-arrow-circle-right" id="next-mes" ></em>
                            </td>
                        </tr>
                    </table>
                    <div style="width:100%;height:2px;background:#299287"></div>
                    <br>
                    <div id="calendario-view"style='width:90%'></div>
                    <br>
                    <br>
                </div>
                <div id="formulario-consulta-persona" style="width:80%;display: none">
                    <b>Documento a solicitar</b>
                    <input type="hidden" id='user_cedula' value='<?php echo $_SESSION["cedula_usuario"]; ?>' name="">
                    <select class="form-control" id="documento-solicitado">
                      <option value='0'>Seleccione el documento</option>
                      <option value='Residencia'>Constancia de Residencia</option>
                      <option value='Buena conducta'>Constancia de buena conducta</option>
                      <option value='No poseer vivienda'>Constancia de no poseer vivienda</option>
                  </select>
                  <div id="valid_doc" style="color:red"></div>
                  <br>
                  <b>Motivo de solicitud</b>
                  <textarea id="motivo-solicitud" class="form-control" placeholder="Indique la razón por la que solicita este documento..."></textarea>
                  <div id="valid_mot" style="color:red"></div>
                  <br>  
                  <center><button id="enviar-solicitud" class="btn btn-info">Enviar solicitud</button></center>
              </div> 

              <div id='formulario_vivienda' style='width:100%;display:none;'>
                        <div style='width:100%;overflow-y: scroll;height: 250px'>
                <form action="<?php echo constant('URL'); ?>Viviendas/Nueva_Vivienda" enctype="multipart/form-data"
                    id="formulario" method="POST" name="formulario">
                    <!-- card-body -->
                    <div class="card-body">
                        <div class="card-block">
                            <div class="form-group row justify-content-center">

                                <div class="col-md-6 mt-2">
                                    <label for="id_calle">
                                        Calle
                                    </label> <span id='valid_calle' style='color:red'></span>
                                    <div class="input-group">
                                        <select class="custom-select" id="id_calle" name="datos[id_calle]">
                                            <option value='vacio'>
                                                ...
                                            </option>
                                            <?php foreach($this->calles as $calles){   ?>
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

                            <!-- <div class="col-md-12 mt-2">
                                <label for="propietario">
                                    Propietario
                                </label>
                                <div class="input-group">
                                    <input class="form-control mb-10" id="propietario" name="datos[propietario]"
                                        placeholder="Propietario" type="text" />
                                </div>
                            </div> -->

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
                                        <?php foreach($this->tipo_vivienda as $T_VIVIENDA){   ?>
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

                        <div class="col-md-4 mt-2">
                            <label for="residuos_solidos">
                                Residuos Solidos
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
                                       Aire libre
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
                        <table class="table table-bordered" id="tabla_techo">
                            <tr>
                                <td class="">
                                    <input list="techo" type="text" id="tipo_techo" name="tipo_techo[]" placeholder="Tipo Techo" class="form-control cedula" />
                                    <datalist id="techo">
                                        <?php foreach($this->tipo_techo as $techo){   ?>
                                            <option value="<?php echo $techo["techo"];?>">
                                            </option>
                                        <?php  }   ?>
                                    </datalist>
                                </td>
                                
                                <td class="col-2">
                                    <button type="button" name="agregar" id="agregar" class="btn btn-success">Agregar</button>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-md-4 mt-2">
                        <label for="">
                            Tipos de Pared en el Hogar
                        </label>
                        <table class="table table-bordered" id="tabla_pared">
                            <tr>
                                <td class="">
                                    <input list="pared" type="text" id="tipo_pared" name="tipo_pared[]" placeholder="Tipo Pared" class="form-control cedula" />
                                    <datalist id="pared">
                                        <?php foreach($this->tipo_pared as $pared){   ?>
                                            <option value="<?php echo $pared["pared"];?>">
                                            </option>
                                        <?php  }   ?>
                                    </datalist>
                                </td>
                                
                                <td class="col-2">
                                    <button type="button" name="agregar" id="agregar2" class="btn btn-success">Agregar</button>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-md-4 mt-2">
                        <label for="">
                            Tipos de Piso en el Hogar
                        </label>
                        <table class="table table-bordered" id="tabla_piso">
                            <tr>
                                <td class="">
                                    <input list="piso" type="text" id="tabla_piso" name="tipo_piso[]" placeholder="Tipo Piso" class="form-control cedula" />
                                    <datalist id="piso">
                                        <?php foreach($this->tipo_piso as $piso){   ?>
                                            <option value="<?php echo $piso["piso"];?>">
                                            </option>
                                        <?php  }   ?>
                                    </datalist>
                                </td>
                                
                                <td class="col-2">
                                    <button type="button" name="agregar" id="agregar3" class="btn btn-success">Agregar</button>
                                </td>
                            </tr>
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
                                      <?php foreach ($this->servicios_gas as $gas) { ?>
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
                                <button type="button"  name="agregar" id="agregar_servicio" class="btn btn-info">Nuevo</button>
                            </td>
                        </tr>
                        <tr>
                            <td colspan='5'><br>
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
                                  <?php foreach ($this->electrodomesticos as $e) { ?>
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
                        <td colspan='4'><br>
                            <div style='width:100%;height: 120px;background: #D3F3C5;overflow-y:scroll'><center><div id='electrodomesticos_agregados' style='width:90%'></div></center></div>
                        </td>
                    </tr>
                </table>
            </div>

        </div>
    </div>

</div>
<!-- /.card-body --></form></div>
<div class="card-footer" style='height: 30px;'>
    <div class="text-center mt-20" >
        <div class="col-xs-12">
            <input type="button" class="btn  btn-success m-r-10" name="" id="guardar" value="Guardar">
        </div>
    </div>
</div>
</form>

</div>
<div id="formulario_familia" style="width:100%;display: none">
                <!-- card-body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="panel1" role="tabpanel">
                                        <div class="row">   

                                            <div class="col-md-6 mt-4">
                                                <label for="primer_nombre">
                                                    Vivienda
                                                </label>
                                                <span id='valid_1' style="color:red;"></span>
                                                <div class="input-group">
                                                    <select id='vivienda_familia' class='form-control'>
                                                        <option value='vacio'>-Seleccione-</option>
                                                         <?php foreach ($this->viviendas as $v) { ?>
                                                                     <option value='<?php echo $v["id_vivienda"] ;?>'><?php echo $v['numero_casa']; ?></option>
                                                        <?php } ?>
                                                    </select><button class='btn btn-info' type='button' id='nueva_vivienda'>Nuevo</button>
                                                </div>

                                            </div>
                                             <div class="col-md-6 mt-4">
                                                <label for="segundo_apellido">
                                                 Condición en que ocupa la vivienda
                                                </label> <span id='valid_cond_ocupacion' style='color:red'></span>
                                                <table style='width: 100%'><tr><td>
                                               <select class='form-control' id='select-cond-ocupacion'>
                                                   <option value='0'>-Seleccione-</option>
                                                   <option value='Adjudicada'>Adjudicada</option>
                                                   <option value='Alquilada'>Alquilada</option>
                                                   <option value="Invadida">Invadida</option>
                                                   <option value='Prestada'>Prestada</option>
                                                   <option value='Propia pagada'>Propia pagada</option>
                                                   <option value='Propia pagándose'>Propia pagándose</option>
                                               </select>
                                            <input style='display:none' type="text" maxlength="20" id='input_condicion_ocupacion' placeholder="Especifique..." class='form-control' name="">
 
                                           </td><td><button class='btn btn-info' type='button' id='nueva_condicion_ocupacion'>Otra</button></td></tr></table>
                                                </div>


                                            <div class="col-md-6 mt-2">
                                                <label for="segundo_nombre">
                                                    Nombre de familia
                                                </label><span id='valid_2' style="color:red;"></span>
                                                <div class="input-group">
                                                    <input class="form-control mb-10" id="nombre_familia"
                                                        name="datos[nombre_familia]" placeholder="Nombre de la familia"
                                                        type="text" />
                                                </div>

                                            </div>

                                            <div class="col-md-6 mt-2">
                                                <label for="primer_apellido">
                                                    Téléfono de familia
                                                </label><span id='valid_3' style="color:red;"></span>
                                                <div class="input-group">
                                                    <input class="form-control mb-10" id="telefono_familia"
                                                        name="datos[telefono_familia]" placeholder="telefono_familia"
                                                        type="number" />
                                                </div>

                                            </div>

                                            <div class="col-md-6 mt-2">
                                                <label for="segundo_apellido">
                                                    Ingreso mensual Aprox
                                                </label><span id='valid_4' style="color:red;"></span>
                                                <div class="input-group">
                                                    <input class="form-control mb-10" id="ingreso_aprox"
                                                        name="datos[ingreso_aprox]" placeholder="Ingreso mensual aprox"
                                                        type="text" />
                                                </div>

                                            </div>



                                             <div class="col-md-6 mt-2">
                                                <label for="segundo_apellido">
                                                    Observaciones (opcional)
                                                </label>
                                                <div class="input-group">
                                                  <textarea class='form-control' id='observaciones_familia' ></textarea>
                                                </div>

                                            </div>


                                              <div class="col-md-12 mt-2">
                                                <label for="segundo_apellido">
                                                    Integrantes
                                                </label><span id='valid_5' style="color:red;"></span>
                                                <div class="input-group">
                                                   <table style='width:100%'>
                                                    <tr>
                                                        <td>
                                                            <input type="number" class='form-control' id='integrante_input' placeholder="Buscar cédula" name="" list='lista_personas'>
                                                            <datalist id='lista_personas'>
                                                                <?php foreach ($this->personas as $p) { ?>
                                                                         <option value='<?php echo $p['cedula_persona']; ?>'><?php echo $p['primer_nombre']." ".$p['primer_apellido']; ?></option>
                                                            <?php    } ?>
                                                            </datalist>
                                                        </td><td><button class='btn btn-primary' type='button' id='btn_agregar'>Agregar</button>&nbsp;&nbsp;<button class='btn btn-info' type='button' id='btn_nuevo'>Nuevo</button></td>
                                                      </tr>
                                                      <tr><td colspan='2'><br>
                                                           <div style='background:#D0E8E7;overflow-y: scroll;width: 95%;height:200px;'><center>
                                                            <div style='width:95%' id='integrantes_agregados'></div>
                                                        </center>
                                                           </div>
                                                      </td>
                                                       
                                                   </table>
                                                </div>

                                            </div>

                                          


                                         </div></div></div><br>
                <!-- /.card-body -->
                    <div class="text-center m-t-20">
                        <div class="col-xs-12">
                            <input type="button" class="btn  btn-success m-r-10" name="" id="guardar_familia" value="Guardar">
                        </div>
                    </div>

              </div> 



</center>
</div>
<!-- /.card-body -->
<div class="card-footer text-center">

</div>
<!-- /.card-footer -->
</div>
<!-- /.card -->
</div>


<div class="col-md-3">
    <!-- Info Boxes Style 2 -->
    <div class="info-box mb-3 paneles_habitante" id='calendario_panel'>
        <span class="info-box-icon"><i class="fa fa-calendar"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Consultar eventos</span>
        </div>
        <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
    <div class="info-box mb-3 paneles_habitante" id='solicitar_panel'>
        <span class="info-box-icon"><i class="fa fa-file-text"></i></span>
<br>
        <div class="info-box-content">
            <span class="info-box-text">Solicitar constancia</span>
        </div>
        <!-- /.info-box-content -->
    </div>

    <div class="info-box mb-3 paneles_habitante" id='vivienda_panel'>
        <span class="info-box-icon"><i class="fa fa-home"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Registrar vivienda</span>
        </div>
        <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
    <div class="info-box mb-3 paneles_habitante" id='familia_panel'>
        <span class="info-box-icon"><i class="fa fa-users"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Registrar familia</span>
        </div>
        <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->

    <!-- /.info-box -->
</div>
</div>

<!-- /.card -->

</section>
<!-- /.content -->
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include (call."Fin.php"); ?>
<?php include (modal."registrar-personas-habitante.php"); ?>
<script src="<?php echo constant('URL')?>config/js/news/consulta-eventos-habitante.js"></script> 
<script src="<?php echo constant('URL')?>config/js/news/registrar_vivienda_habitante.js"></script> 
<script src="<?php echo constant('URL')?>config/js/news/index_habitante.js"></script> 
<script src="<?php echo constant('URL')?>config/js/news/validacion_familia_habitante.js"></script> 
<style type="text/css">
    .paneles_habitante{
        background: #02A2A1;color: white;
        cursor:pointer;
    }

    .paneles_habitante:hover{
        background: #0A5A5A;
    }
</style>


