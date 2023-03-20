<?php include call . "Inicio.php"; ?>
<?php include call . "data-table.php"; ?>

<!-- Contenido de la pagina -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Consulta de Personas con Patologías</h1>
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
                <h3 class="card-title">Consulta y exportación de datos de personas con alguna enfermedad</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered  table-hover">
                    <thead>
                        <tr>
                            <th>Cédula</th>
                            <th>Nombre</th>
                            <th>Enfermedades</th>
                            <th>Medicamentos</th>


                            <?php if ($_SESSION['Enfermos']['modificar']) { ?>
                                <th style="width: 20px;">Editar</th>
                            <?php } ?>
                            <?php if ($_SESSION['Enfermos']['eliminar']) { ?>
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
                                        direction: "Enfermos/Administrar",
                                        accion: "codificar"
                                    },
                                    success: function(direccion_segura) {
                                        $.ajax({
                                            type: "POST",
                                            url: BASE_URL + direccion_segura,
                                            data: {
                                                peticion: "Consulta_Ajax",
                                            },
                                        }).done(function(datos) {
                                            var data = JSON.parse(datos);
                                            var enfermedades = [];
                                            var btn_nueva_enfermedad = document.getElementById(
                                                "btn_nueva_enfermedad");
                                            $("#example1").DataTable({
                                                "data": data,
                                                "columns": [{
                                                        "data": "cedula"
                                                    }, {
                                                        "data": "nombre"
                                                    }, {
                                                        "data": "enfermedades"
                                                    }, {
                                                        "data": "medicamentos"
                                                    },

                                                    <?php if ($_SESSION['Enfermos']['modificar']) { ?> {
                                                            "data": "editar"
                                                        },
                                                    <?php } ?>
                                                    <?php if ($_SESSION['Enfermos']['eliminar']) { ?> {
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
                                            $(document).on('click', '.editar', function() {
                                                fila = $(this).closest("tr");
                                                cedula = fila.find('td:eq(0)').text();
                                                nombre = fila.find('td:eq(1)').text();
                                                $('#cedula').val(cedula);
                                                $('#nombre').val(nombre);
                                            });
                                            $(document).on('click', '#agregar', function() {
                                             var enfermedad_input = document.getElementById("enfermedad_input");
                                             var enfermedad_select = document.getElementById("enfermedad_select");
                                             var medicamentos = document.getElementById('medicamentos');
                                             var valid_enfermedad = document.getElementById("valid_enfermedad");
                                             var div_enfermedaedes = document.getElementById("enfermedades_agregadas");
                                             var enfermedades_previas = JSON.parse(document.getElementById('enfermedades_previas').innerHTML);

                                             if ((enfermedad_input.style.display !='none' && enfermedad_input.value == '') || 
                                                ( enfermedad_input.style.display == 'none' && enfermedad_select.value == 'vacio')) {
                                                    valid_enfermedad.innerHTML = 'Ingrese la patología';
                                                    enfermedad_input.style.borderColor = 'red';
                                                    enfermedad_input.focus();
                                                }  else {
                                                    var agregado = false;
                                                    for (var i = 0; i < enfermedades_previas.length; i++) {

                                                        if (enfermedad_input.style.display != 'none') {

                                                           if (enfermedades_previas[i]['nombre_enfermedad'].toLowerCase() == enfermedad_input.value.toLowerCase()) {
                                                                agregado = true;
                                                            }

                                                            if (!agregado) {
                                                                var opt_select = enfermedad_select.options;
                                                                for (var j = 0; j < opt_select.length; j++) {
                                                                    if (opt_select[j].label.toLowerCase() == enfermedad_input.value.toLowerCase()) {
                                                                        if (opt_select[j].value == enfermedades_previas[i]['id_enfermedad']) {
                                                                            agregado = true;
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        } else {

                                                            if (enfermedad_select.value == enfermedades_previas[i]['id_enfermedad']) {
                                                                agregado = true;
                                                            }

                                                            if (!agregado) {
                                                                if (enfermedad_select.options[enfermedad_select.selectedIndex].text.toLowerCase() == enfermedades_previas[i]['nombre_enfermedad'].toLowerCase()) {
                                                                    agregado = true;
                                                                }
                                                            }
                                                        }
                                                    }
                                                    
                                                    if(agregado){
                                                    valid_enfermedad.innerHTML = 'Esta patología ya se encuentra agregada';
                                                    enfermedad_input.style.borderColor = 'red';
                                                    enfermedad_input.focus();
                                                    }
                                                    else {
                                                        valid_enfermedad.innerHTML = '';
                                                        enfermedad_input.style.borderColor = '';
                                                        var enfer = new Object();
                                                        var textoEnfermedad = "";
                                                        var textoMedicamento = medicamentos.value;
                                                        enfermedad_input.style.display != 'none' ? enfer['enfermedad'] = enfermedad_input.value : enfer['enfermedad'] = enfermedad_select.value;
                                                        enfermedad_input.style.display != 'none' ? textoEnfermedad = enfermedad_input.value : textoEnfermedad = enfermedad_select.options[enfermedad_select.selectedIndex].text;
                                                        enfermedad_input.style.display != 'none' ? enfer['nuevo'] = '1' : enfer['nuevo'] = '0'; 
                                                        textoMedicamento == '' ? enfer[ 'medicamentos'] = "No posee" : enfer[ 'medicamentos'] = textoMedicamento;
                                                        enfermedades.push(enfer);
                                                        $.ajax({
                                                        type: "POST",
                                                        url: BASE_URL +
                                                        direccion_segura,
                                                        data: {
                                                        cedula: $('#cedula').val(),
                                                        enfermedades: enfermedades,
                                                        peticion: "Registrar",
                                                        sql: "SQL_05",
                                                        accion: "Se ha Actualizado una patologia al pordator de la Cedula: " + $('#cedula').val(),
                                                        },
                                                        }).done(function(result) {
                                                        if (result == 1) {
                                                            enfermedades = [];
                                                            $.ajax({
                                                        type: "POST",
                                                        url: BASE_URL + "app/Direcciones.php",
                                                        data: {
                                                            direction: "Enfermos/Administrar",
                                                            accion: "codificar"
                                                        },
                                                        success: function (direccion_segura) {
                                                            $.ajax({
                                                                type: "POST",
                                                                url: BASE_URL + direccion_segura,
                                                                type: "POST",
                                                                data: {
                                                                    peticion: "Datos",
                                                                    'cedula': cedula
                                                                },
                                                            }).done(function (datos) {
                                                                var data = JSON.parse(datos);
                                                                document.getElementById('enfermedades_previas').innerHTML = datos;
                                                                var enfermedades = document.getElementById('enfermedades_agregadas');
                                                                if (data.length == 0) {
                                                                    enfermedades.innerHTML = "No aplica";
                                                                } else {
                                                                    enfermedades.innerHTML = "";
                                                                    for (var i = 0; i < data.length; i++) {
                                                                        var med = '';
                                                                        data[i]['medicamentos'] != 'No posee' ? med = data[i]['medicamentos'] : med = '';
                                                                        var tabl = enfermedades.innerHTML += " <div class='w-100'><hr><div style='width:90%' class='d-flex flex-row justify-content-between'><div>-" + data[i]["nombre_enfermedad"] + "</div><div>" + med + "</div><div><button type='button' onclick='borrar_enfermedad(" + data[i]['id_persona_enfermedad'] + "," + data[i]["cedula_persona"] + ")' class='btn btn-danger' title='Eliminar Enfermedad' style='font-size:22px'>X</button></div></div></div><hr>";
                                                                    }
                                                                    enfermedad_input.value = '';
                                                                    enfermedad_select.value = 'vacio';
                                                                    medicamentos.value = '';
                                                                }

                                                            });
                                                        },
                                                        error: function () {
                                                            alert('Error al codificar dirreccion');
                                                        }
                                                    });
                                                        } else {
                                                        swal({
                                                            title: "ERROR!",
                                                            text: "Ha ocurrido un Error.</br>" + result,
                                                            type: "error",
                                                            html: true,
                                                            showConfirmButton: true,
                                                            customClass: "bigSwalV2",
                                                        });
                                                    }
                                                });
                                                    }
                                                }
                                            });
                                            
                                            $(document).on('click', '#btn_nueva_enfermedad',
                                                function() {
                                                    var enfermedad_input = document
                                                        .getElementById("enfermedad_input");
                                                    var valid_enfermedad = document
                                                        .getElementById("valid_enfermedad");
                                                    if (enfermedad_input.style.display ==
                                                        'none') {
                                                        valid_enfermedad.innerHTML = '';
                                                        enfermedad_input.style.display = '';
                                                        enfermedad_select.style.display =
                                                            'none';
                                                        enfermedad_select.value = 'vacio';
                                                        enfermedad_input.focus();
                                                        btn_nueva_enfermedad.innerHTML =
                                                            'Atrás';
                                                    } else {
                                                        valid_enfermedad.innerHTML = '';
                                                        enfermedad_input.style.display =
                                                            'none';
                                                        enfermedad_select.style.display =
                                                            '';
                                                        enfermedad_input.value = '';
                                                        enfermedad_select.focus();
                                                        btn_nueva_enfermedad.innerHTML =
                                                            'Nueva enfermedad';
                                                    }
                                                });
                                            $(document).on('click', '#enviar', function() {
                                                swal({
                                                            title: "Actualizado!",
                                                            text: "El elemento fue Actualizado con exito.",
                                                            type: "success",
                                                            showConfirmButton: false
                                                        });
                                                        setTimeout(function() {
                                                            location
                                                                .reload();
                                                        }, 2000);
                                            });
                                        }).fail(function() {
                                            alert("error")
                                        })
                                    },
                                    error: function() {
                                        alert('Error al codificar dirreccion');
                                    }
                                });
                            });
                        </script>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Cédula</th>
                            <th>Nombre</th>
                            <th>Enfermedades</th>
                            <th>Medicamentos</th>
                            <!-- <th style="width: 20px;">Ver</th> -->
                            <?php if ($_SESSION['Enfermos']['modificar']) { ?>
                                <th style="width: 20px;">Editar</th>
                            <?php } ?>
                            <?php if ($_SESSION['Enfermos']['eliminar']) { ?>
                                <th style="width: 20px;">Eliminar</th>
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
<?php include modal . "editar-enfermos.php"; ?>
<!-- /.content-wrapper -->
<script src="<?php echo constant('URL') ?>config/js/news/crud-enfermos.js"></script>
<?php include call . "Fin.php"; ?>