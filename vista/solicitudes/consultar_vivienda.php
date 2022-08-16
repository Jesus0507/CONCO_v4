<?php include(call . "Inicio.php"); ?>


<!-- Contenido de la pagina -->
<div class="content-wrapper">
    <input type="hidden" id="id_solicitud" value="<?php echo $_GET['id'] ?>">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0" id="title-solicitud">Consejo Comunal Prados de Occidente</h1>
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
                        <div style="width:100%;text-align: right;font-size:24px"><em class="fa fa-clock-o"></em> <span id="fecha_solicitud">Fecha</span></div>
                        <center>
                            <br>
                            <span style="font-size:80px" class="fa fa-user-o"></span>
                            <h4 id="persona">Pruieba</h4>
                            <input type='hidden' id='id_servicio'>
                        </center>
                        <br>
                        <center>
                            <table style='width:98%;' border='1'>
                                <tr style='background:#699373;color:white'>
                                    <td class='text-center' style='width:30%'>
                                        <strong><span class='fa fa-road'></span>
                                            Calle:</strong><br>

                                    </td>
                                    <td class='text-center' style='width:30%'>
                                        <strong><span class='fa fa-location-arrow'></span>
                                            Dirección de vivienda:</strong><br>

                                    </td>
                                    <td class='text-center' style='width:30%'>
                                        <strong><span class='fa fa-map-signs'></span>
                                            Número de vivienda:</strong><br>

                                    </td>
                                </tr>
                                <tr>
                                    <td id='calle' class="text-center"></td>
                                    <td id='direccion' class='text-center'></td>
                                    <td id='nro_vivienda' class='text-center'></td>
                                </tr>
                            </table>

                            <br>

                            <table style='width:98%;' border='1'>
                                <tr style='background:#699373;color:white'>
                                    <td class='text-center' style='width:30%'>
                                        <strong><span class='fa fa-bed'></span>
                                            Cantidad de habitaciones:</strong><br>

                                    </td>
                                    <td class='text-center' style='width:30%'>
                                        <strong><span class='fa fa-home'></span>
                                            Tipo de vivienda:</strong><br>

                                    </td>
                                    <td class='text-center' style='width:30%'>
                                        <strong><span class='fa fa-signal'></span>
                                            Condición de vivienda:</strong><br>

                                    </td>
                                </tr>
                                <tr>
                                    <td id='habitaciones' class="text-center"></td>
                                    <td id='tipo_vivienda' class='text-center'></td>
                                    <td id='condicion' class='text-center'></td>
                                </tr>
                            </table><br>
                            <table style='width:98%;' border='1'>
                                <tr style='background:#699373;color:white'>
                                    <td class='text-center' style='width:30%'>
                                        <strong><span class='fa fa-users'></span>
                                            Hacinamiento:</strong><br>
                                    </td>
                                    <td class='text-center' style='width:30%'>
                                        <strong><span class='fa fa-tree'></span>
                                            Espacio de siembra:</strong><br>
                                    </td>
                                    <td class='text-center' style='width:30%'>
                                        <strong><span class='fa fa-bath'></span>
                                            Baño sanitario:</strong><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td id='hacinamiento' class="text-center"></td>
                                    <td id='espacio_siembra' class='text-center'></td>
                                    <td id='sanitario' class='text-center'></td>
                                </tr>
                            </table><br>
                            <table style='width:98%;' border='1'>
                                <tr style='background:#699373;color:white'>
                                    <td class='text-center' style='width:30%'>
                                        <strong><span class='fa fa-shower'></span>
                                            Agua de consumo:</strong><br>
                                    </td>
                                    <td class='text-center' style='width:30%'>
                                        <strong><span class='fa fa-tint'></span>
                                            Aguas negras:</strong><br>
                                    </td>
                                    <td class='text-center' style='width:30%'>
                                        <strong><span class='fa fa-trash'></span>
                                            Residuos sólidos:</strong><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td id='agua_consumo' class="text-center"></td>
                                    <td id='aguas_negras' class='text-center'></td>
                                    <td id='residuos_solidos' class='text-center'></td>
                                </tr>
                            </table><br>
                            <table style='width:98%;' border='1'>
                                <tr style='background:#699373;color:white'>
                                    <td class='text-center' style='width:30%'>
                                        <strong><span class='fa fa-plug'></span>
                                            Cableado eléctrico:</strong><br>
                                    </td>
                                    <td class='text-center' style='width:30%'>
                                        <strong><span class='fa fa-phone'></span>
                                            Cableado telefónico:</strong><br>
                                    </td>
                                    <td class='text-center' style='width:30%'>
                                        <strong><span class='fa fa-wifi'></span>
                                            Servicio de internet:</strong><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td id='cableado_electrico' class="text-center"></td>
                                    <td id='cableado_telefonico' class='text-center'></td>
                                    <td id='internet' class='text-center'></td>
                                </tr>
                            </table><br>
                            <table style='width:98%;' border='1'>
                                <tr style='background:#699373;color:white'>
                                    <td class='text-center' style='width:30%'>

                                        <strong><span class='fa fa-fire'></span>
                                            Gas doméstico:</strong><br>
                                    </td>
                                    <td class='text-center' style='width:30%'>

                                        <strong><span class='fa fa-paw'></span>
                                            Animales domésticos:</strong><br>
                                    </td>
                                    <td class='text-center' style='width:30%'>

                                        <strong><span class='fa fa-bug'></span>
                                            Plagas:</strong><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td id='gas' class="text-center"></td>
                                    <td id='animales' class='text-center'></td>
                                    <td id='plagas' class='text-center'></td>
                                </tr>
                            </table><br>
                            <table style='width:98%;' border='1'>
                            <tr style='background:#699373;color:white'>
                                <td class='text-center' colspan='3'>
                                    <strong><span class='fa fa-commenting-o'></span>
                                        Descripción de la vivienda:</strong><br>

                                </td>
                            </tr>
                            <tr>
                                    <td id='descripcion' class="text-center"></td>
                          </tr>
                           </table><br>
                           <table style='width:98%;' border='1'>
                            <tr style='background:#699373;color:white'>
                                <td class='text-center' style='width:30%'>
                                    <strong><span class='fa fa-arrow-up'></span>
                                        Tipo(s) de techo:</strong><br>
                                </td>
                                <td class='text-center' style='width:30%'>
                                    <strong><span class='fa fa-square'></span>
                                        Tipo(s) de pared:</strong><br>
                                </td>
                                <td class='text-center' style='width:30%'>
                                    <strong><span class='fa fa-arrow-down'></span>
                                        Tipo(s) de piso:</strong><br>
                                </td>
                            </tr>
                            <tr>
                                    <td id='tipo_techo' class="text-center"></td>
                                    <td id='tipo_pared' class='text-center'></td>
                                    <td id='tipo_piso' class='text-center'></td>
                                </tr>
                           </table><br>
                           <table style='width:98%;' border='1'>
                            <tr style='background:#699373;color:white'>
                                <td class='text-center' style='width:50%'>
                                    <strong><span class='fa fa-free-code-camp'></span>
                                        Tipo(s) de servicio de gas:</strong><br>
                                </td>
                                <td class='text-center' style='width:50%'>
                                    <strong><span class='fa fa-cogs'></span>
                                        Electrodomésticos:</strong><br>
                                </td>
                            </tr>
                            <tr>
                                    <td id='tipo_gas' class="text-center" style='width:50%'></td>
                                    <td id='electrodomestico' class='text-center' style='width:50%'></td>
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
<script type="text/javascript" src="<?php echo constant('URL') ?>config/js/news/solicitudes-consulta-vivienda.js"></script>