<?php include (call."Inicio.php"); ?>
<?php include (call."data-table.php"); ?>

<!-- Contenido de la pagina -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Consulta de Mienbros del Consejo Comunal </h1>
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
                <h3 class="card-title">Consulta y Exportacion de Datos de Consejo Comunal</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="tabla" class="table table-bordered  table-hover">
                    <thead>
                        <tr>
                            <th>Cedula</th>
                            <th>Nommbre y Apellido</th>
                            
                            <th>Comite</th>
                            <th>Cargo de Vocero</th>
                            <th>Fecha de Ingreso</th>
                            <th>Fecha de Salida</th>
                            <th style="width: 115px;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <script src="<?php echo constant('URL')?>config/js/ajax/Ajax_Consultas_Consejo_Comunal.js"></script>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Cedula</th>
                            <th>Nommbre  y Apellido</th>
                            
                            <th>Comite</th>
                            <th>Cargo de Vocero</th>
                            <th>Fecha de Ingreso</th>
                            <th>Fecha de Salida</th>
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
<?php include modal."ver-consejo_comunal.php"; ?>
<?php include modal."editar-consejo_comunal.php"; ?>
<!-- /.content-wrapper -->
<?php include (call."Fin.php"); ?>