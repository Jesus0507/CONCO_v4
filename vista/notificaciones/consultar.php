<?php include (call."Inicio.php"); ?>
<?php include (call."data-table.php"); ?>

<!-- Contenido de la pagina -->
<div class="content-wrapper">
    <input type="hidden" id="id_notificacion" value="<?php echo $_GET['id'] ?>">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0" id="title-notification">Consejo Comunal Prados de Occidente</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
  <center>
   <div style="width:95%;background: white;height: 90vh;border-radius: 30px;">
<div style="width:90%;text-align: justify; ">

    <br>
      <div style="width:100%;background: #94EDE4;padding-left: 6%;padding-right: 6%;border-radius: 30px">
        <br>
    <em style="font-size:50px" class="fa fa-user"></em> <h4 id="usuario">Pruieba</h4>
    <br>
</div>
     <br>
       <div style="width:100%;background: #94EDE4;padding-left: 6%;border-radius: 30px;padding-right: 6%">
        <br>
    <em style="font-size:50px" class="fa fa-clock-o"></em> <h4 id="fecha">Fecha</h4>
    <br>
</div>
     <br>
     <div style="width:100%;background: #94EDE4;padding-left: 6%;border-radius: 30px;padding-right: 6%">
        <br>
    <em style="font-size:50px" class="fa fa-bell"></em> <h4 id="notificacion">Texto</h4>
<br>
</div>
     </div>  
   </div>
</center>
    </section>
    <!-- /.content -->
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script type="text/javascript" src="<?php echo constant('URL')?>config/js/news/notificaciones-consulta.js"></script>
<?php include (call."Fin.php"); ?>