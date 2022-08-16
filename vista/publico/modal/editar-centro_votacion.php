<div class="modal fade" id="actualizar">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Editar Datos de Centro Votacion</h4>
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

                            <div class="col-md-12 mt-2">
                                <label for="cedula_persona">
                                    Cedula de Persona
                                </label>
                                <div class="input-group">
                                    <input list="cedula_p" readOnly="readOnly" id="cedula_persona2" name="datos[cedula_persona]"
                                        class="form-control " placeholder="Cedula de Persona"/>
                                    <datalist id="cedula_p">
                                        <?php foreach($this->datos["personas"] as $persona){   ?>
                                        <option value="<?php echo $persona["cedula_persona"];?>">
                                            <?php echo $persona["primer_nombre"]." ".$persona["primer_apellido"];?>
                                        </option>
                                        <?php  }   ?>
                                    </datalist>

                                </div>
                            </div>
                        
                            <div class="col-md-6 mt-2">
                                <label for="nombre_centro">
                                    Centro de Votacion
                                </label>
                                <div class="input-group">
                                    <input list="centro" id="nombre_centro2" name="datos[nombre_centro]" class="form-control " placeholder="Centro de Votacion" />
                                    <datalist id="centro">
                                        <?php foreach($this->datos["centros_votacion"] as $centro){   ?>
                                        <option value="<?php echo $centro["nombre_centro"];?>"> 
                                        </option>
                                    <?php  }   ?>
                                    </datalist>
                                    
                                </div>
                            </div>

                            <div class="col-md-6 mt-2">
                                <label for="id_parroquia ">
                                    Parroquia
                                </label>
                                <div class="input-group">

                                    <select class="custom-select" id="id_parroquia2" name="datos[id_parroquia]">
                                    <?php foreach($this->datos["parroquias"] as $parroquia){   ?>
                                        <option value="<?php echo $parroquia["id_parroquia"];?>">
                                            <?php echo $parroquia["nombre_parroquia"];?>
                                        </option>
                                    <?php  }   ?>
                                    </select>

                                    
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