<?php include (call."Inicio.php"); ?>
<!-- Contenido de la pagina -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Registrar Personas</h1>
                </div><!-- /.col -->
                <!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <input type="hidden" value='<?php echo json_encode($_SESSION['Seguridad']); ?>' id='seguridad_usuario' name="">
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Formulario de Registro</h3>
                
            </div>
            <form action="<?php echo constant('URL'); ?>Personas/Nuevo_Persona" enctype="multipart/form-data"
                id="formulario" method="POST" name="formulario">
                <!-- card-body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="vtabs">
                                <ul class="nav nav-tabs tabs-vertical" role="tablist">
                                    <li class="nav-item" style="margin-top: 50%; margin-bottom: 50%;">
                                        <a class="nav-link active" id='tab_1'>
                                            <span class="hidden-sm-up">
                                                <i class="ti-home"></i>
                                            </span>
                                            <span class="hidden-xs-down">
                                                Información Personal
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item" style="margin-top: 50%; margin-bottom: 50%;">
                                        <a id='tab_2' >
                                            <span class="hidden-sm-up">
                                                <i class="ti-user"></i>
                                            </span>
                                            <span class="hidden-xs-down">
                                                Carnets
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item" style="margin-top: 50%; margin-bottom: 50%;">
                                        <a id='tab_3' >
                                            <span class="hidden-sm-up">
                                                <i class="ti-email"></i>
                                            </span>
                                            <span class="hidden-xs-down">
                                                Información de Contacto
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item" style="margin-top: 50%; margin-bottom: 50%;">
                                        <a id='tab_4' >
                                            <span class="hidden-sm-up">
                                                <i class="ti-email"></i>
                                            </span>
                                            <span class="hidden-xs-down">
                                                Información política
                                            </span>
                                        </a>
                                    </li>

                                    <li class="nav-item" style="margin-top: 50%; margin-bottom: 50%;">
                                        <a id='tab_5'>
                                            <span class="hidden-sm-up">
                                                <i class="ti-email"></i>
                                            </span>
                                            <span class="hidden-xs-down">
                                                Información laboral
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item" style="margin-top: 50%; margin-bottom: 50%;">
                                        <a id='tab_6'>
                                            <span class="hidden-sm-up">
                                                <i class="ti-email"></i>
                                            </span>
                                            <span class="hidden-xs-down">
                                                Información de usuario
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="panel1" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <h2>
                                                    Información de Personal
                                                </h2>
                                            </div>
                                            
                                            <div class="col-md-12 mt-2">
                                                <label for="cedula">
                                                Documento de identidad                                               </label> <span style='color:red;display:none' id='valid_1'>Ingrese el documento de identidad</span>

                                                <div class="input-group">
                                                    <input class="form-control input-numero solo-numeros" id="cedula"
                                                    name="datos[cedula]" placeholder="Cedula de identidad"
                                                    type="number" oninput="Limite(this,8)"/>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mt-4">
                                                <label for="primer_nombre">
                                                    Primer Nombre
                                                </label>
                                                <span style='display:none;color:red' id='valid_2'>Ingrese el primer nombre</span>
                                                <div class="input-group">
                                                    <input class="form-control mb-10 solo-letras" id="primer_nombre"
                                                    name="datos[primer_nombre]" placeholder="Primer Nombre"
                                                    type="text" oninput="Limitar(this,15)"/>
                                                </div>

                                            </div>

                                            <div class="col-md-6 mt-4">
                                                <label for="segundo_nombre">
                                                    Segundo Nombre
                                                </label>
                                                <span style='display:none;color:red' id='valid_3'>Ingrese el segundo nombre</span>
                                                <div class="input-group">
                                                    <input class="form-control mb-10 solo-letras" id="segundo_nombre"
                                                    name="datos[segundo_nombre]" placeholder="Segundo Nombre"
                                                    type="text" oninput="Limitar(this,15)" />
                                                </div>

                                            </div>

                                            <div class="col-md-6 mt-2">
                                                <label for="primer_apellido">
                                                    Primer Apellido
                                                </label>
                                                <span style='display:none;color:red' id='valid_4'>Ingrese el primer apellido</span>
                                                <div class="input-group">
                                                    <input class="form-control mb-10 solo-letras" id="primer_apellido"
                                                    name="datos[primer_apellido]" placeholder="Primer Apellido"
                                                    type="text" oninput="Limitar(this,15)"/>
                                                </div>

                                            </div>

                                            <div class="col-md-6 mt-2">
                                                <label for="segundo_apellido">
                                                    Segundo Apellido
                                                </label>
                                                <span style='display:none;color:red' id='valid_5'>Ingrese el segundo apellido</span>
                                                <div class="input-group">
                                                    <input class="form-control mb-10 solo-letras" id="segundo_apellido"
                                                    name="datos[segundo_apellido]" placeholder="Segundo Apellido"
                                                    type="text" oninput="Limitar(this,15)"/>
                                                </div>

                                            </div>
                                            <div class="col-md-6 mt-2">
                                                <div class="form-group">
                                                    <label for="fecha_nacimiento">
                                                        Fecha De Nacimiento 
                                                    </label> <span style='display:none;color:red' id='valid_6'>Ingrese la fecha de nacimiento</span>
                                                    <input class="form-control" id="fecha_nacimiento"
                                                    name="fecha_nacimiento" type="date">
                                                </input>
                                            </div>

                                        </div>



                                        <div class="col-md-6 mt-2">
                                            <label for="estado_civil">
                                                Estado Civil
                                            </label>
                                            <span style='display:none;color:red' id='valid_7'>Ingrese el estado civil </span>
                                            <div class="input-group">
                                                <select class="custom-select" id="estado_civil" name="datos[estado_civil]">
                                                    <option selected="" value="vacio">
                                                        -Seleccione-
                                                    </option>
                                                    <option value="Casado(a)">
                                                        Casado(a)
                                                    </option>
                                                    <option value="Soltero(a)">
                                                        Soltero(a)
                                                    </option>
                                                    <option value="Viudo(a)">
                                                        Viudo(a)
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <label for="genero">
                                                Genero
                                            </label>
                                            <span style='display:none;color:red' id='valid_8'>Ingrese el género</span>
                                            <div class="input-group">
                                                <select class="custom-select" id="genero" name="datos[genero]">
                                                    <option selected="" value="vacio">
                                                        -Seleccione-
                                                    </option>
                                                    <option value="M">
                                                        Masculino
                                                    </option>
                                                    <option value="F">
                                                        Femenino
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <label for="sexualidad">
                                                Orientación sexual
                                            </label>
                                            <span style='display:none;color:red' id='valid_9'>Ingresela orientación sexual</span>
                                            <div class="input-group">
                                                <select class="custom-select" id="sexualidad"
                                                name="datos[sexualidad]">
                                                <option selected="" value="vacio">
                                                    -Seleccione-
                                                </option>
                                                <option value="Heterosexual">
                                                    Heterosexual
                                                </option>
                                                <option value="Homosexual">
                                                    Homosexual
                                                </option>
                                                <option value="Bisexual">
                                                    Bisexual
                                                </option>
                                                <option value="Otro">
                                                    Otro
                                                </option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-6 mt-2">
                                        <label for="nacionalidad">
                                            Nacionalidad
                                        </label>
                                        <span style='display:none;color:red' id='valid_10'>Ingrese la nacionalidad</span>
                                        <div class="input-group">
                                            <input class="form-control mb-10 solo-letras" id="nacionalidad"
                                            name="datos[nacionalidad]" placeholder="Nacionalidad" type="text" oninput="Limitar(this,15)" />
                                        </div>

                                    </div>

                                    <div class="col-md-6 mt-2">
                                        <label for="nivel_educativo">
                                            Nivel Educativo
                                        </label>
                                        <span style='display:none;color:red' id='valid_11'>Ingrese el nivel educativo</span>
                                        <div class="input-group">
                                            <select class='form-control' name="datos[nivel_educativo]" id='nivel_educativo'>
                                                <option value='vacio'>-Seleccione-</option>
                                                <option value='Preescolar'>Preescolar</option>
                                                <option value='Básico'>Básico</option>
                                                <option value='Medio diversificado'>Medio diversificado</option>
                                                <option value='Superior'>Superior</option>
                                            </select>
                                           
                                        </div>
                                    </div>

                                    <div class="col-md-6 mt-2">
                                        <label for="afrodescendencia">
                                            Afrodescendencia
                                        </label>
                                        <span style='display:none;color:red' id='valid_12'>Indique si es afrodescendente</span>
                                        <select class="custom-select" id="afrodescendencia"
                                        name="afrodescendencia">
                                        <option selected="" value="vacio">
                                            -Seleccione-
                                        </option>
                                        <option value="1">
                                            Si
                                        </option>
                                        <option value="0">
                                         No
                                     </option>

                                 </select>
                             </div>

                             <div class="col-md-6 mt-2">
                                <label for="tiempo_comunidad">
                                    Tiempo en la comunidad    
                                </label>
                                <span style='display:none;color:red' id='valid_13'>Campo vacío</span>
                                <div class="input-group">
                                    <input  class="form-control mb-10" id="tiempo_comunidad"
                                    name="datos[tiempo_comunidad]"
                                    type="date" />
                                    <button type="button" class="btn btn-default" id='desde_siempre'>Desde siempre</button>
                                </div>

                            </div>



                            <div class="col-md-4 mt-2">
                                <label for="jefe_familia">
                                    Jefe de familia
                                </label>
                                <span style='display:none;color:red' id='valid_14'>Vacío</span>
                                <select class="custom-select" id="jefe_familia"
                                name="jefe_familia">
                                <option selected="" value="vacio">
                                    -Seleccione-
                                </option>
                                <option value="1">
                                    Si
                                </option>
                                <option value="0">
                                 No
                             </option>

                         </select>
                     </div>

                     <div class="col-md-4 mt-2">
                        <label for="propietario_vivienda">
                            Propietario de vivienda
                        </label>
                        <span style='display:none;color:red' id='valid_15'>Vacío</span>
                        <select class="custom-select" id="propietario_vivienda"
                        name="propietario_vivienda">
                        <option selected="" value="vacio">
                            -Seleccione-
                        </option>
                        <option value="1">
                            Si
                        </option>
                        <option value="0">
                         No
                     </option>

                 </select>
             </div>

             <div class="col-md-4 mt-2">
                <label for="jefe_calle">
                    Jefe de calle
                </label>
                <span style='display:none;color:red' id='valid_16'>Vacío</span>
                <select class="custom-select" id="jefe_calle"
                name="jefe_calle">
                <option selected="" value="vacio">
                    -Seleccione-
                </option>
                <option value="1">
                    Si
                </option>
                <option value="0">
                 No
             </option>

         </select>
     </div>



     <div class="col-md-6 mt-2">
        <label for="miliciano">
            Miliciano
        </label>
        <span style='display:none;color:red' id='valid_17'>Indique si es miliciano</span> 
        <select class="custom-select" id="miliciano"
        name="miliciano">
        <option selected="" value="vacio">
            -Seleccione-
        </option>
        <option value="1">
            Si
        </option>
        <option value="0">
         No
     </option>

 </select>
