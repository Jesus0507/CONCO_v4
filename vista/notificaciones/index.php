<?php include (call."Inicio.php"); ?>

<!-- Contenido de la pagina -->
<div class="content-wrapper">
    <input type="hidden" id="id_notificacion" value="<?php echo $_GET['id'] ?>">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0" id="title-notification"><em class="fa fa-bell"></em> Notificaciones</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
  <center>
   <div style="width:95%;background: white;height: 90vh;border-radius: 30px;overflow-y: scroll;">
<div style="width:90%;text-align: justify; " id="divNotificaciones">

    <br>
      <div style="width:100%;background: #94EDE4;padding-left: 6%;padding-right: 6%;border-radius: 30px">
        <br>
        <table style="width:100%">
          <tr>
            <td style="width:7%;text-align: center"><em style="font-size:60px" class="fa fa-user"></em> <h3>Pruieba</h3></td>
            <td style="width:70%;text-align:center"><h4>Notificación</h4></td>

           <td style="width:20%;text-align:right"><em style="font-size:40px;padding-top:0px" class="fa fa-clock-o"></em><br><br> <b>Fecha</b></td></tr>
            </table>
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

<?php include (call."Fin.php"); ?>
<script type="text/javascript" src="<?php echo constant('URL')?>config/js/news/index-notificaciones.js"></script>