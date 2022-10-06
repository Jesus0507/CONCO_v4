$(function() {
            $(document).on("click", "#enviar", function() {
                var cedula_persona = $("#cedula_persona").val();
                var nombre_centro = $("#nombre_centro").val();
                var id_parroquia = document.getElementById("id_parroquia").selectedIndex;
                var datos = {
                    cedula_votante: cedula_persona,
                    nombre_centro: nombre_centro,
                    id_parroquia: id_parroquia,
                    estado: 1
                };
                $.ajax({
                    type: "POST",
                    url: BASE_URL + "app/Direcciones.php",
                    data: {
                        direction: 'Centro_Votacion/Administrar',
                        accion: "codificar"
                    },
                    success: function(direccion_segura) {
                        $.ajax({
                            type: 'POST',
                            url: BASE_URL + direccion_segura,
                            data: {
                                'datos': datos,
                                id_parroquia: id_parroquia,
                                peticion: "Registrar",
                                sql: "SQL_03",
                                accion: "Se ha Asignado" + cedula_persona + " al centro " + nombre_centro,
                            },
                        }).done(function(datos) {
                            if (datos == 1) {
                                swal({
                                    title: "Registrado!",
                                    text: "El elemento fue Registrado con exito.",
                                    type: "success",
                                    showConfirmButton: false
                                });
                                Direccionar("Centro_Votacion/Administrar/Consultas");
                            } else {
                                swal({
                                    title: "ERROR!",
                                    text: datos,
                                    type: "error",
                                    html: true,
                                    showConfirmButton: true,
                                    customClass: "bigSwalV2",
                                });
                            }
                        }).fail(function() {
                            alert("error");
                        });
                    },
                    error: function() {
                        alert('Error al codificar dirreccion');
                    }
                });
            });