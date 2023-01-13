$(document).ready(function() {
    document.getElementById("cedula").focus();
    Limpiar_Mensajes();
    $("#mostrar").click(function() {
        var ver = document.getElementById("contrasenia");
        if (ver.type === "password") {
            $(".contraseña").attr("type", "text");
            document.getElementById("ojito").className = "fa fa-eye-slash";
            $(".contraseña").focus();
        } else {
            $(".contraseña").attr("type", "password");
            $(".contraseña").focus();
            document.getElementById("ojito").className = "fa fa-eye";
        }
    });
    $("#enviar").on("click", function() {
        envioFormulario();
    });
    document.onkeypress = function(e) {
        if (e.which == 13 || e.keyCode == 13) {
            envioFormulario();
            return false;
        } else {
            return true;
        }
    };
});

function envioFormulario() {
    var errores = "";
    var form = $("#formulario_login");
    if (Validar_Datos()) {
        $.ajax({
            type: "POST",
            url: BASE_URL + "app/Direcciones.php",
            data: {
                direction: "Personas/Usuario_Existente",
                accion: "codificar"
            },
            success: function(direccion_segura) {
                $.ajax({
                    type: "POST",
                    url: BASE_URL + direccion_segura,
                    data: {
                        cedula: $("#cedula").val(),
                        contrasenia: $("#contrasenia").val(),
                        captcha: $("#captcha_code").val(),
                    },
                    beforeSend: function() {
                        $("#enviar").text("Enviando...");
                        $("#enviar").attr("disabled", true);
                    },
                    complete: function(respuesta) {
                        $("#enviar").text("Entrar");
                        $("#enviar").attr("disabled", false);
                    },
                    success: function(respuesta) {
                        Respuesta_Controlador(respuesta, form);
                    },
                    error: function(respuesta) {
                        alert("Error al enviar Controlador");
                    },
                });
            },
            error: function() {
                alert('Error al codificar dirreccion');
            }
        });
    }
}

function Validar_Datos() {
    var cedula = document.getElementById("cedula");
    var msjCedula = document.getElementById("mensaje-cedula");
    var clave = document.getElementById("contrasenia");
    var msjClave = document.getElementById("mensaje-contrasenia");
    var captcha = document.getElementById("captcha_code");
    var msjCaptcha = document.getElementById("texto");
    var retornar = false;
    if (cedula.value == "" || cedula.value == null) {
        msjCedula.innerHTML = "Debe ingresar su cédula.";
        cedula.focus();
        cedula.style.borderColor = "red";
    } else {
        if (contrasenia.value == "" || contrasenia.value == null) {
            msjClave.innerHTML = "Debe ingresar su contraseña.";
            contrasenia.focus();
            contrasenia.style.borderColor = "red";
        } else {
            if (captcha.value == "" || captcha.value == null) {
                msjCaptcha.innerHTML = "Debe ingresar el captcha.";
                captcha.focus();
                captcha.style.borderColor = "red";
            } else {
                retornar = true;
            }
        }
    }
    return retornar;
}

function Respuesta_Controlador(respuesta, form) {
    console.log(respuesta);
    switch (respuesta) {
        case '0':
            $("#cedula").css("border-color", "#F14B4B");
            $("#cedula").focus();
            $("#mensaje-cedula").html("Usuario No Registrado.");
            break;
        case '1':
            $("#contrasenia").blur();
            form.serialize();
            form.submit();
            break;
        case '2':
            if ($("#captcha_code").val() == "") {
                errores = "Debe ingresar el codigo de seguridad.";
                $("#captcha_code").css("border-color", "#F14B4B");
                $("#texto").html(errores);
            } else {
                $("#captcha_code").css("border-color", "#F14B4B");
                $("#captcha_code").focus();
                $("#texto").html("Captcha Inconrrecto, Inntente de Nuevo.");
            }
            break;
        case '3':
            swal({
                type: "warning",
                title: "Atención",
                text: "Ha intentado iniciar sesión erróneamente demasiadas veces, por favor ingrese las preguntas de seguridad para poder cambiar de contraseña",
                showConfirmButton: false,
                timer: 5000
            });
            setTimeout(function() {
                document.getElementById("olvidado").click();
                $("#password").modal("show");
                document.getElementById("cedulaEmergente").value = document.getElementById("cedula").value;
                document.getElementById("modificarContrasenia").click();
            }, 4000);
            break;
        default:
            $("#contrasenia").css("border-color", "#F14B4B");
            $("#contrasenia").focus();
            $("#mensaje-contrasenia").html(respuesta);
            break;
    }
}

