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

<title>Personas Discapacidad</title>

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
                                    <h4>Listado de Personas con Discapadides</h4>
                                </u>
                            </center>
                        </td>
                        <td style="width: 10%;"></td>
                    </tr>

                    <tr> 
                        
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
                                            Dicapadidad
                                        </td>
                                        <td>Observacion</td>
                                        <td>EN Cama</td>
                                    </tr>
                                    <tbody id="datos">
                                        <?php foreach ($this->discapacidades_persona_completo as $key => $value): ?>
                                         <tr>
                                             <td>
                                                 <?php echo $value["cedula_persona"] ?>
                                             </td>
                                             <td>
                                                 <?php echo $value["nombres_apellidos"] ?>
                                             </td>
                                              <td>
                                                 <?php echo $value["direccion"] ?>
                                             </td>
                                             <td>
                                                 <?php echo $value["edad"] ?>
                                             </td>
                                             <td>
                                                 <?php echo $value["genero"] ?>
                                             </td>
                                             <td>
                                                 <?php echo $value["discapacidad"] ?>
                                             </td>
                                             <td>
                                                 <?php echo $value["observacion"] ?>
                                             </td>
                                              <td>
                                                 <?php echo $value["en_cama"] ?>
                                             </td>
                                         </tr> 
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