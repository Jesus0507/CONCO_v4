consulta_permisos();

function consulta_permisos() {
    $.ajax({
        type: "POST",
        url: BASE_URL + "app/Direcciones.php",
        data: {
            direction: "Seguridad/Administrar/Obtener_Permisos",
            accion: "codificar"
        },
        success: function(direccion_segura) {
            $.ajax({
                type: "POST",
                url: BASE_URL + direccion_segura
            }).done(function(result) {
                // revisar(result)
                setTimeout(function() {
                    consulta_permisos();
                }, 10000);
            });
        },
        error: function() {
            alert('Error al codificar dirreccion');
        }
    });
}