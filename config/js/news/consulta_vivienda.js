$(function() {
    $.ajax({
        type: "POST",
        url: BASE_URL + "Viviendas/Administrar",
        data: {
            peticion: "Consulta_Ajax",
        },
    }).done(function(datos) {
        var data = JSON.parse(datos);
        $("#example1").DataTable({
            "data": data,
            "columns": [{
                "data": "numero_casa"
            }, {
                "data": "nombre_calle"
            }, {
                "data": "direccion_vivienda"
            }, {
                "data": "nombre_tipo_vivienda"
            }, {
                "data": "ver"
            }, {
                "data": "editar"
            }, {
                "data": "eliminar"
            }, ],
            "responsive": true,
            "autoWidth": false,
            "ordering": true,
            "info": true,
            "processing": true,
            "pageLength": 10,
            "lengthMenu": [5, 10, 20, 30, 40, 50, 100]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    }).fail(function() {
        alert("error")
    })
});

function Eliminar(id, id_servicio) {
    var estado = {
        tabla: "vivienda",
        id_tabla: "id_vivienda",
        param: id,
        estado: 0
    };
    swal({
        type: "warning",
        title: "Atención",
        text: "Estás por eliminar esta vivienda, ¿Deseas continuar?",
        showCancelButton: true,
        cancelButtonText: "No",
        confirmButtonText: "Si",
    }, function(isConfirm) {
        if (isConfirm) {
            $.ajax({
                url: BASE_URL + "Viviendas/Administrar",
                type: "POST",
                data: {
                    peticion: "Eliminar_Vivienda",
                    estado: estado,
                    sql: "ACT_DES",
                    accion: "Se ha Eliminado la  vivienda",
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
        } else {
            setTimeout(function() {
                swal("Cancelado", "La accion fue cancelada, la informacion esta segura.", "error");
            }, 100);
        }
    });
}

function Ver(valores, techos, pisos, paredes, gas, electrodomesticos) {
    var values = JSON.parse(valores);
    var tipo_techos = JSON.parse(techos);
    var tipo_pisos = JSON.parse(pisos);
    var tipo_paredes = JSON.parse(paredes);
    var gas_v = JSON.parse(gas);
    var electrodomestico_v = JSON.parse(electrodomesticos);
    var texto_tabla = "<center><em style='font-size:60px' class='fa fa-home'></em><br><br>";
    texto_tabla += "<table style='width:98%' border='1'><tr style='background:#057E9F;color:white;'>";
    texto_tabla += "<td style='width:25%'>Calle</td><td style='width:25%'>Dirección</td><td style='width:25%'>Tipo de vivienda</td><td style='width:25%'>Familia</td></tr>";
    texto_tabla += "<tr><td style='width:25%'><em class='fa fa-road'></em> " + values["nombre_calle"] + "</td><td style='width:25%'><em class='fa fa-map-marker'></em> " + values["direccion_vivienda"] + "</td>";
    texto_tabla += "<td style='width:25%'><em class='fa fa-home'></em> " + values["nombre_tipo_vivienda"] + "</td><td style='width:25%'><em class='fa fa-users'></em> " + values["familia"] + "</td></tr>";
    texto_tabla += "</table>";
    texto_tabla += "<br><table style='width:98%' border='1'><tr style='background:#057E9F;color:white;'>";
    texto_tabla += "<td style='width:25%'>Espacio de Siembra</td><td style='width:25%'>Hacinamiento</td><td style='width:25%'>Baño sanitario</td><td style='width:25%'>Condición</td></tr>";
    texto_tabla += "<tr><td style='width:25%'><em class='fa fa-tree'></em> " + get_letras(values["espacio_siembra"]) + "</td><td style='width:25%'><em class='fa fa-users'></em> " + get_letras(values["hacinamiento"]) + "</td>";
    texto_tabla += "<td style='width:25%'><em class='fa fa-bath'></em> " + get_letras(values["banio_sanitario"]) + "</td><td style='width:25%'><em class='fa fa-check-square'></em> " + values["condicion"] + "</td></tr>";
    texto_tabla += "</table>";
    texto_tabla += "<br><table style='width:98%' border='1'><tr style='background:#057E9F;color:white;'>";
    texto_tabla += "<td style='width:25%'>Descripción de condición</td><td style='width:25%'>Cantidad habitaciones</td><td style='width:25%'>Animales domésticos</td><td style='width:25%'>Insectos o roedores</td></tr>";
    texto_tabla += "<tr><td style='width:25%'><em class='fa fa-comment'></em> " + values["descripcion"] + "</td><td style='width:25%'><em class='fa fa-bed'></em> " + values["cantidad_habitaciones"] + "</td>";
    texto_tabla += "<td style='width:25%'><em class='fa fa-paw'></em> " + get_letras(values["animales_domesticos"]) + "</td><td style='width:25%'><em class='fa fa-bug'></em> " + get_letras(values["insectos_roedores"]) + "</td></tr>";
    texto_tabla += "</table>";
    texto_tabla += "<br><table style='width:98%' border='1'><tr style='background:#057E9F;color:white;'>";
    texto_tabla += "<td style='width:33%'>Servicios</td><td style='width:33%'>Techo</td><td style='width:33%'>Pared</td></tr>";
    texto_tabla += "<tr><td style='width:33%'><div style='width:100%;overflow-y:scroll;height:100px;background:#CFF3C5;'>";
    texto_tabla += "<em class='fa fa-tint'></em> Agua consumo: " + values["agua_consumo"] + "<br><hr>";
    texto_tabla += "<em class='fa fa-trash'></em> Residuos sólidos: " + values["residuos_solidos"] + "<br><hr>";
    texto_tabla += "<em class='fa fa-tint'></em> Aguas negras: " + values["aguas_negras"] + "<br><hr>";
    texto_tabla += "<em class='fa fa-phone'></em> Cable telefónico: " + get_letras(values["cable_telefonico"]) + "<br><hr>";
    texto_tabla += "<em class='fa fa-wifi'></em> Internet: " + get_letras(values["internet"]) + "<br><hr>";
    texto_tabla += "<em class='fa fa-plug'></em> Servicio eléctrico: " + get_letras(values["servicio_electrico"]) + "</div></td>";
    texto_tabla += "<td style='width:33%'><div style='width:100%;overflow-y:scroll;height:100px;background:#CFF3C5;'>";
    for (var i = 0; i < tipo_techos.length; i++) {
        texto_tabla += "<em class='fa fa-hand-pointer-o'></em>" + tipo_techos[i]["techo"] + "<br><hr>";
    }
    texto_tabla += "</div></td>";
    texto_tabla += "<td style='width:33%'><div style='width:100%;overflow-y:scroll;height:100px;background:#CFF3C5;'>";
    for (var i = 0; i < tipo_pisos.length; i++) {
        texto_tabla += "<em class='fa fa-hand-stop-o'></em>" + tipo_pisos[i]["pared"] + "<br><hr>";
    }
    texto_tabla += "</div></td></tr>";
    texto_tabla += "</table>";
    texto_tabla += "<br><table style='width:98%' border='1'><tr style='background:#057E9F;color:white;'>";
    texto_tabla += "<td style='width:33%'>Piso</td><td style='width:33%'>Gas</td><td style='width:33%'>Electrodomésticos</td></tr>";
    texto_tabla += "<td style='width:33%'><div style='width:100%;overflow-y:scroll;height:100px;background:#CFF3C5;'>";
    for (var i = 0; i < tipo_paredes.length; i++) {
        texto_tabla += "<em class='fa fa-hand-o-down'></em> " + tipo_paredes[i]["piso"] + "<br><hr>";
    }
    texto_tabla += "</div></td>";
    texto_tabla += "<td style='width:33%'><div style='width:100%;overflow-y:scroll;height:100px;background:#CFF3C5;'>";
    for (var i = 0; i < gas_v.length; i++) {
        texto_tabla += "<em class='fa fa-fire'></em> " + gas_v[i]["nombre_servicio_gas"] + "<br><hr>";
    }
    texto_tabla += "</div></td>";
    texto_tabla += "<td style='width:33%'><div style='width:100%;overflow-y:scroll;height:100px;background:#CFF3C5;'>";
    for (var i = 0; i < electrodomestico_v.length; i++) {
        texto_tabla += "<em class='fa fa-cogs'></em> " + electrodomestico_v[i]["nombre_electrodomestico"] + "<br><hr>";
    }
    texto_tabla += "</div></td></tr></table>";
    texto_tabla = "<div style='overflow-y:scroll;width:100%;height:400px;'>" + texto_tabla + "</div>";
    swal({
        title: "Casa Nro " + values["numero_casa"],
        text: texto_tabla,
        html: true,
        customClass: "bigSwalV2",
    });
}

function get_letras(dato) {
    if (parseInt(dato) == 0) {
        return "No";
    } else {
        return "Si";
    }
}
var id_vivienda = "";

function Modificar(id, vivienda, techos, paredes, pisos, gas, electrodomesticos) {
    vivienda = JSON.parse(vivienda);
    techos = JSON.parse(techos);
    id_vivienda = id;
    gas = JSON.parse(gas);
    document.getElementById("id_calle").value = vivienda["id_calle"];
    document.getElementById("direccion_vivienda").value = vivienda["direccion_vivienda"];
    document.getElementById("numero_casa").value = vivienda["numero_casa"];
    document.getElementById("cantidad_habitaciones").value = vivienda["cantidad_habitaciones"];
    document.getElementById("id_tipo_vivienda").value = vivienda["nombre_tipo_vivienda"];
    document.getElementById("condicion").value = vivienda["condicion"];
    document.getElementById("hacinamiento").value = vivienda["hacinamiento"];
    document.getElementById("espacio_siembra").value = vivienda["espacio_siembra"];
    document.getElementById("banio_sanitario").value = vivienda["banio_sanitario"];
    document.getElementById("agua_consumo").value = vivienda["agua_consumo"];
    document.getElementById("aguas_negras").value = vivienda["aguas_negras"];
    document.getElementById("residuos_solidos").value = vivienda["residuos_solidos"];
    document.getElementById("servicio_electrico").value = vivienda["servicio_electrico"];
    document.getElementById("cable_telefonico").value = vivienda["cable_telefonico"];
    document.getElementById("internet").value = vivienda["internet"];
    gas.length == 0 ? (document.getElementById("gas").value = 0) : (document.getElementById("gas").value = 1);
    document.getElementById("animales_domesticos").value = vivienda["animales_domesticos"];
    document.getElementById("insectos_roedores").value = vivienda["insectos_roedores"];
    document.getElementById("descripcion").value = vivienda["descripcion"];
    cargar_techos(id);
    cargar_paredes(id);
    cargar_pisos(id);
    cargar_servicio_gas(id);
    cargar_electrodomesticos(id);
    $("#editar_vivienda").modal("show");
}

function cargar_techos(id_vivienda) {
    document.getElementById("tabla_techo").innerHTML = "";
    $.ajax({
        url: BASE_URL + "Viviendas/Administrar",
        type: "POST",
        data: {
            peticion: "Obtener",
            id: id_vivienda,
            sql: "SQL_03",
        },
    }).done(function(result) {
        var techos = JSON.parse(result);
        for (var i = 0; i < techos.length; i++) {
            document.getElementById("tabla_techo").innerHTML += "<tr><td><input readOnly='readOnly' type='text' value='" + techos[i]["techo"] + "' class='form-control' placeholder='Tipo techo'></td><td><button type='button' class='btn btn-danger' onclick='borrar_techo(" + techos[i]["id_vivienda_tipo_techo"] + "," + id_vivienda + ")'>X</button></td></tr>";
        }
    });
}

function borrar_techo(id, id_vivienda) {
    swal({
        type: "warning",
        title: "¿Está seguro?",
        text: "Está por eliminar este tipo de techo relacionado con la vivienda, ¿Desea continuar?",
        showCancelButton: true,
        confirmButtonText: "Sí",
        cancelButtonText: "No",
    }, function(isConfirm) {
        if (isConfirm) {
            $.ajax({
                url: BASE_URL + "Viviendas/Administrar",
                type: "POST",
                data: {
                    peticion: "Eliminar",
                    datos: {
                        tabla: "vivienda_tipo_techo",
                        id_tabla: "id_vivienda_tipo_techo",
                        id: id
                    }
                },
            }).done(function(result) {
                if (result == 1) {
                    cargar_techos(id_vivienda);
                } else {
                    setTimeout(function() {
                        swal({
                            title: "ERROR!",
                            text: "Ha ocurrido un Error.</br>" + result,
                            type: "error",
                            html: true,
                            showConfirmButton: true,
                            customClass: "bigSwalV2",
                        });
                    }, 100);
                }
            });
        }
    });
}
document.getElementById("agregar").onclick = function() {
    if (document.getElementById("tipo_techo").value == "0") {
        swal({
            type: "error",
            title: "Error",
            text: "Debe seleccionar un tipo de techo",
            timer: 2000,
            showConfirmButton: false,
        });
        document.getElementById("tipo_techo").style.borderColor = "red";
    } else {
        $.ajax({
            url: BASE_URL + "Viviendas/Administrar",
            type: "POST",
            data: {
                peticion: "Agregar",
                sql: "SQL_13",
                datos: {
                    tabla: "vivienda_tipo_techo",
                    columna: "id_vivienda",
                    data: id_vivienda,
                    buscar: "id_tipo_techo",
                    id: document.getElementById("tipo_techo").value,
                    estado: 1
                }
            },
        }).done(function(result) {
            if (result == 1) {
                cargar_techos(id_vivienda);
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
            document.getElementById("tipo_techo").value = "0";
        });
    }
};
document.getElementById("tipo_techo").onchange = function() {
    if (document.getElementById("tipo_techo").value != "0") {
        document.getElementById("tipo_techo").style.borderColor = "";
    }
};
document.getElementById("tipo_piso").onchange = function() {
    if (document.getElementById("tipo_piso").value != "0") {
        document.getElementById("tipo_piso").style.borderColor = "";
    }
};
document.getElementById("tipo_pared").onchange = function() {
    if (document.getElementById("tipo_pared").value != "0") {
        document.getElementById("tipo_pared").style.borderColor = "";
    }
};

function cargar_paredes(id_vivienda) {
    document.getElementById("tabla_pared").innerHTML = "";
    $.ajax({
        url: BASE_URL + "Viviendas/Administrar",
        type: "POST",
        data: {
            peticion: "Obtener",
            id: id_vivienda,
            sql: "SQL_07",
        },
    }).done(function(result) {
        var paredes = JSON.parse(result);
        for (var i = 0; i < paredes.length; i++) {
            document.getElementById("tabla_pared").innerHTML += "<tr><td><input readOnly='readOnly' type='text' value='" + paredes[i]["pared"] + "' class='form-control'></td><td><button type='button' class='btn btn-danger' onclick='borrar_pared(" + paredes[i]["id_vivienda_tipo_pared"] + "," + id_vivienda + ")'>X</button></td></tr>";
        }
    });
}

function borrar_pared(id, id_vivienda) {
    swal({
        type: "warning",
        title: "¿Está seguro?",
        text: "Está por eliminar este tipo de pared relacionado con la vivienda, ¿Desea continuar?",
        showCancelButton: true,
        confirmButtonText: "Sí",
        cancelButtonText: "No",
    }, function(isConfirm) {
        if (isConfirm) {
            $.ajax({
                url: BASE_URL + "Viviendas/Administrar",
                type: "POST",
                data: {
                    peticion: "Eliminar",
                    datos: {
                        tabla: "vivienda_tipo_pared",
                        id_tabla: "id_vivienda_tipo_pared",
                        id: id
                    }
                },
            }).done(function(result) {
                if (result == 1) {
                    cargar_paredes(id_vivienda);
                } else {
                    setTimeout(function() {
                        swal({
                            title: "ERROR!",
                            text: "Ha ocurrido un Error.</br>" + result,
                            type: "error",
                            html: true,
                            showConfirmButton: true,
                            customClass: "bigSwalV2",
                        });
                    }, 100);
                }
            });
        }
    });
}
document.getElementById("agregar2").onclick = function() {
    if (document.getElementById("tipo_pared").value == "0") {
        swal({
            type: "error",
            title: "Error",
            text: "Debe seleccionar un tipo de pared",
            timer: 2000,
            showConfirmButton: false,
        });
        document.getElementById("tipo_pared").style.borderColor = "red";
    } else {
        $.ajax({
            url: BASE_URL + "Viviendas/Administrar",
            type: "POST",
            data: {
                peticion: "Agregar",
                sql: "SQL_14",
                datos: {
                    tabla: "vivienda_tipo_pared",
                    columna: "id_vivienda",
                    data: id_vivienda,
                    buscar: "id_tipo_pared",
                    id: document.getElementById("tipo_pared").value,
                    estado: 1
                }
            },
        }).done(function(result) {
            if (result == 1) {
                cargar_paredes(id_vivienda);
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
            document.getElementById("tipo_pared").value = "0";
        });
    }
};

function cargar_pisos(id_vivienda) {
    document.getElementById("tabla_piso").innerHTML = "";
    $.ajax({
        url: BASE_URL + "Viviendas/Administrar",
        type: "POST",
        data: {
            peticion: "Obtener",
            id: id_vivienda,
            sql: "SQL_05",
        },
    }).done(function(result) {
        var pisos = JSON.parse(result);
        for (var i = 0; i < pisos.length; i++) {
            document.getElementById("tabla_piso").innerHTML += "<tr><td><input readOnly='readOnly' type='text' value='" + pisos[i]["piso"] + "' class='form-control'></td><td><button type='button' class='btn btn-danger' onclick='borrar_piso(" + pisos[i]["id_vivienda_tipo_piso"] + "," + id_vivienda + ")'>X</button></td></tr>";
        }
    });
}

function borrar_piso(id, id_vivienda) {
    swal({
        type: "warning",
        title: "¿Está seguro?",
        text: "Está por eliminar este tipo de piso relacionado con la vivienda, ¿Desea continuar?",
        showCancelButton: true,
        confirmButtonText: "Sí",
        cancelButtonText: "No",
    }, function(isConfirm) {
        if (isConfirm) {
            $.ajax({
                url: BASE_URL + "Viviendas/Administrar",
                type: "POST",
                data: {
                    peticion: "Eliminar",
                    datos: {
                        tabla: "vivienda_tipo_piso",
                        id_tabla: "id_vivienda_tipo_piso",
                        id: id
                    }
                },
            }).done(function(result) {
                if (result == 1) {
                    cargar_pisos(id_vivienda);
                } else {
                    setTimeout(function() {
                        swal({
                            title: "ERROR!",
                            text: "Ha ocurrido un Error.</br>" + result,
                            type: "error",
                            html: true,
                            showConfirmButton: true,
                            customClass: "bigSwalV2",
                        });
                    }, 100);
                }
            });
        }
    });
}
document.getElementById("agregar3").onclick = function() {
    if (document.getElementById("tipo_piso").value == "0") {
        swal({
            type: "error",
            title: "Error",
            text: "Debe seleccionar un tipo de piso",
            timer: 2000,
            showConfirmButton: false,
        });
        document.getElementById("tipo_piso").style.borderColor = "red";
    } else {
        $.ajax({
            url: BASE_URL + "Viviendas/Administrar",
            type: "POST",
            data: {
                peticion: "Agregar",
                sql: "SQL_15",
                datos: {
                    tabla: "vivienda_tipo_piso",
                    columna: "id_vivienda",
                    data: id_vivienda,
                    buscar: "id_tipo_piso",
                    id: document.getElementById("tipo_piso").value,
                    estado: 1
                }
            },
        }).done(function(result) {
            if (result == 1) {
                cargar_pisos(id_vivienda);
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
            document.getElementById("tipo_piso").value = "0";
        });
    }
};
document.getElementById("guardar").onclick = function() {
    if (document.getElementById("direccion_vivienda").value == "") {
        document.getElementById("valid_direccion").innerHTML = "Debe ingresar la dirección de la vivienda";
        document.getElementById("direccion_vivienda").focus();
        document.getElementById("direccion_vivienda").style.borderColor = "red";
    } else {
        document.getElementById("valid_direccion").innerHTML = "";
        document.getElementById("direccion_vivienda").style.borderColor = "";
        if (document.getElementById("numero_casa").value == "") {
            document.getElementById("valid_numero_casa").innerHTML = "Debe ingresar el número de la vivienda";
            document.getElementById("numero_casa").focus();
            document.getElementById("numero_casa").style.borderColor = "red";
        } else {
            document.getElementById("valid_numero_casa").innerHTML = "";
            document.getElementById("numero_casa").style.borderColor = "";
            if (document.getElementById("cantidad_habitaciones").value == "") {
                document.getElementById("valid_cantidad_habitaciones").innerHTML = "Debe ingresar la cantidad de habitaciones";
                document.getElementById("cantidad_habitaciones").focus();
                document.getElementById("cantidad_habitaciones").style.borderColor = "red";
            } else {
                document.getElementById("valid_cantidad_habitaciones").innerHTML = "";
                document.getElementById("cantidad_habitaciones").style.borderColor = "";
                if (document.getElementById("id_tipo_vivienda").value == "") {
                    document.getElementById("valid_tipo_vivienda").innerHTML = "Debe ingresar el tipo de vivienda";
                    document.getElementById("id_tipo_vivienda").focus();
                    document.getElementById("id_tipo_vivienda").style.borderColor = "red";
                } else {
                    document.getElementById("valid_tipo_vivienda").innerHTML = "";
                    document.getElementById("id_tipo_vivienda").style.borderColor = "";
                    if (document.getElementById("tabla_techo").innerHTML == "" || document.getElementById("tabla_techo").innerHTML == null) {
                        swal({
                            type: "error",
                            title: "Error",
                            text: "Debe ingresar al menos un tipo de techo",
                            timer: 2000,
                            showConfirmButton: false,
                        });
                    } else {
                        if (document.getElementById("tabla_pared").innerHTML == "" || document.getElementById("tabla_pared").innerHTML == null) {
                            swal({
                                type: "error",
                                title: "Error",
                                text: "Debe ingresar al menos un tipo de pared",
                                timer: 2000,
                                showConfirmButton: false,
                            });
                        } else {
                            if (document.getElementById("tabla_piso").innerHTML == "" || document.getElementById("tabla_piso").innerHTML == null) {
                                swal({
                                    type: "error",
                                    title: "Error",
                                    text: "Debe ingresar al menos un tipo de piso",
                                    timer: 2000,
                                    showConfirmButton: false,
                                });
                            } else {
                                var inf_servicio = new Object();
                                inf_servicio['agua_consumo'] = document.getElementById("agua_consumo").value;
                                inf_servicio['aguas_negras'] = document.getElementById("aguas_negras").value;
                                inf_servicio['residuos_solidos'] = document.getElementById("residuos_solidos").value;
                                inf_servicio['cable_telefonico'] = document.getElementById("cable_telefonico").value;
                                inf_servicio['internet'] = document.getElementById("internet").value;
                                inf_servicio['servicio_electrico'] = document.getElementById("servicio_electrico").value;
                                inf_servicio['estado'] = 1;
                                var info_vivienda = new Object();
                                info_vivienda['id_vivienda'] = id_vivienda;
                                info_vivienda['id_calle'] = document.getElementById("id_calle").value;
                                info_vivienda['id_tipo_vivienda'] = document.getElementById("id_tipo_vivienda").value;
                                info_vivienda['id_servicio'] = inf_servicio;
                                info_vivienda['direccion_vivienda'] = document.getElementById("direccion_vivienda").value;
                                info_vivienda['numero_casa'] = document.getElementById("numero_casa").value;
                                info_vivienda['cantidad_habitaciones'] = document.getElementById("cantidad_habitaciones").value;
                                info_vivienda['espacio_siembra'] = document.getElementById("espacio_siembra").value;
                                info_vivienda['hacinamiento'] = document.getElementById("hacinamiento").value;
                                info_vivienda['banio_sanitario'] = document.getElementById("banio_sanitario").value;
                                info_vivienda['condicion'] = document.getElementById("condicion").value;
                                info_vivienda['descripcion'] = document.getElementById("descripcion").value;
                                info_vivienda['animales_domesticos'] = document.getElementById("animales_domesticos").value;
                                info_vivienda['insectos_roedores'] = document.getElementById("insectos_roedores").value;
                                $.ajax({
                                    url: BASE_URL + "Viviendas/Administrar",
                                    type: "POST",
                                    data: {
                                        peticion: "Actualizar",
                                        sql: "SQL_11",
                                        vivienda: info_vivienda,
                                        accion: "La vivienda: " + document.getElementById("numero_casa").value + " fue actualizada exitosamente.",
                                        datos: {
                                            tabla: "vivienda",
                                            columna: "id_vivienda",
                                            estado: 1
                                        }
                                    },
                                }).done(function(datos) {
                                    if (datos == 1) {
                                        swal({
                                            title: "Actualizado!",
                                            text: "El elemento fue Actualizado con exito.",
                                            type: "success",
                                            showConfirmButton: false
                                        });
                                        setTimeout(function() {
                                            location.reload();
                                        }, 2000);
                                    } else {
                                        swal({
                                            title: "ERROR!",
                                            text: "Ha ocurrido un Error.</br>" + datos,
                                            type: "error",
                                            html: true,
                                            showConfirmButton: true,
                                            customClass: "bigSwalV2",
                                        });
                                    }
                                })
                            }
                        }
                    }
                }
            }
        }
    }
};
document.getElementById("direccion_vivienda").onkeyup = function() {
    if (document.getElementById("direccion_vivienda").value != "") {
        document.getElementById("valid_direccion").innerHTML = "";
        document.getElementById("direccion_vivienda").style.borderColor = "";
    }
};
document.getElementById("cantidad_habitaciones").onkeyup = function() {
    if (document.getElementById("cantidad_habitaciones").value != "") {
        document.getElementById("valid_cantidad_habitaciones").innerHTML = "";
        document.getElementById("cantidad_habitaciones").style.borderColor = "";
    }
};
document.getElementById("id_tipo_vivienda").onkeyup = function() {
    if (document.getElementById("id_tipo_vivienda").value != "") {
        document.getElementById("valid_tipo_vivienda").innerHTML = "";
        document.getElementById("id_tipo_vivienda").style.borderColor = "";
    }
};
document.getElementById("numero_casa").onkeyup = function() {
    if (document.getElementById("numero_casa").value != "") {
        document.getElementById("valid_numero_casa").innerHTML = "";
        document.getElementById("numero_casa").style.borderColor = "";
    }
};

function cargar_servicio_gas(id_vivienda) {
    document.getElementById("gases_agregados").innerHTML = "";
    $.ajax({
        url: BASE_URL + "Viviendas/Administrar",
        type: "POST",
        data: {
            peticion: "Obtener",
            id: id_vivienda,
            sql: "SQL_08",
        },
    }).done(function(result) {
        var gases = JSON.parse(result);
        var texto = "";
        for (var i = 0; i < gases.length; i++) {
            texto += "<div><table style='width:100%'><tr><td style='width:25%;text-align:center'>" + gases[i]["nombre_servicio_gas"] + "</td>";
            texto += "<td style='width:25%;text-align:center'>" + gases[i]["tipo_bombona"] + "</td>";
            texto += "<td style='width:25%;text-align:center'>" + gases[i]["dias_duracion"] + " días</td>";
            texto += "<td style='width:25%;text-align:right'><button style='width:20%;margin-top:10px' type='button' class='btn btn-danger' onclick='borrar_gases(" + gases[i]["id_vivienda_servicio_gas"] + "," + id_vivienda + ")'>X</button></td>";
            texto += "</tr></table></div><hr>";
        }
        document.getElementById("gases_agregados").innerHTML = texto;
    });
    $.ajax({
        url: BASE_URL + "Viviendas/Administrar",
        type: "POST",
        data: {
            peticion: "Cargar_Gas",
        },
    }).done(function(result) {
        document.getElementById("gas_select").innerHTML = result;
    });
}

function borrar_gases(id, id_vivienda) {
    swal({
        type: "warning",
        title: "¿Está seguro?",
        text: "Está por eliminar este servicio de gas asociaod a la vivienda, ¿desea continuar?",
        showCancelButton: true,
        confirmButtonText: "Si",
        cancelButtonText: "No",
    }, function(isConfirm) {
        if (isConfirm) {
            $.ajax({
                url: BASE_URL + "Viviendas/Administrar",
                type: "POST",
                data: {
                    peticion: "Eliminar",
                    datos: {
                        tabla: "vivienda_servicio_gas",
                        id_tabla: "id_vivienda_servicio_gas",
                        id: id
                    }
                },
            }).done(function(result) {
                if (result == 1) {
                    cargar_servicio_gas(id_vivienda);
                } else {
                    setTimeout(function() {
                        swal({
                            title: "ERROR!",
                            text: "Ha ocurrido un Error.</br>" + result,
                            type: "error",
                            html: true,
                            showConfirmButton: true,
                            customClass: "bigSwalV2",
                        });
                    }, 100);
                }
            });
        }
    });
}
document.getElementById("agregar_servicio").onclick = function() {
    if (document.getElementById("gas_select").style.display == "none") {
        document.getElementById("gas_input").style.display = "none";
        document.getElementById("gas_select").style.display = "";
        document.getElementById("gas_input").value = "";
    } else {
        document.getElementById("gas_select").style.display = "none";
        document.getElementById("gas_input").style.display = "";
        document.getElementById("gas_input").focus();
        document.getElementById("gas_select").value = "vacio";
    }
}
document.getElementById("agregar_gas").onclick = function() {
    if ((document.getElementById("gas_select").style.display != "none" && document.getElementById("gas_select").value == "vacio") || (document.getElementById("gas_select").style.display == "none" && document.getElementById("gas_input").value == "")) {
        document.getElementById("gas_select").style.borderColor = "red";
        document.getElementById("gas_input").style.borderColor = "red";
        document.getElementById("gas_input").focus();
        document.getElementById("valid_gases_agregados").innerHTML = "Debe indicar una compañía de gas";
    } else {
        document.getElementById("gas_select").style.borderColor = "";
        document.getElementById("gas_input").style.borderColor = "";
        document.getElementById("valid_gases_agregados").innerHTML = "";
        if (document.getElementById("tipo_bombona").value == "vacio") {
            document.getElementById("tipo_bombona").style.borderColor = "red";
            document.getElementById("valid_gases_agregados").innerHTML = "Debe indicar el tipo de bombona";
        } else {
            document.getElementById("tipo_bombona").style.borderColor = "";
            document.getElementById("valid_gases_agregados").innerHTML = "";
            if (document.getElementById("tiempo_duracion").value == "vacio") {
                document.getElementById("tiempo_duracion").style.borderColor = "red";
                document.getElementById("valid_gases_agregados").innerHTML = "Debe indicar el tiempo de duración de la bombona";
            } else {
                document.getElementById("tiempo_duracion").style.borderColor = "";
                document.getElementById("valid_gases_agregados").innerHTML = "";
                var inf_gas = new Object();
                if (document.getElementById("gas_select").style.display != "none") {
                    inf_gas['gas'] = document.getElementById("gas_select").value;
                    inf_gas['nuevo'] = 0;
                } else {
                    inf_gas['gas'] = document.getElementById("gas_input").value;
                    inf_gas['nuevo'] = 1;
                }
                inf_gas['tipo_bombona'] = document.getElementById("tipo_bombona").value;
                inf_gas['tiempo_duracion'] = document.getElementById("tiempo_duracion").value;
                $.ajax({
                    url: BASE_URL + "Viviendas/Administrar",
                    type: "POST",
                    data: {
                        peticion: "Servicio_Gas",
                        sql: "SQL_16",
                        gas: inf_gas,
                        datos: {
                            tabla: "vivienda_servicio_gas",
                            columna: "id_vivienda",
                            id: id_vivienda,
                            estado: 1
                        }
                    },
                }).done(function(result) {
                    if (result == 1) {
                        cargar_servicio_gas(id_vivienda);
                    } else {
                        setTimeout(function() {
                            swal({
                                title: "ERROR!",
                                text: "Ha ocurrido un Error.</br>" + result,
                                type: "error",
                                html: true,
                                showConfirmButton: true,
                                customClass: "bigSwalV2",
                            });
                        }, 100);
                    }
                    document.getElementById("gas_input").style.display = "none";
                    document.getElementById("gas_select").style.display = "";
                    document.getElementById("gas_input").value = "";
                    document.getElementById("gas_select").value = document.getElementById("tipo_bombona").value = document.getElementById("tiempo_duracion").value = 'vacio';
                });
            }
        }
    }
}
document.getElementById("gas_select").onchange = function() {
    if (document.getElementById("gas_select").value != "vacio") {
        document.getElementById("gas_select").style.borderColor = "";
        document.getElementById("valid_gases_agregados").innerHTML = "";
    }
}
document.getElementById("gas_input").onkeyup = function() {
    if (document.getElementById("gas_input").value != "vacio") {
        document.getElementById("gas_input").style.borderColor = "";
        document.getElementById("valid_gases_agregados").innerHTML = "";
    }
}
document.getElementById("tipo_bombona").onchange = function() {
    if (document.getElementById("tipo_bombona").value != "vacio") {
        document.getElementById("tipo_bombona").style.borderColor = "";
        document.getElementById("valid_gases_agregados").innerHTML = "";
    }
}
document.getElementById("tiempo_duracion").onchange = function() {
    if (document.getElementById("tiempo_duracion").value != "vacio") {
        document.getElementById("tiempo_duracion").style.borderColor = "";
        document.getElementById("valid_gases_agregados").innerHTML = "";
    }
}

function cargar_electrodomesticos(id_vivienda) {
    document.getElementById("electrodomesticos_agregados").innerHTML = "";
    $.ajax({
        url: BASE_URL + "Viviendas/Administrar",
        type: "POST",
        data: {
            peticion: "Obtener",
            id: id_vivienda,
            sql: "SQL_09",
        },
    }).done(function(result) {
        var electrodomesticos = JSON.parse(result);
        var texto = "";
        for (var i = 0; i < electrodomesticos.length; i++) {
            texto += "<div><table style='width:100%'><tr><td style='width:25%;text-align:center'>" + electrodomesticos[i]["nombre_electrodomestico"] + "</td>";
            texto += "<td style='width:25%;text-align:center'>" + electrodomesticos[i]["cantidad"] + " Unidades</td>";
            texto += "<td style='width:25%;text-align:right'><button style='width:20%;margin-top:10px' type='button' class='btn btn-danger' onclick='borrar_electrodomesticos(" + electrodomesticos[i]["id_vivienda_electrodomestico"] + "," + id_vivienda + ")'>X</button></td>";
            texto += "</tr></table></div><hr>";
        }
        document.getElementById("electrodomesticos_agregados").innerHTML = texto;
    });
    $.ajax({
        url: BASE_URL + "Viviendas/Administrar",
        type: "POST",
        data: {
            peticion: "Cargar_Electrodomesticos",
        },
    }).done(function(result) {
        document.getElementById("electrodomestico_select").innerHTML = result;
    });
}

function borrar_electrodomesticos(id, id_vivienda) {
    swal({
        type: "warning",
        title: "¿Está seguro?",
        text: "Está por eliminar este electrodoméstico asociado a la vivienda, ¿desea continuar?",
        showCancelButton: true,
        confirmButtonText: "Si",
        cancelButtonText: "No",
    }, function(isConfirm) {
        if (isConfirm) {
            $.ajax({
                url: BASE_URL + "Viviendas/Administrar",
                type: "POST",
                data: {
                    peticion: "Eliminar",
                    datos: {
                        tabla: "vivienda_electrodomesticos",
                        id_tabla: "id_vivienda_electrodomestico",
                        id: id
                    }
                },
            }).done(function(result) {
                if (result == 1) {
                    cargar_electrodomesticos(id_vivienda);
                } else {
                    setTimeout(function() {
                        swal({
                            title: "ERROR!",
                            text: "Ha ocurrido un Error.</br>" + result,
                            type: "error",
                            html: true,
                            showConfirmButton: true,
                            customClass: "bigSwalV2",
                        });
                    }, 100);
                }
            });
        }
    });
}
document.getElementById("nuevo_electrodomestico").onclick = function() {
    if (document.getElementById("electrodomestico_select").style.display == "none") {
        document.getElementById("electrodomestico_input").style.display = "none";
        document.getElementById("electrodomestico_select").style.display = "";
        document.getElementById("electrodomestico_input").value = "";
    } else {
        document.getElementById("electrodomestico_select").style.display = "none";
        document.getElementById("electrodomestico_input").style.display = "";
        document.getElementById("electrodomestico_input").focus();
        document.getElementById("electrodomestico_select").value = "vacio";
    }
}
document.getElementById("agregar_electrodomestico").onclick = function() {
    if ((document.getElementById("electrodomestico_select").style.display != "none" && document.getElementById("electrodomestico_select").value == "vacio") || (document.getElementById("electrodomestico_select").style.display == "none" && document.getElementById("electrodomestico_input").value == "")) {
        document.getElementById("electrodomestico_select").style.borderColor = "red";
        document.getElementById("electrodomestico_input").style.borderColor = "red";
        document.getElementById("electrodomestico_input").focus();
        document.getElementById("valid_electrodomesticos_agregados").innerHTML = "Debe indicar el electrodomestico";
    } else {
        document.getElementById("electrodomestico_select").style.borderColor = "";
        document.getElementById("electrodomestico_input").style.borderColor = "";
        document.getElementById("valid_electrodomesticos_agregados").innerHTML = "";
        if (document.getElementById("cantidad_electrodomestico").value == "") {
            document.getElementById("valid_electrodomesticos_agregados").innerHTML = "Debe ingresar la cantidad";
            document.getElementById("cantidad_electrodomestico").style.borderColor = "red";
        } else {
            document.getElementById("valid_electrodomesticos_agregados").innerHTML = "";
            document.getElementById("cantidad_electrodomestico").style.borderColor = "";
            var inf_electrodomestico = new Object();
            if (document.getElementById("electrodomestico_select").style.display == "none") {
                inf_electrodomestico['nuevo'] = 1;
                inf_electrodomestico['electrodomestico'] = document.getElementById("electrodomestico_input").value;
            } else {
                inf_electrodomestico['nuevo'] = 0;
                inf_electrodomestico['electrodomestico'] = document.getElementById("electrodomestico_select").value;
            }
            inf_electrodomestico['cantidad'] = document.getElementById("cantidad_electrodomestico").value;
            $.ajax({
                url: BASE_URL + "Viviendas/Administrar",
                type: "POST",
                data: {
                    peticion: "Electrodomesticos",
                    sql: "SQL_17",
                    electrodomestico: inf_electrodomestico,
                    datos: {
                        tabla: "vivienda_electrodomesticos",
                        columna: "id_vivienda",
                        id: id_vivienda,
                        estado: 1
                    }
                },
            }).done(function(result) {
                if (result == 1) {
                    cargar_electrodomesticos(id_vivienda);
                } else {
                    setTimeout(function() {
                        swal({
                            title: "ERROR!",
                            text: "Ha ocurrido un Error.</br>" + result,
                            type: "error",
                            html: true,
                            showConfirmButton: true,
                            customClass: "bigSwalV2",
                        });
                    }, 100);
                }
                document.getElementById("electrodomestico_input").value = "";
                document.getElementById("electrodomestico_input").style.display = "none";
                document.getElementById("electrodomestico_select").value = "vacio";
                document.getElementById("electrodomestico_select").style.display = "";
                document.getElementById("cantidad_electrodomestico").value = "";
            })
        }
    }
}
document.getElementById("electrodomestico_select").onchange = function() {
    if (document.getElementById("electrodomestico_select").value != "vacio") {
        document.getElementById("electrodomestico_select").style.borderColor = "";
        document.getElementById("valid_electrodomesticos_agregados").innerHTML = "";
    }
}
document.getElementById("electrodomestico_input").onkeyup = function() {
    if (document.getElementById("electrodomestico_input").value != "") {
        document.getElementById("electrodomestico_input").style.borderColor = "";
        document.getElementById("valid_electrodomesticos_agregados").innerHTML = "";
    }
}
document.getElementById("cantidad_electrodomestico").onkeyup = function() {
    if (document.getElementById("cantidad_electrodomestico").value != "") {
        document.getElementById("cantidad_electrodomestico").style.borderColor = "";
        document.getElementById("valid_electrodomesticos_agregados").innerHTML = "";
    }
}

