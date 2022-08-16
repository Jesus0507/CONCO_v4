<?php include call . "Inicio.php";?>
<?php include (call."data-table.php"); ?>

<!-- Contenido de la pagina -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Consulta de Roles </h1>
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
                <h3 class="card-title">Permisos y Roles del Usuario</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body" >
                <table style="width:100%">
                    <tr><td>
                <div style="width:95%">

                           <table id="example1" class="table table-bordered  table-hover" >
                    <thead>
                        <tr>
                            <th>
                                Cédula
                            </th>
                            <th >
                                Usuario
                            </th>
                            <th >
                                Estado
                            </th>
                            <th>
                                Rol
                            </th>
                            <th>
                                Editar
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                    <script>

                        cargar_tabla();
                        function cargar_tabla(){
                        $(function() {
                            $.ajax({
                                type: 'POST',
                                url: BASE_URL + 'Seguridad/get_info_permisos'
                            }).done(function(datos) {
                                var data = JSON.parse(datos);
                                $("#example1").DataTable({
                                    "data": data,
                                    "columns": [{
                                            "data": "cedula_usuario"
                                        },
                                        {
                                            "data": "usuario"
                                        },
                                        {
                                            "data":"estado"
                                        },
                                        {
                                            "data": "rol"
                                        },
                                        {
                                            "data": "editar"
                                        },
                                    ],
                                    "responsive": true,
                                    "autoWidth": false,
                                    "ordering": true,
                                    "info": false,
                                    "processing": true,
                                    "pageLength": 10,
                                    "lengthMenu": [5, 10, 20, 30, 40, 50, 100]
                                }).buttons().container().appendTo(
                                    '#example1_wrapper .col-md-6:eq(0)');
                            }).fail(function() {
                                alert("error")
                            })

                        });
                    }
                        </script>
                    </tbody>
                    <tfoot>
                       <tr>
                            <th>
                                Cédula
                            </th>
                            <th >
                                Usuario
                            </th>
                            <th >
                                Estado
                            </th>
                            <th>
                                Rol
                            </th>
                            <th>
                               Editar
                            </th>

                        </tr>
                    </tfoot>
                </table>
            </div></td><td>
            <div >
                <h3>Configuración de roles:</h3><br>
               <div class="info-box mb-3 " style="background:#073E4D;color:white">
        <span class="info-box-icon"><i class="fa fa-universal-access"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Super Usuario</span>
        </div>
         <span class="fa fa-cog cog-icon" onclick="get_permisos_rol('Super Usuario');" style="font-size:30px" ></span>
        <!-- /.info-box-content -->
    </div>


      <div class="info-box mb-3 " style="background:#125D71;color:white">
        <span class="info-box-icon"><i class="fa fa-user-circle"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Administrador</span>
        </div>
       <span class="fa fa-cog cog-icon" onclick="get_permisos_rol('Administrador');" style="font-size:30px"></span>
        <!-- /.info-box-content -->
    </div>

      <div class="info-box mb-3 " style="background:#3295B0;color:white">
        <span class="info-box-icon"><i class="fa fa-user"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Habitante</span>
        </div>
         <span class="fa fa-cog cog-icon" onclick="get_permisos_rol('Habitante');" style="font-size:30px"></span>
        <!-- /.info-box-content -->
    </div>


            </div>
        </td></tr></table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
    <!-- /.content -->
</div>
<?php include modal."editar-roles.php"; ?>
<?php include modal."ver-permisos.php"; ?>
<?php include (call."style-permisos-roles.php"); ?>
<script type="text/javascript" src="<?php echo constant('URL')?>config/js/news/permisos_roles.js"></script>
<!-- /.content-wrapper -->
<?php include call . "Fin.php";?>