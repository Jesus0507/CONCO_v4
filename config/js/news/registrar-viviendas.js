var gases_agregados = [];
document.getElementById("agregar_servicio").onclick = function() {
    if (document.getElementById("gas_input").style.display == 'none') {
        document.getElementById("gas_input").style.display = "";
        document.getElementById("gas_select").style.display = 'none';
        document.getElementById("agregar_servicio").innerHTML = 'Atrás';
        document.getElementById("gas_input").focus();
        document.getElementById("gas_select").value = 'vacio';
    } else {
        document.getElementById("gas_input").style.display = "none";
        document.getElementById("gas_select").style.display = '';
        document.getElementById("agregar_servicio").innerHTML = 'Nuevo servicio';
        document.getElementById("gas_input").value = '';
    }
}
document.getElementById("agregar_gas").onclick = function() {
    var validacion = valid_gases_agregados();
    if (validacion['continuar']) {
        document.getElementById("gas_input").value = '';
        document.getElementById("gas_select").value = 'vacio';
        document.getElementById("tipo_bombona").value = 'vacio';
        document.getElementById("tiempo_duracion").value = 'vacio';
        gases_agregados.push(validacion['gas']);
        console.log(gases_agregados);
        var div = document.createElement("div");
        var table = document.createElement("table");
        table.style.width = "100%";
        var tr = document.createElement("tr");
        var td1 = document.createElement("td");
        td1.style.width = '25%';
        td1.style.textalign = 'center';
        var td2 = document.createElement("td");
        td2.style.width = '25%';
        td2.style.textalign = 'center';
        var td3 = document.createElement("td");
        td3.style.width = '25%';
        td3.style.textalign = 'center';
        var td4 = document.createElement("td");
        td4.style.textAlign = 'right';
        td1.innerHTML = validacion['gas']['mostrar_gas'];
        td2.innerHTML = validacion['gas']['tipo_bombona'];
        td3.innerHTML = validacion['gas']['tiempo_duracion'] + " días";
        var button = document.createElement("input");
        button.className = 'btn btn-danger';
        button.value = 'X';
        button.style.width = '20%';
        td4.appendChild(button);
        tr.appendChild(td1);
        tr.appendChild(td2);
        tr.appendChild(td3);
        tr.appendChild(td4);
        table.appendChild(tr);
        var hr = document.createElement("hr");
        div.appendChild(table);
        div.appendChild(hr);
        document.getElementById("gases_agregados").appendChild(div);
        button.onclick = function() {
            document.getElementById("gases_agregados").removeChild(div);
            gases_agregados.splice(gases_agregados.indexOf(validacion['gas']), 1);
            console.log(gases_agregados);
        }
    }
}

