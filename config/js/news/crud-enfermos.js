function eliminar(cedula) {
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
                    tabla: "personas_enfermedades",
                    id_tabla: "cedula_persona",
                    param: cedula,
                    estado: 0,
                    cedula : cedula
                };
                $.ajax({
                    type: "POST",
                    url: BASE_URL + "app/Direcciones.php",
                    data: {
                        direction: "Enfermos/Administrar",
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
                                }, 500);
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
            direction: "Enfermos/Administrar",
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
                var data = JSON.parse(datos);
                document.getElementById('enfermedades_previas').innerHTML = datos;
                var enfermedades = document.getElementById('enfermedades_agregadas');
                if (data.length == 0) {
                    enfermedades.innerHTML = "No aplica";
                } else {
                    enfermedades.innerHTML = "";
                    for (var i = 0; i < data.length; i++) {
                        var med = '';
                        data[i]['medicamentos'] != 'No posee' ? med = data[i]['medicamentos'] : med = '';
                        var tabl = enfermedades.innerHTML += " <div class='w-100'><hr><div style='width:90%' class='d-flex flex-row justify-content-between'><div>-" + data[i]["nombre_enfermedad"] + "</div><div>" + med + "</div><div><button type='button' onclick='borrar_enfermedad(" + data[i]['id_persona_enfermedad'] + "," + data[i]["cedula_persona"] + ")' class='btn btn-danger' title='Eliminar Enfermedad' style='font-size:22px'>X</button></div></div></div><hr>";
                    }
                }

            });
        },
        error: function () {
            alert('Error al codificar dirreccion');
        }
    });
}

function borrar_enfermedad(id, cedula_param) {
    swal({
        type: "warning",
        title: "¿Está seguro?",
        text: "Está por eliminar esta Enfermedad relacionado con la persona, ¿desea continuar?",
        showCancelButton: true,
        confirmButtonText: "Si, continuar",
        cancelButtonText: "No"
    }, function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                type: "POST",
                url: BASE_URL + "app/Direcciones.php",
                data: {
                    direction: "Enfermos/Administrar",
                    accion: "codificar"
                },
                success: function (direccion_segura) {
                    $.ajax({
                        type: "POST",
                        url: BASE_URL + direccion_segura,
                        type: "POST",
                        data: {
                            peticion: "Eliminar_Enfermedad",
                            "id_persona_enfermedad": id,
                            "cedula": cedula_param
                        },
                    }).done(function (result) {
                        $.ajax({
                            type: "POST",
                            url: BASE_URL + "app/Direcciones.php",
                            data: {
                                direction: "Enfermos/Administrar",
                                accion: "codificar"
                            },
                            success: function (direccion_segura) {
                                $.ajax({
                                    type: "POST",
                                    url: BASE_URL + direccion_segura,
                                    type: "POST",
                                    data: {
                                        peticion: "Datos",
                                        'cedula': $('#cedula').val()
                                    },
                                }).done(function (datos) {
                                    var data = JSON.parse(datos);
                                    document.getElementById('enfermedades_previas').innerHTML = datos;
                                    var enfermedades = document.getElementById('enfermedades_agregadas');
                                    if (data.length == 0) {
                                        enfermedades.innerHTML = "No aplica";
                                    } else {
                                        enfermedades.innerHTML = "";
                                        for (var i = 0; i < data.length; i++) {
                                            var med = '';
                                            data[i]['medicamentos'] != 'No posee' ? med = data[i]['medicamentos'] : med = '';
                                            var tabl = enfermedades.innerHTML += " <div class='w-100'><hr><div style='width:90%' class='d-flex flex-row justify-content-between'><div>-" + data[i]["nombre_enfermedad"] + "</div><div>" + med + "</div><div><button type='button' onclick='borrar_enfermedad(" + data[i]['id_persona_enfermedad'] + "," + data[i]["cedula_persona"] + ")' class='btn btn-danger' title='Eliminar Enfermedad' style='font-size:22px'>X</button></div></div></div><hr>";
                                         }
                                    }

                                });
                            },
                            error: function () {
                                alert('Error al codificar dirreccion');
                            }
                        });

                    })
                },
                error: function () {
                    alert('Error al codificar dirreccion');
                }
            });

        }
    });
}

function actualizar_enfermedad(result, cedula_param) {
    var enfermedades = document.getElementById('enfermedades_agregadas');
    if (result != 0) {
        enfermedades.innerHTML = "";
        for (var i = 0; i < result.length; i++) {
            enfermedades.innerHTML += " <table style='width:95%'><tr><td>- " + result[i]["nombre_enfermedad"] + "</td><td style='text-align:right'><span onclick='borrar_enfermedad(" + result[i]['id_persona_enfermedad'] + ",`" + cedula_param + "`)' class='iconDelete fa fa-times-circle' title='Eliminar bono' style='font-size:22px'></span></td></tr></table><br><hr>";
        }
    }
}