</div>

<div class="col-md-6 mt-2">
    <label for="transporte">
        Transporte
    </label>
    <span style='display:none;color:red' id='valid_18'>Indique el tipo de transporte</span>
    <table style="width:100%">
        <tr><td>
            <select  class="custom-select" id="transporte"
            name="transporte">
            <option selected="" value="vacio">
                -Seleccione-
            </option>
            <option value="0">
                Público
            </option>
            <option value="privado">
             Privado
         </option>

     </select></td><td style='display:none' id='tipo_transporte_view'>

       <input type="text" id='tipo_transporte' name="tipo_transporte" placeholder="Indique el tipo de transporte" class="form-control letras_numeros" list='transportes_regitrados' oninput="Limitar(this,15)"> 

       <datalist id='transportes_regitrados'>
           <?php foreach ($this->transportes as $tr) { ?>
            <option value="<?php echo $tr['descripcion_transporte']; ?>"></option>
        <?php } ?>
    </datalist>

</td></tr>
</table>
</div>


<div class="col-md-6 mt-2">
    <label for="comunidad_indigena">
        Comunidad indigena
    </label>
    <span style='display:none;color:red' id='valid_19'>Campo vacío</span>
    <table style="width:100%">
        <tr><td>
            <select  class="custom-select" id="comunidad_indigena"
            name="comunidad_indigena">
            <option selected="" value="vacio">
                -Seleccione-
            </option>
            <option value="si">
                Si
            </option>
            <option value="0">
             No
         </option>

     </select></td><td style='display:none' id='comunidad_indigena_view'>

       <input type="text" id='nombre_comunidad' name="nombre_comunidad" placeholder="Nombre de la comunidad indigena" class="form-control solo-letras" list='comunidades_indigenas' oninput="Limitar(this,20)"> 

       <datalist id='comunidades_indigenas'>
           <?php foreach ($this->comunidades as $cm) { ?>
            <option value="<?php echo $cm['nombre_comunidad']; ?>"></option>
        <?php } ?>
    </datalist>

