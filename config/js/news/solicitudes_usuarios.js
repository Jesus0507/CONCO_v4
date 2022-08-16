var doc = document.getElementById("documento-solicitado");
var mot = document.getElementById("motivo-solicitud");
var valid_doc = document.getElementById("valid_doc");
var valid_mot = document.getElementById("valid_mot");
var boton_enviar = document.getElementById("enviar-solicitud");
var cerrar = document.getElementById("cerrar");
cerrar.onclick = function() {
    doc.style.borderColor = '';
    valid_doc.innerHTML = "";
    mot.style.borderColor = '';
    valid_mot.innerHTML = "";
    mot.value = '';
    doc.value = '0';
}
doc.onchange = function() {
    if (doc.value != '0') {
        doc.style.borderColor = '';
        valid_doc.innerHTML = "";
    } else {
        doc.style.borderColor = 'red';
        valid_doc.innerHTML = "Debe ingresar el documento a solicitar";
    }
}
mot.onkeyup = function() {
    if (mot.value != '') {
        mot.style.borderColor = '';
        valid_mot.innerHTML = "";
    } else {
        mot.style.borderColor = 'red';
        valid_mot.innerHTML = "Debe ingresar el motivo de su solicitud";
    }
}
boton_enviar.onclick = function() {
    if (doc.value == 0) {
        valid_doc.innerHTML = "Debe ingresar el documento a solicitar";
        doc.style.borderColor = "red";
    } else {
        valid_doc.innerHTML = "";
        doc.style.borderColor = "";
        if (mot.value == "") {
            valid_mot.innerHTML = "Debe ingresar el motivo de su solicitud";
            mot.style.borderColor = "red";
            mot.focus();
        } else {
            valid_mot.innerHTML = "";
            mot.style.borderColor = "";
            send_request();
        }
    }
}

function send_request() {
    var datos_persona = new Object();
    datos_persona['cedula_persona'] = "<?php echo $_SESSION['cedula_usuario'] ?>";
    datos_persona['tipo_constancia'] = doc.value;
    datos_persona['motivo_constancia'] = mot.value;
    $.ajax({
        type: "POST",
        url: BASE_URL + "Solicitudes/Nueva_solicitud",
        data: {
            "datos": datos_persona
        }
    }).done(function(result) {
        console.log(result);
        if (result == 1) {
            swal({
                title: "Éxito",
                type: "success",
                text: "Su solicitud de documento ha sido enviada satisfactoriamente",
                showConfirmButton: false,
                timer: 2000,
            });
            doc.value = '0';
            mot.value = '';
            index = 1;
            cambio_vista();
        }
    });
}