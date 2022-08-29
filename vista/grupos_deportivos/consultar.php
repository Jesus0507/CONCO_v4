<?php include (call."Inicio.php"); ?>
<?php include (call."data-table.php"); ?>

<!-- Contenido de la pagina -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Consulta de Grupos Deportivos </h1>
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
                <h3 class="card-title">Consulta y Exportacion de Datos de Grupos Deportivos</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered  table-hover">
                    <thead>
                        <tr>
                            <th>Nombre del Grupo</th>
                            <th>Deporte</th>
                            <th>Descripcion</th>
                            <th style="width: 115px;">Acciones</th>

                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>

                            <th>Nombre del Grupo</th>
                            <th>Deporte</th>
                            <th>Descripcion</th>
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
<?php include modal."ver-grupo_deportivo.php"; ?>
<?php include modal."editar-grupo_deportivo.php"; ?>
<script src="<?php echo constant('URL')?>config/js/ajax/Ajax_Consultas_Grupos_Deportivo.js">
</script>
<!-- /.content-wrapper -->
<?php include (call."Fin.php"); ?>