$(document).ready(function() {
    $("#enviar").on("click", function() {
        var datos = { 
            id_calle: $("#id_calle").val(),
            nombre_negocio: $("#nombre_negocio").val(),
            direccion_negocio: $("#direccion").val(),
            cedula_propietario: $("#cedula_propietario").val(),
            rif_negocio: $("#rif_negocio").val(),
            estado: 1
        };
        $.ajax({
            type: "POST",
            url: BASE_URL + "app/Direcciones.php",
            data: {
                direction: 'Negocios/Administrar',
                accion: "codificar"
            },
            success: function(direccion_segura) {
                $.ajax({
                    type: 'POST',
                    url: BASE_URL + direccion_segura,
                    data: {
                        datos: datos,
                        peticion: "Administrar",
                        sql: "SQL_02",
                        accion: "Se ha registrado un nuevo negocio: " + datos.nombre_negocio,
                    },
                }).done(function(respuesta) {
                    if (respuesta == 1) {
                        swal({
                            title: "Exito!",
                            text: "Se ha registrado de forma exitosa",
                            type: "success",
                            showConfirmButton: false,
                        });
                        Direccionar('Negocios/Administrar/Consultas');
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
                }).fail(function() {
                    swal("ERROR", "Ha ocurrido un Error.", "error");
                })
            },
            error: function() {
                alert('Error al codificar dirreccion');
            }
        });
    });
    document.onkeypress = function(e) {
        if (e.which == 13 || e.keyCode == 13) {
            return false;
        } else {
            return true;
        }
    }
});