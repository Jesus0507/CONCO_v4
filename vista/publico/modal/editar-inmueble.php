<div class="modal fade" id="actualizar">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Editar Datos de Inmueble</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"> 
                <form action="" enctype="multipart/form-data" id="formulario" method="POST" name="formulario">
                    <!-- card-body -->
                    <div class="card-body">
                        <div class="card-block">
                            <div class="form-group row justify-content-center">

                                <div class="col-md-6 mt-2">
                                    <label for="id_calle2">
                                        Calle
                                    </label>
                                    <div class="input-group">
                                        <select class="custom-select" id="id_calle2" name="datos[id_calle]">
                                        <option>
                                           Seleccione ...
                                        </option>
                                    <?php foreach($this->datos["calle"] as $calles){   ?>
                                        <option value="<?php echo $calles["id_calle"];?>">
                                            <?php echo $calles["nombre_calle"];?>
                                        </option>
                                    <?php  }   ?>
                                    </select>
                                    </div>
                                </div>

                                <div class="col-md-6 mt-2">
                                    <label for="nombre_inmueble2">
                                        Nombre de Inmueble
                                    </label>
                                    <div class="input-group">
                                        <input class="form-control no-simbolos mb-10" id="nombre_inmueble2"
                                            name="datos[nombre_inmueble]" placeholder="Nombre de Inmueble"
                                            type="text" oninput="Limitar(this,25)"/>
                                    </div>
                                </div>

                                <div class="col-md-6 mt-2">
                                    <label for="direccion2">
                                        Direccion
                                    </label>
                                    <div class="input-group">
                                        <input class="form-control no-simbolos mb-10" id="direccion2"
                                            name="datos[direccion_inmueble]" placeholder="Direccion" type="text" />
                                    </div>
                                </div>

                                <div class="col-md-6 mt-2">
                                    <label for="tipo_inmueble2">
                                        Tipo Inmueble
                                    </label>
                                    <div class="input-group">
                                        <input list="tipo_I" id="tipo_inmueble2" name="datos[tipo_inmueble]" class="form-control no-simbolos solo-letras" placeholder="Tipo de Inmueble" oninput="Limitar(this,20)" />
                                    <datalist id="tipo_I">
                                        <?php foreach($this->datos["tipo_inmueble"] as $t_inmueble){   ?>
                                        <option value="<?php echo $t_inmueble["nombre_tipo"];?>">
                                        </option>
                                    <?php  }   ?>
                                    </datalist>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->

                </form>
            </div>
            <div class="modal-footer ">
                <input type="button" class="btn  btn-success m-r-10" name="" id="enviar" value="Guardar">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->