function Limpiar_Mensajes() {
    $("#cedula").on({
        click: function() {
            $("#cedula").css("border-color", "#d1d1d1");
            $("#mensaje-cedula").html("");
        },
    });
    $("#contrasenia").on({
        click: function() {
            $("#contrasenia").css("border-color", "#d1d1d1");
            $("#mensaje-contrasenia").html("");
        },
    });
    $("#captcha_code").on({
        keyup: function() {
            $("#captcha_code").css("border-color", "#d1d1d1");
            $("#texto").html("");
        },
    });
}
document.getElementById("cedula").onkeyup = function() {
    validacion_inputs_generica(document.getElementById("cedula"), "", document.getElementById("mensaje-cedula"), "Debe ingresar su cédula.");
};
document.getElementById("contrasenia").onkeyup = function() {
    validacion_inputs_generica(document.getElementById("contrasenia"), "", document.getElementById("mensaje-contrasenia"), "Debe ingresar su contraseña.");
};
document.getElementById("captcha_code").onkeyup = function() {
    validacion_inputs_generica(document.getElementById("captcha_code"), "", document.getElementById("texto"), "Debe ingresar el captcha.");
};
document.getElementById("cedula").maxLength = 9;
var info = "";
document.getElementById("modificarContrasenia").onclick = function() {
    if (document.getElementById("modificarContrasenia").value == "Consultar") {
        if (document.getElementById("cedulaEmergente").value == "") {
            document.getElementById("cedulaEmergente").style.borderColor = "red";
            document.getElementById("textoCedula").innerHTML = "Ingrese la cédula por favor";
            document.getElementById("textoCedula").style.color = 'red';
            document.getElementById("cedulaEmergente").focus();
        } else {
            document.getElementById("cedulaEmergente").style.borderColor = "";
            document.getElementById("textoCedula").innerHTML = "";
            $.ajax({
                type: "POST",
                url: BASE_URL + "app/Direcciones.php",
                data: {
                    direction: "Login/Administrar",
                    accion: "codificar"
                },
                success: function(direccion_segura) {
                    $.ajax({
                        type: "POST",
                        url: BASE_URL + direccion_segura,
                        type: "POST",
                        data: {
                            peticion: "Consultar",
                            cedula: document.getElementById("cedulaEmergente").value,
                        },
                    }).done(function(result) {
                        var resultado = JSON.parse(result);
                        if (resultado.length == 0 || resultado[0]["estado"] == 0) {
                            document.getElementById("cedulaEmergente").style.borderColor = "red";
                            document.getElementById("textoCedula").innerHTML = "Usuario no válido";
                            document.getElementById("textoCedula").style.color = 'red';
                            document.getElementById("cedulaEmergente").focus();
                        } else {
                            if (resultado[0]['preguntas_seguridad'] == "" || resultado[0]['preguntas_seguridad'] == null) {
                                swal({
                                    type: "error",
                                    title: "Error",
                                    text: "Su usuario no posee preguntas de seguridad registradas. Colóquese en contacto con un super usuario para recuperar su contraseña",
                                    timer: 3000,
                                    showConfirmButton: false
                                });
                            } else {
                                document.getElementById("cedulaEmergente").style.borderColor = "";
                                document.getElementById("textoCedula").innerHTML = "";
                                document.getElementById("cedulaEmergente").readOnly = "readOnly";
                                document.getElementById("textoCedula").style.color = "green";
                                document.getElementById("textoCedula").innerHTML = resultado[0]["primer_nombre"] + " " + resultado[0]["primer_apellido"];
                                info = resultado[0];
                                document.getElementById("modificarContrasenia").value = 'Listo';
                                $("#info").show(500);
                            }
                        }
                        console.log(info);
                    });
                },
                error: function() {
                    alert('Error al codificar dirreccion');
                }
            });
        }
    } else {
        if (document.getElementById("mascota").value == "" || document.getElementById("animFav").value == "" || document.getElementById("colorFav").value == "" || document.getElementById("firmaDigital").value == "") {
            swal({
                type: "error",
                title: "Error",
                text: "Ingrese todas las preguntas de seguridad y firma digital",
                timer: 2000,
                showConfirmButton: false
            });
        } else {
            var pregunta = document.getElementById("colorFav").value + document.getElementById("animFav").value + document.getElementById("mascota").value;
            if (pregunta.toLowerCase() == info['preguntas_seguridad'].toLowerCase() && document.getElementById("firmaDigital").value.toLowerCase() == info['digital_sign'].toLowerCase()) {
                if (document.getElementById("passwordEmergente").value == "" || document.getElementById("passwordEmergente2").value == "" || document.getElementById("passwordEmergente").value != document.getElementById("passwordEmergente2").value) {
                    if (document.getElementById("inputs_contrasenia").style.display == "none") {
                        $("#inputs_contrasenia").show(500);
                    } else {
                        swal({
                            type: "error",
                            title: "Error",
                            text: "Debe ingresar la clave y la confirmación de la contraseña. Ambos campos deben ser iguales",
                            timer: 3000,
                            showConfirmButton: false
                        });
                    }
                } else {
                    $.ajax({
                        type: "POST",
                        url: BASE_URL + "app/Direcciones.php",
                        data: {
                            direction: "Login/Administrar",
                            accion: "codificar"
                        },
                        success: function(direccion_segura) {
                            $.ajax({
                                type: "POST",
                                url: BASE_URL + direccion_segura,
                                type: "POST",
                                data: {
                                    peticion: "Recuperar",
                                    cedula: document.getElementById("cedulaEmergente").value,
                                    clave: document.getElementById("passwordEmergente").value
                                },
                            }).done(function(datos) {
                                solicitar_cambio();
                                if (datos) {
                                    swal({
                                        type: "success",
                                        title: "Éxito",
                                        text: "Su solicitud de cambio de contraseña ha sido enviada, a la espera de ser aprobada por los adminsitradores",
                                        timer: 5000,
                                        showConfirmButton: false
                                    });
                                    setTimeout(function() {
                                        location.reload()
                                    }, 4000);
                                }
                            })
                        },
                        error: function() {
                            alert('Error al codificar dirreccion');
                        }
                    });
                }
            } else {
                swal({
                    type: "error",
                    title: "Error",
                    text: "Los datos de seguridad ingresados son incorrectos. En caso de no recordar la información, le recomendamos ponerse en contacto con los administradores.",
                    showConfirmButton: true
                });
            }
        }
    }
}

