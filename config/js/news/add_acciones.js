var last_accion = document.getElementById("last_accion").value;

function cambio_modulo(transicion) {
    if (last_accion != transicion) {
        agregar_accion("Salió del módulo " + last_accion, transicion);
        agregar_accion("Ingresó al módulo " + transicion, transicion);
    }
}

function agregar_accion(accion, tipo) {
    var horas = obtenerHoras(new Date().getHours());
    var minutos = (new Date().getMinutes());
    accion += " a las " + horas + " con " + minutos + " minutos";
    $.ajax({
        type: "POST",
        url: BASE_URL + "Bitacora/Administrar",
        data: {
            nueva_accion: accion,
            tipo :tipo,
            peticion: "Nueva",
        },
    })
}

function obtenerHoras(hora) {
    var retornar = "";
    switch (hora - 1) {
        case 0:
            retornar = "12 de la madrugada";
            break;
        case 1:
            retornar = "1 de la madrugada";
            break;
        case 2:
            retornar = "2 de la madrugada";
            break;
        case 3:
            retornar = "3 de la madrugada";
            break;
        case 4:
            retornar = "4 de la mañana";
            break;
        case 5:
            retornar = "5 de la mañana";
            break;
        case 6:
            retornar = "6 de la mañana";
            break;
        case 7:
            retornar = "7 de la mañana";
            break;
        case 8:
            retornar = "8 de la mañana";
            break;
        case 9:
            retornar = "9 de la mañana";
            break;
        case 10:
            retornar = "10 de la mañana";
            break;
        case 11:
            retornar = "11 de la mañana";
            break;
        case 12:
            retornar = "12 del medio día";
            break;
        case 13:
            retornar = "1 de la tarde";
            break;
        case 14:
            retornar = "2 de la tarde";
            break;
        case 15:
            retornar = "3 de la tarde";
            break;
        case 16:
            retornar = "4 de la tarde";
            break;
        case 17:
            retornar = "5 de la tarde";
            break;
        case 18:
            retornar = "6 de la tarde";
            break;
        case 19:
            retornar = "7 de la noche";
            break;
        case 20:
            retornar = "8 de la noche";
            break;
        case 21:
            retornar = "9 de la noche";
            break;
        case 22:
            retornar = "de la noche";
            break;
        case 23:
            retornar = "de la noche";
            break;
    }
    return retornar;
}

function mostrar_acciones(acciones, usuario) {
    var texto = "<div style='overflow-y: scroll;text-align:justify;height:320px'><div style='width:90%'>" + acciones + "</div></div>";
    swal({
        title: "Ver acciones del usuario " + usuario,
        text: texto,
        html: true
    });
}