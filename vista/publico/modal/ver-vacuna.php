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
                                    <input list="cedula_p" id="cedula_persona" name="cedula_persona"
                                        class="form-control " placeholder="Cedula de Persona" />
                                    <datalist id="cedula_p">
                                        <?php foreach($this->personas as $persona){   ?>
                                        <option value="<?php echo $persona["cedula_persona"];?>">
                                            <?php echo $persona["primer_nombre"]." ".$persona["primer_apellido"];?>
                                        </option>
                                        <?php  }   ?>
                                    </datalist>

                                </div>
                            </div>


                            <div class="col-md-12 mt-2">
                                <label for="">
                                    Vacunas
                                </label>
                                <table class="table table-bordered" id="tabla">
                                    <tr>
                                        <td class="col-6">

                                            <div class="input-group">
                                                <select class="custom-select" id="dosis" name="dosis[]">
                                                    <option value="Primera Dosis">
                                                        Primera Dosis
                                                    </option>
                                                    <option value="Segunda Dosis">
                                                        Segunda Dosis
                                                    </option>
                                                    <option value="Tercera Dosis">
                                                        Tercera Dosis
                                                    </option>
                                                </select>
                                            </div>
                                        </td>
                                        <td class="col-6">

                                            <div class="input-group">
                                                <input class="form-control" id="fecha" name="fecha[]" type="date">
                                            </div>
                                        </td>
                                        <td class="">
                                            <div class="input-group ">
                                                <button type="button" name="agregar" id="agregar"
                                                    class="btn btn-success">Agregar</button>
                                            </div>

                                        </td>
                                    </tr>
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