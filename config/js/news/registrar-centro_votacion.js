document.getElementById('enviar').onclick = function () {
    if (document.getElementById('cedula_persona').value == '' || document.getElementById('cedula_persona').value == null) {
        document.getElementById('cedula_persona').focus();
        document.getElementById('cedula_persona').style.borderColor = 'red';
        document.getElementById('cedula').innerHTML = "Debe ingresar la cédula de la persona";
    }
    else {
        document.getElementById('cedula_persona').blur();
        document.getElementById('cedula_persona').style.borderColor = '';
        document.getElementById('cedula').innerHTML = "";
        var valid = false;

        for (var opt of document.getElementById('cedula_p').options) {
            if (opt.value == document.getElementById('cedula_persona').value) {
                valid = true;
            }
        }


        if (!valid) {
            document.getElementById('cedula_persona').focus();
            document.getElementById('cedula_persona').style.borderColor = 'red';
            document.getElementById('cedula').innerHTML = "La cédula que intenta ingresar no está registrada";

        }
        else {
            $.ajax({
                type: "POST",
                url: BASE_URL + "app/Direcciones.php",
                data: {
                    direction: 'Centro_Votacion/Administrar',
                    accion: "codificar"
                },
                success: function (direccion_segura) {
                    $.ajax({
                        type: 'POST',
                        url: BASE_URL + direccion_segura,
                        data: {
                            datos: document.getElementById('cedula_persona').value,
                            peticion: "Consultar_votante"
                        }
                    }).done(function (result) {
                        if (result != 0) {
                            document.getElementById('cedula_persona').focus();
                            document.getElementById('cedula_persona').style.borderColor = 'red';
                            document.getElementById('cedula').innerHTML = "Ya esta persona fue asignada como votante";
                        }
                        else {
                            document.getElementById('cedula_persona').blur();
                            document.getElementById('cedula_persona').style.borderColor = '';
                            document.getElementById('cedula').innerHTML = "";

                            if (document.getElementById('nombre_centro').value == '' || document.getElementById('nombre_centro').value == null) {
                                document.getElementById('nombre_centro').style.borderColor = 'red';
                                document.getElementById('nombre_centro').focus();
                                document.getElementById('nombre').innerHTML = 'Debe ingresar un centro de votación';
                            }
                            else {
                                document.getElementById('nombre_centro').style.borderColor = '';
                                document.getElementById('nombre_centro').blur();
                                document.getElementById('nombre').innerHTML = '';

                                if (document.getElementById('id_parroquia').value == 0) {
                                    document.getElementById('id_parroquia').style.borderColor = 'red';
                                    document.getElementById('parroquia').innerHTML = 'Seleccione una parroquia';
                                }

                                else {
                                    var datos = new Object();
                                    var existe = 0;
                                    var opciones = document.getElementById('centro').querySelectorAll('option');
                                    datos['persona'] = document.getElementById('cedula_persona').value;
                                    datos['parroquia'] = document.getElementById('id_parroquia').value;
                                    for (var opt of opciones) {
                                        if (opt.value.toLowerCase() == document.getElementById('nombre_centro').value.toLowerCase()) {
                                            existe = 1;
                                        }
                                    }

                                    datos['centro_existente'] = existe;
                                    datos['nombre_centro'] = document.getElementById('nombre_centro').value;

                                    $.ajax({
                                        type: "POST",
                                        url: BASE_URL + "app/Direcciones.php",
                                        data: {
                                            direction: 'Centro_Votacion/Administrar',
                                            accion: "codificar"
                                        },
                                        success: function (direccion_segura) {
                                            $.ajax({
                                                type: 'POST',
                                                url: BASE_URL + direccion_segura,
                                                data: {
                                                    datos: datos,
                                                    accion: "Se ha Asignado" + cedula_persona + " al centro " + nombre_centro,
                                                    sql: "SQL_03",
                                                    peticion: "Registrar"
                                                }
                                            }).done(function (result) {
                                                if (result) {
                                                    swal({
                                                        title: "Registrado!",
                                                        text: "El elemento fue Registrado con exito.",
                                                        type: "success",
                                                        showConfirmButton: false
                                                    });
                                                    Direccionar("Centro_Votacion/Administrar/Consultas");
                                                }
                                            });

                                        }
                                    });
                                }

                            }
                        }
                    });

                }
            });
        }

    }
}


document.getElementById('nombre_centro').onchange=function(){
    var opt_input = document.getElementById('centro').querySelectorAll('option');
    var opt_parroquias = document.getElementById('id_parroquia').querySelectorAll('option');
    var opt_selected = '';
    for(var i = 0 ; i < opt_input.length; i++) {
        if(opt_input[i].value == document.getElementById('nombre_centro').value) {
            opt_selected = opt_input[i]; 
        }
    }

    opt_selected = opt_selected.querySelector('span').innerHTML;

        for(var j = 0; j<opt_parroquias.length; j++) {
            if(opt_parroquias[j].label == opt_selected){
                document.getElementById('id_parroquia').value = opt_parroquias[j].value;
            }
        }
}

window.addEventListener("keypress", function(event){
    if (event.keyCode == 13){
        event.preventDefault();
    }
}, false);

