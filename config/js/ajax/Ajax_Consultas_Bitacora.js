$(function() {
    $.ajax({
        type: "POST",
        url: BASE_URL + "Bitacora/Administrar",
        data: {
            peticion: "Consulta_Ajax",
        },
    }).done(function(datos) {
        var data = JSON.parse(datos);
        $("#example1").DataTable({
            "data": data,
            "columns": [{
                "data": "usuario"
            }, {
                "data": "hora_inicio"
            }, {
                "data": "fecha"
            }, {
                "data": "hora_fin"
            }, {
                "data": "acciones"
            }],
            "responsive": true,
            "autoWidth": false,
            "ordering": true,
            "info": true,
            "processing": true,
            "pageLength": 10,
            "lengthMenu": [5, 10, 20, 30, 40, 50, 100],
            "buttons": ["copy", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    }).fail(function() {
        alert("error")
    })
});