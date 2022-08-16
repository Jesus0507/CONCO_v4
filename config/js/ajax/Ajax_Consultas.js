$(document).ready(function() {
    /* const BASE_URL = 'http://localhost/dashboard/www/Proyecto%20Base/';
    typeof BASE_URL; */
    $.ajax({
        type: 'POST',
        url: BASE_URL + 'Usuario/Consultas_Usuario_Ajax'
    }).done(function(datos) {
        $('.consulta-usuario').html(datos)
    }).fail(function() {
        alert("error")
    })
});