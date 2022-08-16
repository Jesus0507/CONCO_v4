<?php include (call."Inicio.php"); ?>

<!-- Contenido de la pagina -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0" id="title-notification"><em class="fa fa-file-text"></em> Solicitudes de constancia</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
  <center>
   <div style="width:98%;background: white;height: 65vh;border-radius: 30px;">
<div style="width:95%;text-align: justify; ">

    <br>
    <table style="width:100%">
      <tr><td>
        <b>Solicitudes pendientes <em class="fa fa-clock-o"></em></b>
      <div style="width:95%;background: #DEEEE2;padding-left: 6%;padding-right: 6%;border-radius: 5px;overflow-y: scroll;height:50vh">
       <table style='width:100%'>
         <tr>
          <td style="text-align:right" id="total_pendientes">
            Total: 0 
          </td>
         </tr>
       </table> 
       <hr>
       <div id="solicitudes_pendientes">
       <table style='width:100%'>
         <tr>
          <td>
            <em class="fa fa-user-circle"></em> <span style="font-weight: bolder">Juanito alcachofa</span>
          </td>
         </tr>
         <tr>
           <td style="font-size:12px">Constancia de residencia <em class="fa fa-home"></em></td>
           <td style="font-size:12px">2021-22-10</td>
         </tr>
       </table> 
       <hr>

     </div>

</div>
</td>
<td><b>Solicitudes aprobadas <em class="fa fa-check"></em></b>
  <div style="width:95%;background: #94EDE4;padding-left: 6%;padding-right: 6%;border-radius: 5px;overflow-y: scroll;height:50vh">
  <table style='width:100%'>
         <tr>
          <td style="text-align:right" id="total_aprobadas">
            Total: 0 
          </td>
         </tr>
       </table> 
       <hr>
       <div id="solicitudes_aprobadas">
       <table style='width:100%'>
         <tr>
          <td>
            <em class="fa fa-user-circle"></em> <span style="font-weight: bolder">Juanito alcachofa</span>
          </td>
         </tr>
         <tr>
           <td style="font-size:12px">Constancia de residencia <em class="fa fa-home"></em></td>
           <td style="font-size:12px">2021-22-10</td>
         </tr>
       </table> 
       <hr>
       
     </div>
</div>
</td>
<td>
  <b>Solicitudes rechazadas <em class='fa fa-times'></em></b>
  <div style="width:95%;background: #C59696;padding-left: 6%;padding-right: 6%;border-radius: 5px;overflow-y: scroll;height:50vh">
  <table style='width:100%'>
         <tr>
          <td style="text-align:right" id="total_rechazadas">
            Total: 0 
          </td>
         </tr>
       </table> 
       <hr>
       <div id="solicitudes_rechazadas">
       <table style='width:100%'>
         <tr>
          <td>
            <em class="fa fa-user-circle"></em> <span style="font-weight: bolder">Juanito alcachofa</span>
          </td>
         </tr>
         <tr>
           <td style="font-size:12px">Constancia de residencia <em class="fa fa-home"></em></td>
           <td style="font-size:12px">2021-22-10</td>
         </tr>
       </table> 
       <hr>
       
     </div>
</div>
</td>
</tr></table>

     </div>  
   </div>
</center>
    </section>
    <!-- /.content -->
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include (call."Fin.php"); ?>
<script type="text/javascript" src="<?php echo constant('URL')?>config/js/news/index-solicitudes.js"></script>
<!--         <br>
        <table style="width:100%">
          <tr>
            <td style="width:7%;text-align: center"><em style="font-size:60px" class="fa fa-user"></em> <h3>Pruieba</h3></td>
            <td style="width:70%;text-align:center"><h4>Notificación</h4></td>

           <td style="width:20%;text-align:right"><em style="font-size:40px;padding-top:0px" class="fa fa-clock-o"></em><br><br> <b>Fecha</b></td></tr>
            </table>
    <br> -->