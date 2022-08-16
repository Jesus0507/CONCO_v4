$(function() {
    $.ajax({
        type: "POST",
        url: BASE_URL + "Inmuebles/Administrar",
        data: {
            peticion: "Consulta_Ajax",
        },
    }).done(function(datos) {
        var data = JSON.parse(datos);
        $("#example1").DataTable({
            data: data,
            columns: [{
                data: "nombre_calle",
            }, {
                data: "nombre_inmueble",
            }, {
                data: "direccion_inmueble",
            }, {
                data: "nombre_tipo",
            }, {
                data: function(data) {
                    return ('<td class="text-center">' + '<a href="javascript:void(0)" style="margin-right: 5px;" class="btn bg-info ver-popup" title="Ver" type="button" data-toggle="modal" data-target="#ver">' + '<i class="fa fa-eye"></i>' + "</a>" + '<a href="javascript:void(0)" style="margin-right: 5px;" class="btn bg-success btnEditar"  title="Actualizar" type="button" data-toggle="modal" data-target="#actualizar">' + '<i class="fa fa-edit" style="color: white;"></i>' + "</a>" + '<a href="javascript:void(0)" style="margin-right: 5px;" class="btn bg-danger mensaje-eliminar" title="Eliminar">' + '<i class="fa fa-trash"></i>' + "</a>" + '<p style="display: none;">' + data.id_inmueble + "</p>" + "</td>");
                },
            }, ],
            responsive: true,
            autoWidth: false,
            ordering: true,
            info: true,
            processing: true,
            pageLength: 10,
            lengthMenu: [5, 10, 20, 30, 40, 50, 100]
        }).buttons().container().appendTo("#example1_wrapper .col-md-6:eq(0)");
        $("#example1").on("click", ".mensaje-eliminar", function() {
            fila = $(this).closest("tr");
            id = fila.find("td:eq(4)").text();
            var estado = {
                tabla: "inmuebles",
                id_tabla: "id_inmueble",
                param: id,
                estado: 0
            };
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
            }, function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: BASE_URL + "Inmuebles/Administrar",
                        type: "POST",
                        data: {
                            peticion: "Eliminar",
                            estado: estado,
                            sql: "ACT_DES",
                            accion: "Se ha Eliminado el  Inmueble: " + fila.find("td:eq(1)").text(),
                        },
                    }).done(function(result) {
                        if (result == 1) {
                            swal({
                                title: "Eliminado!",
                                text: "El elemento fue eliminado con exito.",
                                type: "success",
                                showConfirmButton: false,
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 2000);
                        } else {
                            swal({
                                title: "ERROR!",
                                text: "Ha ocurrido un Error.</br>" + result,
                                type: "error",
                                html: true,
                                showConfirmButton: true,
                                customClass: "bigSwalV2",
                            });
                        }
                    });
                } else {
                    swal("Cancelado", "La accion fue cancelada, la informacion esta segura.", "error");
                }
            });
        });
        $(document).on("click", ".ver-popup", function() {
            fila = $(this).closest("tr");
            calle = fila.find("td:eq(0)").text();
            inmueble = fila.find("td:eq(1)").text();
            direccion = fila.find("td:eq(2)").text();
            tipo_inmueble = fila.find("td:eq(3)").text();
            $("#calle").val(calle);
            $("#nombre_inmueble").val(inmueble);
            $("#direccion").val(direccion);
            $("#tipo_inmueble").val(tipo_inmueble);
        });
        $(document).on("click", ".btnEditar", function() {
            fila = $(this).closest("tr");
            id = fila.find("td:eq(4)").text();
            calle = fila.find("td:eq(0)").text();
            inmueble = fila.find("td:eq(1)").text();
            direccion = fila.find("td:eq(2)").text();
            tipo_inmueble = fila.find("td:eq(3)").text();
            $("#calle2").val(calle);
            $("#nombre_inmueble2").val(inmueble);
            $("#direccion2").val(direccion);
            $("#tipo_inmueble2").val(tipo_inmueble);
            $.ajax({
                type: "POST",
                url: BASE_URL + "Inmuebles/Administrar",
                data: {
                    peticion: "Consultas_Calle",
                    calle: calle,
                },
            }).done(function(datos) {
                document.getElementById("id_calle2").value = datos;
            }).fail(function() {
                alert("error")
            })
            $(document).on("click", "#enviar", function() {

                var datos = {
                    id_calle: $("#id_calle2").val(),
                    nombre_inmueble: $("#nombre_inmueble2").val(),
                    direccion_inmueble: $("#direccion2").val(),
                    id_tipo_inmueble: $("#tipo_inmueble2").val(),
                    estado: 1,
                    id_inmueble: id,
                };
                
                $.ajax({
                    type: "POST",
                    url: BASE_URL + "Inmuebles/Administrar",
                    data: {
                        datos: datos,
                        peticion: "Administrar",
                        sql: "SQL_03",
                        accion: "Se ha Actualizado el  Inmueble: " + datos.nombre_inmueble,
                    },
                }).done(function(datos) {
                    if (datos == 1) {
                        swal({
                            title: "Actualizado!",
                            text: "El elemento fue Actualizado con exito.",
                            type: "success",
                            showConfirmButton: false
                        });
                        setTimeout(function() {
                            location.reload();
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
        });
    }).fail(function() {
        alert("error");
    });
});