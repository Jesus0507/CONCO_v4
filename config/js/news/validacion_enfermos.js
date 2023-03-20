var persona = document.getElementById('persona');
var valid_persona = document.getElementById("valid_persona");
var btn_seleccionar = document.getElementById("seleccionar_persona");
var span_persona = document.getElementById("nombre_persona");
var div_info = document.getElementById("second");
var registrar_btn = document.getElementById("registrar_btn");
var btn_guardar = document.getElementById("guardar");
var enfermedad_input = document.getElementById("enfermedad_input");
var enfermedad_select = document.getElementById("enfermedad_select");
var btn_nueva_enfermedad = document.getElementById("btn_nueva_enfermedad");
var valid_enfermedad = document.getElementById("valid_enfermedad");
var medicamentos = document.getElementById("medicamentos");
var btn_agregar = document.getElementById("agregar");
var enfermedades = [];
var div_enfermedaedes = document.getElementById("enfermedades_agregadas");
enfermedad_select.onchange = function () {
    if (enfermedad_select.value == 'vacio') {
        valid_enfermedad.innerHTML = 'Ingrese la enfermedad';
        enfermedad_select.style.borderColor = 'red';
        enfermedad_select.focus();
    } else {
        valid_enfermedad.innerHTML = '';
        enfermedad_select.style.borderColor = '';
    }
}
enfermedad_input.onchange = function () {
    if (enfermedad_input.value == '') {
        valid_enfermedad.innerHTML = 'Ingrese la enfermedad';
        enfermedad_input.style.borderColor = 'red';
        enfermedad_input.focus();
    } else {
        valid_enfermedad.innerHTML = '';
        enfermedad_input.style.borderColor = '';
    }
}
btn_nueva_enfermedad.onclick = function () {
    if (enfermedad_input.style.display == 'none') {
        valid_enfermedad.innerHTML = '';
        enfermedad_input.style.display = '';
        enfermedad_select.style.display = 'none';
        enfermedad_select.value = 'vacio';
        enfermedad_input.focus();
        btn_nueva_enfermedad.innerHTML = 'Atrás';
    } else {
        valid_enfermedad.innerHTML = '';
        enfermedad_input.style.display = 'none';
        enfermedad_select.style.display = '';
        enfermedad_input.value = '';
        enfermedad_select.focus();
        btn_nueva_enfermedad.innerHTML = 'Nueva enfermedad';
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
                direction: "Enfermos/Administrar",
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
                    if (result == 0) {
                        valid_persona.innerHTML = "Esta persona no se encuentra registrada";
                    } else {
                        if(result == 1 ){
                            valid_persona.innerHTML = "Esta persona ya posee patologías agregadas";
                        }
                        else {
                        valid_persona.innerHTML = "";
                        var datos = JSON.parse(result);
                        span_persona.innerHTML = datos[0]['primer_nombre'] + " " + datos[0]['primer_apellido'];
                        persona.disabled = 'disabled';
                        btn_seleccionar.style.display = 'none';
                        div_info.style.display = '';
                        //    registrar_btn.style.display = 'none';
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
btn_agregar.onclick = function () {
    if ((enfermedad_input.style.display != 'none' && enfermedad_input.value == '') || (enfermedad_input.style.display == 'none' && enfermedad_select.value == 'vacio')) {
        valid_enfermedad.innerHTML = 'Ingrese la enfermedad';
        enfermedad_input.style.borderColor = 'red';
        enfermedad_input.focus();
    } else {
        var agregado = false;
        for (var i = 0; i < enfermedades.length; i++) {
            if (enfermedad_input.style.display != 'none') {
                if (enfermedades[i]['enfermedad'].toLowerCase() == enfermedad_input.value.toLowerCase()) {
                    agregado = true;
                }

                if (!agregado) {
                    var opt_select = enfermedad_select.options;
                    for (var j = 0; j < opt_select.length; j++) {
                        if (opt_select[j].label.toLowerCase() == enfermedad_input.value.toLowerCase()) {
                            if (opt_select[j].value == enfermedades[i]['enfermedad']) {
                                agregado = true;
                            }
                        }
                    }
                }
            }

            else {
                if (enfermedad_select.value == enfermedades[i]['enfermedad']) {
                    agregado = true;
                }

                if (!agregado) {
                    if (enfermedad_select.options[enfermedad_select.selectedIndex].text.toLowerCase() == enfermedades[i]['enfermedad'].toLowerCase()) {
                        agregado = true;
                    }
                }
            }
        }

        if (agregado) {
            valid_enfermedad.innerHTML = 'Esta enfermedad ya fue agregada';
            enfermedad_input.style.borderColor = 'red';
        }
        else {
            valid_enfermedad.innerHTML = '';
            enfermedad_input.style.borderColor = '';
            var enfer = new Object();
            var textoEnfermedad = "";
            var textoMedicamento = medicamentos.value;
            enfermedad_input.style.display != 'none' ? enfer['enfermedad'] = enfermedad_input.value : enfer['enfermedad'] = enfermedad_select.value;
            enfermedad_input.style.display != 'none' ? textoEnfermedad = enfermedad_input.value : textoEnfermedad = enfermedad_select.options[enfermedad_select.selectedIndex].text;
            enfermedad_input.style.display != 'none' ? enfer['nuevo'] = '1' : enfer['nuevo'] = '0';
            textoMedicamento == '' ? enfer['medicamentos'] = "No posee" : enfer['medicamentos'] = textoMedicamento;
            var div_padre = document.createElement("div");
            div_padre.className = 'w-100';
            var div_hijo = document.createElement("div");
            div_hijo.style.width = '80%';
            div_hijo.style.marginTop = '20px';
            div_hijo.className = 'd-flex flex-row justify-content-between';
            var div1 = document.createElement("div");
            var div2 = document.createElement("div");
            var div3 = document.createElement("div");
            div1.innerHTML = textoEnfermedad;
            div2.innerHTML = medicamentos.value;
            medicamentos.value = '';
            enfermedad_select.value = 'vacio';
            enfermedad_input.value = '';
            var button = document.createElement("input");
            button.type = 'button';
            button.value = 'X';
            button.className = 'btn btn-danger';
            div3.appendChild(button);
            div_hijo.appendChild(div1);
            div_hijo.appendChild(div2);
            div_hijo.appendChild(div3);
            div_padre.appendChild(div_hijo);
            var hr = document.createElement("hr");
            div_padre.appendChild(hr);
            enfermedades.push(enfer);
            div_enfermedaedes.appendChild(div_padre);
            button.onclick = function () {
                div_enfermedaedes.removeChild(div_padre);
                enfermedades.splice(enfermedades.indexOf(enfer), 1);
            }
        }
    }
}
btn_guardar.onclick = function () {
    if (enfermedades.length == 0) {
        swal({
            type: "error",
            title: "Error",
            text: "Ingrese al menos una enfermedad",
            timer: 2000,
            showConfirmButton: false
        })
    } else {
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
                    data: {
                        "cedula": persona.value,
                        "enfermedades": enfermedades,
                        peticion: "Registrar",
                        sql: "SQL_05",
                        accion: "Se ha Registrado el  Enfermos pordator de la Cedula: " + $('#cedula').val(),
                    },
                }).done(function (result) {
                    if (result == 1) {
                        swal({
                            title: "Registrado!",
                            text: "El elemento fue Registrado con exito.",
                            type: "success",
                            showConfirmButton: false
                        });
                        Direccionar("Enfermos/Administrar/Consultas");
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
}