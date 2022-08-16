<?php include call . "Inicio.php";?>
<!-- Contenido de la pagina -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Registrar Grupos Deportivos</h1>
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
                                <label for="id_deporte">
                                    Deporte
                                </label>
                                <div class="input-group">
                                    <input list="tipo_I" id="id_deporte" name="datos[id_deporte]" class="form-control no-simbolos solo-letras "
                                        placeholder="Deporte" oninput="Limitar(this,25)"/>
                                    <datalist id="tipo_I">
                                        <?php foreach ($this->datos["deportes"] as $deporte) {?>
                                        <option value="<?php echo $deporte["nombre_deporte"]; ?>">
                                        </option>
                                        <?php }?>
                                    </datalist>

                                </div>
                            </div>

                            <div class="col-md-6 mt-2">
                                <label for="nombre_grupo_deportivo">
                                    Nombre del Grupo Deportivo
                                </label>
                                <div class="input-group">
                                    <input class="form-control no-simbolos mb-10" id="nombre_grupo_deportivo"
                                        name="datos[nombre_grupo_deportivo]" placeholder="Nombre de Grupo"
                                        type="text" oninput="Limitar(this,50)"/>
                                </div>
                            </div>

                            <div class="col-md-12 mt-2">
                                <label for="descripcion">
                                    Descripcion
                                </label>
                                <div class="input-group">
                                    <input class="form-control no-simbolos mb-10" id="descripcion" name="datos[descripcion]"
                                        placeholder="Nombre de Grupo" type="text" />
                                </div>
                            </div>

                            <div class="col-md-6 mt-2">
                                <label for="">
                                    Integrantes <span id='valid_integrantes' style='color:red'>
                                </label>
                                 <div class="input-group">
                                    <input list="cedula" id="integrantes" name="datos[cedula_propietario]"
                                        class="form-control no-simbolos letras_numeros" placeholder="Cedula" oninput="Limitar(this,15);"/>
                                    <datalist id="cedula">
                                        <?php foreach ($this->datos["personas"] as $persona) {?>
                                        <option value="<?php echo $persona["cedula_persona"]; ?>">
                                            <?php echo $persona["primer_nombre"] . " " . $persona["primer_apellido"]; ?>
                                        </option>
                                    <?php }?>
                                    </datalist>
                                    <button id='agregar' class="btn btn-info" type="button">Agregar</button>
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                  <label>Integrantes agregados a
                                    <span id='nombre_persona'></span>
                                    </label>

                                <div class="text-center" style='width:95%;height:200px;overflow-y: scroll;background: #C5F3F2'>
                                    <div id='integrantes_agregados' style='width:95%;margin-top:10px;'>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>
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

<script type="text/javascript" src="<?php echo constant('URL') ?>config/js/news/grupo_deportivo_validacion.js"></script>
<!-- /.content-wrapper -->
<?php include call . "Fin.php";?>