<?php include call . "Inicio.php";?>
<?php include call . "data-table.php";?>

<!-- Contenido de la pagina -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Consulta de Personas con Discapacidad</h1>
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
                            <th>Cedula</th>
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
        url: BASE_URL + "Discapacitados/Administrar",
        data: {
            peticion: "Consulta_Ajax",
        },
    }).done(function(datos) {
        var data = JSON.parse(datos);
        var discapacidades = [];
        var div_discapacidades = document.getElementById("discapacidades_agregadas");
        $("#example1").DataTable({
            "data": data,
            "columns": [{
                    "data": "cedula"
                }, {
                    "data": "nombre"
                }, {
                    "data": "discapacidades"
                }, <?php if ($_SESSION['Discapacitados']['modificar']) {?> {
                    "data": "editar"
                }, <?php }?>
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
            "lengthMenu": [5, 10, 20, 30, 40, 50, 100]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $(document).on('click', '.editar', function() {
            fila = $(this).closest("tr");
            cedula = fila.find('td:eq(0)').text();
            nombre = fila.find('td:eq(1)').text();
            $('#cedula').val(cedula);
            $('#nombre').val(nombre);
        });
        $(document).on('click', '#agregar', function() {
            if ((discapacidad_input.style.display != 'none' && discapacidad_input.value == '') || (discapacidad_input.style.display == 'none' && discapacidad_select.value == 'vacio')) {
                valid_discapacidad.innerHTML = 'Ingrese la discapacidad';
                discapacidad_input.style.borderColor = 'red';
                discapacidad_input.focus();
            } else {
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
                textoObservaciones == '' ? disc['observaciones'] = "No posee" : disc['observaciones'] = textoNecesidades;
                var div = document.createElement("div");
                var table = document.createElement("table");
                table.style.width = '100%';
                var tr = document.createElement("tr");
                var td1 = document.createElement("td");
                var td2 = document.createElement("td");
                var td3 = document.createElement("td");
                var td4 = document.createElement("td");
                var td5 = document.createElement("td");
                td5.style.textAlign = 'right';
                td1.innerHTML = textoDiscapacidad;
                td2.innerHTML = textoEnCama;
                td3.innerHTML = textoNecesidades;
                td4.innerHTML = textoObservaciones;
                necesidades.value = '';
                observaciones.value = '';
                discapacidad_select.value = 'vacio';
                discapacidad_input.value = '';
                en_cama.value = 'vacio';
                var button = document.createElement("input");
                button.type = 'button';
                button.value = 'X';
                button.className = 'btn btn-danger';
                td5.appendChild(button);
                tr.appendChild(td1);
                tr.appendChild(td2);
                tr.appendChild(td3);
                tr.appendChild(td4);
                tr.appendChild(td5);
                table.appendChild(tr);
                div.appendChild(table);
                var hr = document.createElement("hr");
                discapacidades.push(disc);
                div.appendChild(hr);
                div_discapacidades.appendChild(div);
                button.onclick = function() {
                    div_discapacidades.removeChild(div);
                    discapacidades.splice(discapacidades.indexOf(disc), 1);
                }
            }
        });
        $(document).on('click', '#enviar', function() {
            $.ajax({
                type: "POST",
                url: BASE_URL + "Discapacitados/Administrar",
                data: {
                    cedula: $('#cedula').val(),
                    discapacidades: discapacidades,
                    peticion: "Registrar",
                    sql: "SQL_06",
                    accion: "Se ha Actualizado el  Discapacitado pordator de la Cedula: " + $('#cedula').val(),
                },
            }).done(function(result) {
                if (result == 1) {
                    swal({
                        title: "Actualizado!",
                        text: "El elemento fue Actualizado con exito.",
                        type: "success",
                        showConfirmButton: false
                    });
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
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
        });
        $(document).on('click', '#btn_nueva_discapacidad', function() {
            if (discapacidad_input.style.display == 'none') {
                valid_discapacidad.innerHTML = '';
                discapacidad_input.style.display = '';
                discapacidad_select.style.display = 'none';
                discapacidad_select.value = 'vacio';
                discapacidad_input.focus();
                btn_nueva_discapacidad.innerHTML = 'Atrás';
            } else {
                valid_discapacidad.innerHTML = '';
                discapacidad_input.style.display = 'none';
                discapacidad_select.style.display = '';
                discapacidad_input.value = '';
                discapacidad_select.focus();
                btn_nueva_discapacidad.innerHTML = 'Nueva discapacidad';
            }
        });
    }).fail(function() {
        alert("error")
    })
});
</script>
</tbody>
<tfoot>
    <tr>
       <th>Cedula</th>
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



