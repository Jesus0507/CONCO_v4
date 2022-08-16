function eliminar(id) {
    swal({
        type: "warning",
        title: "Atención",
        text: "Estás por eliminar esta información, ¿deseas continuar?",
        showCancelButton: true,
        cancelButtonText: "No",
        confirmButtonText: "Si"
    }, function(isConfirm) {
        if (isConfirm) {
            var ids = JSON.parse(id);
            for (var i = 0; i < ids.length; i++) {
                var estado = {
                    tabla: "discapacidad_persona",
                    id_tabla: "id_discapacidad_persona",
                    param: ids[i],
                    estado: 0
                };
                $.ajax({
                    type: "POST",
                    url: BASE_URL + "Discapacitados/Administrar",
                    type: "POST",
                    data: {
                        peticion: "Eliminar",
                        estado: estado,
                        sql: "_07_",
                        accion: "Se ha Eliminado el  Discapacitado ",
                    },
                }).done(function(result) {
                    if (result == 1) {
                        swal({
                            title: "Eliminado!",
                            text: "El elemento fue eliminado con exito.",
                            type: "success",
                            showConfirmButton: false,
                        });
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
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
            }
            setTimeout(function() {
                swal({
                    type: "success",
                    title: "Éxito",
                    text: "Se ha eliminado exitosamente esta información",
                    timer: 2000,
                    showConfirmButton: false
                });
                setTimeout(function() {
                    location.reload();
                }, 1000);
            }, 500);
        }
    })
}

function editar(cedula) {
    $.ajax({
        type: "POST",
        url: BASE_URL + "Discapacitados/Administrar",
        type: "POST",
        data: {
            peticion: "Datos",
            'cedula': cedula
        },
    }).done(function(datos) {
        var data = JSON.parse(datos);
        var discapacidades = document.getElementById('discapacidades_agregadas');
        if (data.length === 0) {
            discapacidades.innerHTML = "No aplica";
        } else {
            discapacidades.innerHTML = "";
            for (var i = 0; i < data.length; i++) {
                var tabl = discapacidades.innerHTML += " <table style='width:95%'><tr><hr><td>-" + data[i]["nombre_discapacidad"] + "</td><td>-" + data[i]["observacion_discapacidad"] + "</td><td style='text-align:right'><span onclick='borrar_discapacidad(" + data[i]['id_discapacidad_persona'] + "," + data[i]["cedula_persona"] + ")' class='iconDelete fa fa-times-circle' title='Eliminar Enfermedad' style='font-size:22px'></span></td></tr></table><br><hr>";
            }
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
    }, function(isConfirm) {
        if (isConfirm) {
            $.ajax({
               
                type: "POST",
                url: BASE_URL + "Discapacitados/Administrar",
                type: "POST",
                data: {
                    peticion: "Eliminar_Discapacidad",
                    id_discapacidad_persona: id,
                    cedula_persona: cedula_param
                },
            }).done(function(result) {
                result = JSON.parse(result);
                actualizar_discapacidad(result, cedula_param);
                editar(cedula_param);
            })
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