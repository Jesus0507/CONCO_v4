<style>
.datos {
    border-collapse: collapse !important;
    width: 100%;
}

.datos th,
.datos td {
    border: 1px solid black !important;
}
</style>

<title>HISTORIA CLINICA FAMILIAR</title>

<!-- Contenido de la pagina -->
<div class="content-wrapper" style="width: 100%;">
    <!-- Content Header (Page header) -->
    <script>
     window.blur();
             window.print();
              
         </script>
         <section class="content">
            <!-- Default box -->
            <div class="card">
                <!-- card-body -->
                <div class="card-body">
                    <center>
                        <h4>
                            HISTORIA CLINICA FAMILIAR
                        </h4>
                    </center>
                    <table>
                        <tr>
                            <td>
                                REPUBLICA BOLIVARIANA DE VENEZUELA
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Mision Medica Cubana
                            </td>
                        </tr>
                        <tr>
                            <td>
                                ASIC: <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>
                            </td>
                            <td>
                                Consultorio: <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>
                            </td>
                            <td style="position: relative;left: 00px;">
                                No HC: <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>
                            </td>
                        </tr>
                        <tr>
                            <td>

                                Familiar: <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                
                            </td>
                            <td>

                                Direccion: <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>
                                
                            </td>
                        </tr>

                        <tr>
                            
                        </tr>
                        <tr>
                            <td>
                                Estado: <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lara&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>
                            </td>
                            <td>
                                Municipio: <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Iribarren&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>
                            </td>
                            <td style="position: relative;left: 10px;">
                                Parroquia: <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ana Soto&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>
                            </td>
                        </tr>
                    </table>
                    <table style="width: 100%;">


                        <tr>

                            <td style="width: 100%;">
                                <div style='width:100%;text-align:justify'>
                                    <table class="datos">
                                        <?php foreach ($this->familia_vivienda as $key => $value): ?>
                                            
                                        <?php if ($value["jefe_familia"] == 1): ?>
                                        <tr>
                                            <td>#</td>
                                            
                                            <td>
                                                Nombres y Apellidos
                                            </td>
                                            <td>
                                                Fecha de Nacimiento
                                            </td>
                                            <td>
                                             Edad
                                         </td>
                                         <td>
                                             Sexo
                                         </td>
                                         <td>
                                             N° de Cedula
                                         </td>
                                         <td>
                                             Escolaridad
                                         </td>
                                         <td>
                                             Grupo Dispensarial
                                         </td>
                                         <td>
                                             Factores de Riesgo Y/O Patologias Cronicas
                                         </td>
                                     </tr>
                                     <?php endif ?>
                                     <?php endforeach ?>
                                     <tbody id="datos">
                                         <tr>
                                             <td>
                                                 1
                                             </td>
                                             <td> <?php echo $value["primer_nombre"]." ".$value["primer_apellido"] ?></td>
                                             <td><?php echo $value["fecha_nacimiento"] ?></td>
                                             <td>
                                                 <?php 
                                                    list($ano,$mes,$dia) = explode("-",$value["fecha_nacimiento"]);
                                                    $ano_diferencia  = date("Y") - $ano;
                                                    $mes_diferencia = date("m") - $mes;
                                                    $dia_diferencia   = date("d") - $dia;
                                                    if ($dia_diferencia < 0 || $mes_diferencia < 0)
                                                        $ano_diferencia--;
                                                    echo $ano_diferencia." Años"; 
                                                ?>
                                             </td>
                                             <td><?php echo $value["genero"] ?></td>
                                             <td><?php echo $value["cedula_persona"] ?></td>
                                             <td><?php echo $value["nivel_educativo"] ?></td>

                                           
                                                
                                             <td></td>
                                             <td>
                                                <?php foreach ($this->enfermedades as $e): ?>
                                                    <?php if ($value["cedula_persona"] == $e["cedula_persona"]): ?>
                                                       <?php echo $e["nombre_enfermedad"].", "  ?>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            </td>
                                         </tr>
                                     </tbody>
                                 </table>
                             </div>
                         </td>


                     </tr>

                     <tr style="width: 100%;" >
                        <table style="width: 100%; ">
                            <tr>
                                <td style="width: 50%; ">
                                    Caracterizacion de la Familia
                                    <table class="datos">

                                        <tr>

                                            <td colspan="7">
                                                <center>Tamaño (Numero de Mienbros)</center>
                                            </td>
                                            
                                        </tr>
                                        <tr>
                                            <?php $cont = count($this->familia_vivienda);                                        ?>
                                            <td>Pequeña</td>
                                            <td><?php if ($cont < 5){echo "X";} ?></td>
                                            <td>Mediana</td>
                                            <td><?php if ($cont <= 8){echo "X";} ?></td>
                                            <td>Grande</td>
                                            <td><?php if ($cont >= 9){echo "X";} ?></td>
                                           
                                        </tr>
                                        <tr>
                                            <td colspan="7"><center>Ontogenesis de la Familia</center></td>
                                        </tr>
                                        <tr>

                                            <td>Nuclear</td>
                                            <td><?php if ($cont < 5){echo "X";} ?></td>
                                            <td>Extensa</td>
                                            <td><?php if ($cont >= 5){echo "X";} ?></td>
                                            <td>Ampliada</td>
                                            <td><?php if ($cont >= 6){echo "X";} ?></td>
                                            
                                        </tr>
                                        <tr>
                                            <td colspan="7"><center>Numero de Generaciones</center></td>
                                        </tr>
                                        <tr>

                                            <td colspan="3">Unigeneracional</td>
                                            <td>&nbsp;</td>
                                            <td>Bigeneracional</td>
                                            <td>&nbsp;</td>
                                            
                                            
                                        </tr>
                                        <tr>

                                            <td colspan="3">Trigeneracional</td>
                                            <td>&nbsp;</td>
                                            <td>Multigeneracional</td>
                                            <td>&nbsp;</td>
                                            
                                            
                                        </tr>

                                        <tr>
                                            <td colspan="7"><center>Etapas de desarrollo de la familia</center></td>
                                        </tr>
                                        <tr>

                                            <td colspan="3">Formacion</td>
                                            <td>&nbsp;</td>
                                            <td>Contraccion</td>
                                            <td>&nbsp;</td>
                                            
                                            
                                        </tr>
                                        <tr>

                                            <td colspan="3">Extenssion</td>
                                            <td>&nbsp;</td>
                                            <td>Disolucion</td>
                                            <td>&nbsp;</td>
                                            
                                            
                                        </tr>
                                    </table>

                                </td>

                                <td style="width: 50%; ">
                                    3. Familiograma
                                    <table class="datos">
                                        <tr>

                                            <td colspan="7" height="220px;" >

                                            </td>
                                            
                                        </tr>
                                        
                                        
                                    </table>

                                </td>
                                
                            </tr>
                        </table>

                    </tr>
                    <tr>
                        <table style="">
                            <?php foreach ($this->familia_vivienda as $key => $value): ?>
                                            
                                        <?php if ($value["jefe_familia"] == 1): ?>
                            <tr>
                                <td>
                                    4.Condiciones de Materiales de la Vivienda
                                </td>
                            </tr>
                            
                            <tr>
                                <td>
                                    Ingreso: <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $value["ingreso_mensual_aprox"] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>
                                </td>
                                
                            </tr>
                            <tr>
                                <td>

                                    Familiar: <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $value["nombre_familia"] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>
                                    
                                </td>
                            </tr>

                            <?php endif ?>
                                                <?php endforeach ?>

                            <tr>
                                <td>

                                    Cocina Gas: <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>
                                    
                                </td>
                                <td style="position: relative;left: -300px;">

                                 Electrica: <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>

                             </td>
                             <td style="position: relative;left: -300px;">

                                Leña: <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>
                                
                            </td>
                            <td style="position: relative;left: -300px;">

                                Otros: <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>
                                
                            </td>
                        </tr>

                        

                    </table>
                </tr>
                <tr>
                    <table>
                        <?php foreach ($this->familia_vivienda as $key => $value): ?>
                                            
                                        <?php if ($value["jefe_familia"] == 1): ?>
                        <tr>
                            <td>
                                5.Condiciones Estructurales de la vivienda:
                            </td>
                        </tr>
                        <tr>
                            <table class="datos">
                                <tr>
                                    <td>Hacinamiento</td>
                                    <?php if ($value["hacinamiento"] == 1): ?>
                                    <td>Si</td>
                                    <td><?php echo "X" ?></td>
                                    <td>No</td>
                                    <td></td>
                                    <?php else: ?>
                                    <td>Si</td><td></td>
                                    <td>No</td>
                                    
                                    <td><?php echo "X" ?></td>
                                    <?php endif ?>
                                </tr>
                                <tr>
                                    <td>Servicio Electico</td>
                                    <?php if ($value["servicio_electrico"] == 1): ?>
                                    <td>Si</td>
                                    <td><?php echo "X" ?></td>
                                    <td>No</td>
                                    <td></td>
                                    <?php else: ?>
                                    <td>Si</td><td></td>
                                    <td>No</td>
                                    
                                    <td><?php echo "X" ?></td>
                                    <?php endif ?>
                                </tr>

                                <tr>
                                    <td>Tipo de Vivienda</td>
                                    <?php if ($value["nombre_tipo_vivienda"] == "Casa"): ?>
                                        
                                    <td>Casa</td>
                                    <td><?php echo "X" ?></td>
                                    <td>Apartamento</td>
                                    <td></td>
                                    <td>Habitacion</td>
                                    <td></td>
                                    <td>Rancho</td>
                                    <td></td>
                                    <td>Refugio</td>
                                    <td></td>
                                    <td>Otros</td>
                                    <td></td>
                                     <?php endif ?>

                                     <?php if ($value["nombre_tipo_vivienda"] == "Apartamento"): ?>
                                    <td>Casa</td>
                                    <td></td>
                                    <td>Apartamento</td>
                                    <td><?php echo "X" ?></td>
                                    <td>Habitacion</td>
                                    <td></td>
                                    <td>Rancho</td>
                                    <td></td>
                                    <td>Refugio</td>
                                    <td></td>
                                    <td>Otros</td>
                                    <td></td>
                                    <?php endif ?>

                                    <?php if ($value["nombre_tipo_vivienda"] == "Habitacion"): ?>
                                    <td>Casa</td>
                                    <td></td>
                                    <td>Apartamento</td>
                                    <td></td>
                                    <td>Habitacion</td>
                                    <td><?php echo "X" ?></td>
                                    <td>Rancho</td>
                                    <td></td>
                                    <td>Refugio</td>
                                    <td></td>
                                    <td>Otros</td>
                                    <td></td>
                                    <?php endif ?>

                                    <?php if ($value["nombre_tipo_vivienda"] == "Rancho"): ?>
                                    <td>Casa</td>
                                    <td></td>
                                    <td>Apartamento</td>
                                    <td></td>
                                    <td>Habitacion</td>
                                    <td></td>
                                    <td>Rancho</td>
                                    <td><?php echo "X" ?></td>
                                    <td>Refugio</td>
                                    <td></td>
                                    <td>Otros</td>
                                    <td></td>
                                    <?php endif ?>

                                    <?php if ($value["nombre_tipo_vivienda"] == "Refugio"): ?>
                                    <td>Casa</td>
                                    <td></td>
                                    <td>Apartamento</td>
                                    <td></td>
                                    <td>Habitacion</td>
                                    <td></td>
                                    <td>Rancho</td>
                                    <td></td>
                                    <td>Refugio</td>
                                    <td><?php echo "X" ?></td>
                                    <td>Otros</td>
                                    <td></td>
                                    <?php endif ?>

                                    <?php if ($value["nombre_tipo_vivienda"] !== "Refugio" && 
                                        $value["nombre_tipo_vivienda"] !== "Casa" && 
                                        $value["nombre_tipo_vivienda"] !== "Apartamento" && 
                                        $value["nombre_tipo_vivienda"] !== "Habitacion" && 
                                        $value["nombre_tipo_vivienda"] !== "Rancho"  &&  
                                        $value["nombre_tipo_vivienda"] !== "Refugio" ): ?>
                                    <td>Casa</td>
                                    <td></td>
                                    <td>Apartamento</td>
                                    <td></td>
                                    <td>Habitacion</td>
                                    <td></td>
                                    <td>Rancho</td>
                                    <td></td>
                                    <td>Refugio</td>
                                    <td></td>
                                    <td>Otros</td>
                                    <td><?php echo "X" ?></td>
                                    <?php endif ?>
                                    
                                </tr>

                                <tr>
                                    <?php foreach ($this->pared as $key ): ?>
                                        
                                    
                                    <td>Materiales de Construccion</td>
                                    <td>Bloque</td>
                                    <td><?php if ($key["pared"] == "Bloque, ladrillo o adobe frisado"){echo "X";} ?></td>
                                    <td>Madera</td>
                                    <td><?php if ($key["pared"] == "Madera"){echo "X";} ?></td>
                                    <td>De Tapia</td>
                                    <td><?php if ($key["pared"] == "Tapia o bahareque"){echo "X";} ?></td>
                                    <td>Carton</td>
                                    <td><?php if ($key["pared"] == "Zinc, cartón, tablas o similar"){echo "X";} ?></td>
                                    <td>Zinc</td>
                                    <td><?php if ($key["pared"] == "Zinc, cartón, tablas o similar"){echo "X";} ?></td>
                                    <td>Otros</td>
                                    <td><?php if ($key["pared"] == !"Zinc, cartón, tablas o similar" &&
                                     $key["pared"] == !"Bloque, ladrillo o adobe frisado" &&
                                     $key["pared"] == !"Madera"&&
                                     $key["pared"] == !"Tapia o bahareque" &&
                                     $key["pared"] == !"Zinc, cartón, tablas o similar"){echo "X";} ?></td>
                                    <?php endforeach ?>
                                </tr>

                                <tr>
                                    <?php foreach ($this->techo as $key ): ?>
                                    <td>Techo</td>
                                    <td>Placas</td>
                                    <td><?php if ($key["techo"] == "Placas"){echo "X";} ?></td>
                                    <td>Asbesto</td>
                                    <td><?php if ($key["techo"] == "Asbesto y similares"){echo "X";} ?></td>
                                    <td>Aceroli</td>
                                    <td><?php if ($key["techo"] == "Aceroli"){echo "X";} ?></td>
                                    <td>Guano</td>
                                    <td><?php if ($key["techo"] == "Guano"){echo "X";} ?></td>
                                    <td>Zinc</td>
                                    <td><?php if ($key["techo"] == "Láminas metálicas (zinc , aluminio,similares)"){echo "X";} ?></td>
                                    <td>Otros</td>
                                    <td><?php if ($key["techo"] == !"Placas" &&
                                     $key["techo"] == !"Asbesto y similares" &&
                                     $key["techo"] == !"Aceroli"&&
                                     $key["techo"] == !"Guano" &&
                                     $key["techo"] == !"Láminas metálicas (zinc , aluminio,similares)"){echo "X";} ?></td>
                                    <?php endforeach ?>
                                </tr>

                                <tr>
                                    <?php foreach ($this->piso as $key ): ?>
                                    <td>Pisos</td>
                                    <td>Lozas</td>
                                    <td><?php if ($key["piso"] == "Lozas"){echo "X";} ?></td>
                                    <td>Cemento</td>
                                    <td><?php if ($key["piso"] == "Cemento"){echo "X";} ?></td>
                                    <td>Tierra</td>
                                    <td><?php if ($key["piso"] == "Tierra"){echo "X";} ?></td>
                                    <td>Madera</td>
                                    <td><?php if ($key["piso"] == "Tablas"){echo "X";} ?></td>
                                    
                                    <td>Otros</td>
                                    <td colspan="3">
                                        <?php if ($key["piso"] == !"Lozas" &&
                                     $key["piso"] == !"Cemento" &&
                                     $key["piso"] == !"Tierra"&&
                                     $key["piso"] == !"Tablas"){echo "X";} ?>
                                    </td>
                                    <?php endforeach ?>
                                </tr>

                                <tr>
                                    <td>Abasto de Agua</td>
                                    <td>Posos</td>
                                    <td><?php if ($value["agua_consumo"] == "Posos"){echo "X";} ?></td>
                                    <td>Acueducto</td>
                                    <td><?php if ($value["agua_consumo"] == "Acueducto"){echo "X";} ?></td>
                                    <td>Manantial</td>
                                    <td><?php if ($value["agua_consumo"] == "Manantial"){echo "X";} ?></td>
                                    <td>Rio</td>
                                    <td><?php if ($value["agua_consumo"] == "Rio"){echo "X";} ?></td>
                                    
                                    <td>Otros</td>
                                    <td colspan="3"><?php if ($value["agua_consumo"] == !"Posos" &&
                                     $value["agua_consumo"] == !"Acueducto" &&
                                     $value["agua_consumo"] == !"Manantial"&&
                                     $value["agua_consumo"] == !"Rio"){echo "X";} ?></td>
                                </tr>

                                <tr>
                                    
                                    
                                    <?php if ($value["banio_sanitario"] !== 0 ): ?>
                                        <td>Baño Sanitario</td>
                                    <td>Baño</td>
                                    <td><?php echo "X" ?></td>
                                    <td>Letrina</td>
                                    <td></td>
                                    <td>No Posee</td>
                                    <td></td>
                                    
                                    
                                    <td colspan="2">Otros</td>
                                    <td colspan="4"></td>
                                    <?php else: ?>
                                    <td>Baño Sanitario</td>
                                    <td>Baño</td>
                                    <td><?php echo "X" ?></td>
                                    <td>Letrina</td>
                                    <td></td>
                                    <td>No Posee</td>
                                    <td><?php echo "X" ?></td>
                                    
                                    
                                    <td colspan="2">Otros</td>
                                    <td colspan="4"></td>
                                    <?php endif ?>
                                </tr>

                                <tr>
                                    <?php if ($value["condicion"] == "Buena" ): ?>
                                    <td>Estado Constructivo</td>
                                    <td>Buena</td>
                                    <td><?php echo "X" ?></td>
                                    <td>Regular</td>
                                    <td></td>
                                    <td>Mala</td>
                                    <td>&nbsp;</td>
                                    <td colspan="6"></td>
                                    
                                    <?php endif ?>

                                    <?php if ($value["condicion"] == "Regular" ): ?>
                                    <td>Estado Constructivo</td>
                                    <td>Buena</td>
                                    <td></td>
                                    <td>Regular</td>
                                    <td><?php echo "X" ?></td>
                                    <td>Mala</td>
                                    <td>&nbsp;</td>
                                    <td colspan="6"></td>
                                    
                                    <?php endif ?>

                                    <?php if ($value["condicion"] == "Mala" ): ?>
                                    <td>Estado Constructivo</td>
                                    <td>Buena</td>
                                    <td></td>
                                    <td>Regular</td>
                                    <td></td>
                                    <td>Mala</td>
                                    <td><?php echo "X" ?></td>
                                    <td colspan="6"></td>
                                    
                                    <?php endif ?>
                                </tr>
                                <tr>
                                    
                                    <td>Destino Final residuos liquidos</td>
                                    <td>Alcantarillado</td>
                                    <td></td>
                                    <td>Pozo Septico</td>
                                    <td></td>
                                    
                                    <td colspan="3">Otros</td>
                                    <td colspan="5"></td>

                                </tr>

                                <tr>
                                    <?php if ($value["residuos_solidos"] == "Aseo Urbano" ): ?>
                                    <td>Destino Final desechos solidos</td>
                                    <td>Recogida Local</td>
                                    <td><?php echo "X" ?></td>
                                    <td>Vertederos</td>
                                    <td></td>
                                    
                                    <td colspan="3">Otros</td>
                                    <td colspan="5"></td>
                                    <?php endif ?>

                                    <?php if ($value["residuos_solidos"] == "Aire Libre" ): ?>
                                    <td>Destino Final desechos solidos</td>
                                    <td>Recogida Local</td>
                                    <td></td>
                                    <td>Vertederos</td>
                                    <td><?php echo "X" ?></td>
                                    
                                    <td colspan="3">Otros</td>
                                    <td colspan="5"></td>
                                    <?php endif ?>

                                    <?php if ($value["residuos_solidos"] == !"Aire Libre" || $value["residuos_solidos"] == !"Aire Libre"): ?>
                                    <td>Destino Final desechos solidos</td>
                                    <td>Recogida Local</td>
                                    <td></td>
                                    <td>Vertederos</td>
                                    <td></td>
                                    
                                    <td colspan="3">Otros</td>
                                    <td colspan="5"><?php echo "X" ?></td>
                                    <?php endif ?>
                                </tr>

                                <tr>
                                    <td>Vectores</td>
                                    
                                    <td colspan="12"></td>
                                </tr>
                            </table>
                        </tr>
                         <?php endif ?>
                                                <?php endforeach ?>
                        <tr>
                            <td>
                                <br>
                                Discucion Y Evaluacion Familiar <br><br>
                                <hr>
                            </td>
                        </tr>
                    </table>
                </tr>
            </table>

        </div>
    </div>
    <!-- /.card-body -->
</section>
<!-- /.content -->
</div>