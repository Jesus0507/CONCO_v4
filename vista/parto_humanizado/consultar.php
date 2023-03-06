<?php include (call."Inicio.php"); ?>
<?php include (call."data-table.php"); ?>

<!-- Contenido de la pagina -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Consulta de Parto Humanizado </h1>
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
                <h3 class="card-title">Consulta y exportación de datos de embarazadas</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered  table-hover">
                    <thead>
                        <tr>
                            <th>Cédula</th>
                            <th>Nombre y Apellido</th>
                            <th>Tiempo de gestación</th>
                            <th>Fecha aproximada de parto</th>
                             <th style="width: 20px;">Ver</th>
                            <?php if ($_SESSION['Parto humanizado']['modificar']) {?>
                            <th>Editar</th>
                            <?php }?>
                            <?php if ($_SESSION['Parto humanizado']['eliminar']) {?>
                            <th>Eliminar</th>
                            <?php }?>
                        </tr>
                    </thead>
                    <tbody>
                        <script type="text/javascript">
                            $(function() {
    $.ajax({
        type: "POST",
        url: BASE_URL + "app/Direcciones.php",
        data: {
            direction: "Parto_Humanizado/Administrar",
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
                var tabla = $("#example1").DataTable({
                    "data": data,
                    "columns": [{
                        "data": "cedula_persona"
                    }, {
                        "data": function(data) {
                            return data.primer_nombre + " " + data.primer_apellido;
                        },
                    }, {
                        "data": "tiempo_gestacion"
                    }, {
                        "data": function(data) {
                            if (data.fecha_aprox_parto != "0000-00-00") {
                                return data.fecha_aprox_parto;
                            } else {
                                return "Sin Especificar";
                            }
                        },
                    },
                      {
                        "data": function(data) {
                            return '<td class="text-center">' + 
                            '<a href="javascript:void(0)" style="background: #4dbdbd !important;margin-right: 5px;" class="btn bg-info ver-popup" title="Ver" type="button" data-toggle="modal" data-target="#ver">' + 
                                '<i class="fa fa-eye"></i>' + 
                            '</a>' + 
                            '<p style="display: none;">' + data.id_parto_humanizado + '</p>' + '</td>';
                        }
                    },
 <?php if ($_SESSION['Parto humanizado']['modificar']) {?>
                     {
                        "data": function(data) {
                            return '<td class="text-center">' + 
                            '<a href="javascript:void(0)" style="margin-right: 5px;" class="btn bg-info btnEditar"  title="Actualizar" type="button" data-toggle="modal" data-target="#actualizar">' + 
                                '<i class="fa fa-edit" style="color: white;"></i>' + 
                            '</a>' + '</td>';
                        }
                    }, 
                    <?php }?>
<?php if ($_SESSION['Parto humanizado']['eliminar']) {?>
                     {
                        "data": function(data) {
                            return '<td class="text-center">' + 
                            '<a href="javascript:void(0)" style="margin-right: 5px;" class="btn bg-danger mensaje-eliminar" title="Eliminar">' + 
                                '<i class="fa fa-trash"></i>' + 
                            '</a>' + '</td>';
                        }
                    }, 
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
                /* OPCION ELIMINAR */
                $(document).on("click", ".mensaje-eliminar", function() {
                    fila = $(this).closest("tr");
                    id = fila.find('td:eq(4)').text();
                    var estado = {
                        tabla: "parto_humanizado",
                        id_tabla: "id_parto_humanizado",
                        param: id,
                        estado: 0
                    };
                    swal({
                        title: "¿Desea Eliminar este Elemento?",
                        text: "El elemento seleccionado sera eliminado",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Si, Eliminar!",
                        cancelButtonText: "No, Cancelar!",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    }, function(isConfirm) {
                        if (isConfirm) {
                            $.ajax({
                                url: BASE_URL + direccion_segura,
                                type: "POST",
                                data: {
                                    peticion: "Eliminar",
                                    estado: estado,
                                    sql: "ACT_DES",
                                    accion: "Se ha Eliminado la  Embarazada: " + fila.find("td:eq(1)").text(),
                                },
                            }).done(function(result) {
                                if (result == 1) {
                                    swal({
                                        title: "Eliminado!",
                                        text: "El elemento fue eliminado con exito.",
                                        type: "success",
                                        showConfirmButton: false,
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
                            })
                        } else {
                            swal("Cancelado", "La accion fue cancelada, la informacion esta segura.", "error");
                        }
                    });
                });
                $(document).on('click', '.ver-popup', function() {
                    fila = $(this).closest("tr");
                    id = fila.find('td:eq(4)').text();
                    nombre = fila.find('td:eq(1)').text();
                    $('#nombre_apellido').val(nombre);
                    $.ajax({
                        url: BASE_URL + direccion_segura,
                        type: "POST",
                        data: {
                            peticion: "Persona_Parto_Humanizado",
                            "id": id,
                            sql: "_05_",
                        },
                    }).done(function(result) {
                        var result = JSON.parse(result);
                        $('#cedula_persona').val(result[0]["cedula_persona"]);
                        $('#recibe_micronutrientes').val(result[0]["recibe_micronutrientes"]);
                        $('#tiempo_gestacion').val(result[0]["tiempo_gestacion"]);
                        $('#fecha_aprox_parto').val(result[0]["fecha_aprox_parto"]);
                    });
                });
                $(document).on('click', '.btnEditar', function() {
                    fila = $(this).closest("tr");
                    id = fila.find('td:eq(4)').text();
nombre = fila.find('td:eq(1)').text();
                         $('#nombre_apellido2').val(nombre);
                    $.ajax({
                        url: BASE_URL + direccion_segura,
                        type: "POST",
                        data: {
                            peticion: "Persona_Parto_Humanizado",
                            "id": id,
                            sql: "_05_",
                        },
                    }).done(function(result) {
                        console.log(result);
                        var result = JSON.parse(result);
                        
                        $('#cedula_persona2').val(result[0]["cedula_persona"]);
                        $('#recibe_micronutrientes2').val(result[0]["recibe_micronutrientes"]);
                        $('#tiempo_gestacion2').val(result[0]["tiempo_gestacion"]);
                        $('#fecha_aprox_parto2').val(result[0]["fecha_aprox_parto"]);
                    });
                    $(document).on("click", "#enviar", function() {
                        var datos = {
                            id_parto_humanizado: id,
                            cedula_persona: document.getElementById("cedula_persona2").value,
                            recibe_micronutrientes: document.getElementById("recibe_micronutrientes2").value,
                            tiempo_gestacion: document.getElementById("tiempo_gestacion2").value,
                            fecha_aprox_parto: document.getElementById("fecha_aprox_parto2").value,
                            estado: 1
                        };
                        $.ajax({
                            type: "POST",
                            url: BASE_URL + direccion_segura,
                            data: {
                                datos: datos,
                                peticion: "Editar",
                                sql: "SQL_03",
                                accion: "Se ha Actualizado la  Embarazada: " + fila.find("td:eq(1)").text(),
                            },
                        }).done(function(datos) {
                            if (datos == 1) {
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
                    });
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
                            <th>Nombre y Apellido </th>
                            <th>Tiempo de gestación</th>
                            <th>Fecha aproximada de parto</th>
                             <th style="width: 20px;">Ver</th>
                            <?php if ($_SESSION['Parto humanizado']['modificar']) {?>
                            <th>Editar</th>
                            <?php }?>
                            <?php if ($_SESSION['Parto humanizado']['eliminar']) {?>
                            <th>Eliminar</th>
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
<?php include modal."ver-parto_humanizado.php"; ?>
<?php include modal."editar-parto_humanizado.php"; ?>
<!-- /.content-wrapper -->
<?php include (call."Fin.php"); ?>