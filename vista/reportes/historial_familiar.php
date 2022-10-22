<?php include (call."Inicio.php"); ?>
<!-- Contenido de la pagina -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Generar Historial Clínico</h1> </div>
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
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"> <i class="fas fa-minus"></i> </button>
                    </div>
                </div>
                <form action="" enctype="multipart/form-data" id="formulario" method="POST" name="formulario">
                    <!-- card-body -->
                    <div class="card-body">
                        <div class="card-block">
                            <div class="form-group row justify-content-center">


                                <div class="col-md-12 mt-2">
                                    <label for="familia">
                                        Familia 
                                    </label>
                                    <div class="input-group">
                                        <input list="cedula" id="familia" name="datos[familia]"
                                        class="form-control " placeholder="Nombre Familia" />
                                        <datalist id="cedula">
                                            <?php foreach($this->jefes_familia as $familia){   ?>
                                                <option value="<?php echo $familia["nombre_familia"];?>">
                                                    
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
                                <input type="button" class="btn  btn-info m-r-10" name="" id="imprimir" value="Imprimir">
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
<script type="text/javascript">
    
    document.getElementById("imprimir").onclick=function(){
       window.open("<?php Direcciones::_000_("Reportes/Historial_Clinico");?>"+"?id="+document.getElementById("familia").value);
    }
</script>