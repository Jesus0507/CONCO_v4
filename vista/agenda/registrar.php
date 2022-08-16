<?php include (call."Inicio.php"); ?>
<!-- Contenido de la pagina -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Crear nuevo evento</h1>
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
                <h3 class="card-title">Calendario de eventos</h3>

            </div>
          <br>
          <center>
              <table style="width:100%">
                  <tr>
                    <td style="text-align:right;font-size:32px;cursor:pointer;color:#299287;" onmouseover="this.style.color='#49C5B8'" onmouseout="this.style.color='#299287'">
                        <em class="fas fa-arrow-circle-left" id="back-mes"></em>
                    </td>
                      <td style="text-align:center;font-size:30px;font-weight: bold">
                           <span id="mes-name">Mes</span> <span id="anio-name">Año</span>
                      </td>
                      <td style="text-align:left;font-size:32px;cursor:pointer;color:#299287;" onmouseover="this.style.color='#49C5B8'" onmouseout="this.style.color='#299287'">
                        <em class="fas fa-arrow-circle-right" id="next-mes" ></em>
                    </td>
                  </tr>
              </table>
              <div style="width:100%;height:2px;background:#299287"></div>
              <br>
              <div id="calendario-view"style='width:90%'></div>
              <br>
              <button class='btn btn-info' id='crear-evento-boton' >Crear evento</button>
              <br><br>
          </center>
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include (call."Fin.php"); ?>
<?php include modal . "registro-de-evento.php";?>
<?php include (call."Style-seguridad.php"); ?>
<?php include (call."style-agenda.php"); ?>
<script type="text/javascript" src="<?php echo constant('URL')?>config/js/news/validacion_agenda.js"></script>
