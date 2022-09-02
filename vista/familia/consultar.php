<?php include call . "Inicio.php";?>
<?php include call . "data-table.php";?>

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
                            <?php if ($_SESSION['Nucleo familiar']['modificar']) {?>
                            <th style="width: 20px;">Editar</th>
                            <?php }?>
                            <?php if ($_SESSION['Nucleo familiar']['eliminar']) {?>
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
                                    direction: 'Familias/Administrar',
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
                                                <?php if ($_SESSION['Nucleo familiar']['modificar']) {?> {
                                                    "data": "editar"
                                                },
                                                <?php }?>
                                                <?php if ($_SESSION['Nucleo familiar']['eliminar']) {?> {
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


                                    }).fail(function() {
                                        alert("error")
                                    })
                                },
                                error: function() {
                                    alert('Error al codificar dirreccion');
                                }
                            });

                            $(document).on('click', '#enviar', function() {
                               Actualizar_Familia();
                            });

                            $(document).on('click', '#btn_agregar', function() {
                                Nuevo_Integrante();
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
                            <?php if ($_SESSION['Nucleo familiar']['modificar']) {?>
                            <th>Editar</th>
                            <?php }?>
                            <?php if ($_SESSION['Nucleo familiar']['eliminar']) {?>
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
<?php include modal . "editar-familia.php";?>
<!-- /.content-wrapper -->
<?php include call . "Fin.php";?>
<?php include call . "style-agenda.php";?>
<script type="text/javascript" src="<?php echo constant('URL') ?>config/js/news/consultar-familias.js"></script>
