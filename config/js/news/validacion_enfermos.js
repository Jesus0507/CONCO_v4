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
enfermedad_select.onchange = function() {
    if (enfermedad_select.value == 'vacio') {
        valid_enfermedad.innerHTML = 'Ingrese la enfermedad';
        enfermedad_select.style.borderColor = 'red';
        enfermedad_select.focus();
    } else {
        valid_enfermedad.innerHTML = '';
        enfermedad_select.style.borderColor = '';
    }
}
enfermedad_input.onchange = function() {
    if (enfermedad_input.value == '') {
        valid_enfermedad.innerHTML = 'Ingrese la enfermedad';
        enfermedad_input.style.borderColor = 'red';
        enfermedad_input.focus();
    } else {
        valid_enfermedad.innerHTML = '';
        enfermedad_input.style.borderColor = '';
    }
}
btn_nueva_enfermedad.onclick = function() {
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
persona.onkeyup = function() {
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
btn_seleccionar.onclick = function() {
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
            url: BASE_URL + "Enfermos/Administrar",
            data: {
                peticion: "Personas",
                "cedula": persona.value
            },
        }).done(function(result) {
            if (result == 0) {
                valid_persona.innerHTML = "Esta persona no se encuentra registrada";
            } else {
                valid_persona.innerHTML = "";
                var datos = JSON.parse(result);
                span_persona.innerHTML = datos[0]['primer_nombre'] + " " + datos[0]['primer_apellido'];
                persona.disabled = 'disabled';
                btn_seleccionar.style.display = 'none';
                div_info.style.display = '';
                registrar_btn.style.display = 'none';
            }
        })
    }
}
btn_agregar.onclick = function() {
    if ((enfermedad_input.style.display != 'none' && enfermedad_input.value == '') || (enfermedad_input.style.display == 'none' && enfermedad_select.value == 'vacio')) {
        valid_enfermedad.innerHTML = 'Ingrese la enfermedad';
        enfermedad_input.style.borderColor = 'red';
        enfermedad_input.focus();
    } else {
        valid_enfermedad.innerHTML = '';
        enfermedad_input.style.borderColor = '';
        var enfer = new Object();
        var textoEnfermedad = "";
        var textoMedicamento = medicamentos.value;
        enfermedad_input.style.display != 'none' ? enfer['enfermedad'] = enfermedad_input.value : enfer['enfermedad'] = enfermedad_select.value;
        enfermedad_input.style.display != 'none' ? textoEnfermedad = enfermedad_input.value : textoEnfermedad = enfermedad_select.options[enfermedad_select.selectedIndex].text;
        enfermedad_input.style.display != 'none' ? enfer['nuevo'] = '1' : enfer['nuevo'] = '0';
        textoMedicamento == '' ? enfer['medicamentos'] = "No posee" : enfer['medicamentos'] = textoMedicamento;
        var div = document.createElement("div");
        var table = document.createElement("table");
        table.style.width = '100%';
        var tr = document.createElement("tr");
        var td1 = document.createElement("td");
        var td2 = document.createElement("td");
        var td3 = document.createElement("td");
        td3.style.textAlign = 'right';
        td1.innerHTML = textoEnfermedad;
        td2.innerHTML = medicamentos.value;
        medicamentos.value = '';
        enfermedad_select.value = 'vacio';
        enfermedad_input.value = '';
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
        enfermedades.push(enfer);
        div.appendChild(hr);
        div_enfermedaedes.appendChild(div);
        console.log(enfermedades);
        button.onclick = function() {
            div_enfermedaedes.removeChild(div);		
            enfermedades.splice(enfermedades.indexOf(enfer), 1);
            console.log(enfermedades);
        }
    }
}
btn_guardar.onclick = function() {
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
            url: BASE_URL + "Enfermos/Administrar",
            data: {
                "cedula": persona.value,
                "enfermedades": enfermedades,	
                peticion: "Registrar",
                sql: "SQL_05",
                accion: "Se ha Registrado el  Enfermos pordator de la Cedula: " + $('#cedula').val(),
            },
        }).done(function(result) {
            if (result == 1) {
                swal({
                    title: "Registrado!",
                    text: "El elemento fue Registrado con exito.",
                    type: "success",
                    showConfirmButton: false
                });
                setTimeout(function() {
                    location.href = BASE_URL + "Enfermos/Administrar/Consultas"
                }, 1000);
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