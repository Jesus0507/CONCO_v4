$(function() {
    $.ajax({
        type: "POST",
        url: BASE_URL + "app/Direcciones.php",
        data: {
            direction: "Negocios/Administrar",
            accion: "codificar"
        },
        success: function(direccion_segura) {
            $.ajax({
                type: "POST",
                url: BASE_URL + direccion_segura,
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
                        data: "direccion_negocio",
                    }, {
                        data: "nombre_negocio",
                    }, {
                        data: "cedula_propietario",
                    }, {
                        data: "rif_negocio",
                    }, {
                        data: function(data) {
                            return ('<td class="text-center">' + '<a href="javascript:void(0)" style="margin-right: 5px;background: #4dbdbd !important;" class="btn bg-info ver-popup" title="Ver" type="button" data-toggle="modal" data-target="#ver">' + '<i class="fa fa-eye"></i>' + "</a>" + '<a href="javascript:void(0)" style="margin-right: 5px;" class="btn bg-info btnEditar"  title="Actualizar" type="button" data-toggle="modal" data-target="#actualizar">' + '<i class="fa fa-edit" style="color: white;"></i>' + "</a>" + '<a href="javascript:void(0)" style="margin-right: 5px;" class="btn bg-danger mensaje-eliminar" title="Eliminar">' + '<i class="fa fa-trash"></i>' + "</a>" + '<p style="display: none;">' + data.id_negocio + "</p>" + "</td>");
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
                    id = fila.find("td:eq(5)").text();
                    var estado = {
                        tabla: "negocios",
                        id_tabla: "id_negocio",
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
                                url: BASE_URL + direccion_segura,
                                type: "POST",
                                data: {
                                    peticion: "Eliminar",
                                    estado: estado,
                                    sql: "ACT_DES",
                                    accion: "Se ha Eliminado el  negocio: " + fila.find("td:eq(2)").text(),
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
                    $.ajax({
                        type: "POST",
                        url: BASE_URL + direccion_segura,
                        data: {
                            peticion: "Consultas_Calle",
                            calle: calle,
                        },
                    }).done(function(datos) {
                        $("#calle2 option[value=" + datos + "]").attr("selected", true);
                    }).fail(function() {
                        alert("error")
                    })
                    $(document).on("click", "#enviar", function() {
                        
                        var datos = {
                            id_negocio: id,
                            id_calle: $("#calle2").val(),
                            nombre_negocio: $("#nombre_negocio2").val(),
                            direccion_negocio: $("#direccion_negocio2").val(),
                            cedula_propietario: $("#cedula_propietario2").val(),
                            rif_negocio: $("#rif_negocio2").val(),
                            estado: 1
                        };
                        $.ajax({
                            type: "POST",
                            url: BASE_URL + direccion_segura,
                            data: {
                                datos: datos,
                                peticion: "Administrar",
                                sql: "SQL_03",
                                accion: "Se ha Actualizado el  negocio: " + datos.nombre_negocio,
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
                                    text: datos,
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
        },
        error: function() {
            alert('Error al codificar dirreccion');
        }
    });
});