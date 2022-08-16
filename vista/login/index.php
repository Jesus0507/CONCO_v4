<!DOCTYPE html>
<html lang="es">
<?php include (call."Head.php"); ?>
<?php include (call."Style-login.php"); ?> 

<body class="hold-transition text-sm login-page layout-footer-fixed " id="body">
    <!-- ============================================================== -->
    <!-- Inicio contenido de pagina -->
    <!-- ============================================================== -->
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__wobble" src="<?php echo constant('URL');?>config/img/web/x3.png" alt="AdminLTELogo"
            height="60" width="60">
    </div>


    <div class="row mt-5">
        <!-- /.login-logo -->

        <div class="col-11">
            <div class="card card-outline card-primary card-outline-tabs">
            <div class="card-header text-center">
                <h3 href="" class="h3">Consejo Comunal Prados de Occidente</h3>
            </div>
            <div class="card-header p-0 pt-1 border-bottom-0">
               
              </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                  <div class="tab-pane fade show active" id="login2" role="tabpanel" aria-labelledby="login">
                     
                <form action="<?php echo constant('URL');?>Login/Administrar" method="POST" id="formulario_login">
                    <input type="hidden" name="peticion" value="Ingreso">
                    <div id="mensaje-cedula" style="color:red;"></div>
                    <div class="input-group mb-3">
                        <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number"
    maxlength = "9" class="form-control" id="cedula" placeholder="Usuario" name="cedula_usuario">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <a href="javascript:void(0);" type="button" class="btn"
                                    style="margin: 0px;padding: 0px;">
                                    <span class="fas fa-user"></span>
                                </a>
                            </div>
                        </div>

                    </div>
                    <div id="mensaje-contrasenia" style="color:red;"></div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control contraseña" placeholder="Contraseña" id="contrasenia"
                            name="datos[password]">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <a href="javascript:void(0);" type="button" class="btn"
                                    style="margin: 0px;padding: 0px;" id="mostrar">
                                    <span id="ojito" class="fas fa-eye"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <?php include privado."Captcha.php"; ?>
                        <!-- /.col -->
                        <div class="col-6 mt-2">
                            <input type="button" class="btn btn-primary btn-block" id="enviar" value="Entrar">
                        </div>
                        <div class="col-6 mt-2">
                            <button type="reset" class="btn btn-danger btn-block">Borrar</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <div class="text-center mt-3 mb-3">
                    <a href="#password" role="button" class="btn" id='olvidado' data-toggle="modal">
                        He olvidado mi contraseña
                    </a>
                    <?php include privado."recuperar_contraseña.php"; ?>
                </div>

                  </div>
                  <div class="tab-pane fade" id="constancia2" role="tabpanel" aria-labelledby="constancia">
                    <b>Cédula</b>
                  <table style="width:100%"><tr><td>  <input  type="number" maxlength="8" name="cedulaPersona" id="cedulaPersona" class="form-control" placeholder="Ingrese su cédula"></td></tr></table>

                  <br>

                  <div style="width: 100%;text-align: center;color:red" id="mensajeValidacionPersona" ></div>
                 

                 <br>

                  <button type='button'  id="consultaPersona" class='btn btn-primary' style='width:100%'>Ingresar</button>

                 

                  
                </div>
                
            </div>
            <!-- /.card-body -->
        </div>
        </div>
        <!-- /.card -->
    </div> 

    <!-- ============================================================== -->
    <!-- Final contenido de pagina -->
    <!-- ============================================================== -->
    <?php include (call."Script.php"); ?>
    <script src="<?php echo constant('URL')?>config/js/news/Validacion_Login.js"></script>
    <script src="<?php echo constant('URL')?>config/js/news/consulta-personas-solicitud.js"></script>
</body>

</html>
