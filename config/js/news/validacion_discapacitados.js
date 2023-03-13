var persona = document.getElementById('persona');
var valid_persona = document.getElementById("valid_persona");
var btn_seleccionar = document.getElementById("seleccionar_persona");
var span_persona = document.getElementById("nombre_persona");
var div_info = document.getElementById("second");
var registrar_btn = document.getElementById("registrar_btn");
var btn_guardar = document.getElementById("guardar");
var discapacidad_input = document.getElementById("discapacidad_input");
var discapacidad_select = document.getElementById("discapacidad_select");
var btn_nueva_discapacidad = document.getElementById("btn_nueva_discapacidad");
var valid_discapacidad = document.getElementById("valid_discapacidad");
var en_cama = document.getElementById("en_cama");
var btn_agregar = document.getElementById("agregar");
var discapacidades = [];
var div_discapacidades = document.getElementById("discapacidades_agregadas");
var necesidades = document.getElementById("necesidades");
var observaciones = document.getElementById("observaciones");
discapacidad_select.onchange = function () {
    if (discapacidad_select.value == 'vacio') {
        valid_discapacidad.innerHTML = 'Ingrese la discapacidad';
        discapacidad_select.style.borderColor = 'red';
        discapacidad_select.focus();
    } else {
        valid_discapacidad.innerHTML = '';
        discapacidad_select.style.borderColor = '';
    }
}
discapacidad_input.onchange = function () {
    if (discapacidad_input.value == '') {
        valid_discapacidad.innerHTML = 'Ingrese la discapacidad';
        discapacidad_input.style.borderColor = 'red';
        discapacidad_input.focus();
    } else {
        valid_discapacidad.innerHTML = '';
        discapacidad_input.style.borderColor = '';
    }
}
btn_nueva_discapacidad.onclick = function () {
    if (discapacidad_input.style.display == 'none') {
        valid_discapacidad.innerHTML = '';
        discapacidad_input.style.display = '';
        discapacidad_select.style.display = 'none';
        discapacidad_select.value = 'vacio';
        discapacidad_input.focus();
        btn_nueva_discapacidad.innerHTML = 'Atrás';
    } else {
        valid_discapacidad.innerHTML = '';
        discapacidad_input.style.display = 'none';
        discapacidad_select.style.display = '';
        discapacidad_input.value = '';
        discapacidad_select.focus();
        btn_nueva_discapacidad.innerHTML = 'Nueva discapacidad';
    }
}
persona.onkeyup = function () {
    if (persona.value == '' || persona.value == null) {
        valid_persona.innerHTML = "Debe ingresar una persona";
        persona.focus();
        persona.style.borderColor = 'red';
    } else {
        valid_persona.innerHTML = "";
        persona.focus();
        persona.style.borderColor = '';
    }
}
btn_seleccionar.onclick = function () {
    if (persona.value == '' || persona.value == null) {
        valid_persona.innerHTML = "Debe ingresar una persona";
        persona.focus();
        persona.style.borderColor = 'red';
    } else {
        valid_persona.innerHTML = "";
        persona.focus();
        persona.style.borderColor = '';
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
                    data: {
                        peticion: "Personas",
                        "cedula": persona.value
                    },
                }).done(function (result) {
                    // revisar(result)
                    if (result == 0) {
                        valid_persona.innerHTML = "Esta persona no se encuentra registrada";
                    } else {
                        if(result == 1 ) {
                            valid_persona.innerHTML = "Esta persona ya posee discapacidades agregadas";
                        }
                        else {
                            persona.disabled = 'disabled';
                            valid_persona.innerHTML = "";
                            var datos = JSON.parse(result);
                            span_persona.innerHTML = datos[0]['primer_nombre'] + " " + datos[0]['primer_apellido'];
                            // persona.disabled = 'disabled';
                            btn_seleccionar.style.display = 'none';
                            div_info.style.display = '';
                            // registrar_btn.style.display = 'none';
                        }
                    }
                })
            },
            error: function () {
                alert('Error al codificar dirreccion');
            }
        });
    }
}
en_cama.onchange = function () {
    if (en_cama.value == 'vacio') {
        valid_discapacidad.innerHTML = 'Indique si está en cama';
        en_cama.style.borderColor = 'red';
        en_cama.focus();
    } else {
        valid_discapacidad.innerHTML = '';
        en_cama.style.borderColor = '';
    }
}
btn_agregar.onclick = function () {
    if ((discapacidad_input.style.display != 'none' && discapacidad_input.value == '') || (discapacidad_input.style.display == 'none' && discapacidad_select.value == 'vacio')) {
        valid_discapacidad.innerHTML = 'Ingrese la discapacidad';
        discapacidad_input.style.borderColor = 'red';
        discapacidad_input.focus();
    } else {
        valid_discapacidad.innerHTML = '';
        discapacidad_input.style.borderColor = '';
        if (en_cama.value == 'vacio') {
            valid_discapacidad.innerHTML = 'Indique si está en cama';
            en_cama.style.borderColor = 'red';
            en_cama.focus();
        } else {
            var agregado = false;

            for (var i = 0; i < discapacidades.length; i++) {
                if (discapacidad_input.style.display != 'none') {
                    if (discapacidades[i]['discapacidad'].toLowerCase() == discapacidad_input.value.toLowerCase()) {
                        agregado = true;
                    }

                    if (!agregado) {
                        var opt_select = discapacidad_select.options;
                        for (var j = 0; j < opt_select.length; j++) {
                            if (opt_select[j].label.toLowerCase() == discapacidad_input.value.toLowerCase()) {
                                if (opt_select[j].value == discapacidades[i]['discapacidad']) {
                                    agregado = true;
                                }
                            }
                        }
                    }
                }

                else {
                    if (discapacidad_select.value == discapacidades[i]['discapacidad']) {
                        agregado = true;
                    }

                    if (!agregado) {
                        if (discapacidad_select.options[discapacidad_select.selectedIndex].text.toLowerCase() == discapacidades[i]['discapacidad'].toLowerCase()) {
                            agregado = true;
                        }
                    }
                }
            }

            if (agregado) {
                valid_discapacidad.innerHTML = 'Esta discapacidad ya fue agregada';
                discapacidad_input.style.borderColor = 'red';
            }
            else {
                valid_discapacidad.innerHTML = '';
                en_cama.style.borderColor = '';
                var disc = new Object();
                var textoDiscapacidad = "";
                var textoNecesidades = necesidades.value;
                var textoObservaciones = observaciones.value;
                var textoEnCama = en_cama.options[en_cama.selectedIndex].text;
                var en_cama_valor = en_cama.value;
                discapacidad_input.style.display != 'none' ? disc['discapacidad'] = discapacidad_input.value : disc['discapacidad'] = discapacidad_select.value;
                discapacidad_input.style.display != 'none' ? textoDiscapacidad = discapacidad_input.value : textoDiscapacidad = discapacidad_select.options[discapacidad_select.selectedIndex].text;
                discapacidad_input.style.display != 'none' ? disc['nuevo'] = '1' : disc['nuevo'] = '0';
                disc['en_cama'] = en_cama_valor;
                textoNecesidades == '' ? disc['necesidades'] = "No posee" : disc['necesidades'] = textoNecesidades;
                textoObservaciones == '' ? disc['observaciones'] = "No posee" : disc['observaciones'] = textoNecesidades;
                var div_padre = document.createElement("div");
                var div_hijo = document.createElement("table");
                div_padre.style.width = '100%';
                div_hijo.style.width = '90%';
                div_hijo.className = 'mx-auto d-flex flex-row justify-content-between';
                div_hijo.style.marginTop = '20px';
                var div1 = document.createElement("div");
                var div2 = document.createElement("div");
                var div3 = document.createElement("div");
                var div4 = document.createElement("div");
                var div5 = document.createElement("div");
                div1.innerHTML = textoDiscapacidad;
                div2.innerHTML = textoEnCama;
                div3.innerHTML = textoNecesidades;
                div4.innerHTML = textoObservaciones;
                necesidades.value = '';
                observaciones.value = '';
                discapacidad_select.value = 'vacio';
                discapacidad_input.value = '';
                en_cama.value = 'vacio';
                var button = document.createElement("input");
                button.type = 'button';
                button.value = 'X';
                button.className = 'btn btn-danger';
                div1.style.width = div2.style.width = div3.style.width = div4.style.width = div5.style.width = '20%';
                div1.style.textAlign = div2.style.textAlign = div3.style.textAlign = div4.style.textAlign = div5.style.textAlign = 'center';
                div5.appendChild(button);
                div_hijo.appendChild(div1);
                div_hijo.appendChild(div2);
                div_hijo.appendChild(div3);
                div_hijo.appendChild(div4);
                div_hijo.appendChild(div5);
                div_padre.appendChild(div_hijo);
                var hr = document.createElement("hr");
                discapacidades.push(disc);
                div_padre.appendChild(hr);
                div_discapacidades.appendChild(div_padre);
                button.onclick = function () {
                    div_discapacidades.removeChild(div_padre);
                    discapacidades.splice(discapacidades.indexOf(disc), 1);
                }
            }
        }
    }
}
btn_guardar.onclick = function () {
    if (discapacidades.length == 0) {
        swal({
            type: "error",
            title: "Error",
            text: "Ingrese al menos una discapacidad",
            timer: 2000,
            showConfirmButton: false
        })
    } else {
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
                    data: {
                        cedula: persona.value,
                        discapacidades: discapacidades,
                        peticion: "Administrar",
                        sql: "SQL_06",
                        accion: "Se ha Registrado el  Discapacitado pordator de la Cedula: " + $('#cedula').val(),
                    },
                }).done(function (result) {
                    if (result == 1) {
                        swal({
                            title: "Registrado!",
                            text: "El elemento fue Registrado con exito.",
                            type: "success",
                            showConfirmButton: false
                        });
                        Direccionar("Discapacitados/Administrar/Consultas");
                    } else {
                        swal({
                            title: "ERROR!",
                            text: result,
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
}