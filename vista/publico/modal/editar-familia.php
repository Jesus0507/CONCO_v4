<div class="modal fade" id="actualizar">
    <div class="modal-dialog modal-lg" style="max-width:80%;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Editar Datos de Familia</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> 
            <div class="modal-body">
                <form action="" enctype="multipart/form-data"
                id="formulario" method="POST" name="formulario">
                <div class="form-group row justify-content-center"> 
                    <input type="hidden" id="id_familia" name="">
                    <div class="col-md-6 mt-4">
                        <label for="primer_nombre">
                            Vivienda
                        </label>
                        <span id='valid_1' style="color:red;"></span>
                        <div class="input-group">
                            <select id='vivienda_familia' class='form-control'>
                                <option value='vacio'>-Seleccione-</option>
                                <?php foreach ($this->viviendas as $v) { ?>
                                   <option value='<?php echo $v["id_vivienda"] ;?>'><?php echo $v['numero_casa']; ?></option>
                               <?php } ?>
                           </select>
                       </div>

                   </div>

                   <div class="col-md-6 mt-4">
                    <label for="segundo_apellido">
                       Condición en que ocupa la vivienda
                   </label> <span id='valid_cond_ocupacion' style='color:red'></span>
                   <table style='width: 100%'><tr><td>
                     <select class='form-control' id='select-cond-ocupacion'>
                         <option value='0'>-Seleccione-</option>
                         <option value='Adjudicada'>Adjudicada</option>
                         <option value='Alquilada'>Alquilada</option>
                         <option value="Invadida">Invadida</option>
                         <option value='Prestada'>Prestada</option>
                         <option value='Propia pagada'>Propia pagada</option>
                         <option value='Propia pagándose'>Propia pagándose</option>
                     </select>
                     <input style='display:none' type="text" maxlength="20" id='input_condicion_ocupacion' placeholder="Especifique..." class='form-control' name="">

                 </td><td></td></tr></table>
             </div>


             <div class="col-md-6 mt-2">
                <label for="segundo_nombre">
                    Nombre de familia
                </label><span id='valid_2' style="color:red;"></span>
                <div class="input-group">
                    <input class="form-control mb-10 solo-letras" id="nombre_familia" oninput="Limitar(this,20);"
                    name="datos[nombre_familia]" placeholder="Nombre de la familia"
                    type="text" />
                </div>

            </div>

            <div class="col-md-6 mt-2">
                <label for="primer_apellido">
                    Téléfono de familia
                </label><span id='valid_3' style="color:red;"></span>
                <div class="input-group">
                    <input class="form-control mb-10" id="telefono_familia" oninput="Limitar(this,10);"
                    name="datos[telefono_familia]" placeholder="telefono_familia"
                    type="number" />
                </div>

            </div>

            <div class="col-md-6 mt-2">
                <label for="segundo_apellido">
                    Ingreso mensual Aprox
                </label><span id='valid_4' style="color:red;"></span>
                <div class="input-group">
                    <input class="form-control mb-10" id="ingreso_aprox" oninput="Limitar(this,20);"
                    name="datos[ingreso_aprox]" placeholder="Ingreso mensual aprox"
                    type="text" />
                </div>

            </div>

            <div class="col-md-6 mt-2">
                <label for="segundo_apellido">
                    Observaciones (opcional)
                </label>
                <div class="input-group">
                  <textarea class='form-control' id='observaciones_familia' oninput="Limitar(this,50);" ></textarea>
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
                        <input type="number" class='form-control' id='integrante_input' placeholder="Buscar cédula" name="" list='lista_personas'>
                        <datalist id='lista_personas'>
                            <?php foreach ($this->personas as $p) { ?>
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
    </td>

</table>
</div>

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
