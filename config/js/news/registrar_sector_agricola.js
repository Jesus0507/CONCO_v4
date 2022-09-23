$(document).ready(function() {
    $("#enviar").on("click", function() {
        var datos = {
            cedula_persona: document.getElementById("cedula_persona").value,
            area_produccion: document.getElementById("area_produccion").value,
            anios_experiencia: document.getElementById("anios_experiencia").value,
            rubro_principal: document.getElementById("rubro_principal").value,
            rubro_alternativo: document.getElementById("rubro_alternativo").value,
            registro_INTI: document.getElementById("registro_INTI").selectedIndex,
            constancia_productor: document.getElementById("constancia_productor").selectedIndex,
            senial_hierro: document.getElementById("senial_hierro").selectedIndex,
            financiado: document.getElementById("financiado").value,
            agua_riego: document.getElementById("agua_riego").selectedIndex,
            produccion_actual: document.getElementById("produccion_actual").selectedIndex,
            org_agricola: document.getElementById("org_agricola").value,
            estado: 1
        };
        $.ajax({
            type: "POST",
            url: BASE_URL + "app/Direcciones.php",
            data: {
                direction: 'Sector_Agricola/Administrar',
                accion: "codificar"
            },
            success: function(direccion_segura) {
                $.ajax({
                    type: 'POST',
                    url: BASE_URL + direccion_segura,
                    data: {
                        'datos': datos,
                        peticion: "Administrar",
                        sql: "SQL_01",
                        accion: "Se ha registrado Agricola portador de la cedula: " + datos.cedula_persona,
                    },
                    success: function(respuesta) {
                        if (respuesta == 1) {
                            swal({
                                title: "Exito!",
                                text: "Se ha registrado de forma exitosa",
                                type: "success",
                                showConfirmButton: false,
                            });
                            Direccionar('Sector_Agricola/Administrar/Consultas');
                        } else {
                            swal({
                                title: "ERROR!",
                                text: respuesta,
                                type: "error",
                                html: true,
                                showConfirmButton: true,
                                customClass: "bigSwalV2",
                            });
                        }
                    },
                    error: function(respuesta) {
                        alert("Error al enviar Controlador")
                    }
                });
            },
            error: function() {
                alert('Error al codificar dirreccion');
            }
        });
        // if (datos.cedula_persona == '' || datos.cedula_persona == null && datos.area_produccion == '' || datos.area_produccion == null && datos.anios_experiencia == '' || datos.anios_experiencia == null && datos.rubro_principal == '' || datos.rubro_principal == null && datos.rubro_alternativo == '' || datos.rubro_alternativo == null && datos.registro_INTI == '' || datos.registro_INTI == null && datos.constancia_productor == '' || datos.constancia_productor == null && datos.senial_hierro == '' || datos.senial_hierro == null && datos.financiado == '' || datos.financiado == null && datos.agua_riego == '' || datos.agua_riego == null && datos.produccion_actual == '' || datos.produccion_actual == null && datos.org_agricola == '' || datos.org_agricola == null) {
        //     mensaje("cedula_persona", "mensaje_cedula", "Debe Ingresar su Cedula");
        //     mensaje("area_produccion", "mensaje_area", "Debe Ingresar el Area de Produccion");
        //     mensaje("anios_experiencia", "mensaje_experiencia", "Debe Ingresar los años de experiencia");
        //     mensaje("rubro_principal", "mensaje_rubro", "Debe Ingresar el rubro principal");
        //     mensaje("rubro_alternativo", "mensaje_alternativo", "Debe Ingresar el rubro alternativo");
        //     mensaje("registro_INTI", "mensaje_registro", "Debe Ingresar el registro");
        //     mensaje("constancia_productor", "mensaje_constancia", "Debe Ingresar la constancia de productor");
        //     mensaje("senial_hierro", "mensaje_hierro", "Debe Ingresar la señal de hierro");
        //     mensaje("financiado", "mensaje_financiado", "Debe Ingresar el financiamiento");
        //     mensaje("agua_riego", "mensaje_agua", "Debe Ingresar el agua de riego ");
        //     mensaje("produccion_actual", "mensaje_produccion", "Debe Ingresar la produccion actual");
        //     mensaje("org_agricola", "mensaje_organizacion", "Debe Ingresar la organización");
        // } else {
        //     limpiar("cedula_persona", "mensaje_cedula");
        //     limpiar("area_produccion", "mensaje_area");
        //     limpiar("anios_experiencia", "mensaje_experiencia");
        //     limpiar("org_agricola", "mensaje_organizacion");
        //     limpiar("rubro_principal", "mensaje_rubro");
        //     limpiar("rubro_alternativo", "mensaje_alternativo");
        //     limpiar("financiado", "mensaje_financiado");
        //     limpiar("registro_INTI", "mensaje_registro");
        //     limpiar("constancia_productor", "mensaje_constancia");
        //     limpiar("senial_hierro", "mensaje_hierro");
        //     limpiar("agua_riego", "mensaje_agua");
        //     limpiar("produccion_actual", "mensaje_produccion");
        //     if (datos.cedula_persona == '') {
        //         mensaje("cedula_persona", "mensaje_cedula", "Debe Ingresar su Cedula");
        //     } else {
        //         limpiar("cedula_persona", "mensaje_cedula");
        //         if (datos.area_produccion == '') {
        //             mensaje("area_produccion", "mensaje_area", "Debe Ingresar el Area de Produccion");
        //         } else {
        //             limpiar("area_produccion", "mensaje_area");
        //             if (datos.anios_experiencia == '') {
        //                 mensaje("anios_experiencia", "mensaje_experiencia", "Debe Ingresar los años de experiencia");
        //             } else {
        //                 limpiar("anios_experiencia", "mensaje_experiencia");
        //                 if (datos.org_agricola == '') {
        //                     mensaje("org_agricola", "mensaje_organizacion", "Debe Ingresar la organización");
        //                 } else {
        //                     limpiar("org_agricola", "mensaje_organizacion");
        //                     if (datos.rubro_principal == '') {
        //                         mensaje("rubro_principal", "mensaje_rubro", "Debe Ingresar el rubro principal");
        //                     } else {
        //                         limpiar("rubro_principal", "mensaje_rubro");
        //                         if (datos.rubro_alternativo == '') {
        //                             mensaje("rubro_alternativo", "mensaje_alternativo", "Debe Ingresar el rubro alternativo");
        //                         } else {
        //                             limpiar("rubro_alternativo", "mensaje_alternativo");
        //                             if (datos.financiado == '') {
        //                                 mensaje("financiado", "mensaje_financiado", "Debe Ingresar el financiamiento");
        //                             } else {
        //                                 limpiar("financiado", "mensaje_financiado");
        //                             }
        //                         }
        //                     }
        //                 }
        //             }
        //         }
        //     }
        // }
    });
    document.onkeypress = function(e) {
        if (e.which == 13 || e.keyCode == 13) {
            return false;
        } else {
            return true;
        }
    }
    $(".dinero").on({
        "focus": function(event) {
            $(event.target).select();
        },
        "keyup": function(event) {
            $(event.target).val(function(index, value) {
                return value.replace(/\D/g, "").replace(/([0-9])([0-9]{2})$/, '$1,$2').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
            });
        }
    });
});

function mensaje(id_input, id_mensaje, mensaje) {
    document.getElementById(id_mensaje).innerHTML = mensaje;
    document.getElementById(id_input).style.borderColor = 'red';
    document.getElementById(id_mensaje).style.color = 'red';
    document.getElementById(id_input).focus();
}

function limpiar(id_input, id_mensaje) {
    document.getElementById(id_mensaje).innerHTML = '';
    document.getElementById(id_input).style.borderColor = '';
}