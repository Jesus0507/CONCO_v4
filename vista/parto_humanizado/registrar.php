<?php include (call."Inicio.php"); ?>
<!-- Contenido de la pagina -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Registrar Embarazadas</h1>
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

                            <div class="col-md-6 mt-2">
                                <label for="cedula_persona">
                                    Cedula de Persona
                                </label>
                                <div class="input-group">
                                    <input list="cedula_p" id="cedula_persona" name="datos[cedula_persona]"
                                        class="form-control no-simbolos letras_numeros " placeholder="Cedula de Persona" oninput="Limitar(this,15)" />
                                    <datalist id="cedula_p">
                                        <?php foreach($this->datos["personas"] as $persona){  
                                            if($persona['genero']=="F"){ ?>
                                        <option value="<?php echo $persona["cedula_persona"];?>">
                                            <?php echo $persona["primer_nombre"]." ".$persona["primer_apellido"];?>
                                        </option>
                                        <?php  }  } ?>
                                    </datalist>

                                </div>
                            </div>

                            <div class="col-md-6 mt-2">
                                <label for="recibe_micronutrientes">
                                    Recibe Micronutrientes
                                </label>
                                <div class="input-group">
                                    <select class="custom-select" id="recibe_micronutrientes" name="datos[recibe_micronutrientes]">
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
                                <label for="tiempo_gestacion">
                                    Tiempo de Gestacion
                                </label>
                                <div class="input-group">
                                    <input class="form-control no-simbolos " placeholder="Tiempo de Gestacion" id="tiempo_gestacion" name="datos[tiempo_gestacion]" type="text" oninput="Limitar(this,15)">
                                </div>
                            </div>
                            
                            <div class="col-md-6 mt-2">
                                <label for="fecha_aprox_parto">
                                    Fecha Aproximada de Parto
                                </label>
                                <div class="input-group">
                                    <input class="form-control no-simbolos" id="fecha_aprox_parto" name="datos[fecha_aprox_parto]" type="date" >
                                </div>
                            </div>


                        </div>

                    </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="text-center m-t-20">
                        <div class="col-xs-12">
                            <input type="button" class="btn  btn-success m-r-10" name="" id="boton" value="Guardar">
                            
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
<script src="<?php echo constant('URL')?>config/js/news/validacion_parto_humanizado.js"></script>
<?php include (call."Fin.php"); ?> 