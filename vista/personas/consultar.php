<?php include call . "Inicio.php";?>
<?php include call . "data-table.php";?>

<!-- Contenido de la pagina -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Consulta de Personas </h1>
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
                <h3 class="card-title">Consulta y exportación de datos de personas</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered  table-hover">
                    <thead>
                        <tr>
                            <th>Cédula</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Teléfono</th>
                            <th>Género</th>
                            <th style="width: 20px;">Ver</th>
                            <?php if ($_SESSION['Personas']['modificar']) {?>
                            <th style="width: 20px;">Editar</th>
                            <?php }?>
                            <?php if ($_SESSION['Personas']['eliminar']) {?>
                            <th style="width: 20px;">Eliminar</th>
                            <?php }?>
                        </tr>
                    </thead>
                    <tbody>
                        <script type="text/javascript">
                        cargar_tabla_personas();

                        function cargar_tabla_personas() {
                            $(function() {
                                $.ajax({
                                    type: "POST",
                                    url: BASE_URL + "app/Direcciones.php",
                                    data: {
                                        direction: 'Personas/consultar_informacion_persona',
                                        accion: "codificar"
                                    },
                                    success: function(direccion_segura) {
                                        $.ajax({
                                            type: 'POST',
                                            url: BASE_URL + direccion_segura
                                        }).done(function(datos) {
                                            var data = JSON.parse(datos);
                                            $("#example1").DataTable({
                                                "data": data,
                                                "columns": [{
                                                        "data": "cedula"
                                                    },
                                                    {
                                                        "data": "primer_nombre"
                                                    },
                                                    {
                                                        "data": "primer_apellido"
                                                    },
                                                    {
                                                        "data": "telefono"
                                                    },
                                                    {
                                                        "data": "genero"
                                                    },
                                                    {
                                                        "data": "ver"
                                                    },
                                                    <?php if ($_SESSION['Personas']['modificar']) {?> {
                                                        "data": "editar"
                                                    },
                                                    <?php }?>
                                                    <?php if ($_SESSION['Personas']['eliminar']) {?> {
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
                                                "lengthMenu": [5, 10, 20, 30, 40,
                                                    50, 100
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

                            });
                        }
                        </script>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Cédula</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Teléfono</th>
                            <th>Género</th>
                            <th>Ver</th>
                            <?php if ($_SESSION['Personas']['modificar']) {?>
                            <th>Editar</th>
                            <?php }?>
                            <?php if ($_SESSION['Personas']['eliminar']) {?>
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

<!-- /.content-wrapper -->
<?php include call . "Fin.php";?>
<?php include modal . "editar_persona.php";?>
<?php include call . "Style-agenda.php";?>

<script type="text/javascript" src="<?php echo constant('URL') ?>config/js/news/consulta-personas.js"></script>