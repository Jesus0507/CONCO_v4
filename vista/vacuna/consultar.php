<?php include (call."Inicio.php"); ?>
<?php include (call."data-table.php"); ?>

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
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <script type="text/javascript"
                            src="<?php echo constant('URL')?>config/js/news/crud-vacunados.js"></script>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Cédula</th>
                            <th>Nombre y Apellido</th>
                            <th>Dosis</th>
                            <th>Fecha</th>
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
<?php include modal."ver-vacuna.php"; ?>
<?php include modal."editar-vacuna.php"; ?>

<!-- /.content-wrapper -->
<?php include (call."Fin.php"); ?>

<script type="text/javascript" src="<?php echo constant('URL')?>config/js/news/consultar-vacunados.js"></script> 