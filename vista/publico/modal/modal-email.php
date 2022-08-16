<div class="modal fade" id="correo">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Contactenos</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class=" row">
                    <div class="col-5 text-center d-flex align-items-center justify-content-center">
                        <img src="<?php echo constant('URL')?>config/img/web/correo.png" alt="user-avatar"
                            class="img-fluid" width="200">
                    </div>
                    <div class="col-7">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" id="nombre" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="correo">Correo de Destino</label>
                            <input type="email" id="correo" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="asunto">Asunto</label>
                            <input type="text" id="asunto" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="mensaje">Mensaje</label>
                            <textarea id="mensaje" class="form-control" rows="4"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="button" class="btn btn-primary" value="Enviar Mensaje">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">


            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->