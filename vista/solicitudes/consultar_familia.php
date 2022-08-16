<?php include(call . "Inicio.php"); ?>


<!-- Contenido de la pagina -->
<div class="content-wrapper">
    <input type="hidden" id="id_solicitud" value="<?php echo $_GET['id'] ?>">
    <input type="hidden" id="id_familia" value="<?php echo $this->familia[0]['id_familia']; ?>">
    <input type="hidden" id="cedula_solicitante" value="<?php echo $this->solicitante[0]['cedula_persona']; ?>">
    <input type="hidden" id="correo_solicitante" value="<?php echo $this->solicitante[0]['correo']; ?>">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0" id="title-solicitud"><em class='fa fa-users'></em> Solicitud de registro de familia</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>


    <div id="app" style="padding-top: 8rem;display:none">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3 form-group">
                    <label>
                        Nombre:
                    </label>
                    <input class="form-control" id='email_name' type="text" v-model="from_name">
                    </input>
                </div>
                <div class="col-sm-6 col-sm-offset-3 form-group">
                    <label>
                        Asunto:
                    </label>
                    <input class="form-control" type="text" v-model="subject" id='email_subject'>
                    </input>
                </div>
                <div class="col-sm-6 col-sm-offset-3 form-group">
                    <label>
                        Correo:
                    </label>
                    <input class="form-control" type="email" v-model="from_email" id='email_email'>
                    </input>
                </div>
                <div class="col-sm-6 col-sm-offset-3 form-group">
                    <label>
                        Mensaje:
                    </label>
                    <textarea class="form-control" v-model="message" id='email_message'>
                        </textarea>
                </div>
                <div class="col-sm-6 col-sm-offset-3 text-center">
                    <button @click="enviar" class="btn btn-success" id='btn_correo'>
                        Enviar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <center>
            <div style="width:95%;background: white;height: 170vh;border-radius: 30px;">
                <div style="width:90%;text-align: justify; ">

                    <br>
                    <div style="width:100%;background: #DEEEE2;padding-left: 6%;padding-right: 6%;border-radius: 30px">
                        <br>
                        <div style="width:100%;text-align: right;font-size:24px"><em class="fa fa-clock-o"></em> <span id="fecha_solicitud"><?php echo date('d-m-Y', strtotime($this->solicitud[0]['fecha_solicitud'])); ?></span></div>
                        <center>
                            <br>
                            <span style="font-size:80px" class="fa fa-user-o"></span>
                            <h4 id="persona"><?php echo $this->solicitante[0]['primer_nombre'] . " " . $this->solicitante[0]['primer_apellido']; ?></h4>
                        </center>
                        <br>
                        <center>
                            <table style='width:98%;' border='1'>
                                <tr style='background:#699373;color:white'>
                                    <td class='text-center' style='width:30%'>
                                        <strong><span class='fa fa-users'></span>
                                            Familia:</strong><br>

                                    </td>
                                    <td class='text-center' style='width:30%'>
                                        <strong><span class='fa fa-phone'></span>
                                            Teléfono:</strong><br>

                                    </td>
                                    <td class='text-center' style='width:30%'>
                                        <strong><span class='fa fa-map-signs'></span>
                                            Dirección:</strong><br>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center"><?php echo $this->familia[0]['nombre_familia']; ?></td>
                                    <td class='text-center'><?php echo $this->familia[0]['telefono_familia']; ?></td>
                                    <td class='text-center'><?php echo $this->vivienda[0]['direccion_vivienda']; ?></td>
                                </tr>
                            </table>

                            <br>

                            <table style='width:98%;' border='1'>
                                <tr style='background:#699373;color:white'>
                                    <td class='text-center' style='width:30%'>
                                        <strong><span class='fa fa-map-signs'></span>
                                            Nro de casa:</strong><br>

                                    </td>
                                    <td class='text-center' style='width:30%'>
                                        <strong><span class='fa fa-home'></span>
                                            Ingreso mensual aproximado:</strong><br>

                                    </td>
                                    <td class='text-center' style='width:30%'>
                                        <strong><span class='fa fa-signal'></span>
                                            Condición de ocupación:</strong><br>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center"><?php echo $this->vivienda[0]['numero_casa']; ?></td>
                                    <td class='text-center'><?php echo $this->familia[0]['ingreso_mensual_aprox']; ?></td>
                                    <td class='text-center'><?php echo $this->familia[0]['condicion_ocupacion']; ?></td>
                                </tr>
                            </table><br>
                            <table style='width:98%;' border='1'>
                                <tr style='background:#699373;color:white'>
                                    <td class='text-center' style='width:100%'>
                                        <strong><span class='fa fa-user'></span>
                                            Integrantes (<?php echo count($this->integrantes); ?>):</strong><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td  style='width:100%'>
                                    <?php foreach($this->integrantes as $i){ ?>
                                      <div onclick='ver_info_integrante(`<?php echo json_encode($i); ?>`);' class='div_integrantes' title='Ver información del integrante'> 
                                           * 
                                        <?php echo $i['primer_nombre']." ".$i['primer_apellido']." (".$i['cedula_persona'].")"; ?>        
                                    <hr>
                                    </div>
                                        <?php } ?>
                                    </td>
                                </tr>
                            </table>
                        </center>
                        <br><br>
                        <center><button type="button" class="btn btn-primary" id="aprobar">Aprobar</button> <button type="button" class="btn btn-danger" id="rechazar">Rechazar</button></center>
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

<?php include(call . "Fin.php"); ?>
<?php include(call . "style-agenda.php"); ?>
<script src="<?php echo constant('URL') ?>config/js/vue.min.js"></script>
<script type="text/javascript" src="<?php echo constant('URL') ?>config/js/email.min.js"></script>
<script type="text/javascript" src="<?php echo constant('URL') ?>config/js/news/solicitudes-consulta-familia.js"></script>