function editar(id_familia, id_familia_persona) {
    document.getElementById("id_familia").value = id_familia;
    $.ajax({
        type: "POST",
        url: BASE_URL + "app/Direcciones.php",
        data: {
            direction: "Familias/consultar_familia_datos",
            accion: "codificar"
        },
        success: function (direccion_segura) {
            $.ajax({
                type: "POST",
                url: BASE_URL + direccion_segura,
                data: {
                    'id_familia': id_familia
                }
            }).done(function (datos) {
                var data = JSON.parse(datos);
                var familia = document.getElementById('integrantes_agregados');

                if (data.length == 0) {
                    familia.innerHTML = "No aplica";
                } else {
                    familia.innerHTML = "";
                    for (var i = 0; i < data.length; i++) {
                        document.getElementById("vivienda_familia").value = data[i]['id_vivienda'];
                        document.getElementById("select-cond-ocupacion").value = data[i][
                            'condicion_ocupacion'
                        ];
                        document.getElementById("nombre_familia").value = data[i]['familia'];
                        document.getElementById("telefono_familia").value = data[i]['telefono'];
                        document.getElementById("observaciones_familia").value = data[i][
                            'observacion'
                        ];
                        document.getElementById("ingreso_aprox").value = data[i]['ingreso_mensual'];

                        var inte = JSON.parse(data[i]['integrantes']);

                        for (var j = 0; j < inte.length; j++) {
                            var tabl =
                                familia.innerHTML += " <table style='width:95%'><tr><hr><td>-" +
                                inte[j]["primer_nombre"] + " " + inte[j]["primer_nombre"] +
                                "</td><td style='text-align:right'><span onclick='borrar_familia(" +
                                data[i]['id_familia'] + "," + inte[j]['cedula_persona'] +
                                ")' class='iconDelete fa fa-times-circle' title='Eliminar Familia' style='font-size:22px'></span></td></tr></table><br><hr>";
                        }

                    }
                }

            });
        },
        error: function () {
            alert('Error al codificar dirreccion');
        }
    });
}

function borrar_familia(id, cedula_param) {
    swal({
        type: "warning",
        title: "¿Está seguro?",
        text: "Está por eliminar este integrantes , ¿desea continuar?",
        showCancelButton: true,
        confirmButtonText: "Si, continuar",
        cancelButtonText: "No"
    }, function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                type: "POST",
                url: BASE_URL + "app/Direcciones.php",
                data: {
                    direction: "Familias/eliminar_integrantes",
                    accion: "codificar"
                },
                success: function (direccion_segura) {
                    $.ajax({
                        type: "POST",
                        url: BASE_URL + direccion_segura,
                        data: {
                            "id_familia_persona": id,
                            "cedula_persona": cedula_param
                        }
                    }).done(function (result) {
                        result = JSON.parse(result);
                        actualizar_integrantes(result, cedula_param);
                        editar(id);

                    })
                },
                error: function () {
                    alert('Error al codificar dirreccion');
                }
            });
        }
    });
}

function actualizar_integrantes(result, cedula_param) {

    var enfermedades = document.getElementById('integrantes_agregados');
    if (result != 0) {
        enfermedades.innerHTML = "";
        for (var i = 0; i < result.length; i++) {
            enfermedades.innerHTML += " <table style='width:95%'><tr><td>- " + result[i]["cedula_persona"] +
                "</td><td style='text-align:right'><span onclick='borrar_familia(" + result[i]['id_familia_persona'] +
                "," + result[i]['cedula_persona'] +
                ")' class='iconDelete fa fa-times-circle' title='Eliminar' style='font-size:22px'></span></td></tr></table><br><hr>";
        }
    }

}
var integrantes_input = document.getElementById("integrante_input");
var integrantes = [];
var valid_integrantes = document.getElementById("valid_5");
var div_integrantes = document.getElementById("integrantes_agregados");

function valid_integrantes_agregados() {
    var validar = true;
    for (var i = 0; i < integrantes.length; i++) {
        if (integrantes[i] == integrantes_input.value) {
            validar = false;
        }
    }

    if (!validar) {
        valid_integrantes.innerHTML = 'Ya esta persona fue agregada';
    }

    return validar;
}