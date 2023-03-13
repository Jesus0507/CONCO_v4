function eliminar(id) {
    swal({
        type: "warning",
        title: "Atención",
        text: "Estás por eliminar esta información, ¿deseas continuar?",
        showCancelButton: true,
        cancelButtonText: "No",
        confirmButtonText: "Si"
    }, function (isConfirm) {
        if (isConfirm) {
            var estado = {
                tabla: "discapacidad_persona",
                id_tabla: "cedula_persona",
                param: id,
                estado: 0
            };
            $.ajax({
                type: "POST",
                url: BASE_URL + "app/Direcciones.php",
                data: {
                    direction: "Discapacitados/Administrar",
                    accion: "codificar"
                },
                success: function (direccion_segura) {
                    $.ajax({
                        type: "POST",
                        url: BASE_URL + direccion_segura,
                        type: "POST",
                        data: {
                            peticion: "Eliminar",
                            estado: estado,
                            sql: "_07_",
                            accion: "Se ha Eliminado el  Discapacitado ",
                        },
                    }).done(function (result) {
                        console.log(result);
                        if (result == 1) {
                            setTimeout(function () {
                                swal({
                                    title: "Eliminado!",
                                    text: "El elemento fue eliminado con exito.",
                                    type: "success",
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                                setTimeout(function () {
                                    location.reload();
                                }, 2000);
                            }, 100);
                        } else {
                            swal({
                                title: "ERROR!",
                                text: "Ha ocurrido un Error.</br>" + result,
                                type: "error",
                                html: true,
                                showConfirmButton: true,
                                customClass: "bigSwalV2",
                            });
                        }
                    });
                },
                error: function () {
                    alert('Error al codificar dirreccion');
                }
            });
        }
    })
}

function editar(cedula) {
    $.ajax({
        type: "POST",
        url: BASE_URL + "app/Direcciones.php",
        data: {
            direction: "Discapacitados/Administrar",
            accion: "codificar"
        },
        success: function (direccion_segura) {
            $.ajax({
                type: "POST",
                url: BASE_URL + direccion_segura,
                type: "POST",
                data: {
                    peticion: "Datos",
                    'cedula': cedula
                },
            }).done(function (datos) {
                // revisar(datos)
                var data = JSON.parse(datos);
                document.getElementById('discapacidades_previas').innerHTML = datos;
                var discapacidades = document.getElementById('discapacidades_agregadas');
                if (data.length === 0) {
                    discapacidades.innerHTML = "No aplica";
                } else {
                    discapacidades.innerHTML = "";
                    for (var i = 0; i < data.length; i++) {
                        var tabl = discapacidades.innerHTML += " <div style='width:100%'><hr><div style='width:90%' class='mx-auto d-flex flex-row justify-content-between'><div class='text-center' style='width='40%'>-" + data[i]["nombre_discapacidad"] + "</div><div class='text-center' style='width='40%'>-" + data[i]["observacion_discapacidad"] + "</div><div style='text-align:center;width:20%'><button type='button' onclick='borrar_discapacidad(" + data[i]['id_discapacidad_persona'] + "," + data[i]["cedula_persona"] + ")' class='btn btn-danger' title='Eliminar Enfermedad'>X</button></div></div><hr></div>";
                    }
                }
            });
        },
        error: function () {
            alert('Error al codificar dirreccion');
        }
    });
}

function borrar_discapacidad(id, cedula_param) {
    swal({
        type: "warning",
        title: "¿Está seguro?",
        text: "Está por eliminar esta Discapacidad relacionado con la persona, ¿desea continuar?",
        showCancelButton: true,
        confirmButtonText: "Si, continuar",
        cancelButtonText: "No"
    }, function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                type: "POST",
                url: BASE_URL + "app/Direcciones.php",
                data: {
                    direction: "Discapacitados/Administrar",
                    accion: "codificar"
                },
                success: function (direccion_segura) {
                    $.ajax({
                        type: "POST",
                        url: BASE_URL + direccion_segura,
                        type: "POST",
                        data: {
                            peticion: "Eliminar_Discapacidad",
                            id_discapacidad_persona: id,
                            cedula: cedula_param
                        },
                    }).done(function (result) {
                        result = JSON.parse(result);
                        editar($('#cedula').val());
                    })
                },
                error: function () {
                    alert('Error al codificar dirreccion');
                }
            });
        }
    });
}

function actualizar_discapacidad(result, cedula_param) {
    var discapacidades = document.getElementById('discapacidades_agregadas');
    if (result != 0) {
        discapacidades.innerHTML = "";
        for (var i = 0; i < result.length; i++) {
            discapacidades.innerHTML += " <table style='width:95%'><tr><td>- " + result[i]["nombre_discapacidad"] + "</td><td style='text-align:right'><span onclick='borrar_discapacidad(" + result[i]['id_discapacidad_persona'] + ",`" + cedula_param + "`)' class='iconDelete fa fa-times-circle' title='Eliminar' style='font-size:22px'></span></td></tr></table><br><hr>";
        }
    }
}