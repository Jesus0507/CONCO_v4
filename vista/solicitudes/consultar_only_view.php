<?php include (call."Inicio.php"); ?>

<!-- Contenido de la pagina -->
<div class="content-wrapper">
    <input type="hidden" id="id_solicitud" value="<?php echo $_GET['id'] ?>">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0" id="title-solicitud-view">Consejo Comunal Prados de Occidente</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
  <center>
   <div style="width:95%;background: white;height: 120vh;border-radius: 30px;">
<div style="width:90%;text-align: justify; ">

    <br>
      <div id="div_background" style="width:100%;padding-left: 6%;padding-right: 6%;border-radius: 30px">
        <br>
        <div style="width:100%;text-align: right;font-size:24px"><em class="fa fa-clock-o" ></em> <span id="fecha_solicitud">Fecha</span></div>
        <center>
          <br>
    <span style="font-size:80px" class="fa fa-user-o"></span> <h4 id="persona">Pruieba</h4>
    </center>
    <br>
 <span style="font-size:60px" class="fa fa-file-text-o"></span></td><td ><h5 id="tipo_constancia">constancia</h5>
  <br>
<span style="font-size:60px" class="fa fa-question-circle-o"></span></td><td ><h5 id="motivo">Motivo de solicitud</h5>
  <br>
<span style="font-size:60px" class="fa fa-calendar"></span></td><td ><h5 id="fecha_proceso">Motivo de solicitud</h5>
  <div id="rechazo_div" style="display:none">
   <br>
<span style="font-size:60px" class="fa fa-times-circle"></span></td><td ><h5 id="motivo_rechazo">Motivo de solicitud</h5>

</div>
  <br><br>

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
<script type="text/javascript" src="<?php echo constant('URL')?>config/js/news/solicitudes-consulta-only-view.js"></script>