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

<title>Censo de niños</title>
<script>
        window.blur();
        window.print();

    </script>

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

                                <img style="width: 100%;" src="<?php echo constant('URL') ?>config/img/web/cintillo.png" alt="">
                            </center>
                            <br><br>
                        </td>
                        <td style="width: 10%;"></td>
                    </tr>

                    <tr>
                        <td style="width: 10%;"></td>
                        <td style="width: 80%;">
                            <div style='width:100%;text-align:justify'>
                                <table class="datos">
                                    <tr>
                                        <td colspan="4" style="background: #ffff00;">
                                            <br>
                                            <center>
                                                <h3>
                                                    CENSOS COMUNIDAD PRADOS DE OCCIDENTE DE NIÑOS Y <br> NIÑAS CON
                                                    EDADES COMPRENDIDAS DE 0 A 12 AÑOS
                                                </h3>
                                            </center>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <br>
                                        </td>
                                    </tr>
                                    <tr style="background: #ffff00;">
                                        <td colspan="2">

                                        </td>
                                        <td>
                                            RESPONSABLES DEL CLAP
                                        </td>
                                        <td>
                                            CONTACTO
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="background: #ffff00;">
                                            MUNICIPIO
                                        </td>
                                        <td>
                                            IRIBARREN
                                        </td>
                                        <td>
                                            DORALIS SIERRALTA
                                        </td>

                                        <td>04145581084 </td>



                                    </tr>
                                    <tr>
                                        <td style="background: #ffff00;">PARROQUIA</td>
                                        <td>ANA SOTO</td>
                                        <td></td>
                                        <td></td>

                                    </tr>
                                    <tr>
                                        <td style="background: #ffff00;">COMUNIDAD</td>
                                        <td>PRADO SECTOR 3</td>
                                        <td></td>
                                        <td></td>

                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <br>
                                        </td>
                                    </tr>
                                    <tbody id="datos">

                                        <tr style="background: #ffff00;">
                                            <td>
                                                EDADES
                                            </td>
                                            <td>
                                                SEXO MASCULINO
                                            </td>
                                            <td>
                                                SEXO FEMENINO
                                            </td>
                                            <td>
                                                TOTAL
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="background: #ffff00;">0 MESES A 2 AÑOS</td>
                                            <td><?php echo $this->menos_dos_anios['masculino']; ?></td>
                                            <td><?php echo $this->menos_dos_anios['femenino']; ?></td>
                                            <td><?php echo $this->menos_dos_anios['masculino']+$this->menos_dos_anios['femenino'] ?></td>
                                        </tr>

                                        <tr>
                                            <td style="background: #ffff00;">3 AÑOS A 5</td>
                                            <td><?php echo $this->dos_a_cinco_anios['masculino']; ?></td>
                                            <td><?php echo $this->dos_a_cinco_anios['femenino']; ?></td>
                                            <td><?php echo $this->dos_a_cinco_anios['masculino']+$this->dos_a_cinco_anios['femenino'] ?></td>
                                        </tr>

                                        <tr>
                                            <td style="background: #ffff00;">6 AÑOS A 10</td>
                                            <td><?php echo $this->seis_a_diez_anios['masculino']; ?></td>
                                            <td><?php echo $this->seis_a_diez_anios['femenino']; ?></td>
                                            <td><?php echo $this->seis_a_diez_anios['masculino']+$this->seis_a_diez_anios['femenino'] ?></td>
                                        </tr>

                                        <tr>
                                            <td style="background: #ffff00;"> 11 AÑOS A 12</td>
                                            <td><?php echo $this->once_doce_anios['masculino']; ?></td>
                                            <td><?php echo $this->once_doce_anios['femenino']; ?></td>
                                            <td><?php echo $this->once_doce_anios['masculino']+$this->once_doce_anios['femenino'] ?></td>
                                        </tr>

                                        <tr>
                                            <td>Total:</td>
                                            <td><?php echo $this->menos_dos_anios['masculino']+$this->dos_a_cinco_anios['masculino']+$this->seis_a_diez_anios['masculino']+$this->once_doce_anios['masculino'] ?></td>
                                            <td>
                                            <?php echo $this->menos_dos_anios['femenino']+$this->dos_a_cinco_anios['femenino']+$this->seis_a_diez_anios['femenino']+$this->once_doce_anios['femenino'] ?>
                                            </td>
                                            <td>
                                            <?php echo $this->menos_dos_anios['masculino']+$this->dos_a_cinco_anios['masculino']+$this->seis_a_diez_anios['masculino']+$this->once_doce_anios['masculino']+$this->menos_dos_anios['femenino']+$this->dos_a_cinco_anios['femenino']+$this->seis_a_diez_anios['femenino']+$this->once_doce_anios['femenino']; ?>
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

                    <tr>
                        <script>
                            console.log(<?php echo json_encode($this->menores); ?>)
                        </script>
                        <td style="width: 10%;"></td>
                        <td style="width: 80%;"><br>
                            <div style='width:100%;text-align:justify'>
                                <table class="datos">
                                    <tr>
                                        <td>#</td>
                                        <td>
                                            Nombre y Apellido Niño
                                        </td>

                                        <td>Edad</td>

                                        <td>
                                            Sexo
                                        </td>
                                        <td>Calle</td>
                                        <td>
                                            NOMBRE REPRESENTANTE
                                        </td>
                                        <td>
                                            Contacto
                                        </td>
                                    </tr>
                                    <tbody id="datos">
                                        <?php foreach ($this->menores as $value) : ?>
                                            <tr>
                                                <td><?php echo $cont = $cont + 1; ?></td>
                                                <td><?php echo $value["primer_nombre"] . " " . $value["primer_apellido"] ?></td>
                                                <td><?php echo $value["edad"] ?></td>
                                                <td><?php echo $value["genero"] ?></td>
                                                <td><?php echo $value["calle"] ?></td>

                                                <td><?php echo $value['representante']; ?></td>
                                                <td><?php echo $value['contacto']; ?></td>
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