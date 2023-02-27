function editar(tag) {
    var tr = tag.closest("tr");
    tr = tr.querySelectorAll("td");  
    var cedula_persona = tr[0].innerHTML;
    document.getElementById("cedula_persona_editar").value = cedula_persona;
    document.getElementById("cedula_persona_editar").readOnly = "readOnly";
    cargar_info_vacunas(cedula_persona, 1);
}
function ver(tag) {
    var tr = tag.closest("tr");
    tr = tr.querySelectorAll("td");  
    var cedula_persona = tr[0].innerHTML;
    document.getElementById("cedula_persona_ver").value = cedula_persona;
    document.getElementById("cedula_persona_ver").readOnly = "readOnly";
    document.getElementById("vacunas_ver").innerHTML = "";
    $.ajax({
        type: "POST",
        url: BASE_URL + "app/Direcciones.php",
        data: {
            direction: "Vacunados/Administrar",
            accion: "codificar"
        },
        success: function(direccion_segura) {
            $.ajax({
                type: "POST",
                url: BASE_URL + direccion_segura,
                data: {
                    peticion: "Vacunas_Ver",
                    "cedula": cedula_persona
                }
            }).done(function(result) {
                document.getElementById("vacunas_ver").innerHTML = result;
            })
        },
        error: function() {
            alert('Error al codificar dirreccion');
        }
    });
}
function cargar_info_vacunas(cedula_persona, show) {
    document.getElementById("vacunas_info").innerHTML = "";
    $.ajax({
        type: "POST",
        url: BASE_URL + "app/Direcciones.php",
        data: {
            direction: "Vacunados/Administrar",
            accion: "codificar"
        },
        success: function(direccion_segura) {
            $.ajax({
                type: "POST",
                url: BASE_URL + direccion_segura,
                data: {
                    peticion: "Vacunas",
                    "cedula": cedula_persona
                }
            }).done(function(result) {
                document.getElementById("vacunas_info").innerHTML = result;
                if (show == 1) {
                    $("#actualizar").modal("show");
                    restricciones();
                }
            })
        },
        error: function() {
            alert('Error al codificar dirreccion');
        }
    });
}

function eliminar_dosis(id, cedula) {
    swal({
        type: "warning",
        title: "¿Estás seguro?",
        text: "Está por eliminar la dosis de vacuna asociada con esta persona, ¿desea continuar?",
        showCancelButton: true,
        confirmButtonText: "Si",
        CancelButtonText: "No"
    }, function(isConfirm) {
        if (isConfirm) {
            $.ajax({
                type: "POST",
                url: BASE_URL + "app/Direcciones.php",
                data: {
                    direction: "Personas/borrar_dosis",
                    accion: "codificar"
                },
                success: function(direccion_segura) {
                    $.ajax({
                        type: "POST",
                        url: BASE_URL + direccion_segura,
                        data: {
                            "id": id
                        }
                    }).done(function(result) {
                        if (result == 1) {
                            cargar_info_vacunas(cedula, 0);
                        }
                    })
                },
                error: function() {
                    alert('Error al codificar dirreccion');
                }
            });
        }
    })
}
document.getElementById("agregar_dosis").onclick = function() {
    if (document.getElementById("fecha_dosis").value == "" || document.getElementById("fecha_dosis").value == null) {
        swal({
            type: "error",
            title: "Error",
            text: "Debe seleccionar una fecha",
            showConfirmButton: false,
            timer: 2000
        });
        setTimeout(function() {
            document.getElementById("fecha_dosis").style.borderColor = "red";
        }, 2000);
    } else {
        document.getElementById("fecha_dosis").style.borderColor = "";
        var fecha_vacuna = new Date(document.getElementById("fecha_dosis").value);
        if (fecha_vacuna > new Date()) {
            swal({
                type: "error",
                title: "Error",
                text: "Debe ingresar una fecha válida",
                showConfirmButton: false,
                timer: 2000
            });
            setTimeout(function() {
                document.getElementById("fecha_dosis").style.borderColor = "red";
            }, 2000);
        } else {
            document.getElementById("fecha_dosis").style.borderColor = "";
            $.ajax({
                type: "POST",
                url: BASE_URL + "app/Direcciones.php",
                data: {
                    direction: "Personas/add_vacuna",
                    accion: "codificar"
                },
                success: function(direccion_segura) {
                    $.ajax({
                        type: "POST",
                        url: BASE_URL + direccion_segura,
                        data: {
                            "fecha": document.getElementById("fecha_dosis").value,
                            "persona": document.getElementById("cedula_persona_editar").value,
                            "vacuna": document.getElementById("dosis_vacuna").value
                        }
                    }).done(function(result) {
                        if (result == 1) {
                            cargar_info_vacunas(document.getElementById("cedula_persona_editar").value, 0);
                        } else {
                            swal({
                                type: "error",
                                title: "Error",
                                text: "Algo ha ido mal, asegúrese de que esta dosis no haya sido registrada o que el numero de dosis aplicadas no sea mayor que tres",
                                showConfirmButton: false,
                                timer: 3000
                            });
                        }
                        document.getElementById("fecha_dosis").value = "";
                        document.getElementById("dosis_vacuna").value = "Primera Dosis";
                    })
                },
                error: function() {
                    alert('Error al codificar dirreccion');
                }
            });
        }
    }
}
document.getElementById("fecha_dosis").onchange = function() {
    if (document.getElementById("fecha_dosis").value != "" || document.getElementById("fecha_dosis").value != null) {
        document.getElementById("fecha_dosis").style.borderColor = "";
    }
}

function restricciones() {
    var tabla = document.getElementById('vacunas_info').querySelector('table');
    var filas = tabla.querySelectorAll('tr');
    var select = document.getElementById('dosis_vacuna');
    for (opt of select.options) {
        for(fil of filas) {
            if (opt.value == fil.children[0].innerHTML) {
                opt.disabled = 'disabled';
            }
        } 
    }
}