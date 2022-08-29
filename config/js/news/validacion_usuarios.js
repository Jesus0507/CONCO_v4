var formulario = document.getElementById("formulario");
var cedula = document.getElementById("cedula");
var validCedula = document.getElementById("mensaje-cedula");
var nombre = document.getElementById("nombre");
var validNombre = document.getElementById("mensaje-nombre");
var apellido = document.getElementById("apellido");
var validApellido = document.getElementById("mensaje-apellido");
var correo = document.getElementById("correo");
var tipoCorreo = document.getElementById("tcorreo");
var validCorreo = document.getElementById("mensaje-correo");
var validTelefono = document.getElementById("mensaje-telefono");
var clave = document.getElementById("contrasenia");
var validClave = document.getElementById("mensaje-contrasenia");
var confirmar = document.getElementById("confirmar");
var validConfirmar = document.getElementById("mensaje-confirmar");
var divValidInfo = document.getElementById("pswd_info");
var validMayuscula = document.getElementById("mayuscula");
var validLetra = document.getElementById("letra");
var validNro = document.getElementById("numero");
var validSimbolo = document.getElementById("simbolo");
var validComparar = document.getElementById("comparar");
var validLargo = document.getElementById("length");
var rol = document.getElementById("rol");
var validRol = document.getElementById("mensaje-rol");
var animal = document.getElementById("animal");
var mascota = document.getElementById("mascota");
var color = document.getElementById("color");
var validPreguntas = document.getElementById("mensaje-seguridad");
var btnEnviar = document.getElementById("enviar");
var usuarios = "";
var btnVer = document.getElementById("mostrar");
var ojo = document.getElementById("spanIcon");


btnVer.onclick = function () {
    if (contrasenia.type == 'password') {
        contrasenia.type = 'text';
        ojo.className = "fa fa-eye-slash";
    }
    else {
        contrasenia.type = "password";
        ojo.className = "fa fa-eye";
    }
    confirmar.type = contrasenia.type;
}


$.ajax({
    type: "POST",
    url: BASE_URL + "app/Direcciones.php",
    data: {
        direction: 'Usuario/Consultas_Usuario_Ajax',
        accion: "codificar"
    },
    success: function (direccion_segura) {
        $.ajax({
            type: 'POST',
            url: BASE_URL + direccion_segura,
        }).done(function (datos) {
            usuarios = JSON.parse(datos);
        });
    },
    error: function () {
        alert('Error al codificar dirreccion');
    }
});


$('.solo-letras').on('input', function (e) {
    if (!/^[ a-z-áéíóúüñ]*$/i.test(this.value)) {
        this.value = this.value.replace(/[^ a-z-áéíóúüñ]+/ig, "");
    }
});



cedula.focus();
contrasenia.type = confirmar.type = "password";
onPressed(cedula, "numeros");
onPressed(telefono, "numeros");
onUpped(cedula, validCedula, "ingresar la cédula", 1);
onUpped(nombre, validNombre, "ingresar el nombre", 1);
onUpped(apellido, validApellido, "ingresar el apellido", 1);
onUpped(correo, validCorreo, "ingresar el correo", 1);
onUpped(confirmar, validConfirmar, "confirmar la contraseña", 3);
onUpped(telefono, validTelefono, "ingresar el número de teléfono", 1);
onUpped(clave, validClave, "ingresar la contraseña", 2);
onUpped(animal, validPreguntas, "proporcionar las preguntas de seguridad", 1);
onUpped(mascota, validPreguntas, "proporcionar las preguntas de seguridad", 1);
onUpped(color, validPreguntas, "proporcionar las preguntas de seguridad", 1);




document.onkeypress = function (e) {
    if (e.which == 13 || e.keyCode == 13) {

        ejecucion();
        return false;

    }
    else { return true; }
}


btnEnviar.onclick = function () {
    ejecucion();
}

