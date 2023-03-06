var fechas_dosis_seleccionadas = [];
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
        success: function (direccion_segura) {
            $.ajax({
                type: "POST",
                url: BASE_URL + direccion_segura,
                data: {
                    peticion: "Vacunas_Ver",
                    "cedula": cedula_persona
                }
            }).done(function (result) {
                document.getElementById("vacunas_ver").innerHTML = result;
            })
        },
        error: function () {
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
        success: function (direccion_segura) {
            $.ajax({
                type: "POST",
                url: BASE_URL + direccion_segura,
                data: {
                    peticion: "Vacunas",
                    "cedula": cedula_persona
                }
            }).done(function (result) {
                document.getElementById("vacunas_info").innerHTML = result;
                if (show == 1) {
                    $("#actualizar").modal("show");
                }
                else{
                    $('#example1').DataTable().clear().destroy();
                    cargar_tabla();
                }
                restricciones();
            })
        },
        error: function () {
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
    }, function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                type: "POST",
                url: BASE_URL + "app/Direcciones.php",
                data: {
                    direction: "Personas/borrar_dosis",
                    accion: "codificar"
                },
                success: function (direccion_segura) {
                    $.ajax({
                        type: "POST",
                        url: BASE_URL + direccion_segura,
                        data: {
                            "id": id
                        }
                    }).done(function (result) {
                        if (result == 1) {
                            cargar_info_vacunas(cedula, 0);
                        }
                    })
                },
                error: function () {
                    alert('Error al codificar dirreccion');
                }
            });
        }
    })
}
document.getElementById("agregar_dosis").onclick = function () {
    if (document.getElementById("dosis_vacuna").value == 0) {
        swal({
            type: "error",
            title: "Error",
            text: "Debe seleccionar una dosis",
            showConfirmButton: false,
            timer: 2000
        });
        setTimeout(function () {
            document.getElementById("dosis_vacuna").style.borderColor = "red";
        }, 2000);
    } else {
        document.getElementById("dosis_vacuna").style.borderColor = "";
        if (document.getElementById("fecha_dosis").value == "" || document.getElementById("fecha_dosis").value == null) {
            swal({
                type: "error",
                title: "Error",
                text: "Debe seleccionar una fecha",
                showConfirmButton: false,
                timer: 2000
            });
            setTimeout(function () {
                document.getElementById("fecha_dosis").style.borderColor = "red";
            }, 2000);
        }
        else {
            document.getElementById("fecha_dosis").style.borderColor = "";
            var text_alert = '';
            var valid = true;
            var fecha_vacuna = new Date(document.getElementById("fecha_dosis").value);
            for(const fechas_vacunas of fechas_dosis_seleccionadas) {
                var fecha_seleccionada = new Date(fechas_vacunas);
                if(fecha_seleccionada > fecha_vacuna){
                    valid = false;
                    text_alert = 'La fecha de la dosis a ingresar no puede ser menor a la de las dosis ya agregadas';
                }
            }  
            
            if (fecha_vacuna > new Date()) {
               valid = false;
               text_alert = 'La fecha de la dosis a ingresar no puede ser mayor a la fecha actual';
            }
        
            if (!valid) {
                swal({
                    type: "error",
                    title: "Error",
                    text: text_alert,
                    showConfirmButton: false,
                    timer: 2000
                });
                setTimeout(function () {
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
                    success: function (direccion_segura) {
                        $.ajax({
                            type: "POST",
                            url: BASE_URL + direccion_segura,
                            data: {
                                "fecha": document.getElementById("fecha_dosis").value,
                                "persona": document.getElementById("cedula_persona_editar").value,
                                "vacuna": document.getElementById("dosis_vacuna").value
                            }
                        }).done(function (result) {
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
                            document.getElementById("dosis_vacuna").value = "0";
                        })
                    },
                    error: function () {
                        alert('Error al codificar dirreccion');
                    }
                });
            }
        }
    }
}
document.getElementById("fecha_dosis").onchange = function () {
    if (document.getElementById("fecha_dosis").value != "" || document.getElementById("fecha_dosis").value != null) {
        document.getElementById("fecha_dosis").style.borderColor = "";
    }
}

function restricciones() {
    var tabla = document.getElementById('vacunas_info').querySelector('table');
    var filas = tabla.querySelectorAll('tr');
    var select = document.getElementById('dosis_vacuna');
    fechas_dosis_seleccionadas = [];
    for (fil of filas) {
        fechas_dosis_seleccionadas.push();
        var text = fil.children[1].innerHTML;
        var replaceString = text.split('');
        text = '';
        for (const chars of replaceString) {
            if (chars != '(' && chars != ')') {
                text += chars;
            }
        }
        fechas_dosis_seleccionadas.push(text);
    }
    for(const opt of select.options) {
        opt.style.background = '';
        opt.disabled = '';
    }

    switch (filas.length) {
        case 1:
            select.options[1].disabled = select.options[3].disabled = 'disabled';
            select.options[1].style.background = select.options[3].style.background = '#C3DAE5';
            break;
        case 2:
            select.options[1].disabled = select.options[2].disabled = 'disabled';
            select.options[1].style.background = select.options[2].style.background = '#C3DAE5';
            break;
        default: 
            select.options[1].disabled = select.options[2].disabled = select.options[3].disabled = 'disabled';
            select.options[1].style.background = select.options[2].style.background = select.options[3].style.background = '#C3DAE5';
        break;
    }
}