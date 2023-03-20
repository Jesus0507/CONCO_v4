<?php include call . "Inicio.php";?>
<?php include call . "data-table.php";?>

<!-- Contenido de la pagina -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Consulta de Personas con discapacidad</h1>
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
                <h3 class="card-title">Consulta y exportación de datos de personas con alguna discapcidad</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered  table-hover">
                    <thead>
                        <tr>
                            <th>Cédula</th>
                            <th>Nombre</th>
                            <th>Discapacidades</th>
                            <?php if ($_SESSION['Discapacitados']['modificar']) {?>
                            <th style="width: 20px;">Editar</th>
                            <?php }?>
                            <?php if ($_SESSION['Discapacitados']['eliminar']) {?>
                            <th style="width: 20px;">Eliminar</th>
                            <?php }?>
                        </tr>
                    </thead>
                    <tbody>
                        <script>
                        $(function() {
                            $.ajax({
                                type: "POST",
                                url: BASE_URL + "app/Direcciones.php",
                                data: {
                                    direction: "Discapacitados/Administrar",
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
                                        document.getElementById('discapacidades_previas').innerHTML = datos;
                                        var discapacidades = [];
                                        var div_discapacidades = document.getElementById(
                                            "discapacidades_agregadas");
                                        $("#example1").DataTable({
                                            "data": data,
                                            "columns": [{
                                                    "data": "cedula"
                                                }, {
                                                    "data": "nombre"
                                                }, {
                                                    "data": "discapacidades"
                                                },
                                                <?php if ($_SESSION['Discapacitados']['modificar']) {?> {
                                                    "data": "editar"
                                                },
                                                <?php }?>
                                                <?php if ($_SESSION['Discapacitados']['eliminar']) {?> {
                                                    "data": "eliminar"
                                                }
                                                <?php }?>
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
                                            var discapacidad_input = document.getElementById("discapacidad_input");
                                             var discapacidad_select = document.getElementById("discapacidad_select");
                                             var en_cama = document.getElementById('en_cama');
                                             var necesidades = document.getElementById('necesidades');
                                             var observaciones = document.getElementById('observaciones');
                                             var valid_discapacidad = document.getElementById("valid_discapacidad");
                                             var div_discapacidades = document.getElementById("discapacidades_agregadas");
                                             var discapacidades_previas = JSON.parse(document.getElementById('discapacidades_previas').innerHTML);

                                            if ((discapacidad_input.style.display != 'none' && discapacidad_input.value == '') || (
                                                discapacidad_input.style.display == 'none' && discapacidad_select.value == 'vacio')) {
                                                   
                                                    valid_discapacidad.innerHTML = 'Ingrese la discapacidad';
                                                    discapacidad_input.style.borderColor = 'red';
                                                    discapacidad_input.focus();

                                                } 
                                                else {
                                                    if(en_cama.value == 'vacio'){
                                                    valid_discapacidad.innerHTML = 'Señale si está en cama';
                                                    en_cama.style.borderColor = 'red';
                                                    en_cama.focus();
                                                    }
                                                    else{
                                                    valid_discapacidad.innerHTML = '';
                                                    en_cama.style.borderColor = '';
                                                    en_cama.blur();
                                                    var agregado = false;

                                                    for (var i = 0; i < discapacidades_previas.length; i++) {

                                                    if (discapacidad_input.style.display != 'none') {

                                                    if (discapacidades_previas[i]['nombre_discapacidad'].toLowerCase() == discapacidad_input.value.toLowerCase()) {
                                                            agregado = true;
                                                        }

                                                        if (!agregado) {
                                                            var opt_select = discapacidad_select.options;
                                                            for (var j = 0; j < opt_select.length; j++) {
                                                                if (opt_select[j].label.toLowerCase() == discapacidad_input.value.toLowerCase()) {
                                                                    if (opt_select[j].value == discapacidades_previas[i]['id_discapacidad']) {
                                                                        agregado = true;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    } else {

                                                        if (discapacidad_select.value == discapacidades_previas[i]['id_discapacidad']) {
                                                            agregado = true;
                                                        }

                                                        if (!agregado) {
                                                            if (discapacidad_select.options[discapacidad_select.selectedIndex].text.toLowerCase() == discapacidades_previas[i]['nombre_discapacidad'].toLowerCase()) {
                                                                agregado = true;
                                                            }
                                                        }
                                                    }
                                                    }

                                                    if(agregado) {
                                                    valid_discapacidad.innerHTML = 'Esta discapacidad ya se encuentra agregada';
                                                    discapacidad_input.style.borderColor = 'red';
                                                    discapacidad_input.focus();
                                                    }
                                                    else {
                                                        valid_discapacidad.innerHTML = '';
                                                        discapacidad_input.style.borderColor = '';
                                                        var disc = new Object();
                                                        var textoDiscapacidad = "";
                                                        var textoNecesidades = necesidades.value;
                                                        var textoObservaciones = observaciones.value;
                                                        var textoEnCama = en_cama.options[en_cama.selectedIndex].text;
                                                        var en_cama_valor = en_cama.value;
                                                        discapacidad_input.style.display != 'none' ? disc['discapacidad'] = discapacidad_input.value : disc['discapacidad'] = discapacidad_select.value;
                                                        discapacidad_input.style.display != 'none' ? textoDiscapacidad = discapacidad_input.value : textoDiscapacidad = discapacidad_select.options[discapacidad_select.selectedIndex].text;
                                                        discapacidad_input.style.display != 'none' ? disc['nuevo'] = '1' : disc['nuevo'] = '0';
                                                        disc['en_cama'] = en_cama_valor;
                                                        textoNecesidades == '' ? disc['necesidades'] = "No posee" : disc['necesidades'] = textoNecesidades;
                                                        textoObservaciones == '' ? disc['observaciones'] = "No posee" : disc['observaciones'] = textoObservaciones;
                                                        discapacidades.push(disc);
                                                        $.ajax({
                                                        type: "POST",
                                                        url: BASE_URL +
                                                            direccion_segura,
                                                        data: {
                                                            cedula: $('#cedula').val(),
                                                            discapacidades: discapacidades,
                                                            peticion: "Administrar",
                                                            sql: "SQL_06",
                                                            accion: "Se ha Actualizado el  Discapacitado pordator de la Cedula: " +
                                                                $('#cedula').val(),
                                                        },
                                                        }).done(function(result) {
                                                            if(result == 1){
                                                                discapacidades = [];
                                                                editar($('#cedula').val());
                                                                discapacidad_input.value = discapacidad_select.style.display = necesidades.value = observaciones.value = '';
                                                                discapacidad_select.value = en_cama.value ='vacio';
                                                                discapacidad_input.style.display = 'none';
                                                                btn_nueva_discapacidad.innerHTML = 'Nueva discapacidad';
                                                            }
                                                    });
                                                        }    }
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
                                        $(document).on('click', '#btn_nueva_discapacidad',
                                            function() {
                                                if (discapacidad_input.style.display ==
                                                    'none') {
                                                    valid_discapacidad.innerHTML = '';
                                                    discapacidad_input.style.display =
                                                        '';
                                                    discapacidad_select.style.display =
                                                        'none';
                                                    discapacidad_select.value = 'vacio';
                                                    discapacidad_input.focus();
                                                    btn_nueva_discapacidad.innerHTML =
                                                        'Atrás';
                                                } else {
                                                    valid_discapacidad.innerHTML = '';
                                                    discapacidad_input.style.display =
                                                        'none';
                                                    discapacidad_select.style.display =
                                                        '';
                                                    discapacidad_input.value = '';
                                                    discapacidad_select.focus();
                                                    btn_nueva_discapacidad.innerHTML =
                                                        'Nueva discapacidad';
                                                }
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
                            <th>Discapacidades</th>
                            <?php if ($_SESSION['Discapacitados']['modificar']) {?>
                            <th style="width: 20px;">Editar</th>
                            <?php }?>
                            <?php if ($_SESSION['Discapacitados']['eliminar']) {?>
                            <th style="width: 20px;">Eliminar</th>
                            <?php }?>
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
<?php include modal . "editar-discapacitados.php";?>
<!-- /.content-wrapper -->
<script src="<?php echo constant('URL') ?>config/js/news/crud-discapacitados.js"></script>
<?php include call . "Fin.php";?>
<?php include call . "style-agenda.php";?>