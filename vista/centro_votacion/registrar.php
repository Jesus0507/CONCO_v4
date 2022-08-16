<?php include (call."Inicio.php"); ?>
<!-- Contenido de la pagina -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Registrar Centro de Votacion</h1>
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

                            <div class="col-md-4 mt-2">
                                <label for="cedula_persona">
                                    Cedula de Persona
                                </label>
                                <div class="input-group">
                                    <input list="cedula_p" id="cedula_persona" name="datos[cedula_persona]"
                                        class="form-control no-simbolos letras-numeros " placeholder="Cedula de Persona" oninput="Limitar(this,15)"/>
                                    <datalist id="cedula_p">
                                        <?php foreach($this->datos["personas"] as $persona){   ?>
                                        <option value="<?php echo $persona["cedula_persona"];?>">
                                            <?php echo $persona["primer_nombre"]." ".$persona["primer_apellido"];?>
                                        </option>
                                        <?php  }   ?>
                                    </datalist>

                                </div>
                                <span id="mensaje_1"></span>
                            </div>
                        
                            <div class="col-md-4 mt-2">
                                <label for="nombre_centro">
                                    Centro de Votacion
                                </label>
                                <div class="input-group">
                                    <input list="centro" id="nombre_centro" name="datos[nombre_centro]" class="form-control no-simbolos " placeholder="Centro de Votacion" oninput="Limitar(this,45);" />
                                    <datalist id="centro">
                                        <?php foreach($this->datos["centros_votacion"] as $centro){   ?>
                                        <option value="<?php echo $centro["nombre_centro"];?>"> 
                                        </option>
                                    <?php  }   ?>
                                    </datalist>
                                    
                                </div>
                                <span id="mensaje_2"></span>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="id_parroquia ">
                                    Parroquia
                                </label>
                                <div class="input-group">
                                    <select class="custom-select" id="id_parroquia" name="datos[id_parroquia]">
                                        <option value="0">
                                           Seleccione ...
                                        </option>
                                    <?php foreach($this->datos["parroquias"] as $parroquia){   ?>
                                        <option value="<?php echo $parroquia["id_parroquia "];?>">
                                            <?php echo $parroquia["nombre_parroquia"];?>
                                        </option>
                                    <?php  }   ?>
                                    </select>
                                    <span id="mensaje_3"></span>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="text-center m-t-20">
                        <div class="col-xs-12">
                            <input type="button" class="btn  btn-success m-r-10" name="" id="enviar" value="Guardar">
                            
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
<script src="<?php echo constant('URL')?>config/js/news/registrar-centro_votacion.js"></script>  
<!-- /.content-wrapper -->
<?php include (call."Fin.php"); ?>


