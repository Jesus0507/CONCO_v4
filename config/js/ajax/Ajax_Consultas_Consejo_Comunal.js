$(function() {
    $.ajax({
        type: "POST",
        url: BASE_URL + "Consejo_Comunal/Administrar",
        data: {
            peticion: "Consulta_Ajax",
        },
    }).done(function(datos) {
        var data = JSON.parse(datos);
        var tabla = $("#tabla").DataTable({
            "data": data,
            "columns": [{
                "data": "cedula_persona",
            }, {
                "data": function(data) {
                    return data.primer_nombre + " " + data.primer_apellido;
                },
            }, {
                "data": "nombre_comite",
            }, {
                "data": "cargo_persona",
            }, {
                "data": "fecha_ingreso",
            }, {
                "data": function(data) {
                    if (data.fecha_salida != "0000-00-00") {
                        return data.fecha_salida;
                    } else {
                        return "Activo";
                    }
                },
            }, {
                "data": function(data) {
                    return ('<td class="text-center">' + '<a href="javascript:void(0)" style="margin-right: 5px;" class="btn bg-info ver-popup" title="Ver" type="button" data-toggle="modal" data-target="#ver">' + '<i class="fa fa-eye"></i>' + "</a>" + '<a href="javascript:void(0)" style="margin-right: 5px;" class="btn bg-success btnEditar"  title="Actualizar" type="button" data-toggle="modal" data-target="#actualizar">' + '<i class="fa fa-edit" style="color: white;"></i>' + "</a>" + '<a href="javascript:void(0)" style="margin-right: 5px;" class="btn bg-danger mensaje-eliminar" title="Eliminar">' + '<i class="fa fa-trash"></i>' + "</a>" + '<p style="display: none;">' + data.id_comite_persona + "</p>" + "</td>");
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
        /* OPCION ELIMINAR */
        $(document).on("click", ".mensaje-eliminar", function() {
            fila = $(this).closest("tr");
            id = fila.find("td:eq(6)").text();
            var estado = {
                tabla: "comite_persona",
                id_tabla: "id_comite_persona",
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
                        url: BASE_URL + "Consejo_Comunal/Administrar",
                        type: "POST",
                        data: {
                            peticion: "Eliminar",
                            estado: estado,
                            sql: "_07_",
                            accion: "Se ha Eliminado el Vocero: " + fila.find("td:eq(1)").text() + " del comite: " + fila.find("td:eq(2)").text(),
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
            cedula_vocero = fila.find("td:eq(0)").text();
            primer_nombre = fila.find("td:eq(1)").text();
            nombre_comite = fila.find("td:eq(2  )").text();
            cargo_persona = fila.find("td:eq(3)").text();
            fecha_ingreso = fila.find("td:eq(4)").text();
            fecha_salida = fila.find("td:eq(5)").text();
            $("#cedula_vocero").val(cedula_vocero);
            $("#primer_nombre").val(primer_nombre);
            $("#nombre_comite").val(nombre_comite);
            $("#cargo_persona").val(cargo_persona);
            $("#fecha_ingreso").val(fecha_ingreso);
            $("#fecha_salida").val(fecha_salida);
        });
        $(document).on("click", ".btnEditar", function() {
            fila = $(this).closest("tr");
            id = fila.find("td:eq(6)").text();
            cedula_vocero = fila.find("td:eq(0)").text();
            primer_nombre = fila.find("td:eq(1)").text();
            nombre_comite = fila.find("td:eq(2  )").text();
            cargo_persona = fila.find("td:eq(3)").text();
            fecha_ingreso = fila.find("td:eq(4)").text();
            fecha_salida = fila.find("td:eq(5)").text();
            $("#cedula_vocero2").val(cedula_vocero);
            $("#primer_nombre2").val(primer_nombre);
            $("#nombre_comite2").val(nombre_comite);
            $("#cargo_persona2").val(cargo_persona);
            $("#fecha_ingreso2").val(fecha_ingreso);
            $("#fecha_salida2").val();
            $(document).on("click", "#enviar", function() {
                var datos = {
                    id_comite_persona: id,
                    cedula_persona: $("#cedula_vocero2").val(),
                    nombre_comite: $("#nombre_comite2").val(),
                    cargo_persona: $("#cargo_persona2").val(),
                    fecha_ingreso: $("#fecha_ingreso2").val(),
                    fecha_salida: $("#fecha_salida2").val()
                };
                $.ajax({
                    type: "POST",
                    url: BASE_URL + "Consejo_Comunal/Administrar",
                    data: {
                        datos: datos,
                        peticion: "Editar",
                        sql: "SQL_02",
                        accion: "El portador de la cedula" + cedula_vocero + " fue Actualizado como vocero \\Exitosamente.",
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