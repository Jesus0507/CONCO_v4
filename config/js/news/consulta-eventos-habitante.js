var anio_view = document.getElementById("anio-name");
var mes_view = document.getElementById("mes-name");
var next_mes = document.getElementById("next-mes");
var back_mes = document.getElementById("back-mes");
var cant_anios_back = 0;
var cant_anios_next = 0;
var div_calendario = document.getElementById("calendario-view");
var lista_fechas = [];
var eventos_registrados = [];
get_eventos();
setTimeout(function() {
    obtener_calendario("vacio", "vacio");
}, 500);
//===========================================================================//
function get_eventos() {
    $.ajax({
        type: "POST",
        url: BASE_URL + "app/Direcciones.php",
        data: {
            direction: "Agenda/Administrar",
            accion: "codificar"
        },
    }).done(function(direccion_segura) {
        $.ajax({
            type: "POST",
            url: BASE_URL + direccion_segura,
            data: {
                peticion: "Consulta_Ajax",
            },
        }).done(function(result) {
            var resultado = JSON.parse(result);
            for (var i = 0; i < resultado.length; i++) {
                var fecha_event = new Date(resultado[i]['fecha']);
                if (fecha_event >= new Date()) {
                    eventos_registrados.push(resultado[i]);
                }
            }
        });
    });
}
//===========================================================================//
function obtener_calendario(mes, anio) {
    if (anio == "vacio") {
        anio = new Date().getFullYear();
    }
    if (mes == "vacio") {
        mes = new Date().getMonth();
    }
    var ultimo_dia = new Date(anio, mes + 1, 0);
    mes_view.innerHTML = getMes(mes);
    anio_view.innerHTML = anio;
    llenar_calendario(ultimo_dia.getDate(), mes, anio);
}
//_--------------------------------------------------------------------------------------------//
function validar_ubicacion_hora() {
    var validar = true;
    var horas = [];
    var texto_horas = "";
    for (var i = 0; i < eventos_registrados.length; i++) {
        for (var j = 0; j < lista_fechas.length; j++) {
            if (lista_fechas[j] == eventos_registrados[i]['fecha']) {
                if (eventos_registrados[i]['ubicacion'].toLowerCase() == ubicacion_evento.value.toLowerCase()) {
                    if (!validacion_horas(eventos_registrados[i]['horas'])) {
                        validar = false;
                        horas.push(eventos_registrados[i]['horas']);
                    }
                }
            }
        }
    }
    if (horas.length > 1) {
        for (var x = 0; x < horas.length; x++) {
            if (x == horas.length - 1) {
                texto_horas += " y " + horas[x];
            } else {
                texto_horas += horas[x] + " , ";
            }
        }
    } else {
        texto_horas = horas[0];
    }
    if (!validar) {
        swal({
            type: "error",
            text: "Existen eventos creados en " + ubicacion_evento.value + " " + texto_horas,
            title: "Error"
        });
    }
    return validar;
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
//===========================================================================//
back_mes.onclick = function() {
    var mes_back = 0;
    switch (mes_view.innerHTML) {
        case "Enero":
            mes_back = 11;
            cant_anios_back++;
            break;
        case "Febrero":
            mes_back = 0;
            break;
        case "Marzo":
            mes_back = 1;
            break;
        case "Abril":
            mes_back = 2;
            break;
        case "Mayo":
            mes_back = 3;
            break;
        case "Junio":
            mes_back = 4;
            break;
        case "Julio":
            mes_back = 5;
            break;
        case "Agosto":
            mes_back = 6;
            break;
        case "Septiembre":
            mes_back = 7;
            break;
        case "Octubre":
            mes_back = 8;
            break;
        case "Noviembre":
            mes_back = 9;
            break;
        case "Diciembre":
            mes_back = 10;
            break;
    }
    var retornar_anio = parseInt(anio_view.innerHTML);
    if (cant_anios_back != 0) {
        retornar_anio = parseInt(anio_view.innerHTML) - cant_anios_back;
        cant_anios_back = 0;
    }
    obtener_calendario(mes_back, retornar_anio);
}
//===========================================================================//
next_mes.onclick = function() {
    var mes_next = 0;
    switch (mes_view.innerHTML) {
        case "Enero":
            mes_next = 1;
            break;
        case "Febrero":
            mes_next = 2;
            break;
        case "Marzo":
            mes_next = 3;
            break;
        case "Abril":
            mes_next = 4;
            break;
        case "Mayo":
            mes_next = 5;
            break;
        case "Junio":
            mes_next = 6;
            break;
        case "Julio":
            mes_next = 7;
            break;
        case "Agosto":
            mes_next = 8;
            break;
        case "Septiembre":
            mes_next = 9;
            break;
        case "Octubre":
            mes_next = 10;
            break;
        case "Noviembre":
            mes_next = 11;
            break;
        case "Diciembre":
            mes_next = 0;
            cant_anios_next++;
            break;
    }
    var retornar_anio = parseInt(anio_view.innerHTML);
    if (cant_anios_next != 0) {
        retornar_anio = parseInt(anio_view.innerHTML) + cant_anios_next;
        cant_anios_next = 0;
    }
    obtener_calendario(mes_next, retornar_anio);
}
//===========================================================================//
function llenar_calendario(ultimo, mes, anio) {
    var table = "<table class='table_calendar' border='1'><tr style='background:#11A394;color:white'>";
    table += "<td style='text-align:center'>Lunes</td>";
    table += "<td style='text-align:center'>Martes</td>";
    table += "<td style='text-align:center'>Miércoles</td>";
    table += "<td style='text-align:center'>Jueves</td>";
    table += "<td style='text-align:center'>Viernes</td>";
    table += "<td style='text-align:center'>Sabado</td>";
    table += "<td style='text-align:center'>Domingo</td></tr>";
    for (var i = 1; i < ultimo + 1; i++) {
        var fecha_view = new Date(anio, mes, i);
        var fila = "";
        var day = "";
        if (i.toString().length == 1) {
            day = "0" + i;
        } else {
            day = i;
        }
        if (mes < 10) {
            var clase_td = getClassTd(anio + "-0" + (mes + 1) + "-" + day, i);
        } else {
            var clase_td = getClassTd(anio + "-" + (mes + 1) + "-" + day, i);
        }
        if (i == 1) {
            switch (fecha_view.getDay()) {
                case 1:
                    fila += "<tr><td " + clase_td + i + "</td>";
                    break;
                case 2:
                    fila += "<tr><td></td><td " + clase_td + i + "</td>";
                    break;
                case 3:
                    fila += "<tr><td></td><td></td><td " + clase_td + i + "</td>";
                    break;
                case 4:
                    fila += "<tr><td></td><td></td><td></td><td " + clase_td + i + "</td>";
                    break;
                case 5:
                    fila += "<tr><td></td><td></td><td></td><td></td><td " + clase_td + i + "</td>";
                    break;
                case 6:
                    fila += "<tr><td></td><td></td><td></td><td></td><td></td><td " + clase_td + i + "</td>";
                    break;
                default:
                    fila += "<tr><td></td><td></td><td></td><td></td><td></td><td></td><td " + clase_td + i + "</td></tr>";
                    break;
            }
        } else {
            switch (fecha_view.getDay()) {
                case 1:
                    fila += "<tr><td " + clase_td + i + "</td>";
                    break;
                case 0:
                    fila += "<td " + clase_td + i + "</td></tr>";
                    break;
                default:
                    fila += "<td " + clase_td + i + "</td>";
                    break;
            }
            if (i == ultimo) {
                switch (fecha_view.getDay()) {
                    case 1:
                        fila += "<td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                        break;
                    case 2:
                        fila += "<td></td><td></td><td></td><td></td><td></td></tr>";
                        break;
                    case 3:
                        fila += "<td></td><td></td><td></td><td></td></tr>";
                        break;
                    case 4:
                        fila += "<td></td><td></td><td></td></tr>";
                        break;
                    case 5:
                        fila += "<td></td><td></td></tr>";
                        break;
                    case 6:
                        fila += "<td></td></tr>";
                        break;
                }
            }
        }
        table += fila;
    }
    table += "</table>";
    div_calendario.innerHTML = table;
}
//===========================================================================//
//===========================================================================//
function getMes(mesNro) {
    var mesRetornar = "";
    switch (mesNro + 1) {
        case 1:
            mesRetornar = "Enero";
            break;
        case 2:
            mesRetornar = "Febrero";
            break;
        case 3:
            mesRetornar = "Marzo";
            break;
        case 4:
            mesRetornar = "Abril";
            break;
        case 5:
            mesRetornar = "Mayo";
            break;
        case 6:
            mesRetornar = "Junio";
            break;
        case 7:
            mesRetornar = "Julio";
            break;
        case 8:
            mesRetornar = "Agosto";
            break;
        case 9:
            mesRetornar = "Septiembre";
            break;
        case 10:
            mesRetornar = "Octubre";
            break;
        case 11:
            mesRetornar = "Noviembre";
            break;
        default:
            mesRetornar = "Diciembre";
            break;
    }
    return mesRetornar;
}
//===========================================================================//
function get_mes_number(mes) {
    var mesRetornar = "";
    switch (mes) {
        case "Enero":
            mesRetornar = 1;
            break;
        case "Febrero":
            mesRetornar = 2;
            break;
        case "Marzo":
            mesRetornar = 3;
            break;
        case "Abril":
            mesRetornar = 4;
            break;
        case "Mayo":
            mesRetornar = 5;
            break;
        case "Junio":
            mesRetornar = 6;
            break;
        case "Julio":
            mesRetornar = 7;
            break;
        case "Agosto":
            mesRetornar = 8;
            break;
        case "Septiembre":
            mesRetornar = 9;
            break;
        case "Octubre":
            mesRetornar = 10;
            break;
        case "Noviembre":
            mesRetornar = 11;
            break;
        default:
            mesRetornar = 12;
            break;
    }
    return mesRetornar;
}
//================================================================================//
function getClassTd(fecha, indice) {
    var retornar = "";
    var day = "";
    var mes = "";
    if (new Date().getDate() == 1 || new Date().getDate() == 2 || new Date().getDate() == 3 || new Date().getDate() == 4 || new Date().getDate() == 5 || new Date().getDate() == 6 || new Date().getDate() == 7 || new Date().getDate() == 8 || new Date().getDate() == 9) {
        day = "0" + new Date().getDate();
    } else {
        day = new Date().getDate();
    }
    if (new Date().getMonth() == 0 || new Date().getMonth() == 1 || new Date().getMonth() == 2 || new Date().getMonth() == 3 || new Date().getMonth() == 4 || new Date().getMonth() == 5 || new Date().getMonth() == 6 || new Date().getMonth() == 7 || new Date().getMonth() == 8 || new Date().getMonth() == 9) {
        mes = new Date().getMonth() + 1;
        mes = "0" + mes.toString();
    } else {
        mes = new Date().getMonth() + 1;
    }
    var fecha_act = new Date().getFullYear() + "-" + mes + "-" + day;
    if (eventos_registrados.length == 0) {
        retornar = getClassTdAuxiliar(fecha);
    } else {
        var cont = 0;
        for (var i = 0; i < eventos_registrados.length; i++) {
            if (eventos_registrados[i]['fecha'] == fecha) {
                cont++;
            }
        }
        if (cont == 0) {
            retornar = getClassTdAuxiliar(fecha);
        } else {
            retornar = getClassTdAuxiliarOcupado(fecha, indice);
        }
    }
    if (fecha_act == fecha) {
        retornar = "style='color:#0682A1'" + retornar;
    }
    return retornar;
}

function getClassTdAuxiliar(fecha) {
    var retornar = "";
    if (lista_fechas.length == 0) {
        retornar = "class='calendar_td'  >";
    } else {
        var existe = false;
        for (var i = 0; i < lista_fechas.length; i++) {
            if (lista_fechas[i] == fecha) {
                existe = true;
            }
        }
        if (existe == false) {
            retornar = "class='calendar_td'  >";
        } else {
            retornar = "class='calendar_td_selected'  >";
        }
    }
    return retornar;
}

function getClassTdAuxiliarOcupado(fecha, indice) {
    var retornar = "";
    var texto = "";
    for (var i = 0; i < eventos_registrados.length; i++) {
        if (eventos_registrados[i]['fecha'] == fecha) {
            texto += eventos_registrados[i]['tipo_evento'] + "/" + eventos_registrados[i]['ubicacion'] + "/" + eventos_registrados[i]['horas'] + "/" + eventos_registrados[i]["detalle"] + "º";
        }
    }
    if (lista_fechas.length == 0) {
        retornar = " class='calendar_ocupado' onclick='ver_evento(`" + texto + "`,`" + fecha + "`)'  ><span class='fa fa-map-marker' ></span>";
    } else {
        var existe = false;
        for (var i = 0; i < lista_fechas.length; i++) {
            if (lista_fechas[i] == fecha) {
                existe = true;
            }
        }
        if (existe == false) {
            retornar = " class='calendar_ocupado' onclick='ver_evento(`" + texto + "`,`" + fecha + "`)' ><span class='fa fa-map-marker' ></span>";
        } else {
            retornar = " class='calendar_ocupado_selected' onclick='ver_evento(`" + texto + "`,`" + fecha + "`)' ><span class='fa fa-map-marker' ></span>";
        }
    }
    return retornar;
}

function ver_evento(texto, fecha) {
    var separado = texto.split("º");
    var contenido = "<br>";
    for (var i = 0; i < separado.length - 1; i++) {
        var detalle = "";
        var separado2 = separado[i].split("/");
        if (separado2[3] == "" || separado2[3] == null) {
            detalle = "Sin detalles";
        } else {
            detalle = separado2[3];
        }
        contenido += "<div style='width:95%;text-align:left;font-size:20px;padding-left:2%'><span class='fa fa-bookmark-o'></span> " + separado2[0];
        contenido += "<br><br><span class='fa fa-map-marker'></span> " + separado2[1] + "<br><br>";
        contenido += "<span class='fa fa-clock-o'></span> " + separado2[2] + "<br><br>";
        contenido += "<span class='fa fa-warning'></span> " + detalle + "</div><br><br><div style='width:100%;height:2px !important;background:white;'></div><br>";
    }
    swal({
        title: "Eventos del " + fecha,
        text: "<center><em class='fa fa-calendar' style='font-size:50px;color:black;'></em></center><br><br><div style='width:100%;height:280px;color:white;background:#20c997; overflow-y:scroll'>" + contenido + "</div>",
        html: true
    });
}