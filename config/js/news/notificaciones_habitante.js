var cantidad = document.getElementById("cant_notificaciones");
var notificaciones_no_leidas = document.getElementById("notificaciones-no-leidas");
var notificaciones = document.getElementById("body-notificaciones");
var verTodas = document.getElementById("ver-todas");
var texto_click_notificaciones = [];
getNotifications_habitante();

function getNotifications_habitante() {
    $.ajax({
        type: "POST",
        url: BASE_URL + "app/Direcciones.php",
        data: {
            direction: "Notificaciones/Administrar",
            accion: "codificar"
        },
        success: function(direccion_segura) {
            $.ajax({
                type: "POST",
                url: BASE_URL + direccion_segura,
                data: {
                    peticion: "Consulta_Ajax",
                },
            }).done(function(datos) {
                var result = JSON.parse(datos);
                var cant = 0;
                var cuerpo = "";
                for (var i = 0; i < result.length; i++) {
                    var tipo = result[i]["accion"];
                    tipo = tipo.split("/");
                    var icono = "";
                    var fechaNotificacion = new Date(result[i]["fecha"]);
                    var fechaActual = new Date();
                    var span = getSpan(fechaNotificacion, fechaActual);
                    switch (parseInt(tipo[0])) {
                        case 1:
                            icono = "<i class='fas fa-unlock'></i>";
                            break;
                        case 2:
                            icono = "<i class='fas fa-lock'></i>";
                            break;
                        case 3:
                            icono = "<i class='fas fa-calendar'></i>";
                            break;
                        case 4:
                            icono = "<i class='fas fa-check'></i>";
                            break;
                        case 5:
                            icono = "<i class='fas fa-times'></i>";
                            break;
                    }
                    var mensaje = getRecortado(tipo[1]);
                    if (result[i]["leido"] == 0) {
                        texto_click_notificaciones.push(JSON.stringify(result[i]));
                        cant++;
                        cuerpo += "<a title='" + tipo[1] + "' href='javascript:void(0)' class='dropdown-item' style='font-size:12px !important' onclick='setStatus(`" + result[i]["id_notificacion"] + "`,`" + tipo[1] + "`)'>";
                        cuerpo += icono + " " + mensaje + span;
                        cuerpo += "</a><div class='dropdown-divider'></div>";
                    } else {
                        texto_click_notificaciones.push(JSON.stringify(result[i]));
                        cuerpo += "<a title='" + tipo[1] + "' href='javascript:void(0)' class='dropdown-item' style='background:#BFBFBF;font-size:12px !important;' onclick='setStatus(`" + result[i]["id_notificacion"] + "`,`" + tipo[1] + "`)'>";
                        cuerpo += icono + " " + mensaje + span;
                        cuerpo += "</a><div class='dropdown-divider'></div>";
                    }
                }
                if (result.length == 0) {
                    verTodas.style.display = "none";
                    notificaciones_no_leidas.innerHTML = "No hay notificaciones";
                    notificaciones.style.display = "none";
                    cantidad.innerHTML = "0";
                    cantidad.style.display = "none";
                } else {
                    verTodas.style.display = "";
                    if (cant == 0) {
                        notificaciones_no_leidas.innerHTML = "No hay notificaciones nuevas";
                        cantidad.style.display = "none";
                        cantidad.innerHTML = "0";
                        document.getElementById("page-title").innerHTML = "C.C Prados de Occidente";
                    } else {
                        notificaciones_no_leidas.innerHTML = cant + " Notificaciones";
                        cantidad.style.display = "";
                        cantidad.innerHTML = cant;
                        document.getElementById("page-title").innerHTML = "(" + cant + ") Notificaciones";
                    }
                    notificaciones.innerHTML = cuerpo;
                    notificaciones.style.display = "";
                }
            });
        },
        error: function() {
            alert('Error al codificar dirreccion');
        }
    });
    setTimeout(function() {
        getNotifications_habitante();
    }, 5000);
}

function getSpan(fechaN, fechaA) {
    var retornar = "<span class='float-right text-muted text-sm'>";
    var fechaNoti = fechaN.getDate() + "-" + (fechaN.getMonth() + 1) + "-" + fechaN.getFullYear();
    var fechaAct = fechaA.getDate() + "-" + (fechaA.getMonth() + 1) + "-" + fechaA.getFullYear();
    if (fechaNoti == fechaAct) {
        if (fechaN.getHours() + 1 == fechaA.getHours()) {
            var minutos = fechaA.getMinutes() + 30 - fechaN.getMinutes();
            retornar += minutos + "min</span>";
        } else {
            var horas = fechaA.getHours() - fechaN.getHours();
            retornar += horas + "hrs</span>";
        }
    } else {
        var diasdif = fechaN.getTime() - fechaA.getTime();
        var contdias = Math.round(diasdif / (1000 * 60 * 60 * 24));
        if (contdias * -1 < 7) {
            retornar += contdias * -1 + "dias</span>";
        } else {
            retornar += fechaNoti + "</span>";
        }
    }
    return retornar;
}

function setStatus(id,texto) {
    swal({
        title: "Información de la notificación",
        text: "<b>" + texto + "</b>",
        html: true,
    });

    var datos = {
        id_notificacion: id,
        leido: 1
    };
    $.ajax({
        type: "POST",
        url: BASE_URL + "app/Direcciones.php",
        data: {
            direction: 'Notificaciones/Administrar',
            accion: "codificar"
        },
    }).done(function (direccion_segura) {
        $.ajax({
            type: 'POST',
            url: BASE_URL + direccion_segura,
            data: {
                datos: datos,
                peticion: "Administrar",
                sql: "SQL_03",
            },
        }).done(function (datos) {
            if (datos == 1) {
                getNotifications_habitante();
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
        });
    });
}


function getRecortado(text) {
    var retornar = "";
    var separado = text.split(" ");
    for (var i = 0; i < separado.length; i++) {
        if (i < 3) {
            retornar += separado[i] + " ";
        }
    }
    if (separado.length > 3) {
        retornar += "...";
    }
    return retornar;
}

function nueva_notificacion(datos) {
    $.ajax({
        type: "POST",
        url: BASE_URL + "app/Direcciones.php",
        data: {
            direction: "Notificaciones/Administrar",
            accion: "codificar"
        },
        success: function(direccion_segura) {
            $.ajax({
                type: 'POST',
                url: BASE_URL + direccion_segura,
                data: {
                    datos: datos,
                    peticion: "Nueva",
                    sql: "SQL_01",
                },
            }).done(function(result) {
                getNotifications();
            });
        },
        error: function() {
            alert('Error al codificar dirreccion');
        }
    });
}