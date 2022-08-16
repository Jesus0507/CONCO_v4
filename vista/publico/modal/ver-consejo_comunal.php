<div class="modal fade" id="ver">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ver Datos de Consejo Comunal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> 
            <div class="modal-body">
                <form action="" enctype="multipart/form-data" id="formulario" method="POST" name="formulario">
                    <div class="form-group row justify-content-center">

                        <div class="col-md-6 mt-2">
                            <label for="cedula_vocero">
                                Cedula Vocero
                            </label>
                            <div class="input-group">
                                <input disabled class="form-control mb-10" id="cedula_vocero" name="datos[cedula_vocero]"
                                    placeholder="" type="text" />
                            </div>
                        </div>

                        <div class="col-md-6 mt-2">
                            <label for="primer_nombre">
                                Nombre y Apellido
                            </label>
                            <div class="input-group">
                                <input disabled class="form-control mb-10" id="primer_nombre" name="datos[primer_nombre]"
                                    placeholder="" type="text" />
                            </div>
                        </div>


                        <div class="col-md-6 mt-2">
                            <label for="nombre_comite">
                                Comite
                            </label>
                            <div class="input-group">
                                <input disabled class="form-control mb-10" id="nombre_comite" name="datos[nombre_comite]"
                                    placeholder="" type="text" />
                            </div>
                        </div>

                        <div class="col-md-6 mt-2">
                                <label for="cargo_persona">
                                    Cargo de Vocero
                                </label>
                                <div class="input-group">
                                    <input disabled class="form-control mb-10" id="cargo_persona" name="datos[cargo_persona]"
                                    placeholder="" type="text" />
                                </div>
                            </div>

                            <div class="col-md-6 mt-2">
                    <label for="fecha_ingreso">
                        Fecha de Ingreso
                    </label>
                    <div class="input-group">
                        <input disabled class="form-control mb-10" id="fecha_ingreso" name="datos[fecha_ingreso]"
                            placeholder="letras" type="date" /> 
                    </div>
                </div>

                <div class="col-md-6 mt-2">
                    <label for="fecha_salida">
                        Fecha de Salida
                    </label>
                    <div class="input-group">
                        <input disabled class="form-control mb-10" id="fecha_salida" name="datos[fecha_salida]"
                            placeholder="letras" type="text" />
                    </div>
                </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->