var cantidad_s = document.getElementById("cant_solicitudes");
var solicitudes_no_leidas = document.getElementById("solicitudes-no-leidas");
var solicitudes = document.getElementById("body-solicitudes");
var page_title = document.getElementById("page-title");
var role = document.getElementById('rol_inicio').value;
getSolicitudes();

function getSolicitudes() {
    $.ajax({
        type: "POST",
        url: BASE_URL + "app/Direcciones.php",
        data: {
            direction: "Solicitudes/Consultar_solicitudes",
            accion: "codificar"
        },
    }).done(function (direccion_segura) {
        $.ajax({
            type: 'POST',
            url: BASE_URL + direccion_segura,
        }).done(function (datos) {
            var result_s = JSON.parse(datos);
            var cuerpo_s = "";
            var cuerpo_sa = "";
            var contSA = 0;
            for (var i = 0; i < result_s.length; i++) {
                var icono_s = "";
                var fecha_s = new Date(result_s[i]['fecha_solicitud']);
                var span_s = getSpan(fecha_s, new Date());
                var texto_mensaje = result_s[i]['primer_nombre'] + " " + result_s[i]['primer_apellido'] + " ";
                switch (result_s[i]['tipo_constancia']) {
                    case 'Residencia':
                        icono_s = "<i class='fas fa-home'></i>";
                        texto_mensaje += "Ha realizado una solicitud de constancia de " + result_s[i]['tipo_constancia'];
                        break;
                    case 'Buena conducta':
                        icono_s = "<i class='fas fa-address-card'></i>";
                        texto_mensaje += "Ha realizado una solicitud de constancia de " + result_s[i]['tipo_constancia'];
                        break;
                    case 'No poseer vivienda':
                        icono_s = "<i class='fas fa-hotel'></i>";
                        texto_mensaje += "Ha realizado una solicitud de constancia de " + result_s[i]['tipo_constancia'];
                        break;
                    case 'Vivienda':
                        icono_s = "<i class='fas fa-plus-square'></i>";
                        texto_mensaje += "Ha realizado una solicitud de registro de " + result_s[i]['tipo_constancia'];
                        break;
                    case 'Familia':
                        icono_s = "<i class='fas fa-users'></i>";
                        texto_mensaje += "Ha realizado una solicitud de registro de " + result_s[i]['tipo_constancia'];
                        break;
                    case 'Cambio de contraseña':
                        icono_s = "<i class='fas fa-key'></i>";
                        texto_mensaje += "Ha realizado una solicitud de " + result_s[i]['tipo_constancia'];
                        contSA++;
                        break;
                }

                
                var mensaje_s = getRecortado(texto_mensaje);
                var elementS = "";
                elementS += "<a title='" + texto_mensaje + "' href='javascript:void(0)' style='font-size:12px !important' class='dropdown-item' onclick='goToSolicitud(`" + result_s[i]['id_solicitud'] + "`,`" + result_s[i]['tipo_constancia'] + "`)'>";
                elementS += icono_s + " " + mensaje_s + span_s;
                elementS += "</a><div class='dropdown-divider'></div>";

               if (role == 'Administrador') { 
                   if (result_s[i]['tipo_constancia'] == 'Cambio de contraseña' ) cuerpo_sa += elementS;
               } else {
                if (result_s[i]['tipo_constancia'] != 'Cambio de contraseña' ) cuerpo_s += elementS;
            }
            }
            if (result_s.length == 0) {
                solicitudes_no_leidas.innerHTML = "No hay solcitudes pendientes";
                solicitudes.style.display = "none";
                cantidad_s.innerHTML = '0';
                cantidad_s.style.display = "none";
            } else {
                solicitudes_no_leidas.innerHTML = result_s.length + " Solicitudes";
                cantidad_s.style.display = "";
                if (role == 'Administrador') {
                cantidad_s.innerHTML = contSA ;
                if( contSA == 0 ) { 
                cantidad_s.style.display = "none";
                solicitudes_no_leidas.innerHTML = "No hay solcitudes pendientes";
                solicitudes.style.display = "none";
                }
                } else{
                cantidad_s.innerHTML = (result_s.length - contSA);
                if( (result_s.length - contSA) == 0 ) { 
                    cantidad_s.style.display = "none";
                    solicitudes_no_leidas.innerHTML = "No hay solcitudes pendientes";
                    solicitudes.style.display = "none";
                    }
                }

                console.log(cuerpo_s);
                console.log(cuerpo_sa);
                role == 'Administrador' ? solicitudes.innerHTML = cuerpo_sa : solicitudes.innerHTML = cuerpo_s;
                solicitudes.style.display = "";
            }
            var texto_titulo = "C.C Prados de Occidente";
            if (cantidad.innerHTML != "0") {
                texto_titulo = "(" + cantidad.innerHTML + ")Notificaciones";
            }
            if (cantidad_s.innerHTML != "0") {
                texto_titulo = "(" + cantidad_s.innerHTML + ")Solicitudes";
            }
            if (cantidad.innerHTML != "0" && cantidad_s.innerHTML != "0") {
                texto_titulo = "(" + (parseInt(cantidad_s.innerHTML) + parseInt(cantidad.innerHTML)) + ")C.C Prados de Occidente";
            }
            page_title.innerHTML = texto_titulo;
        });
        setTimeout(function () {
            getSolicitudes();
        }, 5000);
    });
}

function goToSolicitud(id, tipo_solicitud) {
    if (tipo_solicitud == "Vivienda") {
        $.ajax({
            type: "POST",
            url: BASE_URL + "app/Direcciones.php",
            data: {
                direction: "Solicitudes/Solicitud_vivienda",
                accion: "codificar"
            },
        }).done(function (direccion_segura) {
            window.open(BASE_URL + direccion_segura + '&id=' + id);
        });
    } else {
        if (tipo_solicitud == "Familia") {
            $.ajax({
                type: "POST",
                url: BASE_URL + "app/Direcciones.php",
                data: {
                    direction: "Solicitudes/Solicitud_familia",
                    accion: "codificar"
                },
            }).done(function (direccion_segura) {
                window.open(BASE_URL + direccion_segura + '&id=' + id);
            });
        } else {
            $.ajax({
                type: "POST",
                url: BASE_URL + "app/Direcciones.php",
                data: {
                    direction: "Solicitudes/Solicitud",
                    accion: "codificar"
                },
            }).done(function (direccion_segura) {
                window.open(BASE_URL + direccion_segura + '&id=' + id);
            });
        }
    }
}