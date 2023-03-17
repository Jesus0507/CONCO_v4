var tot_aprobadas = document.getElementById('total_aprobadas');
var tot_pendientes = document.getElementById('total_pendientes');
var tot_rechazadas = document.getElementById('total_rechazadas');
var div_aprobadas = document.getElementById("solicitudes_aprobadas");
var div_pendientes = document.getElementById("solicitudes_pendientes");
var div_rechazadas = document.getElementById("solicitudes_rechazadas");
getSolicitudesIndex();

function getSolicitudesIndex() {
    $.ajax({
        type: "POST",
        url: BASE_URL + "app/Direcciones.php",
        data: {
            direction: 'Solicitudes/Administrar',
            accion: "codificar"
        },
        success: function(direccion_segura) {
            $.ajax({
                type: 'POST',
                url: BASE_URL + direccion_segura,
                data: {
                    peticion: 'Consulta_Todas',
                },
            }).done(function(datos) {
                var cuerpo_aprobadas = "";
                var cuerpo_pendientes = "";
                var cuerpo_rechazadas = "";
                var cont_aprobada = 0;
                var cont_pendiente = 0;
                var cont_rechazada = 0;
                var solicitudes_datos = JSON.parse(datos);
                for (var i = 0; i < solicitudes_datos.length; i++) {
                    var fecha_solicitud = new Date(solicitudes_datos[i]['fecha_solicitud']);
                    var date_solicitud = fecha_solicitud.getDate() + "-" + (fecha_solicitud.getMonth() + 1) + "-" + fecha_solicitud.getFullYear();
                    var icono_solicitud = "";
                    var direction;
                    switch (solicitudes_datos[i]['tipo_constancia']) {
                        case "Residencia":
                            icono_solicitud = "fas fa-hotel";
                            break;
                        case "Buena conducta":
                            icono_solicitud = "fas fa-address-card";
                            break;
                        case "No poseer vivienda":
                            cono_solicitud = "fas fa-home";
                            break;
                        case "Vivienda":
                            icono_solicitud = "fas fa-plus-square";
                            break;
                        case "Familia":
                            icono_solicitud = "fas fa-users";
                            break;
                        default:
                            icono_solicitud = "fas fa-key";
                            break;
                    }

                    switch (solicitudes_datos[i]['procesada']) {
                        case 1: //aprobada
                            cuerpo_aprobadas += "<table onclick='openLink(`" + solicitudes_datos[i]["id_solicitud"] + "`,`2`);'";
                            cuerpo_aprobadas += " style='width:100%;cursor:pointer;border-radius:5px' onmouseover='this.style.background=`#5CC8BD`'";
                            cuerpo_aprobadas += "onmouseout='this.style.background=``' ><tr>";
                            cuerpo_aprobadas += "<td colspan='2' style='text-align:right;font-size:12px' >" + date_solicitud + "</td></tr>";
                            cuerpo_aprobadas += "<tr><td><em class='fa fa-user-circle'></em>";
                            cuerpo_aprobadas += "<span style='font-weight: bolder'>";
                            cuerpo_aprobadas += solicitudes_datos[i]["primer_nombre"] + " " + solicitudes_datos[i]['primer_apellido'];
                            cuerpo_aprobadas += "</span></td></tr><tr><td style='font-size:12px'>";
                            cuerpo_aprobadas += "Constancia de " + solicitudes_datos[i]['tipo_constancia'];
                            cuerpo_aprobadas += " <em class='" + icono_solicitud + "'></em></td>";
                            cuerpo_aprobadas += "</tr></table><hr>";
                            cont_aprobada++;
                            break;
                        case 2: //rechazada
                            cuerpo_rechazadas += "<table onclick='openLink(`" + solicitudes_datos[i]["id_solicitud"] + "`,`2`);'";
                            cuerpo_rechazadas += " style='width:100%;cursor:pointer;border-radius:5px' onmouseover='this.style.background=`#A84F4F`'";
                            cuerpo_rechazadas += " onmouseout='this.style.background=``;'><tr>";
                            cuerpo_rechazadas += "<td colspan='2' style='text-align:right;font-size:12px' >" + date_solicitud + "</td></tr>";
                            cuerpo_rechazadas += "<tr><td><em class='fa fa-user-circle'></em>";
                            cuerpo_rechazadas += "<span style='font-weight: bolder'>";
                            cuerpo_rechazadas += solicitudes_datos[i]["primer_nombre"] + " " + solicitudes_datos[i]['primer_apellido'];
                            cuerpo_rechazadas += "</span></td></tr><tr><td style='font-size:12px'>";
                            cuerpo_rechazadas += "Constancia de " + solicitudes_datos[i]['tipo_constancia'];
                            cuerpo_rechazadas += " <em class='" + icono_solicitud + "'></em></td>";
                            cuerpo_rechazadas += "</tr></table><hr>";
                            cont_rechazada++;
                            break;
                        default : //pendiente
                            var cuerpo_sol = '';
                           cuerpo_sol += "<table style='width:100%;cursor:pointer;border-radius:5px' onmouseover='this.style.background=`#A9CFB3`'";
                           cuerpo_sol += "onmouseout='this.style.background=``' ";
                            if(icono_solicitud == 'fas fa-key' || icono_solicitud == 'fas fa-plus-square' ){
                               cuerpo_sol += " onclick='openLink(`" + solicitudes_datos[i]["id_solicitud"] + "`,`3`);' ><tr>"; 
                            }
                            else{
                               cuerpo_sol += " onclick='openLink(`" + solicitudes_datos[i]["id_solicitud"] + "`,`1`);' ><tr>";
                            }
                            
                           cuerpo_sol += "<td colspan='2' style='text-align:right;font-size:12px' >" + date_solicitud + "</td></tr>";
                           cuerpo_sol += "<tr><td><em class='fa fa-user-circle'></em>";
                           cuerpo_sol += "<span style='font-weight: bolder'>";
                           cuerpo_sol += solicitudes_datos[i]["primer_nombre"] + " " + solicitudes_datos[i]['primer_apellido'];
                           cuerpo_sol += "</span></td></tr><tr><td style='font-size:12px'>";
                           if(icono_solicitud == 'fas fa-key' || icono_solicitud == 'fas fa-plus-square' ){
                            cuerpo_sol += "Solicitud de " + solicitudes_datos[i]['tipo_constancia'];
                         }
                         else{
                            cuerpo_sol += "Constancia de " + solicitudes_datos[i]['tipo_constancia'];
                         }
                           cuerpo_sol += " <em class='" + icono_solicitud + "'></em></td>";
                           cuerpo_sol += "</tr></table><hr>";
                           if(solicitudes_datos[i]['tipo_constancia'] == 'Cambio de contraseña' && solicitudes_datos[i]['procesada']==3 && document.getElementById('rol_inicio').value == 'Super Usuario'){
                           cuerpo_pendientes += cuerpo_sol;
                           cont_pendiente++;
                           }

                           if(solicitudes_datos[i]['tipo_constancia'] == 'Cambio de contraseña' && solicitudes_datos[i]['procesada']==0 && document.getElementById('rol_inicio').value == 'Administrador'){
                            cuerpo_pendientes += cuerpo_sol;
                            cont_pendiente++;
                            }

                            if(solicitudes_datos[i]['tipo_constancia'] != 'Cambio de contraseña' && solicitudes_datos[i]['procesada']==0){
                                cuerpo_pendientes += cuerpo_sol;
                                cont_pendiente++;
                                }
                            break;
                    }
                }
                total_rechazadas.innerHTML = "Total:" + cont_rechazada;
                total_aprobadas.innerHTML = "Total:" + cont_aprobada;
                total_pendientes.innerHTML = "Total:" + cont_pendiente;
                div_rechazadas.innerHTML = cuerpo_rechazadas;
                div_aprobadas.innerHTML = cuerpo_aprobadas;
                div_pendientes.innerHTML = cuerpo_pendientes;
                setTimeout(function() {
                    getSolicitudesIndex();
                }, 30000);
            });
        },
        error: function() {
            alert('Error al codificar dirreccion');
        }
    });
}

