<?php include (call."Inicio.php"); ?>
<!-- Contenido de la pagina -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
             <h1 class="m-0">Registrar Persona con alguna discapacidad</h1>
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

                </div>
            </div>
            <form action="" enctype="multipart/form-data" id="formulario" method="POST" name="formulario">
                <!-- card-body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                         <label>Persona</label> <span id='valid_persona' style='color:red'></span>
                         <table style='width:100%'><tr><td>
                             <input type="number" maxlength="15" placeholder="Buscar cédula" class='form-control no-simbolos letras_numeros' id='persona' name="" list='lista_personas' oninput="Limitar(this,15)">

                             <datalist id='lista_personas'>
                                 <?php foreach ($this->datos["personas"] as $p) { ?>
                                     <option value='<?php echo $p['cedula_persona'];?>'><?php echo $p['primer_nombre']." ".$p['segundo_nombre']; ?></option>
                                 <?php   } ?>
                             </datalist></td>
                             

                            
                         </tr>
                         <tr>
                              <td><button type='button' class="btn btn-info mt-2" id='seleccionar_persona'>Seleccionar</button></td>
                         </tr>
                     </table>

                     </div>
                 </div>
                 <br>

                 <div id='second' style='display:none'>
                     <div class='row'>

                         <div class="col-md-12">

                             <label>Discapacidad</label> <span id='valid_discapacidad' style='color:red'></span>
                             <table style='width:100%'><tr><td class="col-md-3">
                                 <input type="text" style='display:none'  placeholder="Discapacidad..." class='form-control no-simbolos solo-letras' id='discapacidad_input' name="" oninput="Limitar(this,30)">

                                 <select class='form-control no-simbolos' id='discapacidad_select'> 
                                   <option value='vacio'>-Discapacidad-</option>
                                   <?php foreach ($this->datos["discapacidad"] as $d) { ?>
                                     <option value='<?php echo $d['id_discapacidad'];?>'><?php echo $d['nombre_discapacidad']; ?></option>
                                 <?php   } ?>
                             </select></td>

                             <td class="col-md-3">
                                <select id='en_cama' class='form-control no-simbolos'>
                                    <option value='vacio'>-En cama-</option>
                                    <option value="1">Si</option>
                                    <option value='0'>No</option>
                                </select>
                             </td>
                             <td class="col-md-3">
                               <input type="text" class='form-control no-simbolos' id='necesidades' placeholder="Necesidades (opcional)" name="">
                             </td>
                            <td class="col-md-3">
                               <input type="text" class='form-control no-simbolos' id='observaciones' placeholder="Observaciones (opcional)" name="">
                             </td>
                             
                        </tr>
                        <tr>
                            <td>
                                <button id='agregar' class="btn btn-info mt-2 ml-2" type="button">Agregar</button>&nbsp;&nbsp;<button type='button' class="btn btn-info mt-2" id='btn_nueva_discapacidad' >Nueva discapacidad</button>
                            </td>
                        </tr>
                    </table>


                         </div>



                     </div>
                    

                     <label class="mt-2">Discapacidades agregadas a <span id='nombre_persona'></span></label>
                     <center><div style='width:100%;height:200px;overflow-y: scroll;background: #C7F2EE'>
                         <center><div id='discapacidades_agregadas' style='width:100%'></div></div>
                         </center>
                         <br>

                         <center><input type="button" class="btn  btn-info m-r-10" name="" id="guardar" value="Guardar"></center>
                     </div></center>
                 </div>
             </div>
             <!-- /.card-body -->

         </form>
         <!-- /.card-footer-->
     </div>
     <!-- /.card -->

 </section>
 <!-- /.content -->
 <!-- /.content -->
</div>
<?php include modal."agregar-familiares.php"; ?>
<script type="text/javascript" src="<?php echo constant('URL')?>config/js/news/validacion_discapacitados.js"></script>
<!-- /.content-wrapper -->
<?php include (call."Fin.php"); ?>

<style>
    .color-table.info-table thead th {
        background-color: #009efb;
        color: #fff;
    }
</style>