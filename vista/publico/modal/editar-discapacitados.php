<div class="modal fade" id="actualizar">
    <div class="modal-dialog modal-lg" style="max-width:80%;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Editar Datos de Discapacitados</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" enctype="multipart/form-data"
                    id="formulario" method="POST" name="formulario">
                    <div class="form-group row justify-content-center"> 

                       <div class="col-md-6 mt-2">
                        <label for="cedula">
                            Cedula de Persona
                        </label>
                        <div class="input-group">
                            <input class="form-control mb-10" id="cedula" name="datos[cedula]"
                            placeholder="" type="text" disabled />
                        </div>
                    </div>

                    <div class="col-md-6 mt-2">
                        <label for="nombre">
                            Nombre y Apellido
                        </label>
                        <div class="input-group">
                            <input class="form-control mb-10" id="nombre" name="datos[nombre]"
                            placeholder="" type="text" disabled />
                        </div>
                    </div>

                    <div class="col-md-12 mt-2">

                       <label>Discapacidad</label> <span id='valid_discapacidad' style='color:red'></span>
                       <table style='width:100%'><tr><td>
                           <input type="text" style='display:none' maxlength="30" placeholder="Discapacidad..." class='form-control no-simbolos' id='discapacidad_input' name="">

                           <select class='form-control no-simbolos' id='discapacidad_select'> 
                             <option value='vacio'>-Discapacidad-</option>
                             <?php foreach ($this->datos["discapacidad"] as $d) { ?>
                               <option value='<?php echo $d['id_discapacidad'];?>'><?php echo $d['nombre_discapacidad']; ?></option>
                           <?php   } ?>
                       </select></td>

                       <td>
                        <select id='en_cama' class='form-control no-simbolos'>
                            <option value='vacio'>-En cama-</option>
                            <option value="1">Si</option>
                            <option value='0'>No</option>
                        </select>
                    </td>
                    <td>
                     <input type="text" class='form-control no-simbolos' id='necesidades' placeholder="Necesidades (opcional)" name="">
                 </td>
                 <td>
                     <input type="text" class='form-control no-simbolos' id='observaciones' placeholder="Observaciones (opcional)" name="">
                 </td>
                 <td>
                    <button id='agregar' class="btn btn-info" type="button">Agregar</button>&nbsp;&nbsp;<button type='button' class="btn btn-primary" id='btn_nueva_discapacidad' >Nueva discapacidad</button>
                </td>
            </tr>
        </table>


    </div>

    <div class="col-md-12 mt-2">
       <label>Discapacidades agregadas a <span id='nombre_persona'></span></label>
       <center><div style='width:95%;height:200px;overflow-y: scroll;background: #C5F3F2'>
           <center><div id='discapacidades_agregadas' style='width:95%'></div></div>
           </center>
       </div>

   </div>
</form>
</div>
<div class="modal-footer ">
    <input type="submit" class="btn  btn-success m-r-10" name="" id="enviar" value="Guardar">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
</div>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->