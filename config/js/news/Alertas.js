! function($) {
    "use strict";

    var SweetAlert = function() {};

    //examples 
    SweetAlert.prototype.init = function() {

            //mensaje basico
            $('.mensaje-basico').click(function() {
                swal("Mensaje Basico");
            });

            //registro exitoso
            $('.mensaje-registro').click(function() {
                swal("Registro Exitoso!", "", "success")
            });

            //eliminar elemento
            $('.mensaje-eliminar').click(function() {
                swal({
                    title: "¿Desea Eliminar este Elemento?",
                    text: "El elemento seleccionado sera eliminado de manera permanente!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Si, Eliminar!",
                    cancelButtonText: "No, Cancelar!",
                    closeOnConfirm: false
                }, function() {
                    swal("Eliminado!", "El elemento fue eliminado con exito.", "success");
                });
            });

            //eliminar elemento
            $('mensaje-editar').click(function() {
                swal({
                    title: "¿Desea Actualizar este Elemento?",
                    text: "La elemento seleccionado sera actualizado de manera permanente!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Si, Actualizar!",
                    cancelButtonText: "No, Cancelar!",
                    closeOnConfirm: false
                }, function() {
                    swal("Actualizado!", "El elemento fue actualizado con exito.", "success");
                });
            });

            //confirmar eliminacion
            $('.mensaje-elimar2').click(function() {
                swal({
                    title: "¿Desea Eliminar este Elemento?",
                    text: "El elemento seleccionado sera eliminado de manera permanente!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Si, Eliminar!",
                    cancelButtonText: "No, Cancelar!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                }, function(isConfirm) {
                    if (isConfirm) {
                        swal("Eliminado!", "El elemento fue eliminado con exito.", "success");
                    } else {
                        swal("Cancelado", "La accion fue cancelada, la informacion esta segura.", "error");
                    }
                });
            });

            $('.mensaje-editar2').click(function() {
                swal({
                    title: "¿Desea Actualizar este Elemento?",
                    text: "La elemento seleccionado sera actualizado de manera permanente!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Si, Actualizar!",
                    cancelButtonText: "No, Cancelar!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                }, function(isConfirm) {
                    if (isConfirm) {
                        swal("Actualizado!", "El elemento fue actualizado con exito.", "success");
                    } else {
                        swal("Cancelado", "La accion fue cancelada, la informacion esta segura.", "error");
                    }
                });
            });

            //alerta automatica
            $('.mensaje-tiempo').click(function() {
                swal({
                    title: "!Alerta automatica!",
                    text: "Este mensaje se cerrara en 3 segundos.",
                    timer: 3000,
                    showConfirmButton: false
                });
            });

            $(".NO-DISPONIBLE").click(function() {
                swal({
                    title: "",
                    text: "Esta seccion aun no esta disponible",
                    type: "error",
                    timer: 2000,
                    showConfirmButton: false
                })
            });

        },
        //init
        $.SweetAlert = new SweetAlert, $.SweetAlert.Constructor = SweetAlert
}(window.jQuery),

//initializing 
function($) {
    "use strict";
    $.SweetAlert.init()
}(window.jQuery);