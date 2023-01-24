cargar_tabla();

function cargar_tabla() {
    $(function() {
        $.ajax({
            type: "POST",
            url: BASE_URL + "app/Direcciones.php",
            data: {
                direction: 'Seguridad/Administrar/Consulta_Ajax',
                accion: "codificar"
            },
            success: function(direccion_segura) {
                $.ajax({
                    type: 'POST',
                    url: BASE_URL + direccion_segura
                }).done(function(datos) {
                    var data = JSON.parse(datos);
                    $("#example1").DataTable({
                        "data": data,
                        "columns": [{
                            "data": "cedula_usuario"
                        }, {
                            "data": "usuario"
                        }, {
                            "data": "estado"
                        }, {
                            "data": "rol"
                        }, {
                            "data": "editar"
                        }, ],
                        "responsive": true,
                        "autoWidth": false,
                        "ordering": true,
                        "info": false,
                        "processing": true,
                        "pageLength": 10,
                        "lengthMenu": [5, 10, 20, 30, 40, 50, 100]
                    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                }).fail(function() {
                    alert("error")
                })
            },
            error: function() {
                alert('Error al codificar dirreccion');
            }
        });
    });
}