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
            url: BASE_URL + "Usuario/Usuario_Existente",
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
    if (respuesta == 0) {
        $("#cedula").css("border-color", "#F14B4B");
        $("#cedula").focus();
        $("#mensaje-cedula").html("Usuario No Registrado.");
    } else {
        if (respuesta == 1) {
            $("#contrasenia").blur();
            form.serialize();
            form.submit();
        } else {
            if (respuesta == 2) {
                if ($("#captcha_code").val() == "") {
                    errores = "Debe ingresar el codigo de seguridad.";
                    $("#captcha_code").css("border-color", "#F14B4B");
                    $("#texto").html(errores);
                } else {
                    $("#captcha_code").css("border-color", "#F14B4B");
                    $("#captcha_code").focus();
                    $("#texto").html("Captcha Inconrrecto, Inntente de Nuevo.");
                }
            } else {
                $("#contrasenia").css("border-color", "#F14B4B");
                $("#contrasenia").focus();
                $("#mensaje-contrasenia").html(respuesta);
            }
        }
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
                url: BASE_URL + "login/Administrar",
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
            });
        }
    } else {
        if (document.getElementById("mascota").value == "" || document.getElementById("animFav").value == "" || document.getElementById("colorFav").value == "") {
            swal({
                type: "error",
                title: "Error",
                text: "Ingrese todas las preguntas de seguridad",
                timer: 2000,
                showConfirmButton: false
            });
        } else {
            var pregunta = document.getElementById("colorFav").value + document.getElementById("animFav").value + document.getElementById("mascota").value;
            if (pregunta.toLowerCase() == info['preguntas_seguridad'].toLowerCase()) {
                if (document.getElementById("passwordEmergente").value == "" || document.getElementById("passwordEmergente2").value == "" || document.getElementById("passwordEmergente").value != document.getElementById("passwordEmergente2").value) {
                    swal({
                        type: "error",
                        title: "Error",
                        text: "Debe ingresar la clave y la confirmación de la contraseña. Ambos campos deben ser iguales",
                        timer: 3000,
                        showConfirmButton: false
                    });
                } else {
                    $.ajax({
                        type: "POST",
                        url: BASE_URL + "login/Administrar",
                        type: "POST",
                        data: {
                            peticion: "Recuperar",
                            cedula: document.getElementById("cedulaEmergente").value,
                            clave: document.getElementById("passwordEmergente").value
                        },
                    }).done(function(datos) {
                        if (datos) {
                            swal({
                                type: "success",
                                title: "Éxito",
                                text: "Su contraseña ha sido cambiada exitosamente",
                                timer: 3000,
                                showConfirmButton: false
                            });
                            $('#password').modal('hide');
                        }
                    })
                }
            } else {
                swal({
                    type: "error",
                    title: "Error",
                    text: "Los datos de seguridad ingresados son incorrectos",
                    timer: 3000,
                    showConfirmButton: false
                });
            }
        }
    }
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
    document.getElementById("modificarContrasenia").value = 'Consultar';
    var inputs = document.getElementById("info").querySelectorAll("input");
    for (var i = 0; i < inputs.length; i++) {
        inputs[i].value = '';
    }
}