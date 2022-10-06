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
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog --> 
</div>
<!-- /.modal -->