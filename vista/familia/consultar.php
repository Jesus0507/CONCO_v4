<?php include (call."Inicio.php"); ?>
<?php include (call."data-table.php"); ?>

<!-- Contenido de la pagina -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Consulta de Familias </h1>
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
                <h3 class="card-title">Consulta y Exportacion de Datos de Usuarios</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered  table-hover">
                    <thead>
                        <tr>
                            <th>Familia</th>
                            <th>Teléfono</th>
                            <th>Dirección</th>
                            <th>Nro Casa</th>
                            <th>Ingreso mensual aprox</th>
                            <th style="width: 20px;">Ver</th>
                            <?php if($_SESSION['Nucleo familiar']['modificar']){ ?>
                            <th style="width: 20px;">Editar</th>
                            <?php } ?>
                            <?php if($_SESSION['Nucleo familiar']['eliminar']){ ?>
                            <th style="width: 20px;">Eliminar</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <script>
                        $(function() {
                            $.ajax({
                                type: "POST",
                                url: BASE_URL + "app/Direcciones.php",
                                data: {
                                    direction: 'Familias/consultar_info_familia',
                                    accion: "codificar"
                                },
                                success: function(direccion_segura) {
                                    $.ajax({
                                        type: 'POST',
                                        url: BASE_URL + direccion_segura,
                                    }).done(function(datos) {
                                        var data = JSON.parse(datos);

                                        $("#example1").DataTable({
                                            "data": data,
                                            "columns": [{
                                                    "data": "familia"
                                                },
                                                {
                                                    "data": "telefono"
                                                },
                                                {
                                                    "data": "direccion"
                                                },
                                                {
                                                    "data": "Nro Casa"
                                                },
                                                {
                                                    "data": "ingreso_mensual"
                                                },
                                                {
                                                    "data": "ver"
                                                },
                                                <?php if($_SESSION['Nucleo familiar']['modificar']){ ?> {
                                                    "data": "editar"
                                                },
                                                <?php } ?>
                                                <?php if($_SESSION['Nucleo familiar']['eliminar']){ ?> {
                                                    "data": "eliminar"
                                                }
                                                <?php } ?>
                                            ],
                                            "responsive": true,
                                            "autoWidth": false,
                                            "ordering": true,
                                            "info": true,
                                            "processing": true,
                                            "pageLength": 10,
                                            "lengthMenu": [5, 10, 20, 30, 40, 50,
                                                100
                                            ]
                                        }).buttons().container().appendTo(
                                            '#example1_wrapper .col-md-6:eq(0)');


                                    }).fail(function() {
                                        alert("error")
                                    })
                                },
                                error: function() {
                                    alert('Error al codificar dirreccion');
                                }
                            });

                            $(document).on('click', '#enviar', function() {
                                var vivienda = document.getElementById("vivienda_familia");
                                var nombre_familia = document.getElementById("nombre_familia");
                                var telefono_familia = document.getElementById('telefono_familia');
                                var ingreso_aprox = document.getElementById("ingreso_aprox");
                                var observaciones = document.getElementById("observaciones_familia");
                                var condicion_ocupacion_select = document.getElementById(
                                    "select-cond-ocupacion");
                                var condicion_ocupacion_input = document.getElementById(
                                    "input_condicion_ocupacion");
                                var datos_familia = new Object();
                                datos_familia['id_vivienda'] = parseInt(vivienda.value);
                                datos_familia['nombre_familia'] = nombre_familia.value;
                                datos_familia['telefono_familia'] = telefono_familia.value;
                                datos_familia['ingreso_mensual_aprox'] = ingreso_aprox.value;
                                condicion_ocupacion_select.style.display != 'none' ? datos_familia[
                                        'condicion_ocupacion'] = condicion_ocupacion_select.value :
                                    datos_familia['condicion_ocupacion'] = condicion_ocupacion_input
                                    .value
                                observaciones.value == '' ? datos_familia['observacion'] =
                                    "Sin observaciones" : datos_familia['observacion'] = observaciones
                                    .value;

                                datos_familia['integrantes'] = integrantes;
                                datos_familia['estado'] = 1;
                                datos_familia['id_familia'] = $('#id_familia').val()

                                $.ajax({
                                    type: "POST",
                                    url: BASE_URL + "app/Direcciones.php",
                                    data: {
                                        direction: "Familias/actualizar_familia",
                                        accion: "codificar"
                                    },
                                    success: function(direccion_segura) {
                                        $.ajax({
                                            type: "POST",
                                            url: BASE_URL + direccion_segura,
                                            data: {
                                                "datos": datos_familia
                                            }
                                        }).done(function(result) {
                                            swal({
                                                title: "Éxito",
                                                text: "Familia Actualizada satisfactoriamente",
                                                timer: 2000,
                                                showConfirmButton: false,
                                                type: "success"
                                            });
                                        });
                                    },
                                    error: function() {
                                        alert('Error al codificar dirreccion');
                                    }
                                });
                            });

                            $(document).on('click', '#btn_agregar', function() {

                                if (integrantes_input.value == "") {
                                    integrantes_input.focus();
                                    valid_integrantes.innerHTML =
                                        'Debe ingresar la cédula o el nombre de una persona';
                                } else {
                                    valid_integrantes.innerHTML = "";
                                    if (valid_integrantes_agregados()) {
                                        valid_integrantes.innerHTML = "";
                                        $.ajax({
                                            type: "POST",
                                            url: BASE_URL + "app/Direcciones.php",
                                            data: {
                                                direction: 'Personas/Consultas_cedula',
                                                accion: "codificar"
                                            },
                                            success: function(direccion_segura) {
                                                $.ajax({
                                                    type: 'POST',
                                                    url: BASE_URL +
                                                        direccion_segura,
                                                    data: {
                                                        'cedula': integrantes_input
                                                            .value
                                                    }
                                                }).done(function(datos) {
                                                    if (datos != 0) {

                                                        var result = JSON.parse(
                                                            datos);
                                                        integrantes.push(result[0][
                                                            'cedula_persona'
                                                        ]);
                                                        integrantes_input.value =
                                                        '';
                                                        var div = document
                                                            .createElement("div");
                                                        div.style.width = '100%';
                                                        var tabla = document
                                                            .createElement("table");
                                                        tabla.style.width = '100%';
                                                        var tr = document
                                                            .createElement("tr");
                                                        var td1 = document
                                                            .createElement("td");
                                                        var td2 = document
                                                            .createElement("td");
                                                        td1.innerHTML =
                                                            "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-" +
                                                            result[0][
                                                                'primer_nombre'
                                                            ] + " " + result[0][
                                                                'primer_apellido'
                                                            ];
                                                        var btn = document
                                                            .createElement("input");
                                                        btn.type = "button";
                                                        btn.className =
                                                            "btn btn-danger";
                                                        btn.value = "X";
                                                        td2.style.textAlign =
                                                            "right";
                                                        td2.appendChild(btn);
                                                        tr.appendChild(td1);
                                                        tr.appendChild(td2);
                                                        tabla.appendChild(tr);
                                                        div.appendChild(tabla);
                                                        var hr = document
                                                            .createElement("hr");
                                                        div.appendChild(tabla);
                                                        div.appendChild(hr);
                                                        div_integrantes.appendChild(
                                                            div);
                                                        btn.onclick = function() {
                                                            div_integrantes
                                                                .removeChild(
                                                                    div);
                                                            integrantes.splice(
                                                                integrantes
                                                                .indexOf(
                                                                    result[
                                                                        0][
                                                                        'cedula_persona'
                                                                    ]), 1);
                                                        }

                                                    } else {
                                                        valid_integrantes
                                                            .innerHTML =
                                                            "Esta persona no está registrada";
                                                    }

                                                });
                                            },
                                            error: function() {
                                                alert('Error al codificar dirreccion');
                                            }
                                        });

                                    }
                                }
                            });

                        });
                        </script>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Familia</th>
                            <th>Teléfono</th>
                            <th>Dirección</th>
                            <th>Nro Casa</th>
                            <th>Ingreso mensual aprox</th>
                            <th>Ver</th>
                            <?php if($_SESSION['Nucleo familiar']['modificar']){ ?>
                            <th>Editar</th>
                            <?php } ?>
                            <?php if($_SESSION['Nucleo familiar']['eliminar']){ ?>
                            <th>Eliminar</th>
                            <?php } ?>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
    <!-- /.content -->
</div>
<?php include modal."editar-familia.php"; ?>
<!-- /.content-wrapper -->
<?php include (call."Fin.php"); ?>
<?php include (call."style-agenda.php"); ?>
<script type="text/javascript" src="<?php echo constant('URL')?>config/js/news/consultar-familias.js"></script>
<script type="text/javascript" src="<?php echo constant('URL')?>config/js/news/crud-familias.js"></script>
