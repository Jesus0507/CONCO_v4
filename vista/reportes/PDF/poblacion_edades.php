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

<title>Poblacion de Edades</title>

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
                    <td style="width: 10%;"></td>
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
                                <h4>Listado des Edades</h4>
                            </u>
                        </center>
                    </td>
                    <td style="width: 10%;"></td>
                </tr>
                
                
                
                <tr>
                    <td style="width: 10%;"></td>
                    <td style="width: 80%;">
                        <br>
                        <div style='width:100%;text-align:justify'>
                            <table class="datos">
                                
                                <tr>
                                    <td>
                                        Cedula
                                    </td>
                                    <td>
                                        Nombre y Apellido
                                    </td>
                                    

                                    <td>
                                        Edad
                                    </td>
                                    <td>
                                        Sexo
                                    </td>
                                    <td>
                                        Calle
                                    </td>
                                </tr>
                                <tbody id="datos">
                                    <?php foreach ($this->poblacion_edades as $value): ?>
                                        <tr>
                                            <td><?php echo $value["cedula_persona"] ?></td>
                                            <td> <?php echo $value["primer_nombre"]." ".$value["primer_apellido"] ?></td>
                                            <td><?php echo $value["edad"] ?></td>
                                            <td><?php 
                                            if ($value["genero"] == "M") {
                                                echo "Masculino";
                                            }else{
                                                echo "Femenino";
                                            }
                                        ?></td>
                                        <td><?php echo $value["nombre_calle"] ?></td>
                                        
                                    </tr>
                                <?php endforeach ?>
                                <tr>
                                    <td>
                                        Total:
                                    </td>
                                    <td colspan="5">

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </td>
                <td style="width: 10%;"></td>
            </tr>
            
            
            
            

            

            
            
        </table>

    </div>
</div>
<!-- /.card-body -->
</section>
<!-- /.content -->
</div>