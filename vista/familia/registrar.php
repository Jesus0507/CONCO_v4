<?php include (call."Inicio.php"); ?>
<!-- Contenido de la pagina -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Registrar Familia</h1>
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
            <form action="<?php echo constant('URL'); ?>Familias/Nuevo_Familia" enctype="multipart/form-data"
                id="formulario" method="POST" name="formulario">
                <!-- card-body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="panel1" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <h2>
                                                    Familia
                                                </h2>
                                            </div>

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
                                            <input style='display:none' type="text" maxlength="20" id='input_condicion_ocupacion' placeholder="Especifique..." class='form-control solo-letras' name="" oninput="Limitar(this,15)">
 
                                           </td><td><button class='btn btn-info' type='button' id='nueva_condicion_ocupacion'>Otra</button></td></tr></table>
                                                </div>


                                            <div class="col-md-6 mt-2">
                                                <label for="segundo_nombre">
                                                    Nombre de familia
                                                </label><span id='valid_2' style="color:red;"></span>
                                                <div class="input-group">
                                                    <input class="form-control mb-10 solo-letras" id="nombre_familia"
                                                        name="datos[nombre_familia]" placeholder="Nombre de la familia"
                                                        type="text" oninput="Limitar(this,25)" />
                                                </div>

                                            </div>

                                            <div class="col-md-6 mt-2">
                                                <label for="primer_apellido">
                                                    Téléfono de familia
                                                </label><span id='valid_3' style="color:red;"></span>
                                                <div class="input-group">
                                                    <input class="form-control mb-10 solo-numeros" id="telefono_familia"
                                                        name="datos[telefono_familia]" placeholder="telefono_familia"
                                                        type="number" oninput="Limitar(this,12)"/>
                                                </div>

                                            </div>

                                            <div class="col-md-6 mt-2">
                                                <label for="segundo_apellido">
                                                    Ingreso mensual Aprox
                                                </label><span id='valid_4' style="color:red;"></span>
                                                <div class="input-group">
                                                    <input class="form-control mb-10 no-acentos" id="ingreso_aprox"
                                                        name="datos[ingreso_aprox]" placeholder="Ingreso mensual aprox"
                                                        type="text" oninput="Limitar(this,10)"/>
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
                                                            <input type="number" class='form-control letras_numeros' id='integrante_input' placeholder="Buscar cédula" name="" list='lista_personas' oninput="Limitar(this,15)">
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

                                          


                                         </div></div></div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="text-center m-t-20">
                        <div class="col-xs-12">
                            <input type="button" class="btn  btn-success m-r-10" name="" id="guardar" value="Guardar">
                            
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
<?php include modal."agregar-familiares.php"; ?>
<script type="text/javascript" src="<?php echo constant('URL')?>config/js/news/validacion_familia.js"></script>
<!-- /.content-wrapper -->
<?php include (call."Fin.php"); ?>

<style>
.color-table.info-table thead th {
    background-color: #009efb;
    color: #fff;
}
</style>