function valid_gases_agregados() {
    var validar = new Object;
    validar['continuar'] = false;
    if ((document.getElementById("gas_input").style.display == 'none' && document.getElementById("gas_select").value == "vacio") || (document.getElementById("gas_input").style.display != 'none' && document.getElementById("gas_input").value == "")) {
        document.getElementById("valid_gases_agregados").innerHTML = 'Indique la compañía de gas';
        document.getElementById("gas_input").style.borderColor = document.getElementById("gas_select").style.borderColor = "red";
    } else {
        document.getElementById("valid_gases_agregados").innerHTML = '';
        document.getElementById("gas_input").style.borderColor = document.getElementById("gas_select").style.borderColor = "";
        if (document.getElementById("tipo_bombona").value == 'vacio') {
            document.getElementById("valid_gases_agregados").innerHTML = 'Indique el tipo de bombona';
            document.getElementById("tipo_bombona").style.borderColor = 'red';
        } else {
            document.getElementById("valid_gases_agregados").innerHTML = '';
            document.getElementById("tipo_bombona").style.borderColor = '';
            if (document.getElementById("tiempo_duracion").value == 'vacio') {
                document.getElementById("valid_gases_agregados").innerHTML = 'Ingrese el tiempo aproximado de duración';
                document.getElementById("tiempo_duracion").style.borderColor = 'red';
            } else {
                document.getElementById("valid_gases_agregados").innerHTML = '';
                document.getElementById("tiempo_duracion").style.borderColor = '';
                var cont = 0;
                var gas = new Object();
                if (document.getElementById("gas_input").style.display == 'none') {
                    gas['servicio_gas'] = document.getElementById("gas_select").value;
                    gas['mostrar_gas'] = document.getElementById("gas_select").options[document.getElementById("gas_select").selectedIndex].text;
                    gas['nuevo'] = '0';
                } else {
                    gas['servicio_gas'] = document.getElementById("gas_input").value;
                    gas['mostrar_gas'] = document.getElementById("gas_input").value;
                    gas['nuevo'] = '1';
                }
                gas['tiempo_duracion'] = document.getElementById("tiempo_duracion").value;
                gas['tipo_bombona'] = document.getElementById("tipo_bombona").value;
                for (var i = 0; i < gases_agregados.length; i++) {
                    console.log(JSON.stringify(gases_agregados[i]) + " -- " + JSON.stringify(gas));
                    if (JSON.stringify(gases_agregados[i]) == JSON.stringify(gas)) {
                        cont++;
                    }
                }
                if (cont == 0) {
                    validar['continuar'] = true;
                    validar['gas'] = gas;
                    document.getElementById("valid_gases_agregados").innerHTML = '';
                } else {
                    document.getElementById("valid_gases_agregados").innerHTML = 'Este servicio de gas ya fue agregado';
                }
            }
        }
    }
    return validar;
}
var electrodomesticos_agregados = [];
document.getElementById("nuevo_electrodomestico").onclick = function() {
    if (document.getElementById("electrodomestico_input").style.display == 'none') {
        document.getElementById("electrodomestico_input").style.display = "";
        document.getElementById("electrodomestico_select").style.display = 'none';
        document.getElementById("nuevo_electrodomestico").innerHTML = 'Atrás';
        document.getElementById("electrodomestico_input").focus();
        document.getElementById("electrodomestico_select").value = 'vacio';
    } else {
        document.getElementById("electrodomestico_input").style.display = "none";
        document.getElementById("electrodomestico_select").style.display = '';
        document.getElementById("nuevo_electrodomestico").innerHTML = 'Nuevo electrodoméstico';
        document.getElementById("electrodomestico_input").value = '';
    }
}
document.getElementById("agregar_electrodomestico").onclick = function() {
    var validacion = valid_electrodomesticos_agregados();
    if (validacion['continuar']) {
        document.getElementById("electrodomestico_select").value = 'vacio';
        document.getElementById("electrodomestico_input").value = '';
        document.getElementById("cantidad_electrodomestico").value = '';
        electrodomesticos_agregados.push(validacion['valor_electrodomestico']);
        console.log(electrodomesticos_agregados);
        var div = document.createElement("div");
        var table = document.createElement("table");
        table.style.width = "100%";
        var tr = document.createElement("tr");
        var td1 = document.createElement("td");
        td1.style.width = '35%';
        td1.style.textalign = 'center';
        var td2 = document.createElement("td");
        td2.style.width = '35%';
        td2.style.textalign = 'center';
        var td3 = document.createElement("td");
        td3.style.width = '30%';
        td3.style.textalign = 'right';
        td1.innerHTML = validacion['valor_electrodomestico']['mostrar_electrodomestico'];
        td2.innerHTML = validacion['valor_electrodomestico']['cantidad'] + " Unidades";
        var button = document.createElement("input");
        button.className = 'btn btn-danger';
        button.value = 'X';
        button.style.width = '20%';
        td3.appendChild(button);
        tr.appendChild(td1);
        tr.appendChild(td2);
        tr.appendChild(td3);
        table.appendChild(tr);
        var hr = document.createElement("hr");
        div.appendChild(table);
        div.appendChild(hr);
        document.getElementById("electrodomesticos_agregados").appendChild(div);
        button.onclick = function() {
            document.getElementById("electrodomesticos_agregados").removeChild(div);
            electrodomesticos_agregados.splice(electrodomesticos_agregados.indexOf(validacion['gas']), 1);
            console.log(electrodomesticos_agregados);
        }
    }
}

