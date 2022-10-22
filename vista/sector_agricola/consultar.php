<?php include (call."Inicio.php"); ?>
<?php include (call."data-table.php"); ?>

<!-- Contenido de la pagina -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Consulta del Sector agrícola </h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Consulta y exportacion de datos de sector agrícola </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered  table-hover">
                    <thead>
                        <tr>
                            <th>Cédula</th>
                            <th>Nombre y apellido</th>

                            <th>Área de producción</th>
                            <th>Años de experiencia</th>
                            <th style="width: 115px;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <script src="<?php echo constant('URL')?>config/js/ajax/Ajax_Consultas_Sector_Agricola.js">
                        </script>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Cédula</th>
                            <th>Nombre y apellido</th>

                            <th>Área de producción</th>
                            <th>Años de experiencia</th>
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
<?php include modal."ver-sector_agricola.php"; ?>
<?php include modal."editar-sector_agricola.php"; ?>
<!-- /.content-wrapper -->
<?php include (call."Fin.php"); ?>