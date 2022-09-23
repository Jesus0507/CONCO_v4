    $(document).ready(function() {
        $("#enviar").on("click", function() {
            var datos = {
                id_calle: $("#id_calle").val(),
                nombre_inmueble: $("#nombre_inmueble").val(),
                direccion_inmueble: $("#direccion").val(),
                id_tipo_inmueble: $("#tipo_inmueble").val(),
                estado: 1
            };
            var retornar = false;
            $.ajax({
                type: "POST",
                url: BASE_URL + "app/Direcciones.php",
                data: {
                    direction: 'Inmuebles/Administrar',
                    accion: "codificar"
                },
                success: function(direccion_segura) {
                    $.ajax({
                        type: 'POST',
                        url: BASE_URL + direccion_segura,
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
                                Direccionar('Inmuebles/Administrar/Consultas');
                            } else {
                                swal({
                                    title: "ERROR!",
                                    text: respuesta,
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
                },
                error: function() {
                    alert('Error al codificar dirreccion');
                }
            });
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