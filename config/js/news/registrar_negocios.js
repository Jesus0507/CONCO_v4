$(document).ready(function() { 
    $("#enviar").on("click", function() {
        var form = $("#formulario"); 
        var id_calle = document.getElementById("id_calle");
        var nombre_negocio = document.getElementById("nombre_negocio");
        var direccion = document.getElementById("direccion");
        var cedula_propietario = document.getElementById("cedula_propietario");
        var rif_negocio = document.getElementById("rif_negocio");
        var mensaje_calle = document.getElementById("mensaje_calle");
        var mensaje_negocio = document.getElementById("mensaje_negocio");
        var mensaje_direccion = document.getElementById("mensaje_direccion");
        var mensaje_cedula = document.getElementById("mensaje_cedula");
        var mensaje_rif = document.getElementById("mensaje_rif");
        var retornar = false; 
        if (id_calle.value == 0 && direccion.value == '' || direccion.value == null && nombre_negocio.value == '' || nombre_negocio.value == null && cedula_propietario.value == '' || cedula_propietario.value == null && rif_negocio.value == '' || rif_negocio.value == null) {
            mensaje_calle.innerHTML = 'Debe seleccionar una Calle';
            id_calle.style.borderColor = 'red';
            mensaje_calle.style.color = 'red';
            id_calle.focus();
            mensaje_direccion.innerHTML = 'el campo direccion no puede estar vacio';
            direccion.style.borderColor = 'red';
            mensaje_direccion.style.color = 'red';
            direccion.focus();
            mensaje_negocio.innerHTML = 'el campo nombre no puede estar vacio';
            nombre_negocio.style.borderColor = 'red';
            mensaje_negocio.style.color = 'red';
            nombre_negocio.focus();
            mensaje_cedula.innerHTML = 'el campo cedula no puede estar vacio';
            cedula_propietario.style.borderColor = 'red';
            mensaje_cedula.style.color = 'red';
            cedula_propietario.focus();
            mensaje_rif.innerHTML = 'el campo rif no puede estar vacio';
            rif_negocio.style.borderColor = 'red';
            mensaje_rif.style.color = 'red';
            rif_negocio.focus();
        }
        if (id_calle.value == 0) {
            mensaje_calle.innerHTML = 'Debe seleccionar una Calle';
            id_calle.style.borderColor = 'red';
            mensaje_calle.style.color = 'red';
            id_calle.focus();
        } else {
            mensaje_calle.innerHTML = '';
            id_calle.style.borderColor = '';
            if (direccion.value == '' || direccion.value == null) {
                mensaje_direccion.innerHTML = 'el campo direccion no puede estar vacio';
                direccion.style.borderColor = 'red';
                mensaje_direccion.style.color = 'red';
                direccion.focus();
            } else {
                mensaje_direccion.innerHTML = '';
                direccion.style.borderColor = '';
                if (nombre_negocio.value == '' || nombre_negocio.value == null) {
                    mensaje_negocio.innerHTML = 'el campo nombre no puede estar vacio';
                    nombre_negocio.style.borderColor = 'red';
                    mensaje_negocio.style.color = 'red';
                    nombre_negocio.focus();
                } else {
                    mensaje_negocio.innerHTML = '';
                    nombre_negocio.style.borderColor = '';
                    if (cedula_propietario.value == '' || cedula_propietario.value == null) {
                        mensaje_cedula.innerHTML = 'el campo cedula no puede estar vacio';
                        cedula_propietario.style.borderColor = 'red';
                        mensaje_cedula.style.color = 'red';
                        cedula_propietario.focus();
                    } else {
                        mensaje_cedula.innerHTML = '';
                        cedula_propietario.style.borderColor = '';
                        if (rif_negocio.value == '' || rif_negocio.value == null) {
                            mensaje_rif.innerHTML = 'el campo rif no puede estar vacio';
                            rif_negocio.style.borderColor = 'red';
                            mensaje_rif.style.color = 'red';
                            rif_negocio.focus();
                        } else {
                            mensaje_rif.innerHTML = '';
                            rif_negocio.style.borderColor = '';
                            var datos = {
                                id_calle: $("#id_calle").val(),
                                nombre_negocio: $("#nombre_negocio").val(),
                                direccion_negocio: $("#direccion").val(),
                                cedula_propietario: $("#cedula_propietario").val(),
                                rif_negocio: $("#rif_negocio").val(),
                                estado: 1
                            };
                            $.ajax({
                                type: 'POST',
                                url: BASE_URL + 'Negocios/Administrar',
                                data: {
                                    'datos': datos,
                                    peticion: "Existente"
                                },
                            }).done(function(respuesta) {
                                if (respuesta != 0) {
                                    mensaje_rif.innerHTML = 'Ya hay un negocio registrado con este rif.';
                                    rif_negocio.style.borderColor = 'red';
                                    mensaje_rif.style.color = 'red';
                                    rif_negocio.focus();
                                } else {
                                    $.ajax({
                                        type: 'POST',
                                        url: BASE_URL + 'Negocios/Administrar',
                                        data: {
                                            'datos': datos,
                                            peticion: "Administrar",
                                            sql: "SQL_02",
                                            accion: "Se ha registrado un nuevo negocio: "+datos.nombre_negocio,
                                        },
                                        success: function(respuesta) {
                                            if (respuesta == 1) {
                                                swal({
                                                    title: "Exito!",
                                                    text: "Se ha registrado de forma exitosa",
                                                    type: "success",
                                                    showConfirmButton: false,
                                                });
                                                setTimeout(function() {
                                                    location.href = BASE_URL + 'Negocios/Administrar/Consultas';
                                                }, 2000);
                                            } else {
                                                swal({
                                                    title: "ERROR!",
                                                    text: "Ha ocurrido un Error.</br>" + respuesta,
                                                    type: "error",
                                                    html: true,
                                                    showConfirmButton: true,
                                                    customClass: "bigSwalV2",
                                                });
                                            }
                                        },
                                        error: function(respuesta) {
                                            alert("Error al enviar Controlador")
                                        }
                                    });
                                }
                            }).fail(function() {
                                swal("ERROR", "Ha ocurrido un Error.", "error");
                            })
                        }
                    }
                }
            }
        }
    });
    document.onkeypress = function(e) {
        if (e.which == 13 || e.keyCode == 13) {
            return false;
        } else {
            return true;
        }
    }
});