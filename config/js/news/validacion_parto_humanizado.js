var cedula = document.getElementById("cedula_persona");
var t_gestacion = document.getElementById("tiempo_gestacion");
var f_parto = document.getElementById("fecha_aprox_parto");
var boton = document.getElementById("boton");
var formulario = document.getElementById("formulario");
boton.onclick = function() {
    if (cedula.value == "") {
        cedula.style.borderColor = "red";
        cedula.focus();
    } else {
        var datos = {
            cedula_persona: document.getElementById("cedula_persona").value,
            recibe_micronutrientes: document.getElementById("recibe_micronutrientes").selectedIndex,
            tiempo_gestacion: document.getElementById("tiempo_gestacion").value,
            fecha_aprox_parto: document.getElementById("fecha_aprox_parto").value,
            estado: 1
        };
        $.ajax({
            type: "POST",
            url: BASE_URL + "Parto_Humanizado/Administrar",
            data: {
                "cedula_persona": cedula.value,
                peticion: "Existente",
            },
        }).done(function(respuesta) {
            if (respuesta != 1) {
                cedula.focus();
                cedula.style.borderColor = 'red';
                swal({
                    type: "error",
                    title: "Error",
                    text: respuesta,
                    timer: 2000,
                    showConfirmButton: false
                });
            } else {
                cedula.style.borderColor = '';
                if (t_gestacion.value == "") {
                    t_gestacion.focus();
                    t_gestacion.style.borderColor = 'red';
                } else {
                    t_gestacion.style.borderColor = '';
                    if (f_parto.value == "") {
                        f_parto.style.borderColor = "red";
                        f_parto.focus();
                    } else {
                        f_parto.style.borderColor = "";
                        $.ajax({
                            type: "POST",
                            url: BASE_URL + "Parto_Humanizado/Administrar",
                            data: {
                                datos: datos,
                                peticion: "Administrar",
                                sql: "SQL_02",
                                accion: "Se ha Registrado la  Embarazada portadora de la cedula: " + cedula,
                            },
                        }).done(function(datos) {
                            if (datos == 1) {
                                swal({
                                    title: "Registrado!",
                                    text: "El elemento fue Registrado con exito.",
                                    type: "success",
                                    showConfirmButton: false
                                });
                                setTimeout(function() {
                                    location.href = BASE_URL + "Parto_Humanizado/Administrar/Consultas"
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
                        }).fail(function() {
                            alert("error");
                        });
                    }
                }
            }
        });
    }
}