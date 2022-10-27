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

                            <div class="col-md-12 mt-2">
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
                        
                            <div class="col-md-6 mt-2">
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

                            <div class="col-md-6 mt-2">
                                <label for="id_parroquia ">
                                    Parroquia
                                </label>
                                <div class="input-group">
                                    <select class="custom-select" id="id_parroquia" name="datos[id_parroquia]">
                                        <option value="0">
                                           Seleccione ...
                                        </option>
                                    <?php foreach($this->datos["parroquias"] as $parroquia){   ?>
                                        <option value="<?php echo $parroquia["id_parroquia"];?>">
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
                            <input type="button" class="btn  btn-info m-r-10" name="" id="enviar" value="Guardar">
                            
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
<script type="text/javascript">
    $(document).on("click", "#enviar", function() {
    var cedula_persona = $("#cedula_persona").val();
    var nombre_centro = $("#nombre_centro").val();
    var id_parroquia = document.getElementById("id_parroquia").selectedIndex;
    var datos = {
        cedula_votante: cedula_persona,
        nombre_centro: nombre_centro,
        id_parroquia: id_parroquia,
        estado: 1
    };
    $.ajax({
        type: "POST",
        url: BASE_URL + "app/Direcciones.php",
        data: {
            direction: 'Centro_Votacion/Administrar',
            accion: "codificar"
        },
        success: function(direccion_segura) {
            $.ajax({
                type: 'POST',
                url: BASE_URL + direccion_segura,
                data: {
                    'datos': datos,
                    id_parroquia: id_parroquia,
                    peticion: "Registrar",
                    sql: "SQL_03",
                    accion: "Se ha Asignado" + cedula_persona + " al centro " + nombre_centro,
                },
            }).done(function(datos) {
                if (datos == 1) {
                    swal({
                        title: "Registrado!",
                        text: "El elemento fue Registrado con exito.",
                        type: "success",
                        showConfirmButton: false
                    });
                    Direccionar("Centro_Votacion/Administrar/Consultas");
                } else {
                    swal({
                        title: "ERROR!",
                        text: datos,
                        type: "error",
                        html: true,
                        showConfirmButton: true,
                        customClass: "bigSwalV2",
                    });
                }
            }).fail(function() {
                alert("error");
            });
        },
        error: function() {
            alert('Error al codificar dirreccion');
        }
    });
});
</script>
<!-- /.content-wrapper -->
<?php include (call."Fin.php"); ?>


