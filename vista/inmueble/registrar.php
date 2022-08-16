<?php include (call."Inicio.php"); ?>
<!-- Contenido de la pagina -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Registrar Inmuebles</h1>
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
                                <label for="id_calle">
                                    Calle
                                </label>
                                <div class="input-group">
                                    <select class="custom-select" id="id_calle" name="datos[id_calle]">
                                        <option value="0">
                                           Seleccione ...
                                        </option>
                                    <?php foreach($this->datos["calle"] as $calles){   ?>
                                        <option value="<?php echo $calles["id_calle"];?>">
                                            <?php echo $calles["nombre_calle"];?>
                                        </option>
                                    <?php  }   ?>
                                    </select>
                                </div>
                                <span id="mensaje_1"></span>
                            </div>

                            <div class="col-md-6 mt-2">
                                <label for="nombre_inmueble">
                                    Nombre de Inmueble
                                </label>
                                <div class="input-group">
                                    <input class="form-control no-simbolos mb-10" id="nombre_inmueble" name="datos[nombre_inmueble]"
                                        placeholder="Nombre de Inmueble" type="text" oninput="Limitar(this,25)"/>
                                </div>
                                <span id="mensaje_2"></span>
                            </div>

                            <div class="col-md-6 mt-2">
                                <label for="direccion">
                                    Direccion
                                </label>
                                <div class="input-group">
                                    <input class="form-control no-simbolos mb-10" id="direccion" name="datos[direccion_inmueble]"
                                        placeholder="Direccion" type="text" />
                                </div>
                                <span id="mensaje_3"></span>
                            </div>

                            <div class="col-md-6 mt-2">
                                <label for="tipo_inmueble">
                                    Tipo Inmueble
                                </label>
                                <div class="input-group">
                                    <input list="tipo_I" id="tipo_inmueble" name="datos[id_tipo_inmueble]" class="form-control no-simbolos solo-letras " placeholder="Tipo de Inmueble" oninput="Limitar(this,20)"/>
                                    <datalist id="tipo_I">
                                        <?php foreach($this->datos["tipo_inmueble"] as $t_inmueble){   ?>
                                        <option value="<?php echo $t_inmueble["nombre_tipo"];?>">
                                        </option>
                                    <?php  }   ?>
                                    </datalist>
                                    
                                </div>
                                <span id="mensaje_4"></span>
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
<!-- /.content-wrapper -->
<?php include (call."Fin.php"); ?>
<?php include (call."Style-seguridad.php"); ?>

<script src="<?php echo constant('URL')?>config/js/news/registrar-inmuebles.js"></script> 