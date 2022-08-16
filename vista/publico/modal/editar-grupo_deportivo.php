<div class="modal fade" id="actualizar">
    <div class="modal-dialog modal-xl" style="max-width: 80%;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Editar Grupo Deportivo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" enctype="multipart/form-data" id="formulario" method="POST" name="formulario">
                    <div class="form-group row justify-content-center">
 
                        <div class="col-md-6 mt-2">
                            <label for="id_deporte">
                                Deporte
                            </label>
                            <div class="input-group">
                                <input list="tipo_I" id="id_deporte2" name="datos[id_deporte]" class="form-control "
                                    placeholder="Deporte" />
                                <datalist id="tipo_I">
                                    <?php foreach($this->datos["deportes"] as $deporte){   ?>
                                    <option value="<?php echo $deporte["nombre_deporte"];?>">
                                    </option>
                                    <?php  }   ?>
                                </datalist>

                            </div>
                        </div>

                        <div class="col-md-6 mt-2">
                            <label for="nombre_grupo_deportivo">
                                Nombre Grupo Deportivo
                            </label>
                            <div class="input-group">
                                <input class="form-control mb-10" id="nombre_grupo2"
                                    name="datos[nombre_grupo_deportivo]" placeholder="Nombre de Grupo" type="text" />
                            </div>
                        </div>

                        <div class="col-md-12 mt-2">
                            <label for="descripcion">
                                Descripcion
                            </label>
                            <div class="input-group">
                                <input class="form-control mb-10" id="descripcion2" name="datos[descripcion]"
                                    placeholder="Nombre de Grupo" type="text" />
                            </div>
                        </div>

                        <div class="col-md-12 mt-2">
            <label for="segundo_apellido">
                Integrantes
            </label><span id='valid_5' style="color:red;"></span>
            <div class="input-group">
               <table style='width:100%'>
                <tr>
                    <td>
                        <input type="number" class='form-control' id='integrantes_grupo_input' placeholder="Buscar cédula"  list='lista_personas'>
                        <datalist id='lista_personas'>
                            <?php foreach ($this->datos["personas"] as $p) { ?>
                             <option value='<?php echo $p['cedula_persona']; ?>'><?php echo $p['primer_nombre']." ".$p['primer_apellido']; ?></option>
                         <?php    } ?>
                     </datalist>
                 </td><td><button class='btn btn-primary' type='button' id='btn_agregar'>Agregar</button></td>
             </tr>
             <tr><td colspan='2'><br>
               <div style='background:#D0E8E7;overflow-y: scroll;width: 95%;height:200px;'><center>
                <div style='width:95%' id='integrantes_agregados'></div>
            </center>
        </div>
                    </div>
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