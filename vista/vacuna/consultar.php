<?php include(call . "Inicio.php"); ?>
<?php include(call . "data-table.php"); ?>

<!-- Contenido de la pagina -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Consulta de Vacunados </h1>
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
                <h3 class="card-title">Consulta y exportación de datos de vacunados contra el covid19</h3>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered  table-hover">
                    <thead>
                        <tr>
                            <th>Cédula</th>
                            <th>Nombre y Apellido</th>
                            <th>Dosis</th>
                            <th>Fecha</th>
                            <th>Ver</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <script type="text/javascript">
                            cargar_tabla();
                            function cargar_tabla() {
                                $.ajax({
                                    type: "POST",
                                    url: BASE_URL + "app/Direcciones.php",
                                    data: {
                                        direction: 'Vacunados/Administrar',
                                        accion: "codificar"
                                    },
                                    success: function(direccion_segura) {
                                        $.ajax({
                                            type: 'POST',
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
                                                    },
                                                    {
                                                        "data": "nombre_apellido"
                                                    },
                                                    {
                                                        "data": "dosis"
                                                    },
                                                    {
                                                        "data": "fecha_vacuna"
                                                    },
                                                    {
                                                        "data": function(data) {
                                                            return ('<td class="text-center">' + '<a href="javascript:void(0)" style="margin-right: 5px;background: #4dbdbd !important;" class="btn bg-info ver-popup" onclick="ver(this)" title="Ver" type="button" data-toggle="modal" data-target="#ver">' + '<i class="fa fa-eye"></i>' + "</a>" + '<p style="display: none;">' + "</td>");
                                                        }
                                                    },
                                                    {
                                                        "data": function(data) {
                                                            return '<td class="text-center">' +
                                                                '<a href="javascript:void(0)" style="margin-right: 5px;" class="btn bg-info btnEditar" onclick="editar(this)"  title="Actualizar"  type="button" >' +
                                                                '<i class="fa fa-edit" style="color: white;"></i>' +
                                                                '</a></td>';
                                                        }
                                                    },
                                                    {
                                                        "data": function(data) {
                                                            return '<td class="text-center">' +
                                                                '<a href="javascript:void(0)" style="margin-right: 5px;" class="btn bg-danger mensaje-eliminar" title="Eliminar">' +
                                                                '<i class="fa fa-trash"></i>' +
                                                                '</a>' +
                                                                '<p style="display: none;">' + data
                                                                .id_vacuna_covid + '</p>' +
                                                                '</td>';
                                                        }
                                                    }

                                                ],
                                                "responsive": true,
                                                "autoWidth": false,
                                                "ordering": true,
                                                "info": true,
                                                "processing": true,
                                                "pageLength": 10,
                                                "lengthMenu": [5, 10, 20, 30, 40, 50, 100]
                                            }).buttons().container().appendTo(
                                                '#example1_wrapper .col-md-6:eq(0)');



                                            $(document).on("click", ".mensaje-eliminar", function() {
                                                fila = $(this).closest("tr");
                                                cedula_persona = fila.find("td:eq(0)").text();

                                                var estado = {
                                                    tabla: "vacuna_covid",
                                                    id_tabla: "cedula_persona",
                                                    param: cedula_persona,
                                                    estado: 0
                                                };

                                                swal({
                                                        title: "¿Desea Eliminar este Elemento?",
                                                        text: "El elemento seleccionado sera eliminado de manera permanente!",
                                                        type: "warning",
                                                        showCancelButton: true,
                                                        confirmButtonColor: "#DD6B55",
                                                        confirmButtonText: "Si, Eliminar!",
                                                        cancelButtonText: "No, Cancelar!",
                                                        closeOnConfirm: false,
                                                        closeOnCancel: false,
                                                    },
                                                    function(isConfirm) {
                                                        if (isConfirm) {
                                                            $.ajax({
                                                                url: BASE_URL + direccion_segura,
                                                                type: "POST",
                                                                data: {
                                                                    peticion: "Eliminar",
                                                                    estado: estado,
                                                                    sql: "ACT_DES",
                                                                    accion: "Se ha Eliminado el  Vacunado: " + fila.find("td:eq(1)").text(),
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
                                                                        text: result,
                                                                        type: "error",
                                                                        html: true,
                                                                        showConfirmButton: true,
                                                                        customClass: "bigSwalV2",
                                                                    });
                                                                }
                                                            });
                                                        } else {
                                                            swal("Cancelado", "La accion fue cancelada, la informacion esta segura.", "error");
                                                        }
                                                    }
                                                );
                                            });
                                        }).fail(function() {
                                            alert("error")
                                        })
                                    },
                                    error: function() {
                                        alert('Error al codificar dirreccion');
                                    }
                                });
                            }
                        </script>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Cédula</th>
                            <th>Nombre y Apellido</th>
                            <th>Dosis</th>
                            <th>Fecha</th>
                            <th>Ver</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
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
<?php include modal . "ver-vacuna.php"; ?>
<?php include modal . "editar-vacuna.php"; ?>

<!-- /.content-wrapper -->
<?php include(call . "Fin.php"); ?>

<script type="text/javascript" src="<?php echo constant('URL') ?>config/js/news/consultar-vacunados.js"></script>