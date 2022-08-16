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

<title>Personas Enfermedades</title>

<!-- Contenido de la pagina -->
<div class="content-wrapper">
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
                <table style="width: 100%;">
                    <tr>
                       
                        <td style="width: 80%;">
                            <center>
                                <h5>
                                    REPUBLICA BOLIVARIANA DE VENEZUELA<br />
                                    CONSEJO COMUNAL<br />
                                    PRADOS DE OCCIDENTE SECTOR III<br />
                                    RIF. J-30725585 CODIGO 13-03-04-608-0002<br />
                                    Barquisimeto Municipio Iribarren<br />
                                    Parroquia Guerrera Ana Soto Estado Lara<br />
                                    <br />
                                </h5>
                                <u>
                                    <h4>Listado de Personas con Enfermedades</h4>
                                </u>
                            </center>
                        </td>
                        
                    </tr>

                    <tr>
                        
                        <td style="width: 100%;">
                            <div style='width:100%;text-align:justify'>
                                <table class="datos">
                                    <tr>
                                        <td>
                                            Cedula
                                        </td>
                                        <td>
                                            Nombres y Apellidos
                                        </td>
                                        <td>
                                            Direccion
                                        </td>
                                        <td>
                                            Edad
                                        </td>
                                        <td>Sexo</td>
                                        <td>
                                            Diagnostico
                                        </td>
                                        <td>Observacion</td>
                                    </tr>
                                    <tbody id="datos">
                                        <?php foreach ($this->personas_familia as $key => $value): ?>
                                            <?php foreach ($this->enfermos as $key): ?>
                                               
                                                    
                                               <?php if ($value["cedula_persona"] == $key["cedula_persona"]): ?>
                                                   
                                               
                                        
                                        <tr>
                                            <td><?php echo $value["cedula_persona"]; ?></td>
                                            <td><?php echo $value["primer_nombre"]." ".$value["primer_apellido"] ?></td>
                                            <td><?php echo $value["direccion_vivienda"] ?></td>
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
                                            

     
                                            <td>
                                                <?php foreach ($this->enfermedades as $e): ?>
                                                    <?php if ($key["cedula_persona"] == $e["cedula_persona"]): ?>
                                                       <center>
                                                            <?php echo $e["nombre_enfermedad"]."</br>" ?>
                                                       </center>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            </td>
                                            <td>
                                                
                                            </td>
                                            
                                        </tr>
                                        <?php endif ?>
                                        
                                            <?php endforeach ?>
                                        <?php endforeach ?>

                                    </tbody>
                                </table>
                            </div>
                        </td>
                        
                    <tr>
                        
                    </tr>
                    </tr>
                </table>

            </div>
        </div>
        <!-- /.card-body -->
    </section>
    <!-- /.content -->
</div>