function solicitar_cambio() {
    var datos_persona = new Object();
    datos_persona['cedula_persona'] = document.getElementById("cedulaEmergente").value;
    datos_persona['tipo_constancia'] = "Cambio de contraseña";
    datos_persona['motivo_constancia'] = "Olvido de contraseña";
    $.ajax({
        type: "POST",
        url: BASE_URL + "app/Direcciones.php",
        data: {
            direction: "Solicitudes/Nueva_solicitud",
            accion: "codificar"
        },
        success: function(direccion_segura) {
            $.ajax({
                type: "POST",
                url: BASE_URL + direccion_segura,
                data: {
                    "datos": datos_persona
                }
            });
        },
        error: function() {
            alert('Error al codificar dirreccion');
        }
    });
}
document.getElementById("cedulaEmergente").onkeyup = function() {
    if (document.getElementById("cedulaEmergente").value != "") {
        document.getElementById("cedulaEmergente").style.borderColor = "";
        document.getElementById("textoCedula").innerHTML = "";
    }
};
document.getElementById("olvidado").onclick = function() {
    document.getElementById("cedulaEmergente").style.borderColor = "";
    document.getElementById("cedulaEmergente").value = "";
    document.getElementById("cedulaEmergente").readOnly = "";
    document.getElementById("textoCedula").innerHTML = "";
    document.getElementById("info").style.display = 'none';
    document.getElementById("inputs_contrasenia").style.display = "none";
    document.getElementById("modificarContrasenia").value = 'Consultar';
    var inputs = document.getElementById("info").querySelectorAll("input");
    for (var i = 0; i < inputs.length; i++) {
        inputs[i].value = '';
    }
}