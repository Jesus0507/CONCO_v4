function ver_familia(integrantes, nombre, tlf, direccion, numero_casa, ingreso) {
    var integrants = JSON.parse(integrantes);
    var texto_integrantes = "";
    for (var i = 0; i < integrants.length; i++) {
        texto_integrantes += "<table style='width:100%'><tr><td>" + integrants[i]['primer_nombre'] + " " + integrants[i]['primer_apellido'];
        texto_integrantes += "</td><td>" + integrants[i]['cedula_persona'] + "</td></tr></table><br><hr>";
    }
    var texto_swal = "<center><em class='fa fa-users' style='font-size:60px'></em></center><br>";
    texto_swal += "<table border='1' style='width:100%'><tr style='color:white;background:#7BACAA;font-weight:bold'><td>Teléfono</td><td>Dirección</td><td>Nro de Casa</td>";
    texto_swal += "<td>Ingreso mensual</td><td>Integrantes (" + integrants.length + ")</td></tr>";
    texto_swal += "<tr><td>" + tlf + "</td><td>" + direccion + "</td><td>" + numero_casa + "</td><td>" + ingreso + "</td>";
    texto_swal += "<td><div style='overflow-y:scroll; width:100%;height:120px;background:#D0E8E7'>";
    texto_swal += "<center><div style='width:90%'>" + texto_integrantes + "</div></center></div></td></tr></table>";
    swal({
        title: "Familia " + nombre,
        text: texto_swal,
        html: true,
        customClass: "bigSwalV2"
    });
}