</td></tr>
</table>
</div>

<div class="col-md-6 mt-2">
    <label for="privado_libertad">
        Privado de libertad
    </label>
    <span style='display:none;color:red' id='valid_20'>Campo vacío</span>
    <select class="custom-select" id="privado_libertad"
    name="privado_libertad">
    <option selected="" value="vacio">
        -Seleccione-
    </option>
    <option value="1">
        Si
    </option>
    <option value="0">
     No
 </option>

</select>
</div>
<!-- 
                                            <div class="col-md-6 mt-2">
                                                <label for="institucion">
                                                    Institucion Academica
                                                </label>
                                                <div class="input-group">
                                                    <input class="form-control mb-10" id="institucion"
                                                        name="datos[institucion]" placeholder="Institucion Academica"
                                                        type="text" />
                                                </div>
                                            </div> -->




                                        </div>

                                    </div>
                                    <div class="tab-pane" id="panel2" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <h2>
                                                    Documentos
                                                </h2>
                                            </div>



                                            <div class="col-md-6 mt-4">
                                                <label for=""> Carnet de la Patria</label>
                                            </div>
                                            <div class="col-md-6 mt-4">
                                                <label for=""> Carnet de el PSUV (opcional)</label>
                                            </div>
                                            <div class="col-md-6 mt-2">
                                                <label for="serial_patria">
                                                    Serial Patria
                                                </label>
                                                <span style='color:red' id='valid_serial_patria'></span>
                                                <div class="input-group">
                                                    <input class="form-control mb-10 no-espacios no-acentos" id="serial_patria"
                                                    name="datos[serial_patria]" placeholder="Serial" type="text" oninput="Limitar(this,10)"/>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mt-2">
                                                <label for="serial_psuv">
                                                    Serial PSUV
                                                </label>
                                                <span style='color:red' id='valid_serial_psuv'></span>
                                                <div class="input-group">
                                                    <input class="form-control mb-10 no-espacios no-acentos" id="serial_psuv"
                                                    name="datos[serial_psuv]" placeholder="Serial" type="text" oninput="Limitar(this,12)"/>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mt-2">
                                                <label for="codigo_patria">
                                                    Codigo Patria
                                                </label>
                                                <span style='color:red' id='valid_codigo_patria'></span>
                                                <div class="input-group">
                                                    <input class="form-control mb-10 no-espacios no-acentos" id="codigo_patria"
                                                    name="datos[codigo_patria]" placeholder="Codigo" type="text" oninput="Limitar(this,10)"/>
                                                </div>

                                            </div>

                                            <div class="col-md-6 mt-2">
                                                <label for="codigo_psuv">
                                                    Codigo PSUV
                                                </label>
                                                <span style='color:red' id='valid_codigo_psuv'></span>
                                                <div class="input-group">
                                                    <input class="form-control mb-10 no-espacios no-acentos" id="codigo_psuv"
                                                    name="datos[codigo_psuv]" placeholder="Codigo" type="text" oninput="Limitar(this,12)"/>
                                                </div>
                                            </div>


                                            <div class="col-md-6 mt-2">
                                                <label for="certificado">
                                                    Certificado de discapacidad
                                                </label>
                                                <br>
                                                <label for="serial_discapacidad">
                                                    Serial discapacidad
                                                </label>
                                                <span style='color:red' id='valid_serial_discapacidad'></span>
                                                <div class="input-group">
                                                    <input class="form-control mb-10 no-espacios no-acentos" id="serial_discapacidad"
                                                    name="datos[serial_discapacidad]" placeholder="Serial" type="text" oninput="Limitar(this,12)"/>
                                                </div>
                                                <label for="codigo_discapacidad">
                                                    Código discapacidad
                                                </label>
                                                <span style='color:red' id='valid_codigo_discapacidad'></span>
                                                <div class="input-group">
                                                    <input class="form-control mb-10 no-espacios no-acentos" id="codigo_discapacidad"
                                                    name="datos[codigo_discapacidad]" placeholder="Codigo" type="text" oninput="Limitar(this,12)"/>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="tab-pane" id="panel3" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <h2>
                                                    Información de Contacto
                                                </h2>
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <div class="form-group">
                                                    <label for="correo">
                                                        Correo Electronico
                                                    </label>
                                                    <div class="input-group">
                                                        <input class="form-control no-espacios" id="correo" name="datos[correo]"
                                                        placeholder="Correo" type="text">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">@</span>
                                                        </div>
                                                        <select class="custom-select" id="tipo_correo"
                                                        name="datos[tipo_correo]">
                                                        <option selected="" value="@gmail.com">
                                                            gmail.com
                                                        </option>
                                                        <option value="@hotmail.com">
                                                            hotmail.com
                                                        </option>
                                                        <option value="@yahoo.com">
                                                            yahoo.com
                                                        </option>
                                                        <option value="@yahoo.es">
                                                            yahoo.es
                                                        </option>
                                                        <option value="@outlok.com">
                                                            outlok.com
                                                        </option>
                                                    </select>
                                                </input>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-9 mt-2">
                                        <label for="telefono_personal">
                                            Telefono Personal
                                        </label>
                                        <span style='display:none;color:red' id='valid_21'>Ingrese el número de teléfono</span>
                                        <div class="input-group">
                                            <input class="form-control mb-10 solo-numeros no-espacios" id="telefono"
                                            name="datos[telefono]" placeholder="0000-000-0000"
                                            type="number" oninput="Limitar(this,12)"/>
                                        </div>

                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <label for="whatsapp">
                                            <i class="fa fa-whatsapp" style="font-size: 15px;"></i> WhatsApp
                                        </label>
                                        <span style='display:none;color:red' id='valid_22'>Campo vacío</span>
                                        <div class="input-group">
                                           <select class="custom-select" id="whatsapp" name="datos[whatsapp]">
                                            <option selected="" value="vacio">
                                                -Seleccione-
                                            </option>
                                            <option value="1">
                                             Si
                                         </option>
                                         <option value="0">
                                            No
                                        </option>
                                    </select>
                                </div>
                            </div>
                                          <!--   <div class="col-md-12 mt-2">
                                                <label for="telefono_casa">
                                                    Telefono de Casa
                                                </label>
                                                <div class="input-group">
                                                    <input class="form-control mb-10" id="telefono_casa"
                                                        name="datos[telefono_casa]" placeholder="0000-000-0000"
                                                        type="text" />
                                                </div>

                                            </div> -->
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="panel4" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <h2>
                                                    Información política
                                                </h2>
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <label for="organizacion_politica">
                                                    Organización política
                                                </label>
                                                <span style='display:none;color:red' id='valid_23'>Indique si pertenece a una org política</span>
                                                <table style="width:100%">
                                                    <tr><td>
                                                        <div class="input-group">
                                                            <select  class="custom-select" id="organizacion_politica" name="datos[organizacion_politica]">
                                                                <option selected="" value="0">
                                                                    Ninguna
                                                                </option>
                                                                <?php foreach ($this->organizaciones as $org) { ?>
                                                                    <option value="<?php echo $org['id_org_politica']; ?>"><?php echo $org['nombre_org']; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                            <input style='display:none' type="text" id='nombre_organizacion' class='form-control' placeholder="Escriba el nombre de la organización" name="" oninput="Limitar(this,30)">
                                                        </div></td><td>
                                                            <input type="button" id='btn_nueva_org'  class='btn btn-primary' value="Nueva organización">
                                                        </td></tr></table>
                                                    </div>





                                                    <div class="col-md-12 text-center mt-2">
                                                        <h4>
                                                            Beneficios Politicos
                                                        </h4>
                                                    </div>

                                                    <div class="col-md-12 mt-2">
                                                        <label for="bonos">
                                                            Bonos
                                                        </label>
                                                        <span style='display:none;color:red' id='valid_24'>Ingrese el nombre del bono</span>
                                                        <table style="width:100%">
                                                            <tr><td><br>
                                                                <div class="input-group">
                                                                 <select id='input_bonos' class='form-control'>
                                                                    <option value='vacio'>-Seleccione-</option>
                                                                    <?php foreach ($this->bonos as $b) { ?>
                                                                       <option value="<?php echo $b['id_bono']; ?>"><?php echo $b['nombre_bono'];?></option>
                                                                   <?php  } ?>
                                                               </select>

                                                               <input style='display:none' type="text" id='bono_nuevo' name="bono_nuevo" class='form-control' placeholder="Nombre del bono" oninput="Limitar(this,20)">
                                                           </div>
                                                       </td>
                                                       <td><br>
                                                        <button class="btn btn-primary" type="button" id='btn_nuevo_bono'>
                                                            Nuevo
                                                        </button>
                                                        <button class="btn btn-info" type="button" id='btn_agregar_bono'>
                                                            Agregar
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="text-align:center"><br>
                                                        <div style='width:80%;border-radius: 6px;height: 250px !important;background:#B8F1FF;overflow-y: scroll' id='bonos_agregados'>

                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>

                                        <div class="col-md-12 mt-2">
                                           <label for="misiones">
                                             Misiones
                                         </label>
                                         <span style='display:none;color:red' id='valid_25'>Ingrese el nombre de la misión</span>
                                         <table style="width:100%">
                                            <tr><td>
                                                Nombre misión
                                                <div class="input-group">
                                                 <input type="text" id='nombre_mision' style='display:none'  class='form-control' placeholder="Nombre de la misión" >
                                                 <select class='form-control' id='input_misiones'>
                                                    <option value='vacio'>-Seleccione-</option>
                                                    <?php foreach ($this->misiones as $m) { ?>
                                                       <option value="<?php echo $m['id_mision']; ?>"><?php echo $m['nombre_mision'];?></option>
                                                   <?php  } ?>
                                               </select>
                                           </div>
                                       </td><td>
                                        Recibe actualmente 
                                        <select id='recibe_actualmente' class='form-control'>
                                            <option value='1'>Si</option>
                                            <option value='0'>No</option>
                                        </select>

                                    </td>

                                    <td style='display:none' id='ver_fecha_recepcion'>Última vez recibido
                                        <input  type="date" id='ultima_recepcion' class='form-control' name="">
                                    </td>
                                    <td>
                                        <br>
                                        <button class="btn btn-info" type="button" id='btn_nueva_mision'>
                                            Nueva
                                        </button>
                                        <button class="btn btn-info" type="button" id='btn_agregar_mision'>
                                            Agregar
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="text-align:center"><br>
                                        <div style='width:80%;border-radius: 6px;height: 250px !important;background:#B8D7FF;overflow-y: scroll' id='misiones_agregadas'>

                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>





                    </div>


                </div>

                <div class="tab-pane" id="panel5" role="tabpanel">


                    <div class="row  mt-2">
                        <div class="col-md-12 text-center mt-2">
                            <h4>
                                Información laboral
                            </h4>
                        </div>

                        <div class="col-md-12 mt-2">
                            <label for="ocupacion">
                             Ocupacion
                         </label>
                         <span style='display:none;color:red' id='valid_26'>Ingrese la ocupación</span>
                         <table style='width:100%'>
                            <tr><td>
                                <div class="input-group">
                                    <select id='ocupacion' class='form-control'>
                                        <option value='0'>Sin ocupación</option>
                                        <?php foreach ($this->ocupaciones as $o) { ?>
                                           <option value='<?php echo $o["id_ocupacion"]; ?>'><?php echo $o['nombre_ocupacion'];?></option>
                                           <?php  } ?></select>

                                           <input style='display:none' type="text" class='form-control' id='ocupacion_nueva' name="ocupacion" placeholder="Ocupación de la persona">
                                       </div>
                                   </td><td><input type="button" id='btn_nueva_ocupacion' class='btn btn-info' value='Nueva' name=""></td></tr></table>


                                   <div class="col-md-12 mt-2">
                                    <label for="cond_laboral">
                                        Condición laboral
                                    </label>
                                    <span style='display:none;color:red' id='valid_27'>Campo sin llenar</span>
                                    <table style='width:100%'><tr><td>
                                        <div class="input-group">

                                         <select class='form-control' id="nombre_condicion_laboral">
                                            <option value='0'>Desempleado</option>
                                            <?php foreach ($this->condiciones as $cond) { ?>
                                                <option value='<?php echo $cond["nombre_cond_laboral"]; ?>'><?php echo $cond['nombre_cond_laboral'];?></option>
                                                <?php      } ?></select>
                                                <input style='display:none' class='form-control' type="text" id='nombre_cond_nueva'  placeholder="Nombre de la condición laboral" >
                                            </div>
                                        </td><td>
                                           <select class="form-control" id="sector_laboral"
                                           name="datos[sector_laboral]">
                                           <option value='vacio'>-Sector Laboral-</option>
                                           <option value="1">
                                            Formal
                                        </option>
                                        <option value="2">
                                         Público
                                     </option>
                                 </select>
                             </td>
                             <td style='display:none' id='ver_sector_formal'>
                               <select class="form-control" id="tipo_sector_formal"
                               name="datos[tipo_sector_formal]">
                               <option value='vacio'>-Tipo de sector formal-</option>
                               <option value="1">
                                 Informal
                             </option>
                             <option value="2">
                                 Privado
                             </option>
                         </select>
                     </td>
                     <td>
                        <input type="button" class='btn btn-info' id='nueva_cond' value='Nueva' name="">
                    </td>

                </tr></table>
            </div>


            <div class="col-md-12 mt-2">
                <label >
                 Proyectos en los que labora
             </label>
             <table style='width:100%'><tr><td style='width:120%'>

                <div  id='proyectos_agregados'>
                    <select class="form-control" id="proyectos"
                    name="datos[proyctos]">
                    <option value='vacio'>-Seleccione-</option>
                    <?php foreach ($this->proyectos as $pr) { ?>
                      <option value="<?php echo $pr['id_proyecto']; ?>"><?php echo $pr['nombre_proyecto']; ?></option>
                  <?php   } ?>
              </select>
          </div>
          <div  style='display:none' id='nuevo_proyecto'>
            <table style='width:100%'><tr><td>
                <input type="text" id='nombre_proyecto' name="nombre_proyecto" placeholder="Nombre del proyecto" class='form-control'>
            </td>
            <td>
                <select id='area_proyecto' class='form-control'>
                 <option value='vacio'>-Seleccione-</option>
                 <option value='Construcción y mantenimiento'>Construcción y mantenimiento</option>
                 <option value='Transporte'>Transporte</option>
                 <option value='Alimentación'>Alimentación</option>
                 <option value='Comunicación'>Comunicación</option>
                 <option value='Textil o Artesanal'>Textil o Artesanal</option>
                 <option value='Agricola'>Agricola</option>
                 <option value='Cultural'>Cultural</option>
                 <option value='Educativo'>Educativo</option>
             </select>
         </td>
         <td>
             <input type="text" id='estado_proyecto' name="estado_proyecto" placeholder="Estado del proyecto" class='form-control'> 
         </td></tr></table>
     </div>
 </td><td  ><input type="button" id="otro_proyecto" value="Otro" class='btn btn-info'></td>
 <td ><input type="button" id="agregar_proyecto" value="Agregar" class='btn btn-primary'></td></tr></table>
</div>

<div class="col-md-10 mt-2" style='border-radius: 6px;overflow-y: scroll;background: #CFFEDE;width: 100%;height: 200px !important' id='proyectos_persona'>


</div>
</div></div></div>
<div class="tab-pane" id="panel6" role="tabpanel">
    <div class="row">
        <div class="col-md-12 text-center">
            <h2>
                Información de Usuario
            </h2>
        </div>
        <div class="col-md-12 mt-2">
            <div class="form-group">
                <label for="correo">
                 Contraseña
             </label> <span id='valid_contrasenia' style='color:red;display:none'>Debe ingresar la contraseña del usuario</span>
             <div class="input-group">
                <table style='width:100%'>
                    <tr><td>
                        <input class="form-control no-espacios" id="contrasenia" name=""
                        placeholder="Contraseña de ingreso" type="password" oninput="Limitar(this,10)">
                    </td><td><button type='button' class='btn btn-default' id='ver_clave'><em class='fa fa-eye'></em></button></td></tr></table>
                </table>

            </div>
        </div>

        <div class="col-md-12 mt-2">
            <div class="form-group">
                <label for="correo">
                 Confirmar contraseña
             </label> <span id='valid_confirmar' style='color:red;display:none'>Debe confirmar la contraseña del usuario</span>
             <div class="input-group">
                        <input class="form-control no-espacios" id="confirmar" name=""
                        placeholder="Contraseña de ingreso" type="password" oninput="Limitar(this,10)">

            </div>
        </div>

        <br>

        <label for="telefono_personal">
            Preguntas de seguridad
        </label>
        <div class="col-md-12 mt-2">
            <table style='width:100%'><tr><td>
            <span style='display:none;color:red' id='valid_color'>Ingrese el color favorito</span>
            <div class="input-group">
                <input class="form-control mb-10" id="color_fav"
                placeholder="Color favorito"
                type="text" oninput="Limitar(this,10)" />
            </div></td>

<td>
            <span style='display:none;color:red' id='valid_animal'>Ingrese el animal favorito</span>
            <div class="input-group">
                <input class="form-control mb-10" id="animal_fav"
                placeholder="Animal favorito"
                type="text" oninput="Limitar(this,10)"/>
            </div>
</td><td>
            <span style='display:none;color:red' id='valid_mascota'>Ingrese el nombre de la primera mascota</span>
            <div class="input-group">
                <input class="form-control mb-10" id="primera_mascota"
                placeholder="Nombre de la primera mascota"
                type="text"  oninput="Limitar(this,10)" />
            </div>
</td></tr></table>  


    </div>

    <div class="col-md-12 mt-2" id='ver_rol' style='display:none'>
                            <label for="nombre_calle">
                               Rol
                            </label> <span id='valid_rol' style='display:none;color:red'></span>
                            <div class="input-group">
                                <select class='form-control' id='rol_usuario'>
                                    <option value='vacio'>-Seleccione-</option>
                                    <option value='Habitante'>Habitante</option>
                                     <option value='Super Usuario'>Super Usuario</option>
                                      <option value='Administrador'>Administrador</option>
                                </select>
                            </div>
                        </div>
</div>





</div>

</div>
</div>
</div>
</div>
</div>
</div>

<!-- /.card-body -->
<div class="card-footer">

    <div class="col-md-12 mt-4">
        <div style="float: left;">
            <a id="anterior" style='display:none' type="button" class="btn  btn-info">
                Anterior
            </a>
        </div>
    </div>
    <div class="col-md-12 mt-4">
        <div style="float: right;">
            <a id="siguiente" type="button" class="btn  btn-info">
                Siguiente
            </a>
        </div>
    </div>
    <div class="text-center m-t-20" id="botones-finales" style='display:none'>
        <div class="col-xs-12">
            <input type="button" class="btn  btn-primary m-r-10" name="" id="guardar" value="Guardar">
        </div>
    </div>
</div>
</form>
<!-- /.card-footer-->
</div>
<!-- /.card -->

</section>
<!-- /.content -->
<!-- /.content -->
</div>

<!-- /.content-wrapper -->
<?php include (call."Fin.php"); ?>


<script type="text/javascript" src="<?php echo constant('URL')?>config/js/news/registrar-personas.js"></script>
<style>
    .color-table.info-table thead th {
        background-color: #009efb;
        color: #fff;
    }
</style>