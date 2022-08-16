<form action="<?php echo constant('URL'); ?>Calle/Nueva_Calle" enctype="multipart/form-data" id="formulario"
    method="POST" name="formulario">
    <!-- card-body -->
    <div class="card-body">
        <div class="card-block">
            <div class="form-group row justify-content-center">
                <div class="col-md-12 mt-2">
                    <label for="x">
                        Select
                    </label>
                    <div class="input-group">
                        <select class="custom-select" id="x" name="datos[x]">
                            <option selected="" value="0">
                                Select 1
                            </option>
                            <option value="1">
                                Select 2
                            </option>
                        </select>
                    </div>
                </div>

                
                <div class="col-md-12 mt-2">
                    <label for="numero">
                        Numero
                    </label>
                    <div class="input-group">
                        <input class="form-control mb-10" id="numero" name="datos[numero]" placeholder="Numero"
                            type="number" />
                    </div>
                </div>

                <div class="col-md-12 mt-2">
                    <label for="telefono">
                        telefono
                    </label>
                    <div class="input-group">
                        <input class="form-control mb-10" id="telefono" name="datos[telefono]" placeholder="telefono"
                            type="tel" />
                    </div>
                </div>

                <div class="col-md-12 mt-2">
                    <label for="correo">
                        correo
                    </label>
                    <div class="input-group">
                        <input class="form-control mb-10" id="correo" name="datos[correo]" placeholder="correo"
                            type="email" />
                    </div>
                </div>

                <div class="col-md-12 mt-2">
                    <label for="x">
                        letras
                    </label>
                    <div class="input-group">
                        <input class="form-control mb-10" id="x" name="datos[x]"
                            placeholder="letras" type="text" />
                    </div>
                </div>

                <div class="col-md-12 mt-2">
                    <label for="observacion">
                        textarea
                    </label>
                    <textarea class="form-control" cols="5" id="x" name="x" rows="5"
                        placeholder="x"></textarea>
                </div>

            </div>

        </div>

    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <div class="text-center m-t-20">
            <div class="col-xs-12">
                <input type="submit" class="btn  btn-success m-r-10" name="" id="" value="Guardar">
                <input type="button" class="btn btn-danger" id="" name="" value="Limpiar">
            </div>
        </div>
    </div>
</form>