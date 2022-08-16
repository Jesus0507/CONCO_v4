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

<title>Listado de Jefes de Familia</title>

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
                            </center>
                            <table class="datos">
                                <tr>
                                    <td>Direccion</td>
                                    <td>Calle </td>
                                    <td> Fecha: <?php echo date('d-m-Y'); ?></td>
                                </tr>
                                <tr>
                                    <td>Consejo Comunal</td>
                                    <td colspan="2">Prados de Occidente Sector III</td>
                                </tr>   
                                
                            </table>
                            <br>
                        </td>
                        <td style="width: 10%;"></td>
                    </tr>

                    <tr>
                        <td style="width: 10%;"></td>
                        <td style="width: 80%;">
                            <div style='width:100%;text-align:justify'>
                                <table class="datos">
                                    <tr>
                                        <td colspan="6" ><center>Canditad Por Calle</center></td>
                                    </tr>
                                    <tr>
                                        <td>#</td>
                                        <td>
                                            Jefe de Casa
                                        </td>
                                        <td>
                                            C.I
                                        </td>
                                        <td>
                                            N° de Personas
                                        </td>

                                        <td>
                                            N° de Casa
                                        </td>
                                        <td>
                                            Firma
                                        </td>
                                    </tr>
                                    <tbody id="datos">
                                        <?php $cont = 1; ?>
                                        <?php foreach ($this->jefes_familia as $key => $value): $contador=0; ?>
                                            <?php foreach ($this->personas_familia as $key): ?>
                                                <?php if ($value["id_familia"] == $key["id_familia"]): ?>
                                                    <?php $contador++;?>
                                                <?php endif ?>
                                            <?php endforeach ?>
                                        <tr>
                                            <td><?php echo $cont++ ?></td>
                                            <td><?php echo $value["primer_nombre"]." ".$value["primer_apellido"] ?></td>
                                            <td><?php echo $value["cedula_persona"] ?></td>
                                            <td><?php echo $contador; ?></td>
                                            <td><?php echo $value["numero_casa"]; ?></td>
                                            <td></td>
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