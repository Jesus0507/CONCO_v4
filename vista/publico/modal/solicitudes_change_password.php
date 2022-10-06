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
                  <span class='fa fa-pencil mt-2' style='font-size:23px'> Firma digital</span>
                  <input type="text" class="form-control w-100" id='firma_solicitud' class='mt-2' disabled value="sdfsdfsd">
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
<!-- /.modal -->