function eliminar(id) {
    var estado = {
        tabla: "familia",
        id_tabla: "id_familia",
        param: id,
        estado: 0
    };
    fila = $(this).closest("tr");
    swal({
        type: "warning",
        title: "Atención",
        text: "Estás por eliminar esta familia, ¿deseas continuar?",
        showCancelButton: true,
        cancelButtonText: "No",
        confirmButtonText: "Si"
    }, function(isConfirm) {
        if (isConfirm) {
            $.ajax({
                type: "POST",
                url: BASE_URL + "app/Direcciones.php",
                data: {
                    direction: "Familias/Administrar",
                    accion: "codificar"
                },
                success: function(direccion_segura) {
                    $.ajax({
                        type: "POST",
                        url: BASE_URL + direccion_segura,
                        data: {
                            peticion: "Eliminar",
                            estado: estado,
                            sql: "ACT_DES",
                            accion: "Se ha la familia: " + fila.find("td:eq(0)").text(),
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
                },
                error: function() {
                    alert('Error al codificar dirreccion');
                }
            });
        }
    })
}

function editar(id_familia, id_familia_persona) {
    document.getElementById("id_familia").value = id_familia;
    $.ajax({
        type: "POST",
        url: BASE_URL + "app/Direcciones.php",
        data: {
            direction: "Familias/Administrar",
            accion: "codificar"
        },
        success: function(direccion_segura) {
            $.ajax({
                type: "POST",
                url: BASE_URL + direccion_segura,
                data: {
                    peticion: "Datos",
                    'id_familia': id_familia
                }
            }).done(function(datos) {
                var data = JSON.parse(datos);
                var familia = document.getElementById('integrantes_agregados');
                if (data.length == 0) {
                    familia.innerHTML = "No aplica";
                } else {
                    familia.innerHTML = "";
                    for (var i = 0; i < data.length; i++) {
                        document.getElementById("vivienda_familia").value = data[i]['id_vivienda'];
                        document.getElementById("select-cond-ocupacion").value = data[i]['condicion_ocupacion'];
                        document.getElementById("nombre_familia").value = data[i]['familia'];
                        document.getElementById("telefono_familia").value = data[i]['telefono'];
                        document.getElementById("observaciones_familia").value = data[i]['observacion'];
                        document.getElementById("ingreso_aprox").value = data[i]['ingreso_mensual'];
                        var inte = JSON.parse(data[i]['integrantes']);
                        for (var j = 0; j < inte.length; j++) {
                            var tabl = familia.innerHTML += " <table style='width:95%'><tr><hr><td>-" + inte[j]["primer_nombre"] + " " + inte[j]["primer_nombre"] + "</td><td style='text-align:right'><span onclick='borrar_familia(" + data[i]['id_familia'] + "," + inte[j]['cedula_persona'] + ")' class='iconDelete fa fa-times-circle' title='Eliminar Familia' style='font-size:22px'></span></td></tr></table><br><hr>";
                        }
                    }
                }
            });
        },
        error: function() {
            alert('Error al codificar dirreccion');
        }
    });
}

function borrar_familia(id, cedula_param) {
    swal({
        type: "warning",
        title: "¿Está seguro?",
        text: "Está por eliminar este integrantes , ¿desea continuar?",
        showCancelButton: true,
        confirmButtonText: "Si, continuar",
        cancelButtonText: "No"
    }, function(isConfirm) {
        if (isConfirm) {
            $.ajax({
                type: "POST",
                url: BASE_URL + "app/Direcciones.php",
                data: {
                    direction: "Familias/Administrar",
                    accion: "codificar"
                },
                success: function(direccion_segura) {
                    $.ajax({
                        type: "POST",
                        url: BASE_URL + direccion_segura,
                        data: {
                            peticion: "Eliminar_Integrantes",
                            "cedula_persona": cedula_param
                        }
                    }).done(function(result) {
                        revisar(result);
                        result = JSON.parse(result);
                        actualizar_integrantes(result, cedula_param);
                        editar(id);
                    })
                },
                error: function() {
                    alert('Error al codificar dirreccion');
                }
            });
        }
    });
}

function actualizar_integrantes(result, cedula_param) {
    var enfermedades = document.getElementById('integrantes_agregados');

    if (result != 0) {
        enfermedades.innerHTML = "";
        for (var i = 0; i < result.length; i++) {
            enfermedades.innerHTML += " <table style='width:95%'><tr><td>- " + result[i]["cedula_persona"] + "</td><td style='text-align:right'><span onclick='borrar_familia(" + result[i]['id_familia_persona'] + "," + result[i]['cedula_persona'] + ")' class='iconDelete fa fa-times-circle' title='Eliminar' style='font-size:22px'></span></td></tr></table><br><hr>";
        }
    }
}
var integrantes_input = document.getElementById("integrante_input");
var integrantes = [];
var valid_integrantes = document.getElementById("valid_5");
var div_integrantes = document.getElementById("integrantes_agregados");

function valid_integrantes_agregados() {
    var validar = true;
    for (var i = 0; i < integrantes.length; i++) {
        if (integrantes[i] == integrantes_input.value) {
            validar = false;
        }
    }
    if (!validar) {
        valid_integrantes.innerHTML = 'Ya esta persona fue agregada';
    }
    return validar;
}

function ver_familia(integrantes, nombre, tlf, direccion, numero_casa, ingreso) {
    var integrants = JSON.parse(integrantes);
    var texto_integrantes = "";
    for (var i = 0; i < integrants.length; i++) {
        texto_integrantes += "<table style='width:100%'><tr><td>" + integrants[i]['primer_nombre'] + " " + integrants[i]['primer_apellido'];
        texto_integrantes += "</td><td>" + integrants[i]['cedula_persona'] + "</td></tr></table><br><hr>";
    }
    var texto_swal = "<center><em class='fa fa-users' style='font-size:60px'></em></center><br>";
    texto_swal += "<table border='1' style='width:100%'><tr style='color:white;background:#7BACAA;font-weight:bold'><td>Teléfono</td><td>Dirección</td><td>Nro de Casa</td>";
    texto_swal += "<td>Ingreso mensual</td><td>Integrantes (" + integrants.length + ")</td></tr>";
    texto_swal += "<tr><td>" + tlf + "</td><td>" + direccion + "</td><td>" + numero_casa + "</td><td>" + ingreso + "</td>";
    texto_swal += "<td><div style='overflow-y:scroll; width:100%;height:120px;background:#D0E8E7'>";
    texto_swal += "<center><div style='width:90%'>" + texto_integrantes + "</div></center></div></td></tr></table>";
    swal({
        title: "Familia " + nombre,
        text: texto_swal,
        html: true,
        customClass: "bigSwalV2"
    });
}

function Nuevo_Integrante() {
    if (integrantes_input.value == "") {
        integrantes_input.focus();
        valid_integrantes.innerHTML = 'Debe ingresar la cédula o el nombre de una persona';
    } else {
        valid_integrantes.innerHTML = "";
        if (valid_integrantes_agregados()) {
            valid_integrantes.innerHTML = "";
            $.ajax({
                type: "POST",
                url: BASE_URL + "app/Direcciones.php",
                data: {
                    direction: 'Familias/Administrar',
                    accion: "codificar"
                },
                success: function(direccion_segura) {
                    $.ajax({
                        type: 'POST',
                        url: BASE_URL + direccion_segura,
                        data: {
                            peticion: "Existente",
                            'cedula': integrantes_input.value
                        }
                    }).done(function(datos) {
                        if (datos != 0) {
                            var result = JSON.parse(datos);
                            integrantes.push(result[0]['cedula_persona']);
                            integrantes_input.value = '';
                            var div = document.createElement("div");
                            div.style.width = '100%';
                            var tabla = document.createElement("table");
                            tabla.style.width = '100%';
                            var tr = document.createElement("tr");
                            var td1 = document.createElement("td");
                            var td2 = document.createElement("td");
                            td1.innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-" + result[0]['primer_nombre'] + " " + result[0]['primer_apellido'];
                            var btn = document.createElement("input");
                            btn.type = "button";
                            btn.className = "btn btn-danger";
                            btn.value = "X";
                            td2.style.textAlign = "right";
                            td2.appendChild(btn);
                            tr.appendChild(td1);
                            tr.appendChild(td2);
                            tabla.appendChild(tr);
                            div.appendChild(tabla);
                            var hr = document.createElement("hr");
                            div.appendChild(tabla);
                            div.appendChild(hr);
                            div_integrantes.appendChild(div);
                            btn.onclick = function() {
                                div_integrantes.removeChild(div);
                                integrantes.splice(integrantes.indexOf(result[0]['cedula_persona']), 1);
                            }
                        } else {
                            valid_integrantes.innerHTML = "Esta persona no está registrada";
                        }
                    });
                },
                error: function() {
                    alert('Error al codificar dirreccion');
                }
            });
        }
    }
}

function Actualizar_Familia() {
    var vivienda = document.getElementById("vivienda_familia");
    var nombre_familia = document.getElementById("nombre_familia");
    var telefono_familia = document.getElementById('telefono_familia');
    var ingreso_aprox = document.getElementById("ingreso_aprox");
    var observaciones = document.getElementById("observaciones_familia");
    var condicion_ocupacion_select = document.getElementById("select-cond-ocupacion");
    var condicion_ocupacion_input = document.getElementById("input_condicion_ocupacion");
    var datos_familia = new Object();
    datos_familia['id_familia'] = document.getElementById("id_familia").value;
    datos_familia['id_vivienda'] = parseInt(vivienda.value);
    condicion_ocupacion_select.style.display != 'none' ? datos_familia['condicion_ocupacion'] = condicion_ocupacion_select.value : datos_familia['condicion_ocupacion'] = condicion_ocupacion_input.value
    datos_familia['nombre_familia'] = nombre_familia.value;
    observaciones.value == '' ? datos_familia['observacion'] = "Sin observaciones" : datos_familia['observacion'] = observaciones.value;
    datos_familia['telefono_familia'] = telefono_familia.value;
    datos_familia['ingreso_mensual_aprox'] = ingreso_aprox.value;
    datos_familia['estado'] = 1;
    $.ajax({
        type: "POST",
        url: BASE_URL + "app/Direcciones.php",
        data: {
            direction: "Familias/Administrar",
            accion: "codificar"
        },
        success: function(direccion_segura) {
            $.ajax({
                type: "POST",
                url: BASE_URL + direccion_segura,
                data: {
                    datos: datos_familia,
                    integrantes: integrantes,
                    id_familia: document.getElementById("id_familia").value,
                    peticion: "Editar",
                    sql: "SQL_04",
                    accion: "Se ha Actualizado la  Familia: " + nombre_familia,
                }
            }).done(function(result) {
                if (result == 1) {
                    swal({
                        title: "Actualizado!",
                        text: "El elemento fue Actualizado con exito.",
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
        },
        error: function() {
            alert('Error al codificar dirreccion');
        }
    });
}