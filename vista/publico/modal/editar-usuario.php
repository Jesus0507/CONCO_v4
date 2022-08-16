<div class="modal fade" id="actualizar">
    <div class="modal-dialog modal-xl"> 
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modificar datos del usuario</h4>
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
                <h1 style="font-weight: bold" id="editCedula">dsgsd</h1>
            </div></center><center>
            <table style="width: 90%;text-align: center ;">
                <tr>
                    <td style="text-align:center"><input type="text" id="editNombre" placeholder="Nombre" class="form-control"></td>
                    <td style="text-align:center"><input type="text" id="editApellido" placeholder="Apellido" class="form-control"></td>
                </tr>
                <tr>
                    <td style="text-align:center"><input type="number" id="editTelefono" placeholder="Teléfono" class="form-control"></td>
                    <td style="text-align:center"><input type="text" id="editCorreo" placeholder="Correo" class="form-control"></td>
                </tr>
            </table>
            <br><br>
        </center>
            <div class="modal-footer ">
            <input type="button" class="btn  btn-success m-r-10" name="" id="enviarEditar" value="Guardar">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->