function openLink(id, tipo) {
    if (tipo == 1) {
        $.ajax({
            type: "POST",
            url: BASE_URL + "app/Direcciones.php",
            data: {
                direction: "Solicitudes/Administrar/Solicitud",
                accion: "codificar"
            },
            success: function(direccion_segura) {
                window.open(BASE_URL + direccion_segura + '?id=' + id);
            },
            error: function() {
                alert('Error al codificar dirreccion');
            }
        });
    } else {
        if(tipo==2){
        $.ajax({
            type: "POST",
            url: BASE_URL + "app/Direcciones.php",
            data: {
                direction: "Solicitudes/Administrar/Solicitud_View_Only",
                accion: "codificar"
            },
            success: function(direccion_segura) {
                window.open(BASE_URL + direccion_segura + '?id=' + id);
            },
            error: function() {
                alert('Error al codificar dirreccion');
            }
        });
    } 
    else{
        var solicitudes_pen = document.getElementById("body-solicitudes");
        for (var i=0; i<solicitudes_pen.children.length;i++){
            var div = document.createElement('div');
            div.appendChild(solicitudes_pen.children[i]);
            if(div.innerHTML.includes("&quot;id_solicitud&quot;:"+id)){
                div.querySelector('a').click();
            }
            else {
                if(div.innerHTML.includes("goToSolicitud(`"+id)){
                    div.querySelector('a').click();
                }
            }
        }
    }
    }
}