function valid_electrodomesticos_agregados() {
    var validar = new Object;
    validar['continuar'] = false;
    if ((document.getElementById("electrodomestico_input").style.display == 'none' && document.getElementById("electrodomestico_select").value == "vacio") || (document.getElementById("electrodomestico_input").style.display != 'none' && document.getElementById("electrodomestico_input").value == "")) {
        document.getElementById("valid_electrodomesticos_agregados").innerHTML = 'Indique el electrodoméstico';
        document.getElementById("electrodomestico_input").style.borderColor = document.getElementById("electrodomestico_select").style.borderColor = "red";
    } else {
        document.getElementById("valid_electrodomesticos_agregados").innerHTML = '';
        document.getElementById("electrodomestico_input").style.borderColor = document.getElementById("electrodomestico_select").style.borderColor = "";
        if (document.getElementById("cantidad_electrodomestico").value == "") {
            document.getElementById("valid_electrodomesticos_agregados").innerHTML = 'Indique la cantidad de unidades';
            document.getElementById("cantidad_electrodomestico").style.borderColor = 'red';
            document.getElementById("cantidad_electrodomestico").focus();
        } else {
            document.getElementById("valid_electrodomesticos_agregados").innerHTML = '';
            document.getElementById("cantidad_electrodomestico").style.borderColor = '';
            var cont = 0;
            var electrodomestico = new Object();
            if (document.getElementById("electrodomestico_input").style.display == 'none') {
                electrodomestico['electrodomestico'] = document.getElementById("electrodomestico_select").value;
                electrodomestico['mostrar_electrodomestico'] = document.getElementById("electrodomestico_select").options[document.getElementById("electrodomestico_select").selectedIndex].text;
                electrodomestico['nuevo'] = '0';
            } else {
                electrodomestico['electrodomestico'] = document.getElementById("electrodomestico_input").value;
                electrodomestico['mostrar_electrodomestico'] = document.getElementById("electrodomestico_input").value;
                electrodomestico['nuevo'] = '1';
            }
            electrodomestico['cantidad'] = document.getElementById("cantidad_electrodomestico").value;
            for (var i = 0; i < electrodomesticos_agregados.length; i++) {
                console.log(JSON.stringify(electrodomesticos_agregados[i]) + " -- " + JSON.stringify(electrodomestico));
                if (JSON.stringify(electrodomesticos_agregados[i]) == JSON.stringify(electrodomestico)) {
                    cont++;
                }
            }
            if (cont == 0) {
                validar['continuar'] = true;
                validar['valor_electrodomestico'] = electrodomestico;
                document.getElementById("valid_electrodomesticos_agregados").innerHTML = '';
            } else {
                document.getElementById("valid_electrodomesticos_agregados").innerHTML = 'Este servicio de gas ya fue agregado';
            }
        }
    }
    return validar;
}
document.getElementById("id_calle").onchange = function() {
    if (document.getElementById("id_calle").value == "vacio") {
        document.getElementById("id_calle").style.borderColor = 'red';
        document.getElementById("id_calle").focus();
        document.getElementById("valid_calle").innerHTML = 'Ingrese la calle';
    } else {
        document.getElementById("id_calle").style.borderColor = '';
        document.getElementById("valid_calle").innerHTML = '';
    }
}
document.getElementById("direccion_vivienda").onkeyup = function() {
    if (document.getElementById("direccion_vivienda").value == '' || document.getElementById("direccion_vivienda").value == null) {
        document.getElementById("direccion_vivienda").style.borderColor = 'red';
        document.getElementById("direccion_vivienda").focus();
        document.getElementById("valid_direccion").innerHTML = 'Ingrese la dirección';
    } else {
        document.getElementById("direccion_vivienda").style.borderColor = '';
        document.getElementById("valid_direccion").innerHTML = '';
    }
}
document.getElementById("numero_casa").onkeyup = function() {
    if (document.getElementById("numero_casa").value == '' || document.getElementById("numero_casa").value == null) {
        document.getElementById("numero_casa").focus();
        document.getElementById("numero_casa").style.borderColor = 'red';
        document.getElementById("valid_numero_casa").innerHTML = 'Ingrese el nro de casa';
    } else {
        document.getElementById("numero_casa").style.borderColor = '';
        document.getElementById("valid_numero_casa").innerHTML = '';
    }
}
document.getElementById("cantidad_habitaciones").onkeyup = function() {
    if (document.getElementById("cantidad_habitaciones").value == '' || document.getElementById("cantidad_habitaciones").value == null) {
        document.getElementById("cantidad_habitaciones").style.borderColor = 'red';
        document.getElementById("cantidad_habitaciones").focus();
        document.getElementById("valid_cantidad_habitaciones").innerHTML = 'Ingrese la cantidad de habitaciones';
    } else {
        document.getElementById("cantidad_habitaciones").style.borderColor = '';
        document.getElementById("valid_cantidad_habitaciones").innerHTML = '';
    }
}
document.getElementById("id_tipo_vivienda").onkeyup = function() {
    if (document.getElementById("id_tipo_vivienda").value == '' || document.getElementById("id_tipo_vivienda").value == null) {
        document.getElementById("id_tipo_vivienda").style.borderColor = 'red';
        document.getElementById("id_tipo_vivienda").focus();
        document.getElementById("valid_tipo_vivienda").innerHTML = 'Ingrese el tipo de vivienda';
    } else {
        document.getElementById("id_tipo_vivienda").style.borderColor = '';
        document.getElementById("valid_tipo_vivienda").innerHTML = '';
    }
}
document.getElementById("condicion").onchange = function() {
    if (document.getElementById("condicion").value == '0') {
        document.getElementById("condicion").focus();
        document.getElementById("condicion").style.borderColor = 'red';
        document.getElementById("valid_condicion_vivienda").innerHTML = 'Ingrese la condición de la vivienda';
    } else {
        document.getElementById("condicion").style.borderColor = '';
        document.getElementById("valid_condicion_vivienda").innerHTML = '';
    }
}
document.getElementById("agua_consumo").onchange = function() {
    if (document.getElementById("agua_consumo").value == 'vacio') {
        document.getElementById("agua_consumo").style.borderColor = 'red';
        document.getElementById("agua_consumo").focus();
        document.getElementById("valid_agua_consumo").innerHTML = 'Campo vacío';
    } else {
        document.getElementById("agua_consumo").style.borderColor = '';
        document.getElementById("valid_agua_consumo").innerHTML = '';
    }
}
document.getElementById("aguas_negras").onchange = function() {
    if (document.getElementById("aguas_negras").value == '0') {
        document.getElementById("aguas_negras").style.borderColor = 'red';
        document.getElementById("aguas_negras").focus();
        document.getElementById("valid_aguas_negras").innerHTML = 'Campo vacío';
    } else {
        document.getElementById("aguas_negras").style.borderColor = '';
        document.getElementById("valid_aguas_negras").innerHTML = '';
    }
}

