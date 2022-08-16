<div class="modal fade" id="agregar">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Registrar Familiares</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="<?php echo constant('URL'); ?>" enctype="multipart/form-data"
                id="formulario" method="POST" name="formulario">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="vtabs">
                                <ul class="nav nav-tabs tabs-vertical" role="tablist">
                                    <li class="nav-item" style="margin-top: 50%; margin-bottom: 50%;">
                                        <a class="nav-link active" data-toggle="tab" href="#panel5" role="tab">
                                            <span class="hidden-sm-up">
                                                <i class="ti-home"></i>
                                            </span>
                                            <span class="hidden-xs-down">
                                                Informacion Personal
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item" style="margin-top: 50%; margin-bottom: 50%;">
                                        <a class="nav-link" data-toggle="tab" href="#panel6" role="tab">
                                            <span class="hidden-sm-up">
                                                <i class="ti-user"></i>
                                            </span>
                                            <span class="hidden-xs-down">
                                                Documentos Personales
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item" style="margin-top: 50%; margin-bottom: 50%;">
                                        <a class="nav-link" data-toggle="tab" href="#panel7" role="tab">
                                            <span class="hidden-sm-up">
                                                <i class="ti-email"></i>
                                            </span>
                                            <span class="hidden-xs-down">
                                                Informacion de Contacto
                                            </span>
                                        </a>
                                    </li>
                                    
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="panel5" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <h2>
                                                    Miembro de Familia
                                                </h2>
                                            </div>

                                            <div class="col-md-6 mt-4">
                                                <label for="primer_nombre">
                                                    Primer Nombre
                                                </label>
                                                <div class="input-group">
                                                    <input class="form-control mb-10" id="primer_nombre"
                                                        name="datos[primer_nombre]" placeholder="Primer Nombre"
                                                        type="text" />
                                                </div>

                                            </div>

                                            <div class="col-md-6 mt-4">
                                                <label for="segundo_nombre">
                                                    Segundo Nombre
                                                </label>
                                                <div class="input-group">
                                                    <input class="form-control mb-10" id="segundo_nombre"
                                                        name="datos[segundo_nombre]" placeholder="Segundo Nombre"
                                                        type="text" />
                                                </div>

                                            </div>

                                            <div class="col-md-6 mt-2">
                                                <label for="primer_apellido">
                                                    Primer Apellido
                                                </label>
                                                <div class="input-group">
                                                    <input class="form-control mb-10" id="primer_apellido"
                                                        name="datos[primer_apellido]" placeholder="Primer Apellido"
                                                        type="text" />
                                                </div>

                                            </div>

                                            <div class="col-md-6 mt-2">
                                                <label for="segundo_apellido">
                                                    Segundo Apellido
                                                </label>
                                                <div class="input-group">
                                                    <input class="form-control mb-10" id="segundo_apellido"
                                                        name="datos[segundo_apellido]" placeholder="Segundo Apellido"
                                                        type="text" />
                                                </div>

                                            </div>
                                            <div class="col-md-6 mt-2">
                                                <div class="form-group">
                                                    <label for="fecha_nacimiento">
                                                        Fecha De Nacimiento
                                                    </label>
                                                    <input class="form-control" id="fecha_nacimiento"
                                                        name="fecha_nacimiento" type="date">
                                                    </input>
                                                </div>

                                            </div>
                                            <div class="col-md-6 mt-2">
                                                <label for="genero">
                                                    Genero
                                                </label>
                                                <div class="input-group">
                                                    <select class="custom-select" id="genero" name="datos[genero]">
                                                        <option selected="" value="0">
                                                            ...
                                                        </option>
                                                        <option value="Masculino">
                                                            Masculino
                                                        </option>
                                                        <option value="Femenino">
                                                            Femenino
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-2">
                                                <label for="tipo_persona">
                                                    Tipo Persona
                                                </label>
                                                <div class="input-group">
                                                    <select class="custom-select" id="tipo_persona"
                                                        name="datos[tipo_persona]">
                                                        <option value="Padre">
                                                            Padre
                                                        </option>
                                                        <option value="Madre" selected="">
                                                            Madre
                                                        </option>
                                                        <option value="Hijo">
                                                            Hijo
                                                        </option>
                                                        <option value="Hija">
                                                            Hija
                                                        </option>
                                                        <option value="Hacinamiento">
                                                            Hacinamiento
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mt-2">
                                                <label for="genero">
                                                    Estado Civil
                                                </label>
                                                <div class="input-group">
                                                    <select class="custom-select" id="genero" name="datos[genero]">
                                                        <option selected="" value="0">
                                                            ...
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
                                                <div class="form-group">
                                                    <label for="fecha_nacimiento">
                                                        Fecha De Nacimiento
                                                    </label>
                                                    <input class="form-control" id="fecha_nacimiento"
                                                        name="fecha_nacimiento" type="date">
                                                    </input>
                                                </div>

                                            </div>
                                            <div class="col-md-6 mt-2">
                                                <label for="genero">
                                                    Genero
                                                </label>
                                                <div class="input-group">
                                                    <select class="custom-select" id="genero" name="datos[genero]">
                                                        <option selected="" value="0">
                                                            ...
                                                        </option>
                                                        <option value="Masculino">
                                                            Masculino
                                                        </option>
                                                        <option value="Femenino">
                                                            Femenino
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="panel6" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <h2>
                                                    Documentos
                                                </h2>
                                            </div>
                                            <div class="col-md-1 mt-2">
                                                <label for="tcedula">
                                                    Tipo
                                                </label>
                                                <div class="input-group">
                                                    <select class="custom-select" id="tcedula" name="datos[tcedula]">
                                                        <option selected="" value="V">
                                                            V
                                                        </option>
                                                        <option value="E">
                                                            E
                                                        </option>
                                                        <option value="R">
                                                            R
                                                        </option>
                                                        <option value="P">
                                                            P
                                                        </option>
                                                        <option value="J">
                                                            J
                                                        </option>
                                                        <option value="G">
                                                            G
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-11 mt-2">
                                                <label for="cedula">
                                                    Cedula
                                                </label>
                                                <div class="input-group">
                                                    <input class="form-control input-numero" id="cedula"
                                                        name="datos[cedula]" placeholder="Cedula de identidad"
                                                        type="text-center" />
                                                </div>
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
                                                <div class="input-group">
                                                    <input class="form-control mb-10" id="serial_patria"
                                                        name="datos[serial_patria]" placeholder="Serial" type="text" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 mt-2">
                                                <label for="serial_psuv">
                                                    Serial PSUV
                                                </label>
                                                <div class="input-group">
                                                    <input class="form-control mb-10" id="serial_psuv"
                                                        name="datos[serial_psuv]" placeholder="Serial" type="text" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 mt-2">
                                                <label for="codigo_patria">
                                                    Codigo Patria
                                                </label>
                                                <div class="input-group">
                                                    <input class="form-control mb-10" id="codigo_patria"
                                                        name="datos[codigo_patria]" placeholder="Codigo" type="text" />
                                                </div>

                                            </div>

                                            <div class="col-md-6 mt-2">
                                                <label for="codigo_psuv">
                                                    Codigo PSUV
                                                </label>
                                                <div class="input-group">
                                                    <input class="form-control mb-10" id="codigo_psuv"
                                                        name="datos[codigo_psuv]" placeholder="Codigo" type="text" />
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="panel7" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <h2>
                                                    Informacion de Contacto
                                                </h2>
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <div class="form-group">
                                                    <label for="correo">
                                                        Correo Electronico
                                                    </label>
                                                    <div class="input-group">
                                                        <input class="form-control" id="correo" name="datos[correo]"
                                                            placeholder="Correo" type="text">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">@</span>
                                                        </div>
                                                        <select class="custom-select" id="tcorreo"
                                                            name="datos[tcorreo]">
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

                                            <div class="col-md-10 mt-2">
                                                <label for="telefono_personal">
                                                    Telefono Personal
                                                </label>
                                                <div class="input-group">
                                                    <input class="form-control mb-10" id="telefono_personal"
                                                        name="datos[telefono_personal]" placeholder="0000-000-0000"
                                                        type="text" />
                                                </div>

                                            </div>
                                            <div class="col-md-2 mt-3">
                                                <label for="telefono_personal">
                                                    <i class="fa fa-whatsapp" style="font-size: 15px;"></i> WhatsApp
                                                </label>
                                                <div class="input-group">
                                                    <div class="form-check mr-2 mt-2">
                                                        <input class="form-check-input" type="radio"
                                                            name="data[wathsapp]" id="no">
                                                        <label class="form-check-label" for="no">No</label>
                                                    </div>
                                                    <div class="form-check mt-2">
                                                        <input class="form-check-input" type="radio"
                                                            name="data[wathsapp]" id="si" checked>
                                                        <label class="form-check-label" for="si">Si</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <label for="telefono_casa">
                                                    Telefono de Casa
                                                </label>
                                                <div class="input-group">
                                                    <input class="form-control mb-10" id="telefono_casa"
                                                        name="datos[telefono_casa]" placeholder="0000-000-0000"
                                                        type="text" />
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <input type="submit" class="btn  btn-success m-r-10" name="" id="" value="Guardar">
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog --> 
</div>
<!-- /.modal -->