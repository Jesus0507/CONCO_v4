<div class="modal fade" id="ver">
    <div class="modal-dialog modal-xl" style="max-width:60% !important">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ver Datos de Usuario</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
             <center>
                <div id="preview">
                                    <img src="<?php echo constant('URL')?>config/img/users/user-3.png"
                                        class="img-circle" width="100" />
                </div>
                         <br>
                      <h1 style="font-weight: bold" id="descripcion"></h1>
                      <br>
                      <table style="width:40%">
                          <tr>
                            <td><em style="font-size:24px;" class="fa fa-phone"></em></td>
                            <td ><h3 id="telefono" style="font-weight: bold"></h3></td>
</tr>
                            <tr>
                                <td><em style="font-size:24px;" class="fa fa-envelope"></em></td>
                            <td ><h3 id="correo" style="font-weight: bold"></h3></td>
                          </tr>
                          <tr>
                            <td><em style="font-size:24px;" class="fa fa-user"></em></td>
                            <td colspan="2" >
                                <h3 id="rol" style="font-weight: bold"></h3>
                            </td>
                          </tr>
                      </table>
            </center>
                                

            </div>
            <div class="modal-footer ">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->