function validar_vivienda() {
    var validar = false;
    if (document.getElementById("id_calle").value == "vacio") {
        document.getElementById("id_calle").style.borderColor = 'red';
        document.getElementById("id_calle").focus();
        document.getElementById("valid_calle").innerHTML = 'Ingrese la calle';
    } else {
        document.getElementById("id_calle").style.borderColor = '';
        document.getElementById("valid_calle").innerHTML = '';
        if (document.getElementById("direccion_vivienda").value == '' || document.getElementById("direccion_vivienda").value == null) {
            document.getElementById("direccion_vivienda").style.borderColor = 'red';
            document.getElementById("direccion_vivienda").focus();
            document.getElementById("valid_direccion").innerHTML = 'Ingrese la dirección';
        } else {
            document.getElementById("direccion_vivienda").style.borderColor = '';
            document.getElementById("valid_direccion").innerHTML = '';
            if (document.getElementById("numero_casa").value == '' || document.getElementById("numero_casa").value == null) {
                document.getElementById("numero_casa").focus();
                document.getElementById("numero_casa").style.borderColor = 'red';
                document.getElementById("valid_numero_casa").innerHTML = 'Ingrese el nro de casa';
            } else {
                document.getElementById("numero_casa").style.borderColor = '';
                document.getElementById("valid_numero_casa").innerHTML = '';
                if (document.getElementById("cantidad_habitaciones").value == '' || document.getElementById("cantidad_habitaciones").value == null) {
                    document.getElementById("cantidad_habitaciones").style.borderColor = 'red';
                    document.getElementById("cantidad_habitaciones").focus();
                    document.getElementById("valid_cantidad_habitaciones").innerHTML = 'Ingrese la cantidad de habitaciones';
                } else {
                    document.getElementById("cantidad_habitaciones").style.borderColor = '';
                    document.getElementById("valid_cantidad_habitaciones").innerHTML = '';
                    if (document.getElementById("id_tipo_vivienda").value == '' || document.getElementById("id_tipo_vivienda").value == null) {
                        document.getElementById("id_tipo_vivienda").style.borderColor = 'red';
                        document.getElementById("id_tipo_vivienda").focus();
                        document.getElementById("valid_tipo_vivienda").innerHTML = 'Ingrese el tipo de vivienda';
                    } else {
                        document.getElementById("id_tipo_vivienda").style.borderColor = '';
                        document.getElementById("valid_tipo_vivienda").innerHTML = '';
                        if (document.getElementById("condicion").value == '0') {
                            document.getElementById("condicion").focus();
                            document.getElementById("condicion").style.borderColor = 'red';
                            document.getElementById("valid_condicion_vivienda").innerHTML = 'Ingrese la condición de la vivienda';
                        } else {
                            document.getElementById("condicion").style.borderColor = '';
                            document.getElementById("valid_condicion_vivienda").innerHTML = '';
                            if (document.getElementById("agua_consumo").value == 'vacio') {
                                document.getElementById("agua_consumo").style.borderColor = 'red';
                                document.getElementById("agua_consumo").focus();
                                document.getElementById("valid_agua_consumo").innerHTML = 'Campo vacío';
                            } else {
                                document.getElementById("agua_consumo").style.borderColor = '';
                                document.getElementById("valid_agua_consumo").innerHTML = '';
                                if (document.getElementById("aguas_negras").value == '0') {
                                    document.getElementById("aguas_negras").style.borderColor = 'red';
                                    document.getElementById("aguas_negras").focus();
                                    document.getElementById("valid_aguas_negras").innerHTML = 'Campo vacío';
                                } else {
                                    document.getElementById("aguas_negras").style.borderColor = '';
                                    document.getElementById("valid_aguas_negras").innerHTML = '';
                                    if (document.getElementById("residuos_solidos").value == '0') {
                                        document.getElementById("residuos_solidos").style.borderColor = 'red';
                                        document.getElementById("residuos_solidos").focus();
                                        document.getElementById("valid_residuos_solidos").innerHTML = 'Campo vacío';
                                    } else {
                                        document.getElementById("residuos_solidos").style.borderColor = '';
                                        document.getElementById("valid_residuos_solidos").innerHTML = '';
                                        if (gases_agregados.length == 0) {
                                            swal({
                                                type: "error",
                                                title: "Error",
                                                text: "Agregue al menos un servicio de gas",
                                                showConfirmButton: false,
                                                timer: 2000
                                            });
                                        } else {
                                            if (electrodomesticos_agregados.length == 0) {
                                                swal({
                                                    type: "error",
                                                    title: "Error",
                                                    text: "Agregue al menos un electrodoméstico",
                                                    showConfirmButton: false,
                                                    timer: 2000
                                                });
                                            } else {
                                                validar = true;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    return validar;
}
var techos = [];
var paredes = [];
var pisos = [];
var btn_agregar_techo = document.getElementById("agregar_techo");
var btn_agregar_pared = document.getElementById("agregar_pared");
var btn_agregar_piso = document.getElementById("agregar_piso");
var div_techos = document.getElementById("techos_agregados");
var div_paredes = document.getElementById("paredes_agregados");
var div_pisos = document.getElementById("pisos_agregados");
var techos_input = document.getElementById("tipo_techo");
var paredes_input = document.getElementById("tipo_pared");
var pisos_input = document.getElementById("tabla_piso");
var valid_techos = document.getElementById("valid_techos");
var valid_paredes = document.getElementById("valid_paredes");
var valid_pisos = document.getElementById("valid_pisos");
btn_agregar_techo.onclick = function() {
    if ((techos_input.style.display != 'none' && techos_input.value == '')) {
        valid_techos.innerHTML = 'Debe ingresar un techo';
        techos_input.style.borderColor = 'red';
        techos_input.focus();
    } else {
        valid_techos.innerHTML = '';
        techos_input.style.borderColor = '';
        var tipos_techos = new Object();
        var texto_techos = "";
        tipos_techos['id_tipo_techo'] = techos_input.value;
        texto_techos = techos_input.value;
        var div = document.createElement("div");
        var table = document.createElement("table");
        table.style.width = '100%';
        var tr = document.createElement("tr");
        var td1 = document.createElement("td");
        var td2 = document.createElement("td");
        var td3 = document.createElement("td");
        td3.style.textAlign = 'right';
        td1.innerHTML = texto_techos;
        techos_input.value = '';
        var button = document.createElement("input");
        button.type = 'button';
        button.value = 'X';
        button.className = 'btn btn-danger';
        td3.appendChild(button);
        tr.appendChild(td1);
        tr.appendChild(td2);
        tr.appendChild(td3);
        table.appendChild(tr);
        div.appendChild(table);
        var hr = document.createElement("hr");
        techos.push(tipos_techos);
        div.appendChild(hr);
        div_techos.appendChild(div);
        button.onclick = function() {
            div_techos.removeChild(div);
            techos.splice(techos.indexOf(tipos_techos), 1);
        }
    }
}
btn_agregar_pared.onclick = function() {
    if ((paredes_input.style.display != 'none' && paredes_input.value == '')) {
        valid_paredes.innerHTML = 'Debe ingresar una pared';
        paredes_input.style.borderColor = 'red';
        paredes_input.focus();
    } else {
        valid_paredes.innerHTML = '';
        paredes_input.style.borderColor = '';
        var tipos_pared = new Object();
        var texto_pared = "";
        tipos_pared['id_tipo_pared'] = paredes_input.value;
        texto_pared = paredes_input.value;
        var div = document.createElement("div");
        var table = document.createElement("table");
        table.style.width = '100%';
        var tr = document.createElement("tr");
        var td1 = document.createElement("td");
        var td2 = document.createElement("td");
        var td3 = document.createElement("td");
        td3.style.textAlign = 'right';
        td1.innerHTML = texto_pared;
        paredes_input.value = '';
        var button = document.createElement("input");
        button.type = 'button';
        button.value = 'X';
        button.className = 'btn btn-danger';
        td3.appendChild(button);
        tr.appendChild(td1);
        tr.appendChild(td2);
        tr.appendChild(td3);
        table.appendChild(tr);
        div.appendChild(table);
        var hr = document.createElement("hr");
        paredes.push(tipos_pared);
        div.appendChild(hr);
        div_paredes.appendChild(div);
        button.onclick = function() {
            div_paredes.removeChild(div);
            paredes.splice(paredes.indexOf(tipos_pared), 1);
        }
    }
}
btn_agregar_piso.onclick = function() {
    if ((pisos_input.style.display != 'none' && pisos_input.value == '')) {
        valid_pisos.innerHTML = 'Debe ingresar una pared';
        pisos_input.style.borderColor = 'red';
        pisos_input.focus();
    } else {
        valid_pisos.innerHTML = '';
        pisos_input.style.borderColor = '';
        var tipos_piso = new Object();
        var texto_piso = "";
        tipos_piso['id_tipo_piso'] = pisos_input.value;
        texto_piso = pisos_input.value;
        var div = document.createElement("div");
        var table = document.createElement("table");
        table.style.width = '100%';
        var tr = document.createElement("tr");
        var td1 = document.createElement("td");
        var td2 = document.createElement("td");
        var td3 = document.createElement("td");
        td3.style.textAlign = 'right';
        td1.innerHTML = texto_piso;
        pisos_input.value = '';
        var button = document.createElement("input");
        button.type = 'button';
        button.value = 'X';
        button.className = 'btn btn-danger';
        td3.appendChild(button);
        tr.appendChild(td1);
        tr.appendChild(td2);
        tr.appendChild(td3);
        table.appendChild(tr);
        div.appendChild(table);
        var hr = document.createElement("hr");
        pisos.push(tipos_piso);
        div.appendChild(hr);
        div_pisos.appendChild(div);
        button.onclick = function() {
            div_pisos.removeChild(div);
            pisos.splice(pisos.indexOf(tipos_piso), 1);
        }
    }
}
$(document).ready(function() {
    $("#gas").on("change", function() {
        var value = $("#gas").val();
        if (value == "1") {
            $("#tabla_gas").modal('show');
        }
    });
    $(document).on('click', '#guardar', function() {
       
        var inf_servicio = new Object();
        inf_servicio['agua_consumo'] = document.getElementById("agua_consumo").value;
        inf_servicio['aguas_negras'] = document.getElementById("aguas_negras").value;
        inf_servicio['residuos_solidos'] = document.getElementById("residuos_solidos").value;
        inf_servicio['cable_telefonico'] = document.getElementById("cable_telefonico").value;
        inf_servicio['internet'] = document.getElementById("internet").value;
        inf_servicio['servicio_electrico'] = document.getElementById("servicio_electrico").value;
        inf_servicio['estado'] = 1;
        var info_vivienda = new Object();
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
        info_vivienda['estado'] = 1;
        if (validar_vivienda()) {
            $.ajax({
                url: BASE_URL + "Viviendas/Administrar",
                type: "POST",
                data: {
                    peticion: "Registrar",
                    sql: "SQL_10",
                    vivienda: info_vivienda,
                    accion: "La vivienda: " + document.getElementById("numero_casa").value + " fue Registrada exitosamente.",
                },
            }).done(function(datos) {
                console.log(datos)
                if (datos == 1) {
                    swal({
                        title: "Registrado!",
                        text: "El elemento fue Registrado con exito.",
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
            // $.ajax({
            //     type: 'POST',
            //     url: BASE_URL + 'Viviendas/Asignar_Servicios',
            //     data: {
            //         'datos': datos
            //     }
            // }).done(function(id) {
            //     console.log(id);
            //     var id_servicio = id;
            //     $.ajax({
            //         type: 'POST',
            //         url: BASE_URL + 'Viviendas/Nueva_Vivienda',
            //         data: {
            //             'datos': datos,
            //             'id_servicio': id_servicio
            //         }
            //     }).done(function(datos) {
            //         console.log(datos);
            //         $.ajax({
            //             type: 'POST',
            //             url: BASE_URL + 'Viviendas/Techo_Pared_Piso',
            //             data: {
            //                 'tipo_techo': tipo_techo,
            //                 'tipo_pared': tipo_pared,
            //                 'tipo_piso': tipo_piso,
            //             }
            //         }).done(function(datos) {
            //             console.log(datos);
            //             $.ajax({
            //                 type: 'POST',
            //                 url: BASE_URL + 'Viviendas/Electrodomesticos_Gases',
            //                 data: {
            //                     'electrodomesticos': electrodomesticos_agregados,
            //                     'gases': gases_agregados,
            //                 }
            //             }).done(function(datos) {
            //                 console.log(datos);
            //                 swal({
            //                     title: "Éxito",
            //                     text: "La vivienda fue guardada con éxito",
            //                     type: "success",
            //                     timer: 2000,
            //                     showConfirmButton: false
            //                 });
            //                 setTimeout(function() {
            //                     location.href = BASE_URL + "Viviendas/Consultas";
            //                 }, 1000);
            //             }).fail(function() {
            //                 alert("error")
            //             })
            //         }).fail(function() {
            //             alert("error")
            //         })
            //     }).fail(function() {
            //         alert("error")
            //     })
            // }).fail(function() {
            //     alert("error")
            // })
        }
    });
});