var tipo_evento = document.getElementById('tipo_evento');
var detalle_evento = document.getElementById('detalle_evento');
var titulo = document.getElementById('modal-title');
var btn_guardar = document.getElementById("guardar_cambios");
var datos_evento;
var ubicacion = document.getElementById("ubicacion_evento");
var desde = document.getElementById("desde_evento");
var hasta = document.getElementById("hasta_evento");

function editar_evento(data, data_complete) {
    setTimeout(function() {
        var datos = JSON.parse(data);
        titulo.innerHTML = datos['tipo_evento'];
        tipo_evento.value = datos['tipo_evento'];
        detalle_evento.value = datos['detalle'];
        ubicacion.value = datos['ubicacion'];
        var separado = datos['horas'].split(" ");
        desde.value = get_time(separado[1] + " " + separado[2]);
        hasta.value = get_time(separado[4] + " " + separado[5]);
        datos_evento = datos;
        $("#ver").modal().show();
    }, 100);
}
btn_guardar.onclick = function() {
    if (tipo_evento.value == "") {
        tipo_evento.style.borderColor = "red";
        swal({
            title: "Error",
            text: "Debe especificar de que tipo de evento se trata",
            timer: 2000,
            showConfirmButton: false,
            type: "error"
        });
    } else {
        if (desde.value == 0 || hasta.value == 0 || ubicacion.value == "") {
            swal({
                title: "Error",
                text: "Todo evento debe poseer una ubicación, hora de inicio y hora de finalización",
                timer: 2000,
                showConfirmButton: false,
                type: "error"
            });
        } else {
            if (desde.value == hasta.value) {
                swal({
                    title: "Error",
                    text: 'Las horas de inicio y de finalización no pueden ser la misma',
                    timer: 2000,
                    showConfirmButton: false,
                    type: "error"
                });
            } else {
                if (parseInt(desde.value) > parseInt(hasta.value)) {
                    swal({
                        title: "Error",
                        text: "La hora de inicio no puede ser luego de la hora de finalización",
                        timer: 2000,
                        showConfirmButton: false,
                        type: "error"
                    });
                } else {
                    valid_ubicacion_horas();
                }
            }
        }
    }
}

function eliminar_evento(id) {
    var datos = {
        id_agenda: id,
    };
    swal({
        type: "warning",
        text: "Estás por eliminar este evento, si continúas el evento será removido del sistema.¿Deseas continuar?",
        title: "Atención",
        showCancelButton: true,
        cancelButtonText: "No, cancelar",
        confirmButtonText: "Si, continuar",
        closeOnConfirm: true
    }, function(isConfirm) {
        if (isConfirm) {
            $.ajax({
                url: BASE_URL + "Agenda/Administrar",
                type: "POST",
                data: {
                    peticion: "Administrar",
                    datos: datos,
                    sql: "SQL_06",
                    accion: "Se ha Eliminado un Evento ",
                },
            }).done(function(result) {
                if (result == 1) {
                    setTimeout(function() {
                        swal({
                            title: "Eliminado!",
                            text: "El elemento fue eliminado con exito.",
                            type: "success",
                            showConfirmButton: false,
                        });
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }, 100);
                } else {
                    setTimeout(function() {
                        swal({
                            title: "ERROR!",
                            text: "Ha ocurrido un Error.</br>" + result,
                            type: "error",
                            html: true,
                            showConfirmButton: true,
                            customClass: "bigSwalV2",
                        });
                    }, 100);
                }
            });
        } else {
            swal("Cancelado", "La accion fue cancelada, la informacion esta segura.", "error");
        }
    });
}

function ver_evento(evento, usuario) {
    var consulta = JSON.parse(evento);
    if (consulta['detalle'] == "" || consulta["detalle"] == null) {
        consulta['detalle'] = "Sin detalles";
    }
    var text = "<center><em class='fa fa-calendar' style='font-size:50px'>";
    text += "</em><br><br><table style='width:100%' border='1'><tr style='font-weight:bold'><td>Creador</td><td>Fecha</td><td>Ubicación</td>";
    text += "<td>Horas</td><td>Detalle</td></tr>";
    text += "<tr><td>" + usuario + "</td><td>" + consulta['fecha'] + "</td><td>" + consulta['ubicacion'] + "</td><td>" + consulta['horas'];
    text += "</td><td>" + consulta['detalle'] + "</td></tr></table></center>";
    swal({
        customClass: "bigSwalV2",
        title: consulta['tipo_evento'],
        html: true,
        text: text
    });
}

