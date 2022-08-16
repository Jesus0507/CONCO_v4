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
                    tabla: "personas_enfermedades",
                    id_tabla: "id_persona_enfermedad",
                    param: ids[i],
                    estado: 0
                };
                $.ajax({
                    type: "POST",
                    url: BASE_URL + "Enfermos/Administrar",
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
        }
    })
}

function editar(cedula) {
    $.ajax({
        type: "POST",
        url: BASE_URL + "Enfermos/Administrar",
        type: "POST",
        data: {
            peticion: "Datos",
            'cedula': cedula
        },
    }).done(function(datos) {
        var data = JSON.parse(datos);
        var enfermedades = document.getElementById('enfermedades_agregadas');
        if (data.length == 0) {
            enfermedades.innerHTML = "No aplica";
        } else {
            enfermedades.innerHTML = "";
            for (var i = 0; i < data.length; i++) {
                var tabl = enfermedades.innerHTML += " <table style='width:95%'><tr><hr><td>-" + data[i]["nombre_enfermedad"] + "</td><td style='text-align:right'><span onclick='borrar_enfermedad(" + data[i]['id_persona_enfermedad'] + "," + data[i]["cedula_persona"] + ")' class='iconDelete fa fa-times-circle' title='Eliminar Enfermedad' style='font-size:22px'></span></td></tr></table><br><hr>";
            }
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
    }, function(isConfirm) {
        if (isConfirm) {
            $.ajax({
                type: "POST",
                url: BASE_URL + "Enfermos/Administrar",
                type: "POST",
                data: {
                    peticion: "Eliminar_Enfermedad",
                    "id_persona_enfermedad": id,
                    "cedula_persona": cedula_param
                },
            }).done(function(result) {
                result = JSON.parse(result);
                actualizar_enfermedad(result, cedula_param);
                editar(cedula_param);
                console.log(result);
            })
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