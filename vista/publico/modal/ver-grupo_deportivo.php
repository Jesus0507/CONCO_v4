<div class="modal fade" id="ver">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ver Datos de Grupo Deportivo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo constant('URL'); ?>" enctype="multipart/form-data" id="formulario"
                    method="POST" name="formulario">
                    <div class="form-group row justify-content-center">

                        <div class="col-md-6 mt-2">
                            <label for="id_deporte">
                                Deporte
                            </label>
                            <div class="input-group">
                                <input disabled id="id_deporte" name="datos[id_deporte]" class="form-control "
                                    placeholder="Deporte" />
                                

                            </div>
                        </div>

                        <div class="col-md-6 mt-2">
                            <label for="nombre_grupo_deportivo">
                                Nombre Grupo Deportivo
                            </label>
                            <div class="input-group">
                                <input disabled class="form-control mb-10" id="nombre_grupo"
                                    name="datos[nombre_grupo_deportivo]" placeholder="Nombre de Grupo" type="text" />
                            </div>
                        </div>

                        <div class="col-md-12 mt-2">
                            <label for="descripcion">
                                Descripcion
                            </label>
                            <div class="input-group">
                                <input disabled class="form-control mb-10" id="descripcion" name="datos[descripcion]"
                                    placeholder="Nombre de Grupo" type="text" />
                            </div>
                        </div>

                        <div class="col-md-12 mt-2">
                            <label for="">
                                Integrantes
                            </label>
                            <table  class="table table-bordered" id="tabla">
                               
                            </table>
                        </div>
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