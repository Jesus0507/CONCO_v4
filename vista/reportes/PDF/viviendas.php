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

<title>Listado de Viviendas</title>

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
                                    <h4>Listado de Viviendas</h4>
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
                                            Numero de Casa
                                        </td>
                                        <td>
                                            Calle
                                        </td>
                                        <td>
                                            Direccion
                                        </td>

                                        <td>Tipo de Vivienda</td>

                                        <td>Condicion</td>
                                        
                                    </tr>
                                    <tbody id="datos">
                                        <?php foreach ($this->viviendas as $key => $value): ?>
                                            
                                        
                                        <tr>
                                            <td><?php echo $value["numero_casa"] ?></td>
                                            <td><?php echo $value["nombre_calle"] ?></td>
                                            <td><?php echo $value["direccion_vivienda"] ?></td>
                                            <td><?php echo $value["nombre_tipo_vivienda"] ?></td>
                                            <td><?php echo $value["condicion"] ?></td>
                                        </tr>
                                        <?php endforeach ?>
                                        <tr>
                                            <td>
                                                Total:
                                            </td>
                                            <td colspan="5">
                                                <?php echo count($this->viviendas) ?>
                                            </td>
                                        </tr>
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