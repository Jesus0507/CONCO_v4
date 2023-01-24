<?php include (call."Inicio.php"); ?>
<!-- Contenido de la pagina -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Generar Listados</h1>
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
                <h3 class="card-title">Lista de Reportes</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"> <i
                            class="fas fa-minus"></i> </button>
                </div>
            </div>
            <form action="" enctype="multipart/form-data" id="formulario" method="POST" name="formulario">
                <!-- card-body -->
                <div class="card-body">
                    <div class="card-block">
                        <div class="form-group row justify-content-center">
                            <div class="col-md-12 mt-2">
                                <label for="listados"> Seleccionar Reporte</label>
                                <div class="input-group">
                                    <select class="custom-select" id="listados" name="listados">
                                        <option> ... </option>

                                        <option value="<?php Direcciones::_045_();?>">
                                            Listado de Grupos Deportivos
                                        </option>

                                        <option value="<?php Direcciones::_000_("Reportes/Administrar/Milicianos");?>">
                                            Listado de Milicianos
                                        </option>

                                        <option value="<?php Direcciones::_000_("Reportes/Administrar/Jefe_Familias");?>">
                                            Listado de Jefes de Familia
                                        </option>

                                        <option value="<?php Direcciones::_000_("Reportes/Administrar/Personas_Discapacidad");?>">
                                            Listado de Personas con Discapacidad
                                        </option>

                                        <option value="<?php Direcciones::_000_("Reportes/Administrar/Consejo_Comunal");?>">
                                            Listado de Estructura del Consejo Comunal
                                        </option>

                                        <option value="<?php Direcciones::_000_("Reportes/Administrar/Embarazadas");?>">
                                            Listado de Embarazadas
                                        </option>

                                        <option value="<?php Direcciones::_000_("Reportes/Administrar/Nivel_Educativo");?>">
                                            Listado de Nivel Educativo de Personas
                                        </option>

                                        <option value="<?php Direcciones::_000_("Reportes/Administrar/Carnet_Personas");?>">
                                            Listado de Personas con Carnet
                                        </option>

                                        <option value="<?php Direcciones::_000_("Reportes/Administrar/Negocios");?>">
                                            Listado de Negocios
                                        </option>

                                        <option value="<?php Direcciones::_000_("Reportes/Administrar/Inmuebles");?>">
                                            Listado de Inmuebles
                                        </option>

                                        <option value="<?php Direcciones::_000_("Reportes/Administrar/Viviendas");?>">
                                            Listado de Viviendas
                                        </option>

                                        <option value="<?php Direcciones::_000_("Reportes/Administrar/Personas_Enfermedades");?>">
                                            Listado de Personas Enfermedades
                                        </option>

                                        <option value="<?php Direcciones::_000_("Reportes/Administrar/Votantes");?>">
                                            Listado de Votantes
                                        </option>

                                        <option value="<?php Direcciones::_000_("Reportes/Administrar/Poblacion_Edades");?>">
                                            Listado de Poblacion Edades
                                        </option>

                                        <option value="<?php Direcciones::_000_("Reportes/Administrar/Sexo_Diverso");?>">
                                            Listado de Personas de Sexo Diverso
                                        </option>

                                        
                                    </select>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="text-center m-t-20">
                        <div class="col-xs-12">
                            <input type="button" class="btn  btn-info m-r-10" name="" id="enviar" value="Imprimir">

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
<script>

    document.getElementById("enviar").onclick=function(){
       window.open(document.getElementById("listados").value);
    }
    
</script>