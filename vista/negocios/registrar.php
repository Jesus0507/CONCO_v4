<?php include (call."Inicio.php"); ?> 
<!-- Contenido de la pagina -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Registrar Negocios</h1>
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
            <form action="" enctype="multipart/form-data" id="formulario" method="POST" name="formulario" >
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
                                <span id="mensaje_calle"></span>
                            </div>

                           
                            <div class="col-md-6 mt-2">
                                <label for="direccion">
                                    Direccion de Negocio
                                </label>
                                <div class="input-group">
                                    <input class="form-control no-simbolos mb-10 letras_numeros" id="direccion" name="datos[direccion_negocio]"
                                        placeholder="Direccion de Negocio" type="text" oninput="Limitar(this,30);" />
                                </div>
                                <span id="mensaje_direccion"></span>
                            </div>

                            <div class="col-md-12 mt-2">
                                <label for="nombre_negocio">
                                    Nombre de Negocio
                                </label>
                                <div class="input-group">
                                    <input class="form-control letras_numeros mb-10" id="nombre_negocio" name="datos[nombre_negocio]"
                                        placeholder="Nombre de Negocio" type="text" oninput="Limitar(this,30);" />
                                         
                                </div>
                                <span id="mensaje_negocio"></span>
                            </div>
                            
                            <div class="col-md-6 mt-2">
                                <label for="cedula_propietario">
                                    Propietario
                                </label>
                                <div class="input-group">
                                    <input list="cedula" id="cedula_propietario" name="datos[cedula_propietario]"
                                        class="form-control no-simbolos letras_numeros" placeholder="Cedula" oninput="Limitar(this,15);"/>
                                    <datalist id="cedula">
                                        <?php foreach($this->datos["personas"] as $persona){   ?>
                                        <option value="<?php echo $persona["cedula_persona"];?>">
                                            <?php echo $persona["primer_nombre"]." ".$persona["primer_apellido"];?>
                                        </option>
                                    <?php  }   ?>
                                    </datalist>
                                    
                                </div>
                                <span id="mensaje_cedula"></span>
                            </div>

                            <div class="col-md-6 mt-2">
                                <label for="rif_negocio">
                                    Rif del Negocio
                                </label>
                                <div class="input-group">
                                    <input class="form-control mb-10 letras_numeros" id="rif_negocio" name="datos[rif_negocio]"
                                        placeholder="Rif del Negocio" type="text" onkeyup="Filtro(this,'-',RIF,false)" oninput="Limitar(this,12);"/>
                                </div>
                                <span id="mensaje_rif"></span>
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
<script src="<?php echo constant('URL')?>config/js/news/registrar_negocios.js"></script> 
<?php include (call."Fin.php"); ?>
<?php include (call."Style-seguridad.php"); ?>

