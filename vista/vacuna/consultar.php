<?php include (call."Inicio.php"); ?>
<?php include (call."data-table.php"); ?>

<!-- Contenido de la pagina -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Consulta de Vacunas </h1>
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
                <h3 class="card-title">Consulta y Exportacion de Datos de Vacunas</h3>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered  table-hover">
                    <thead>
                        <tr>
                            <th>Cedula</th>
                            <th>Nombre y Apellido</th>
                            <th>Dosis</th>
                            <th>Fecha</th>
                            <th style="width: 115px;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <script>
                        $(function() {
                            $.ajax({
                                type: 'POST',
                                url: BASE_URL + 'Personas/Consultas_Vacunas_Ajax'
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
                                                return '<td class="text-center">' +
                                                    '<a href="javascript:void(0)" style="margin-right: 5px;" class="btn bg-success btnEditar" onclick="editar(this)"  title="Actualizar"  type="button" >' +
                                                    '<i class="fa fa-edit" style="color: white;"></i>' +
                                                    '</a>' +

                                                    '<a href="javascript:void(0)" style="margin-right: 5px;" class="btn bg-danger mensaje-eliminar" title="Eliminar">' +
                                                    '<i class="fa fa-trash"></i>' +
                                                    '</a>' +
                                                    '<p style="display: none;">' + data
                                                    .id_vacuna_covid + '</p>' +
                                                    '</td>';
                                            }
                                        },

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

                                    
                                    
                 $(document).on("click", ".mensaje-eliminar", function () {
                fila = $(this).closest("tr");
                cedula_persona = fila.find("td:eq(0)").text();


                swal(
                    {
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
                    function (isConfirm) {
                        if (isConfirm) {
                            $.ajax({
                                url: BASE_URL + "Personas/Eliminar_Vacunados",
                                type: "POST",
                                data: {
                                    cedula_persona: cedula_persona,
                                },
                            }).done(function (result) {
                                if (result != 0) {
                                    swal({
                                        title: "Eliminado!",
                                        text: "El elemento fue eliminado con exito.",
                                        type: "success",
                                        showConfirmButton: false,
                                    }); 
                                    setTimeout(function () {
                                        location.reload();
                                    }, 2000);

                                    // tabla.ajax.reload(null, false);
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


                        });
                        </script>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Cedula</th>
                            <th>Nombre y Apellido</th>
                            <th>Dosis</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
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
<?php include modal."ver-vacuna.php"; ?>
<?php include modal."editar-vacuna.php"; ?>

<!-- /.content-wrapper -->
<?php include (call."Fin.php"); ?>

<script type="text/javascript" src="<?php echo constant('URL')?>config/js/news/consultar-vacunados.js"></script>