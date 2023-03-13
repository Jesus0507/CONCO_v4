<div class="modal fade" id="modal-session">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Su sesión ha expirado</h4>
            </div>
            <div class="modal-body">
                <p>¿Desea continuar en la sesión?</p>
                <p>Su sesión se cerrará automaticamente en : <span id='modal_count'></span></p>
            </div>
            <div class="modal-footer justify-content-between">
                <button id='close' type="button" class="btn btn-default" data-dismiss="modal">Cerrar sesión</button>
                <button id='keep' type="button" class="btn btn-primary">No, seguir en la sesión</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <script src="<?php echo constant('URL')?>config/js/news/session_expire.js"></script>
    <!-- /.modal-dialog -->
</div>