var cantidad_s = document.getElementById("cant_solicitudes");
var solicitudes_no_leidas = document.getElementById("solicitudes-no-leidas");
var solicitudes = document.getElementById("body-solicitudes");
var page_title = document.getElementById("page-title");
var role = document.getElementById('rol_inicio').value;
var process = '';
var descartar = document.getElementById('descartar');
var procesar = document.getElementById('procesar');
var solicitante = new Object();
getSolicitudes();

function getSolicitudes() {
    $.ajax({
        type: "POST",
        url: BASE_URL + "app/Direcciones.php",
        data: {
            direction: "Solicitudes/Administrar",
            accion: "codificar"
        },
    }).done(function(direccion_segura) {
        $.ajax({
            type: 'POST',
            url: BASE_URL + direccion_segura,
            data: {
                peticion: "Consulta_Todas",
            },
        }).done(function(datos) {
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
                        process = result_s[i]['procesada'];
                        contSA++;
                        break;
                }
                var mensaje_s = getRecortado(texto_mensaje);
                var elementS = "";
                if (result_s[i]['tipo_constancia'] == 'Cambio de contraseña') {
                    if (result_s[i]['procesada'] == 3) {
                        elementS += "<a title='" + texto_mensaje + "' href='javascript:void(0)' style='font-size:12px !important' class='dropdown-item' onclick='goToSolicitudSU(`" + JSON.stringify(result_s[i]) + "`)'>";
                    } else {
                        elementS += "<a title='" + texto_mensaje + "' href='javascript:void(0)' style='font-size:12px !important' class='dropdown-item' onclick='goToSolicitudAdministrador(`" + JSON.stringify(result_s[i]) + "`)'>";
                    }
                } else {
                    elementS += "<a title='" + texto_mensaje + "' href='javascript:void(0)' style='font-size:12px !important' class='dropdown-item' onclick='goToSolicitud(`" + result_s[i]['id_solicitud'] + "`,`" + result_s[i]['tipo_constancia'] + "`)'>";
                }
                elementS += icono_s + " " + mensaje_s + span_s;
                elementS += "</a><div class='dropdown-divider'></div>";
                if (role == 'Administrador' || (role == 'Super Usuario' && result_s[i]['procesada'] == 3)) {
                    if (result_s[i]['tipo_constancia'] == 'Cambio de contraseña') cuerpo_sa += elementS;
                } else {
                    if (result_s[i]['tipo_constancia'] != 'Cambio de contraseña') cuerpo_s += elementS;
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
                if (role == 'Administrador' || (role == 'Super Usuario' && process == 3)) {
                    cantidad_s.innerHTML = contSA;
                    if (contSA == 0) {
                        cantidad_s.style.display = "none";
                        solicitudes_no_leidas.innerHTML = "No hay solcitudes pendientes";
                        solicitudes.style.display = "none";
                    }
                } else {
                    cantidad_s.innerHTML = (result_s.length - contSA);
                    if ((result_s.length - contSA) == 0) {
                        cantidad_s.style.display = "none";
                        solicitudes_no_leidas.innerHTML = "No hay solcitudes pendientes";
                        solicitudes.style.display = "none";
                    }
                }
                if (role == 'Administrador' || (role == 'Super Usuario' && process == 3)) {
                    solicitudes.innerHTML = cuerpo_sa;
                } else {
                    solicitudes.innerHTML = cuerpo_s
                }
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
        setTimeout(function() {
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
                direction: "Solicitudes/Administrar/Solicitud_Vivienda",
                accion: "codificar"
            },
        }).done(function(direccion_segura) {
            window.open(BASE_URL + direccion_segura + '?id=' + id);
        });
    } else {
        if (tipo_solicitud == "Familia") {
            $.ajax({
                type: "POST",
                url: BASE_URL + "app/Direcciones.php",
                data: {
                    direction: "Solicitudes/Administrar/Solicitud_Familia",
                    accion: "codificar"
                },
            }).done(function(direccion_segura) {
                window.open(BASE_URL + direccion_segura + '?id=' + id);
            });
        } else {
            $.ajax({
                type: "POST",
                url: BASE_URL + "app/Direcciones.php",
                data: {
                    direction: "Solicitudes/Administrar/Solicitud",
                    accion: "codificar"
                },
            }).done(function(direccion_segura) {
                window.open(BASE_URL + direccion_segura + '?id=' + id);
            });
        }
    }
}

function goToSolicitudAdministrador(info) {
    info = JSON.parse(info);
    var cedula = document.getElementById('cedula_solicitud');
    var descripcion = document.getElementById('descripcion_solicitud');
    var firma = document.getElementById('firma_solicitud');
    solicitante['correo'] = info['correo'];
    solicitante['id'] = info['id_solicitud'];
    firma.value = info['digital_sign'];
    cedula.innerHTML = info['cedula_persona'];
    descripcion.innerHTML = info['primer_nombre'] + info['primer_apellido'];
    $('#change_password').modal('show');
}
descartar.onclick = function() {
    descartarSolicitud();
}
procesar.onclick = function() {
    process != 3 ? procesarSolicitud() : procesarSolicitudSU();
}

function descartarSolicitud() {
    var textoSwal = "Está por descartar la solicitud de cambio de contraseña ¿desea continuar?<br><br>";
    textoSwal += "<textArea class='form-control' placeholder='Motivo de rechazo' id='text-area'></textArea><br>";
    textoSwal += "<div style='color:red' id='valid-text-area'></div>";
    swal({
        title: "Atención",
        type: "warning",
        text: textoSwal,
        showCancelButton: true,
        confirmButtonText: "Si, rechazar",
        cancelButtonText: "No, cancelar",
        closeOnConfirm: false,
        html: true,
    }, function(isConfirm) {
        if (isConfirm) {
            //eliminarSolicitud();
            if (document.getElementById("text-area").value == "") {
                document.getElementById("text-area").focus();
                document.getElementById("text-area").style.borderColor = "red";
                document.getElementById("valid-text-area").innerHTML = "Debe ingresar el motivo del rechazo de la solicitud";
            } else {
                var motivo_rechazo = document.getElementById("text-area").value;
                document.getElementById("valid-text-area").innerHTML = "";
                document.getElementById("text-area").style.borderColor = "";
                document.getElementById("text-area").blur();
                solicitante['cedula_persona'] = document.getElementById('cedula_solicitud').innerHTML;
                solicitante["asunto"] = "Solicitud de cambio de contraseña rechazada";
                solicitante["mensaje"] = "Su solicitud  de cambio de contraseña ha sido rechazada. El motivo del rechazo es: " + motivo_rechazo;
                rechazoSolicitud(motivo_rechazo);
                swal({
                    title: "Exito",
                    text: "La solicitud ha sido rechazada",
                    type: "success",
                    showConfirmButton: false,
                    timer: 2000,
                });
                if (solicitante["correo"] != "No posee") {
                    location.reload();
                    //   document.getElementById("btn_correo").click();
                } else {
                    location.reload();
                }
            }
        }
    });
};

function procesarSolicitud() {
    var textoSwal = "Necesitamos la siguiente información para poder procesar la solicitud:<br><br>";
    textoSwal += "<textArea class='form-control' placeholder='Ingrese su firma digital' id='text-area-sign'></textArea><br>";
    textoSwal += "<div style='color:red' id='valid-text-area-sign'></div>";
    textoSwal += "<textArea class='form-control' placeholder='Ingrese su clave pública' id='text-area-public'></textArea><br>";
    textoSwal += "<div style='color:red' id='valid-text-area-public'></div>";
    swal({
        title: "Atención",
        type: "warning",
        text: textoSwal,
        showCancelButton: true,
        confirmButtonText: "Si, procesar",
        cancelButtonText: "No, cancelar",
        closeOnConfirm: false,
        html: true,
    }, function(isConfirm) {
        if (isConfirm) {
            //eliminarSolicitud();
            if (document.getElementById("text-area-sign").value == "") {
                document.getElementById("text-area-sign").focus();
                document.getElementById("text-area-sign").style.borderColor = "red";
                document.getElementById("valid-text-area-sign").innerHTML = "Debe ingresar su firma digital";
            } else {
                document.getElementById("valid-text-area-sign").innerHTML = "";
                document.getElementById("text-area-sign").style.borderColor = "";
                document.getElementById("text-area-sign").blur();
                if (document.getElementById("text-area-public").value == "") {
                    document.getElementById("text-area-public").focus();
                    document.getElementById("text-area-public").style.borderColor = "red";
                    document.getElementById("valid-text-area-public").innerHTML = "Debe ingresar su clave pública";
                } else {
                    var sign = document.getElementById("text-area-sign").value;
                    var public = document.getElementById("text-area-public").value;
                    document.getElementById("valid-text-area-public").innerHTML = "";
                    document.getElementById("text-area-public").style.borderColor = "";
                    document.getElementById("text-area-public").blur();
                    procesamientoSolicitud(sign, public);
                }
            }
        }
    });
};

function procesamientoSolicitud(firma, clave) {
    var fecha_actual = new Date();
    fecha_actual = fecha_actual.getDate() + "-" + (fecha_actual.getMonth() + 1) + "-" + fecha_actual.getFullYear();
    $.ajax({
        type: "POST",
        url: BASE_URL + "app/Direcciones.php",
        data: {
            direction: "Solicitudes/Administrar",
            accion: "codificar"
        },
        success: function(direccion_segura) {
            $.ajax({
                type: "POST",
                url: BASE_URL + direccion_segura,
                data: {
                    peticion: "Estado_Contrasenia",
                    id: solicitante['id'],
                    procesada: 3,
                    observaciones: "Procesada el " + fecha_actual + "/" + firma + "/" + clave,
                },
            }).done(function(resp) {
                if (resp == 'proceder') {
                    swal({
                        title: "Exito",
                        text: "La solicitud ha sido procesada",
                        type: "success",
                        showConfirmButton: false,
                        timer: 2000,
                    });
                } else {
                    if (resp == 0) {
                        swal({
                            title: "Error",
                            text: "Su firma digital es incorrecta",
                            type: "error",
                            showConfirmButton: false,
                            timer: 2000,
                        });
                    } else {
                        swal({
                            title: "Error",
                            text: "Clave pública no válida. Si no conoce su clave pública, puede acceder a ella en el panel de usuario arriba a la derecha. Allí podra copiarla",
                            type: "warning",
                        });
                    }
                }
            })
        },
        error: function() {
            alert('Error al codificar dirreccion');
        }
    });
}

function rechazoSolicitud(motivo) {
    var fecha_actual = new Date();
    fecha_actual = fecha_actual.getDate() + "-" + (fecha_actual.getMonth() + 1) + "-" + fecha_actual.getFullYear();
    $.ajax({
        type: "POST",
        url: BASE_URL + "app/Direcciones.php",
        data: {
            direction: "Solicitudes/Administrar",
            accion: "codificar"
        },
        success: function(direccion_segura) {
            $.ajax({
                type: "POST",
                url: BASE_URL + direccion_segura,
                data: {
                    peticion: "Establecer_Estado",
                    id: solicitante['id'],
                    procesada: 2,
                    observaciones: "Rechazada el " + fecha_actual + "/" + motivo,
                },
            });
        },
        error: function() {
            alert('Error al codificar dirreccion');
        }
    });
}

function goToSolicitudSU(info) {
    info = JSON.parse(info);
    var divs = document.getElementById('change_password').querySelectorAll('div');
    divs[0].classList.remove('modal-xs');
    divs[0].classList.add('modal-xl');
    var cedula = document.getElementById('cedula_solicitud');
    var descripcion = document.getElementById('descripcion_solicitud');
    var firma = document.getElementById('firma_solicitud');
    var claveAdmin = document.getElementById('clave_administrador');
    var firma_label = document.getElementById('sign-label');
    firma.classList.add('d-none');
    firma_label.classList.add('d-none');
    document.getElementById('adminInfo').classList.remove('d-none');
    var observaciones = info['observaciones'];
    var firma = observaciones.split('/');
    // solicitante['correo'] = info['correo'];
    solicitante['id'] = info['id_solicitud'];
    solicitante['cedula'] = info['cedula_persona'];
    cedula.innerHTML = info['cedula_persona'];
    descripcion.innerHTML = info['primer_nombre'] + info['primer_apellido'];
    document.getElementById('firma_administrador').value = firma[1];
    claveAdmin.value = firma[2];
    claveAdmin.disabled = 'disabled';
    document.getElementById('firma_administrador').disabled = 'disabled';
    $('#change_password').modal('show');
}

function procesarSolicitudSU() {
    if (document.getElementById('clave_su').value === '' || document.getElementById('clave_su').value === null) {
        swal({
            type: 'error',
            title: 'Error',
            text: 'Debe ingresar su clave privada. Si no la conoce, puede acceder a ella a través del panel de usuario, arriba a la derecha'
        });
        document.getElementById('clave_su').style.borderColor = 'red';
    } else {
        document.getElementById('clave_su').style.borderColor = '';
        if (document.getElementById('decodificarFirma').style.display != 'none') {
            swal({
                type: 'warning',
                title: 'Algo ha salido mal',
                text: 'Debe decodificar la firma digital del administrador, para poder comprobar su identidad y aprobar o rechazar la solicitud'
            });
        } else {
            var fecha_actual = new Date();
            fecha_actual = fecha_actual.getDate() + "-" + (fecha_actual.getMonth() + 1) + "-" + fecha_actual.getFullYear();
            $.ajax({
                type: "POST",
                url: BASE_URL + "app/Direcciones.php",
                data: {
                    direction: "Solicitudes/Administrar",
                    accion: "codificar"
                },
                success: function(direccion_segura) {
                    $.ajax({
                        type: "POST",
                        url: BASE_URL + direccion_segura,
                        data: {
                            peticion: "Aprobar_Cambio_Clave",
                            id: solicitante['id'],
                            cedula: solicitante['cedula'],
                            procesada: 1,
                            observaciones: "Aprobada el " + fecha_actual,
                        },
                    }).done(function(resp) {
                        console.log(resp);
                        if (resp) {
                            swal({
                                type: 'success',
                                title: 'Exito!',
                                text: 'Se ha aprobado el cambio de contraseña exitosamente!',
                                showConfirmButton: false,
                                timer: 2000
                            });
                            setTimeout(function() {
                                location.reload()
                            }, 2000);
                        }
                    });
                },
                error: function() {
                    alert('Error al codificar dirreccion');
                }
            });
        }
    }
}
document.getElementById('decodificarFirma').onclick = function() {
    if (document.getElementById('clave_su').value === '' || document.getElementById('clave_su').value === null) {
        swal({
            type: 'error',
            title: 'Error',
            text: 'Debe ingresar su clave privada. Si no la conoce, puede acceder a ella a través del panel de usuario, arriba a la derecha'
        });
        document.getElementById('clave_su').style.borderColor = 'red';
    } else {
        document.getElementById('clave_su').style.borderColor = '';
        document.getElementById('span_su').className = document.getElementById('span_admin').className = 'loader';
        $.ajax({
            type: "POST",
            url: BASE_URL + "app/Direcciones.php",
            data: {
                direction: "Solicitudes/Administrar",
                accion: "codificar"
            },
            success: function(direccion_segura) {
                $.ajax({
                    type: "POST",
                    url: BASE_URL + direccion_segura,
                    data: {
                        peticion: "Ver_Claves",
                        public_key: document.getElementById('clave_administrador').value,
                        private_key: document.getElementById('clave_su').value,
                        firma: document.getElementById('firma_administrador').value
                    },
                }).done(function(resp) {
                    resp = JSON.parse(resp);
                    if (resp['public'] === 1) {
                        document.getElementById('span_admin').style.color = 'green';
                        document.getElementById('span_admin').style.fontSize = '23px';
                        document.getElementById('span_admin').className = 'fa fa-check';
                        setTimeout(function() {
                            if (resp['priv'] === 1) {
                                document.getElementById('span_su').style.color = 'green';
                                document.getElementById('span_su').className = 'fa fa-check';
                                document.getElementById('span_su').style.fontSize = '23px';
                                setTimeout(function() {
                                    document.getElementById('firma_administrador').value = resp['firma'];
                                    document.getElementById('decodificarFirma').style.display = 'none';
                                }, 2000)
                            }
                        }, 2000)
                    }
                });
            },
            error: function() {
                alert('Error al codificar dirreccion');
            }
        });
    }
}