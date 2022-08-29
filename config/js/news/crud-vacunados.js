$(function () {
    $.ajax({
        type: "POST",
        url: BASE_URL + "app/Direcciones.php",
        data: {
            direction: 'Personas/Consultas_Vacunas_Ajax',
            accion: "codificar"
        },
        success: function (direccion_segura) {
            $.ajax({
                type: 'POST',
                url: BASE_URL + direccion_segura,
            }).done(function (datos) {
                var data = JSON.parse(datos);
                var tabla = $("#example1").DataTable({
                    "data": data,
                    "columns": [{
                        "data": "cedula_persona"
                    },
                    {
                        "data": "nombre_apellido"
                    },
                    {
                        "data": "dosis"
                    },
                    {
                        "data": "fecha_vacuna"
                    },
                    {
                        "data": function (data) {
                            return '<td class="text-center">' +
                                '<a href="javascript:void(0)" style="margin-right: 5px;" class="btn bg-success btnEditar" onclick="editar(this)"  title="Actualizar"  type="button" >' +
                                '<i class="fa fa-edit" style="color: white;"></i>' +
                                '</a>' +

                                '<a href="javascript:void(0)" style="margin-right: 5px;" class="btn bg-danger mensaje-eliminar" title="Eliminar">' +
                                '<i class="fa fa-trash"></i>' +
                                '</a>' +
                                '<p style="display: none;">' + data
                                    .id_vacuna_covid + '</p>' +
                                '</td>';
                        }
                    },

                    ],
                    "responsive": true,
                    "autoWidth": false,
                    "ordering": true,
                    "info": true,
                    "processing": true,
                    "pageLength": 10,
                    "lengthMenu": [5, 10, 20, 30, 40, 50, 100]
                }).buttons().container().appendTo(
                    '#example1_wrapper .col-md-6:eq(0)');



                $(document).on("click", ".mensaje-eliminar", function () {
                    fila = $(this).closest("tr");
                    cedula_persona = fila.find("td:eq(0)").text();

                    swal({
                        title: "¿Desea Eliminar este Elemento?",
                        text: "El elemento seleccionado sera eliminado de manera permanente!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Si, Eliminar!",
                        cancelButtonText: "No, Cancelar!",
                        closeOnConfirm: false,
                        closeOnCancel: false,
                    },
                        function (isConfirm) {
                            if (isConfirm) {
                                $.ajax({
                                    type: "POST",
                                    url: BASE_URL + "app/Direcciones.php",
                                    data: {
                                        direction: "Personas/Eliminar_Vacunados",
                                        accion: "codificar"
                                    },
                                    success: function (direccion_segura) {
                                        $.ajax({
                                            url: BASE_URL + direccion_segura
                                            ,
                                            type: "POST",
                                            data: {
                                                cedula_persona: cedula_persona,
                                            },
                                        }).done(function (result) {
                                            if (result != 0) {
                                                swal({
                                                    title: "Eliminado!",
                                                    text: "El elemento fue eliminado con exito.",
                                                    type: "success",
                                                    showConfirmButton: false,
                                                });
                                                setTimeout(function () {
                                                    location
                                                        .reload();
                                                }, 2000);

                                            }
                                        });
                                    },
                                    error: function () {
                                        alert('Error al codificar dirreccion');
                                    }
                                });

                            } else {
                                swal("Cancelado",
                                    "La accion fue cancelada, la informacion esta segura.",
                                    "error");
                            }
                        }
                    );
                });
            }).fail(function () {
                alert("error")
            })
        },
        error: function () {
            alert('Error al codificar dirreccion');
        }
    });
});