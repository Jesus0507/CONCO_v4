<div class="modal fade" id="change_password">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Solicitud de cambio de contraseña</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span> 
                </button>
            </div>
            <div class="modal-body">
                <h5>Información del solicitante</h5>
                <br>
                <div class="mx-auto w-95">
                <span class='fa fa-drivers-license mt-2' style='font-size:23px'> Cédula</span><h6 id='cedula_solicitud' class='mt-2'>123456</h6>
                  <span class='fa fa-user mt-2' style='font-size:23px'> Descripción</span><h6 id='descripcion_solicitud' class='mt-2'>123456</h6>
                  <span class='fa fa-pencil mt-2' style='font-size:23px' id='sign-label'> Firma digital</span>
                  <input type="text" class="form-control w-100" id='firma_solicitud' class='mt-2' disabled value="sdfsdfsd">
                </div>
               <div class='d-none' id='adminInfo'>
               <hr>
               <h5>Información del Administrador</h5>
               <br>
               <span class='fa fa-drivers-license mt-2' style='font-size:23px'> Firma digital</span>
               <table class='w-100'>
                <tr>
                    <td><input type='text' id='firma_administrador' class='form-control' disabled></td>
                    <td><input type='button' id='decodificarFirma' value='Decodificar' class='btn btn-info'></td>
                </tr>
                </table>
                <span class='fa fa-user-secret mt-2' style='font-size:23px'> Clave pública: </span>
               <table class='w-100'>
                <tr>
                    <td><input type='text' id='clave_administrador' class='form-control' disabled></td>
                    <td></td>
                    <td><span id='span_admin'></td>
                </tr>
                </table>
                <hr>
               <h5>Información requerida</h5>
               <br>
               <span class='fa fa-user-secret mt-2' style='font-size:23px'> Clave privada:</span>
               <table class='w-100'>
                <tr>
                    <td><input type='text' id='clave_su' placeholder='Introduzca su clave privada' class='form-control'></td>
                    <td></td>
                    <td><span id='span_su'></td>
                </tr>
                </table>
               </div>    
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" id="descartar">Descartar</button>
                <button type="button" class="btn btn-primary" id="procesar">Procesar</button>
            </div>
            <div id="app" style="padding-top: 8rem;display:none">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3 form-group">
                        <label>
                            Nombre:
                        </label>
                        <input class="form-control" id='email_name'  type="text" v-model="from_name">
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
                        <input class="form-control" type="email" v-model="from_email"  id='email_email'>
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
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog --> 
</div>
<style>
    .loader {
    width: 30px; /* control the size */
    aspect-ratio: 1;
    display: grid;
    -webkit-mask: conic-gradient(from 22deg, #0003,#000);
            mask: conic-gradient(from 22deg, #0003,#000);
    animation: load 1s steps(8) infinite;
  }
  .loader,
  .loader:before {
    --_g: linear-gradient(#17177c 0 0) 50%; /* update the color here */
    background: 
      var(--_g)/34% 8%  space no-repeat,
      var(--_g)/8%  34% no-repeat space;
  }
  .loader:before {
    content: "";
    transform: rotate(45deg);
  }
  @keyframes load {
    from {transform: rotate(0turn)}
    to   {transform: rotate(1turn)}
  }
</style>
<!-- /.modal -->