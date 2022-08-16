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
<title>Grupos Deportivos</title>
<!-- Contenido de la pagina -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <script>
    /* window.blur();
             window.print();
             window.close(); */
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
                                        <h4>Listado de Grupos Deportivos</h4>
                                    </u>
                                </center>
                            </td>
                            <td style="width: 10%;"></td>
                        </tr>

                        <tr>
                            <td style="width: 10%;"></td>
                            <td style="width: 80%;">
                                <div style='width:100%;text-align:justify'>
                                    <table class="datos">
                                        <tr>
                                            <td>
                                                Nombre del Grupo
                                            </td>
                                            <td>
                                                Deporte
                                            </td>
                                            <td>
                                                Cantidad de Integrantes
                                            </td>

                                            <td>
                                                Descripcion
                                            </td>

                                        </tr>
                                        <tbody id="datos">
                                            <?php foreach ($this->grupos_deportivos as $key => $value): $contador=0; ?>
                                               <?php foreach ($this->grupos_deportivos_personas as $key): ?>
                                                <?php if ($value["id_grupo_deportivo"] == $key["id_grupo_deportivo"]): ?>
                                                    <?php $contador++;?>
                                                <?php endif ?>
                                            <?php endforeach ?>

                                            <tr>
                                                <td><?php echo $value["nombre_grupo_deportivo"] ?></td>
                                                <td><?php echo $value["nombre_deporte"] ?></td>
                                                <td>
                                                 <?php echo $contador; ?>
                                                 
                                             </td>
                                             <td><?php echo $value["descripcion"] ?></td>
                                         </tr>
                                     <?php endforeach ?>
                                 </tbody>
                             </table>
                         </div>
                     </td>
                     <td style="width: 10%;"></td>
                     <tr>
                        <td style="width: 10%;"></td>
                        <td style="width: 80%;"></td>
                        <td style="width: 10%;"></td>
                    </tr>
                </tr>
            </table>

        </div>
    </div>
    <!-- /.card-body -->
</section>
<!-- /.content -->
</div>