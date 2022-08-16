<?php include (call."Inicio.php"); ?>
<!-- Contenido de la pagina -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Generar Constancias</h1>
                </div>
                <!-- /.col -->
                
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Lista de Constancias</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"> <i
                            class="fas fa-minus"></i> </button>
                </div>
            </div>
            <form action="<?php echo constant('URL'); ?>Calles/Nueva_Calle" enctype="multipart/form-data"
                id="formulario" method="POST" name="formulario">
                <!-- card-body -->
                <div class="card-body">
                    <div class="card-block">
                        <div class="form-group row justify-content-center">
                            <div class="col-md-6 mt-2">
                                <label for="tablas"> Seleccionar Reporte</label>
                                <div class="input-group">
                                    <select class="custom-select" id="tablas" name="constancias">
                                        <option> ... </option>
                                        <option value="1">
                                            Constancia de Residencia
                                        </option>

                                        <option value="2">
                                            Constancia de Buena Conducta
                                        </option>

                                        <option value="3">
                                            Constancia de No Poseer Vivienda
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 mt-2">
                                <label for="cedula_propietario">
                                    Cedula
                                </label>
                                <div class="input-group">
                                    <input list="cedula" id="cedula_propietario" name="datos[cedula_propietario]"
                                        class="form-control " placeholder="Cedula" />
                                    <datalist id="cedula">
                                        <?php foreach($this->personas as $persona){   ?>
                                        <option value="<?php echo $persona["cedula_persona"];?>">
                                            <?php echo $persona["primer_nombre"]." ".$persona["primer_apellido"];?>
                                        </option>
                                        <?php  }   ?>
                                    </datalist>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="text-center m-t-20">
                        <div class="col-xs-12">
                            <input type="submit" class="btn  btn-success m-r-10" name="" id="" value="Guardar">
                            <input type="button" class="btn btn-danger" id="" name="" value="Limpiar">
                        </div>
                    </div>
                </div>
            </form>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->
    </section>


    
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include (call."Fin.php"); ?>