$(function() {
    $.ajax({
            type: "POST",
            url: BASE_URL + "Negocios/Consultas_Negocios_Ajax",
        })
        .done(function(datos) {
            var data = JSON.parse(datos);

            $("#example1")
                .DataTable({
                    data: data,
                    columns: [{
                            data: "nombre_calle",
                        },
                        {
                            data: "direccion_negocio",
                        },
                        {
                            data: "nombre_negocio",
                        },
                        {
                            data: "cedula_propietario",
                        },
                        {
                            data: "rif_negocio",
                        },
                        {
                            data: function(data) {
                                return (
                                    '<td class="text-center">' +
                                    '<a href="javascript:void(0)" style="margin-right: 5px;" class="btn bg-info ver-popup" title="Ver" type="button" data-toggle="modal" data-target="#ver">' +
                                    '<i class="fa fa-eye"></i>' +
                                    "</a>" +
                                    '<a href="javascript:void(0)" style="margin-right: 5px;" class="btn bg-success btnEditar"  title="Actualizar" type="button" data-toggle="modal" data-target="#actualizar">' +
                                    '<i class="fa fa-edit" style="color: white;"></i>' +
                                    "</a>" +
                                    '<a href="javascript:void(0)" style="margin-right: 5px;" class="btn bg-danger mensaje-eliminar" title="Eliminar">' +
                                    '<i class="fa fa-trash"></i>' +
                                    "</a>" +
                                    '<p style="display: none;">' +
                                    data.id_negocio +
                                    "</p>" +
                                    "</td>"
                                );
                            },
                        },
                    ],
                    responsive: true,
                    autoWidth: false,
                    ordering: true,
                    info: true,
                    processing: true,
                    pageLength: 10,
                    lengthMenu: [5, 10, 20, 30, 40, 50, 100]
                })
                .buttons()
                .container()
                .appendTo("#example1_wrapper .col-md-6:eq(0)");

            $("#example1").on("click", ".mensaje-eliminar", function() {
                fila = $(this).closest("tr");
                id = fila.find("td:eq(5)").text();
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
                    function(isConfirm) {
                        if (isConfirm) {
                            $.ajax({
                                url: BASE_URL + "Negocios/Eliminar_Negocio",
                                type: "POST",
                                data: {
                                    id: id,
                                    nombre_negocio: fila.find("td:eq(2)").text(),
                                },
                            }).done(function(result) {
                                if (result != 0) {
                                    swal({
                                        title: "Eliminado!",
                                        text: "El elemento fue eliminado con exito.",
                                        type: "success",
                                        showConfirmButton: false,
                                    });
                                    setTimeout(function() {
                                        location.reload();
                                    }, 3000);

                                    // tabla.ajax.reload(null, false);
                                }
                            });
                        } else {
                            swal("Cancelado", "La accion fue cancelada, la informacion esta segura.", "error");
                        }
                    }
                );
            });

            $(document).on("click", ".ver-popup", function() {
                fila = $(this).closest("tr");
                calle = fila.find("td:eq(0)").text();
                direccion = fila.find("td:eq(1)").text();
                nombre_negocio = fila.find("td:eq(2)").text();
                cedula_propietario = fila.find("td:eq(3)").text();
                rif_negocio = fila.find("td:eq(4)").text();

                $("#calle").val(calle);

                $("#direccion").val(direccion);
                $("#nombre_negocio").val(nombre_negocio);
                $("#cedula_propietario").val(cedula_propietario);
                $("#rif_negocio").val(rif_negocio);
            });

            $(document).on("click", ".btnEditar", function() {
                fila = $(this).closest("tr");
                id = fila.find("td:eq(5)").text();
                calle = fila.find("td:eq(0)").text();
                direccion = fila.find("td:eq(1)").text();
                nombre_negocio = fila.find("td:eq(2)").text();
                cedula_propietario = fila.find("td:eq(3)").text();
                rif_negocio = fila.find("td:eq(4)").text();

                $("#direccion_negocio2").val(direccion);
                $("#nombre_negocio2").val(nombre_negocio);
                $("#cedula_propietario2").val(cedula_propietario);
                $("#rif_negocio2").val(rif_negocio);

                $(document).on("click", "#enviar", function() {
                    var datos = [
                        document.getElementById("calle2").value,
                        document.getElementById("nombre_negocio2").value,
                        document.getElementById("direccion_negocio2").value,
                        document.getElementById("cedula_propietario2").value,
                        document.getElementById("rif_negocio2").value,
                        id,
                    ];

                    $.ajax({
                            type: "POST",
                            url: BASE_URL + "Negocios/Editar_Negocio",
                            data: {
                                datos: datos,
                            },
                        })
                        .done(function(datos) {
                            if (datos != 0) {
                                    swal({
                                        title: "Exito!",
                                        text: "El elemento fue modificado con exito.",
                                        type: "success",
                                        showConfirmButton: false,
                                    });
                                    setTimeout(function() {
                                        location.reload();
                                    }, 2000);
                                }
                                                   })
                        .fail(function() {
                            alert("error");
                        });
                });
            });
        })
        .fail(function() {
            alert("error");
        });
});