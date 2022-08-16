$(function() {
    $(document).on("click", "#enviar", function() {
        var cedula_persona = $("#cedula_persona").val();
        var nombre_centro = $("#nombre_centro").val();
        var id_parroquia = document.getElementById("id_parroquia").selectedIndex;
        var datos = {
            cedula_votante: cedula_persona,
            nombre_centro: nombre_centro,
            estado: 1
        };
        $.ajax({
            type: 'POST',
            url: BASE_URL + 'Centro_Votacion/Administrar',
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
                setTimeout(function() {
                    location.href = BASE_URL + "Centro_Votacion/Administrar/Consultas";
                }, 2000);
            } else {
                swal({
                    title: "ERROR!",
                    text: "Ha ocurrido un Error.</br>" + datos,
                    type: "error",
                    html: true,
                    showConfirmButton: true,
                    customClass: "bigSwalV2",
                });
            }
        }).fail(function() {
            alert("error");
        });
    });
    $("#nombre_centro").keyup(function() {
        var nombre_centro = $("#nombre_centro").val();
        $.ajax({
            type: "POST",
            url: BASE_URL + "Centro_Votacion/Administrar",
            data: {
                peticion: "Centro_Votacion",
                nombre_centro: nombre_centro,
            },
        }).done(function(datos) {
            if (datos != "vacio") {
                document.getElementById("id_parroquia").selectedIndex = datos;
            }
        }).fail(function() {
            alert("error");
        });
    });
});