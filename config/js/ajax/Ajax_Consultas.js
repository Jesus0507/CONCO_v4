$(document).ready(function() {
    /* const BASE_URL = 'http://localhost/dashboard/www/Proyecto%20Base/';
    typeof BASE_URL; */
    $.ajax({
        type: "POST",
        url: BASE_URL + "app/Direcciones.php",
        data: {
            direction: "Usuario/Consultas_Usuario_Ajax",
            accion: "codificar"
        },
        success: function(direccion_segura) {
            $.ajax({
                type: 'POST',
                url: BASE_URL + direccion_segura
            }).done(function(datos) {
                $('.consulta-usuario').html(datos)
            }).fail(function() {
                alert("error")
            })
        },
        error: function() {
            alert('Error al codificar dirreccion');
        }
    });
});