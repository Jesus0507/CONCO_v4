$(function() {
    $.ajax({   
        type: "POST",
        url: BASE_URL + "Negocios/Administrar", 
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
                    return ('<td class="text-center">' + '<a href="javascript:void(0)" style="margin-right: 5px;" class="btn bg-info ver-popup" title="Ver" type="button" data-toggle="modal" data-target="#ver">' + '<i class="fa fa-eye"></i>' + "</a>" + '<a href="javascript:void(0)" style="margin-right: 5px;" class="btn bg-success btnEditar"  title="Actualizar" type="button" data-toggle="modal" data-target="#actualizar">' + '<i class="fa fa-edit" style="color: white;"></i>' + "</a>" + '<a href="javascript:void(0)" style="margin-right: 5px;" class="btn bg-danger mensaje-eliminar" title="Eliminar">' + '<i class="fa fa-trash"></i>' + "</a>" + '<p style="display: none;">' + data.id_negocio + "</p>" + "</td>");
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
                        url: BASE_URL + "Negocios/Administrar",
                        type: "POST",
                        data: {
                            peticion: "Administrar",
                            estado: estado,
                            sql: "ACT_DES",
                            accion: "Se ha Eliminado el  negocio: "+fila.find("td:eq(2)").text(),
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
                url: BASE_URL + "Negocios/Administrar",
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
                var form = $("#formulario");
                var id_calle = document.getElementById("calle2");
                var nombre_negocio = document.getElementById("nombre_negocio2");
                var direccion = document.getElementById("direccion_negocio2");
                var cedula_propietario = document.getElementById("cedula_propietario2");
                var rif_negocio = document.getElementById("rif_negocio2");
                var mensaje_calle = document.getElementById("mensaje_calle");
                var mensaje_negocio = document.getElementById("mensaje_negocio");
                var mensaje_direccion = document.getElementById("mensaje_direccion");
                var mensaje_cedula = document.getElementById("mensaje_cedula");
                var mensaje_rif = document.getElementById("mensaje_rif");
                var datos = {
                    id_negocio: id,
                    id_calle: $("#calle2").val(),
                    nombre_negocio: $("#nombre_negocio2").val(),
                    direccion_negocio: $("#direccion_negocio2").val(),
                    cedula_propietario: $("#cedula_propietario2").val(),
                    rif_negocio: $("#rif_negocio2").val(),
                    estado: 1
                };
                if (id_calle.value == 0) {
                    mensaje_calle.innerHTML = 'Debe seleccionar una Calle';
                    id_calle.style.borderColor = 'red';
                    mensaje_calle.style.color = 'red';
                    id_calle.focus();
                } else {
                    mensaje_calle.innerHTML = '';
                    id_calle.style.borderColor = '';
                    if (direccion.value == '' || direccion.value == null) {
                        mensaje_direccion.innerHTML = 'el campo direccion no puede estar vacio';
                        direccion.style.borderColor = 'red';
                        mensaje_direccion.style.color = 'red';
                        direccion.focus();
                    } else {
                        mensaje_direccion.innerHTML = '';
                        direccion.style.borderColor = '';
                        if (nombre_negocio.value == '' || nombre_negocio.value == null) {
                            mensaje_negocio.innerHTML = 'el campo nombre no puede estar vacio';
                            nombre_negocio.style.borderColor = 'red';
                            mensaje_negocio.style.color = 'red';
                            nombre_negocio.focus();
                        } else {
                            mensaje_negocio.innerHTML = '';
                            nombre_negocio.style.borderColor = '';
                            if (cedula_propietario.value == '' || cedula_propietario.value == null) {
                                mensaje_cedula.innerHTML = 'el campo cedula no puede estar vacio';
                                cedula_propietario.style.borderColor = 'red';
                                mensaje_cedula.style.color = 'red';
                                cedula_propietario.focus();
                            } else {
                                mensaje_cedula.innerHTML = '';
                                cedula_propietario.style.borderColor = '';
                                if (rif_negocio.value == '' || rif_negocio.value == null) {
                                    mensaje_rif.innerHTML = 'el campo rif no puede estar vacio';
                                    rif_negocio.style.borderColor = 'red';
                                    mensaje_rif.style.color = 'red';
                                    rif_negocio.focus();
                                } else {
                                    mensaje_rif.innerHTML = '';
                                    rif_negocio.style.borderColor = '';
                                    $.ajax({
                                        type: "POST",
                                        url: BASE_URL + "Negocios/Administrar",
                                        data: {
                                            datos: datos,
                                            peticion: "Administrar",
                                            sql: "SQL_03",
                                            accion: "Se ha Actualizado el  negocio: "+datos.nombre_negocio,
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
                                }
                            }
                        }
                    }
                }
            });
        });
    }).fail(function() {
        alert("error");
    });
});