function ejecucion() {

    if (campoVacio(cedula, validCedula, "ingresar la cédula")) {
        if (existenteUser()) {
            if (campoVacio(nombre, validNombre, "ingresar el nombre")) {
                if (campoVacio(apellido, validApellido, "ingresar el apellido")) {
                    if (campoVacio(correo, validCorreo, "ingresar el correo")) {
                        if (campoVacio(telefono, validTelefono, "ingresar el número de teléfono")) {
                            if (campoVacio(contrasenia, validClave, "ingresar la contraseña") && validCaracteres(contrasenia, "todo")) {
                                if (campoVacio(confirmar, validConfirmar, "confirmar la contraseña") && validCaracteres(confirmar, "iguales")) {
                                    if (selectVacio(rol, validRol, "seleccionar el rol")) {
                                        if (campoVacio(animal, validPreguntas, "proporcionar las preguntas de seguridad") && campoVacio(mascota, validPreguntas, "proporcionar las preguntas de seguridad") && campoVacio(color, validPreguntas, "proporcionar las preguntas de seguridad")) {
                                            swal({
                                                title: "¡Éxito!",
                                                type: "success",
                                                text: "El usuario " + nombre.value + " " + apellido.value + " ha sido registrado exitosamente",
                                                showConfirmButton: false,
                                                timer: 3000
                                            });

                                            setTimeout(function () { formulario.submit(); }, 2000);
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


function campoVacio(elemento, validElemento, mensaje) {
    var retornar = false;
    if (elemento.value == "" || elemento.value == null) {
        elemento.focus();
        validElemento.innerHTML = "Debe " + mensaje + " del usuario.";
        elemento.style.borderColor = "red";
    }
    else {
        elemento.blur();
        validElemento.innerHTML = "";
        elemento.style.borderColor = "";
        retornar = true;
    }

    return retornar;
}

function selectVacio(elemento, validElemento, mensaje) {
    var retornar = false;
    if (elemento.value == 0) {
        validElemento.innerHTML = "Debe " + mensaje + " del usuario.";
        elemento.style.borderColor = "red";
    }
    else {
        validElemento.innerHTML = "";
        elemento.style.borderColor = "";
        retornar = true;
    }

    return retornar;
}




function validCaracteres(elemento, tipoValidacion) {
    var retornar = true;

    switch (tipoValidacion) {
        case "iguales":
            if (elemento.value != contrasenia.value) {
                elemento.style.borderColor = "red";
                validComparar.style.color = "red";
                retornar = false;
            }
            else {
                elemento.style.borderColor = "";
                validComparar.style.color = "green";
            }
            break;

        case "numeros":
            retornar = (event.charCode >= 48 && event.charCode <= 57);
            break;

        default:
            if (elemento.value != "" && elemento.value != null) {
                if (elemento.value.match(/[A-z]/)) {
                    elemento.style.borderColor = "";
                    validLetra.style.color = "green";

                }
                else {
                    elemento.style.borderColor = "red";
                    validLetra.style.color = "red";
                    retornar = false;
                }

                if (elemento.value.match(/[A-Z]/)) {

                    elemento.style.borderColor = "";
                    validMayuscula.style.color = "green";


                }
                else {

                    elemento.style.borderColor = "red";
                    validMayuscula.style.color = "red";
                    retornar = false;
                }

                if (elemento.value.match(/\d/)) {

                    elemento.style.borderColor = "";
                    validNro.style.color = "green";
                }
                else {

                    elemento.style.borderColor = "red";
                    validNro.style.color = "red";
                    retornar = false;
                }

                if (elemento.value.match(/[!@#$%^&*()_=\[\]{};':`"\\|,.<>\/?+~-]/)) {
                    elemento.style.borderColor = "";
                    validSimbolo.style.color = "green";
                }
                else {

                    elemento.style.borderColor = "red";
                    validSimbolo.style.color = "red";
                    retornar = false;
                }

                if (elemento.value.length < 8) {
                    elemento.style.borderColor = "red";
                    validLargo.style.color = "red";
                    retornar = false;
                }
                else {
                    elemento.style.borderColor = "";
                    validLargo.style.color = "green";
                }
            }
            else {

                elemento.style.borderColor = "red";
                validLetra.style.color = validMayuscula.style.color = validNro.style.color = validLargo.style.color = validSimbolo.style.color = "red";
                retornar = false;
            }
            break;

    }

    if (retornar == false) {
        elemento.focus();
    }

    return retornar;
}

function onPressed(elemento, tipo) {

    elemento.onkeypress = function () {
        return validCaracteres(elemento, tipo);
    }

}

function onUpped(elemento, tipo, mensaje, funcion) {

    elemento.onkeyup = function () {
        campoVacio(elemento, tipo, mensaje);
        if (funcion == 2) {
            validCaracteres(elemento, "todo");
        }
        if (funcion == 3) {
            validCaracteres(elemento, "iguales");
        }
        elemento.focus();
    }

}

function existenteUser() {
    var retornar = true;
    for (var i = 0; i < usuarios.length; i++) {
        if (usuarios[i]['cedula_usuario'] == cedula.value && usuarios[i]['estado'] == 1) {
            retornar = false;
            cedula.focus();
            swal({
                timer: 3000,
                title: "Error",
                text: "Este usuario ya se encuentra registrado",
                type: "error",
                showConfirmButton: false,
            });
        }
    }


    return retornar;
}
