<?php include call . "Inicio.php";?>
<?php include call . "data-table.php";?>
<!-- Contenido de la pagina -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Consulta de eventos </h1>
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
                <h3 class="card-title">Consulta de eventos en la agenda de la comunidad</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered  table-hover">
                    <thead>
                        <tr>
                            <th>Creador</th>
                            <th>fecha</th>
                            <th>Evento</th>
                            <th>Horas</th>
                            <th style="width: 20px;">Ver</th>
                          <?php if ($_SESSION['Agenda']['modificar']) {?>
                            <th style="width: 20px;">Editar</th>
                        <?php }?>
                        <?php if ($_SESSION['Agenda']['eliminar']) {?>
                            <th style="width: 20px;">Eliminar</th>
                        <?php }?>
                        </tr>
                    </thead>
                    <tbody>
                        <script>
                        $(function() {
                            $.ajax({
                                type: "POST",
                                url: BASE_URL + "Agenda/Administrar",
                                data: {
                                    peticion: "Consulta_Ajax",
                                },
                            }).done(function(datos) {
                                var data = JSON.parse(datos);
                                
                                $("#example1").DataTable({
                                    "data": data,
                                    "columns": [{
                                            "data": "usuario"
                                        },
                                        {
                                            "data": "fecha"
                                        },
                                        {
                                            "data": "tipo_evento"
                                        },
                                        {
                                            "data":"horas"
                                        },
                                        {
                                            "data": "ver"
                                        },
                                        <?php if ($_SESSION['Agenda']['modificar']) {?>
                                        {
                                            "data": "editar"
                                        },
                                    <?php }?>
                                    <?php if ($_SESSION['Agenda']['eliminar']) {?>
                                        {
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
                                }).buttons().container().appendTo(
                                    '#example1_wrapper .col-md-6:eq(0)');


                            }).fail(function() {
                                alert("error")
                            })

                        });
                        </script>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Creador</th>
                            <th>Fecha</th>
                            <th>Evento</th>
                            <th>Horas</th>
                            <th>Ver</th>
                           <?php if ($_SESSION['Agenda']['modificar']) {?>
                            <th>Editar</th>
                        <?php }?>
                        <?php if ($_SESSION['Agenda']['eliminar']) {?>
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
<?php include modal . "editar-evento.php";?>
<?php include call . "style-agenda.php";?>

<!-- /.content-wrapper -->
<?php include call . "Fin.php";?>

<script type="text/javascript" src="<?php echo constant('URL') ?>config/js/news/consultar-eventos.js"></script>