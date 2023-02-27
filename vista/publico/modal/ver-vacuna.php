<div class="modal fade" id="ver">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ver Datos de Vacuna</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"> 
            <form action="<?php echo constant('URL'); ?>" enctype="multipart/form-data"
                    id="formulario" method="POST" name="formulario">
                    <div class="form-group row justify-content-center">

                            <div class="col-md-12 mt-2">
                                <label for="cedula_persona">
                                    Cedula de Persona
                                </label>
                                <div class="input-group">
                                    <input id="cedula_persona_ver" name="cedula_persona"
                                        class="form-control " placeholder="Cedula de Persona" />
                                </div>
                            </div>
 

                            <div class="col-md-12 mt-2">
                                <label for="">
                                    Vacunas
                                </label>
                                <table class="table table-bordered" id="tabla">
                                    <div id='vacunas_info' style='width:100%;height:150px;background:#AEE6E8;overflow-y:scroll'>

                                            </div>
                                </table>
                            </div>
                            <span id="texto"></span>
                        </div>
                </form>
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