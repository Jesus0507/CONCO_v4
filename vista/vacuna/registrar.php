<?php include(call . "Inicio.php"); ?>
<!-- Contenido de la pagina -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Registrar Vacuna</h1>
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
            <form action="<?php echo constant('URL'); ?>Personas/Asignar_Vacunas" enctype="multipart/form-data" id="formulario" method="POST" name="formulario">
                <!-- card-body -->
                <div class="card-body">
                    <div class="card-block">
                        <div class="form-group row justify-content-center">

                            <div class="col-md-12 mt-2">
                                <label for="cedula_persona">
                                    Cedula de Persona
                                </label>
                                <div class="input-group">
                                    <input list="cedula_p" id="cedula_persona" name="cedula_persona" class="form-control no-simbolos letras_numeros" placeholder="Cedula de Persona" oninput="Limitar(this,15)"/>
                                    <datalist id="cedula_p">
                                        <?php foreach ($this->personas as $persona) {   ?>
                                            <option value="<?php echo $persona["cedula_persona"]; ?>">
                                                <?php echo $persona["primer_nombre"] . " " . $persona["primer_apellido"]; ?>
                                            </option>
                                        <?php  }   ?>
                                    </datalist>

                                </div>
                            </div>


                            <div class="col-md-12 mt-2">
                                <label for="">
                                    Vacunas
                                </label>
                                <table class="table table-bordered" id="tabla">
                                    <tr>
                                        <td class="col-6">

                                            <div class="input-group">
                                                <select class="custom-select" id="dosis" name="dosis[]">
                                                    <option value="Primera Dosis">
                                                        Primera Dosis
                                                    </option>
                                                    <option value="Segunda Dosis">
                                                        Segunda Dosis
                                                    </option>
                                                    <option value="Tercera Dosis">
                                                        Tercera Dosis
                                                    </option>
                                                </select>
                                            </div>
                                        </td>
                                        <td class="col-6">

                                            <div class="input-group">
                                                <input class="form-control no-simbolos" id="fecha" name="fecha[]" type="date">
                                            </div>
                                        </td>
                                        <td class="">
                                            <div class="input-group ">
                                                <button type="button" name="agregar" id="agregar" class="btn btn-success">Agregar</button>
                                            </div>

                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <span id="texto"></span>
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
<?php include(call . "Fin.php"); ?>
<script>
    $(document).ready(function() {
        var i = 1;
        $('#agregar').click(function() {
            var html1 =
                '<tr id="row' + i + '" >' +
                '<td class="col-6">' +
                '<div class="input-group"><select class="custom-select" id="dosis" name="dosis[]"><option selected value="Primera Dosis">Primera Dosis</option><option value="Segunda Dosis">Segunda Dosis</option><option value="Tercera Dosis">Tercera Dosis</option></select></div>' +
                '</td>' +
                '<td class="col-6">' +
                '<div class="input-group"><input class="form-control no-simbolos" id="fecha" name="fecha[]" type="date"></div>' +
                '</td>' +
                '<td>' +
                '<button type="button" name="eliminar" id="' + i +
                '" class="btn btn-danger eliminar">X</button>' +
                '</td>' +
                '</tr>';
            var html2 =
                '<tr id="row' + i + '" >' +
                '<td class="col-6">' +
                '<div class="input-group"><select class="custom-select" id="dosis" name="dosis[]"><option value="Primera Dosis">Primera Dosis</option><option selected value="Segunda Dosis">Segunda Dosis</option><option value="Tercera Dosis">Tercera Dosis</option></select></div>' +
                '</td>' +
                '<td class="col-6">' +
                '<div class="input-group"><input class="form-control no-simbolos" id="fecha" name="fecha[]" type="date"></div>' +
                '</td>' +
                '<td>' +
                '<button type="button" name="eliminar" id="' + i +
                '" class="btn btn-danger eliminar">X</button>' +
                '</td>' +
                '</tr>';
            var html3 =
                '<tr id="row' + i + '" >' +
                '<td class="col-6">' +
                '<div class="input-group"><select class="custom-select" id="dosis" name="dosis[]"><option value="Primera Dosis">Primera Dosis</option><option value="Segunda Dosis">Segunda Dosis</option><option selected value="Tercera Dosis">Tercera Dosis</option></select></div>' +
                '</td>' +
                '<td class="col-6">' +
                '<div class="input-group"><input class="form-control no-simbolos" id="fecha" name="fecha[]" type="date"></div>' +
                '</td>' +
                '<td>' +
                '<button type="button" name="eliminar" id="' + i +
                '" class="btn btn-danger eliminar">X</button>' +
                '</td>' +
                '</tr>';


            if (i <= 1) {
                $('#tabla').append(html2);
            } else {
                if (i <= 2) {
                    $('#tabla').append(html3);
                } else {
                    if (i <= 3) {
                        document.getElementById("texto").innerHTML = "No puede agregar mas";
                    } else {}
                }
            }

            i == 3 ? i = 3 : i++;
            console.log(i);

        });

        $(document).on('click', '.eliminar', function() {
            var boton = $(this).attr("id");
            $('#row' + boton + '').remove();
            i == 1 ? i = 1 : i--;
            document.getElementById("texto").innerHTML = "";
            console.log(i);
        });

        $(document).on('click', '#enviar', function() {

            if (document.getElementById("cedula_persona").value != "") {

                var todos_inputs = $('#tabla :input');
                var dosis = [];
                var fecha = [];
                var validado = true;

                for (var i = 0; i < todos_inputs.length; i++) {
                    if (todos_inputs[i].type == 'text') {
                        dosis.push(todos_inputs[i].value);

                    }
                }
                for (var i = 0; i < todos_inputs.length; i++) {
                    if (todos_inputs[i].type == 'date') {
                        if (todos_inputs[i].value == "") {
                            validado = false;
                        } else {
                            fecha.push(todos_inputs[i].value);
                        }
                    }
                }

                if (validado == false) {
                    swal({
                        type: "error",
                        title: "Error",
                        text: "Debe agregar las fechas de vacunación",
                        timer: 2000,
                        showConfirmButton: false
                    });
                } else {
                    $.ajax({
                        type: "POST",
                        url: BASE_URL + "Personas/consulta_vacunado",
                        data: {
                            "cedula": document.getElementById("cedula_persona").value
                        }
                    }).done(function(result) {
                        console.log(result);
                        if (result) {
                            swal({
                                type: "success",
                                title: "Éxito",
                                text: "Se han registrado los vacunados exitosamente",
                                timer: 2000,
                                showConfirmButton: false
                            });

                            setTimeout(function() {
                                document.getElementById("formulario").submit();
                            }, 1000);
                        } else {
                            swal({
                                type: "error",
                                title: "Error",
                                text: "Esta persona ya se encuentra registrada como vacunado",
                                timer: 2000,
                                showConfirmButton: false
                            });
                        }
                    });

                }
            } else {
                swal({
                    type: "error",
                    title: "Error",
                    text: "Debe seleccionar una persona",
                    timer: 2000,
                    showConfirmButton: false
                });
            }



        });
    });
</script>