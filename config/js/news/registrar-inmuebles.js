    $(document).ready(function() {
        $("#enviar").on("click", function() {
            var form = $("#formulario");
            var id_calle = document.getElementById("id_calle");
            var nombre_inmueble = document.getElementById("nombre_inmueble");
            var direccion = document.getElementById("direccion");
            var tipo_inmueble = document.getElementById("tipo_inmueble");
            var mensaje_1 = document.getElementById("mensaje_1");
            var mensaje_2 = document.getElementById("mensaje_2");
            var mensaje_3 = document.getElementById("mensaje_3");
            var mensaje_4 = document.getElementById("mensaje_4");
            var datos = {
                id_calle: $("#id_calle").val(),
                nombre_inmueble: $("#nombre_inmueble").val(),
                direccion_inmueble: $("#direccion").val(),
                id_tipo_inmueble: $("#tipo_inmueble").val(), 
                estado: 1
            };
            var retornar = false;
            if (id_calle.value == 0) {
                mensaje_1.innerHTML = 'Debe seleccionar una Calle';
                id_calle.style.borderColor = 'red';
                mensaje_1.style.color = 'red';
                id_calle.focus();
            } else {
                mensaje_1.innerHTML = '';
                id_calle.style.borderColor = '';
                if (nombre_inmueble.value == '' || nombre_inmueble.value == null) {
                    mensaje_2.innerHTML = 'el campo nombre no puede estar vacio';
                    nombre_inmueble.style.borderColor = 'red';
                    mensaje_2.style.color = 'red';
                    nombre_inmueble.focus();
                } else {
                    mensaje_2.innerHTML = '';
                    nombre_inmueble.style.borderColor = '';
                    if (direccion.value == '' || direccion.value == null) {
                        mensaje_3.innerHTML = 'el campo direccion no puede estar vacio';
                        direccion.style.borderColor = 'red';
                        mensaje_3.style.color = 'red';
                        direccion.focus();
                    } else {
                        mensaje_3.innerHTML = '';
                        direccion.style.borderColor = '';
                        if (tipo_inmueble.value == '' || tipo_inmueble.value == null) {
                            mensaje_4.innerHTML = 'el campo tipo de inmueble no puede estar vacio';
                            tipo_inmueble.style.borderColor = 'red';
                            mensaje_4.style.color = 'red';
                            tipo_inmueble.focus();
                        } else {
                            mensaje_4.innerHTML = '';
                            tipo_inmueble.style.borderColor = '';
                            $.ajax({
                                type: 'POST',
                                url: BASE_URL + 'Inmuebles/Administrar',
                                data: {
                                    'datos': datos,
                                    peticion: "Administrar",
                                    sql: "SQL_02",
                                    accion: "Se ha registrado un nuevo Inmueble: " + datos.nombre_inmueble,
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
                                            location.href = BASE_URL + 'Inmuebles/Administrar/Consultas';
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
                    }
                }
            }
        });
        document.onkeypress = function(e) {
            if (e.which == 13 || e.keyCode == 13) {
                envioFormulario();
                return false;
            } else {
                return true;
            }
        }
    });