function get_time(hora) {
    var numero = "";
    switch (hora) {
        case "08:00 AM":
            numero = 1;
            break;
        case "09:00 AM":
            numero = 2;
            break;
        case "10:00 AM":
            numero = 3;
            break;
        case "11:00 AM":
            numero = 4;
            break;
        case "12:00 PM":
            numero = 5;
            break;
        case "01:00 PM":
            numero = 6;
            break;
        case "02:00 PM":
            numero = 7;
            break;
        case "03:00 PM":
            numero = 8;
            break;
        case "04:00 PM":
            numero = 9;
            break;
        case "05:00 PM":
            numero = 10;
            break;
        case "06:00 PM":
            numero = 11;
            break;
        case "07:00 PM":
            numero = 12;
            break;
        case "08:00 PM":
            numero = 13;
            break;
    }
    return numero;
}

function valid_ubicacion_horas() {
    $.ajax({
        type: "POST",
        url: BASE_URL + "Agenda/Administrar",
        data: {
            peticion: "Consulta_Ajax",
        },
    }).done(function(result) {
        var eventos_registrados = [];
        var resultado = JSON.parse(result);
        for (var i = 0; i < resultado.length; i++) {
            var fecha_event = new Date(resultado[i]['fecha']);
            if (fecha_event >= new Date()) {
                eventos_registrados.push(resultado[i]);
            }
        }
        var mensaje = "";
        var texto_horas = [];
        var mensaje_horas = "";
        var validar = true;
        for (var i = 0; i < eventos_registrados.length; i++) {
            if (eventos_registrados[i]['fecha'] == datos_evento['fecha'] && datos_evento['id_agenda'] != eventos_registrados[i]['id_agenda'] && datos_evento['ubicacion'].toLowerCase() == eventos_registrados[i]['ubicacion'].toLowerCase()) {
                var separado = eventos_registrados[i]['horas'].split(" ");
                var inicio = get_time(separado[1] + " " + separado[2]);
                var fin = get_time(separado[4] + " " + separado[5]);
                for (j = parseInt(desde.value); j <= parseInt(hasta.value); j++) {
                    if (j == inicio || j == fin) {
                        validar = false;
                    }
                }
                if (!validar) {
                    texto_horas.push(eventos_registrados[i]['horas']);
                }
            }
        }
        if (!validar) {
            if (texto_horas.length > 1) {
                for (var i = 0; i < texto_horas.length; i++) {
                    if (i == texto_horas - 1) {
                        mensaje_horas += " y " + texto_horas[i];
                    } else {
                        mensaje_horas += texto_horas[i] + " , ";
                    }
                }
            } else {
                mensaje_horas = texto_horas[0];
            }
            mensaje = "Ya existen otros eventos creados " + mensaje_horas;
        }
        if (!validar) {
            swal({
                title: "Error",
                text: mensaje,
                type: "error"
            });
        } else {
            datos_evento['tipo_evento'] = tipo_evento.value;
            datos_evento['detalle'] = detalle_evento.value;
            datos_evento['ubicacion'] = ubicacion.value;
            datos_evento['horas'] = "De " + desde.options[desde.selectedIndex].text + " hasta " + hasta.options[hasta.selectedIndex].text;
            $.ajax({
                type: "POST",
                url: BASE_URL + "Agenda/Administrar",
                data: {
                    datos: datos_evento,
                    peticion: "Administrar",
                    sql: "SQL_03",
                    accion: "Se ha Actualizado el  Evento: " + datos_evento.tipo_evento,
                },
            }).done(function(result) {
                if (result == 1) {
                    swal({
                        title: "Éxito",
                        text: "El evento ha sido modificado exitosamente",
                        timer: 2000,
                        showConfirmButton: false,
                        type: "success"
                    });
                    setTimeout(function() {
                        location.reload();
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
            })
        }
    });
}