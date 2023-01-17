var dosis_select = document.getElementById("dosis");
var fechas_input = document.getElementById("fecha");
var btn_agregar = document.getElementById("agregar");
var vacunas_agg = [];
var btn_registrar = document.getElementById("enviar");
var div_vacunas = document.getElementById("vacunas-agregadas");
var cedula = document.getElementById("cedula_persona");

btn_agregar.onclick = function () {
  if (
    dosis_select.value == 0 ||
    fechas_input.value == null ||
    fechas_input.value == ""
  ) {
    swal({
      type: "error",
      title: "Error",
      text: "Debe seleccionar una dosis y colocar la fecha",
      timer: 2000,
      showConfirmButton: false,
    });
  } else {
    switch (vacunas_agg.length) {
      case 0:
        if (valid_fecha_vacunado(1)) {
          add_vacuna(1, false);
        }
        break;
      case 1:
        if (valid_fecha_vacunado(2)) {
          add_vacuna(2, false);
        }
        break;

      case 2:
        if (valid_fecha_vacunado(3)) {
          add_vacuna(3, false);
        }
        break;
    }
  }
};

function valid_fecha_vacunado(index) {
  var fecha_dosis = new Date(fechas_input.value);
  var fecha_act = new Date();
  var retornar = false;
  var mensaje = "";
  switch (index) {
    case 1:
      if (fecha_act < fecha_dosis) {
        mensaje =
          "La fecha de la primera dosis no puede ser posterior a la fecha actual";
      } else {
        retornar = true;
      }
      break;

    case 2:
      var fecha_dosis1 = new Date(vacunas_agg[0]["fecha"]);
      if (fecha_dosis1 > fecha_dosis) {
        mensaje =
          "La fecha de la segunda dosis no puede ser anterior a la fecha de la primera dosis";
      } else {
        if (fecha_act < fecha_dosis) {
          mensaje =
            "La fecha de la segunda dosis no puede ser posterior a la fecha actual";
        } else {
          retornar = true;
        }
      }
      break;

    default:
      var fecha_dosis2 = new Date(vacunas_agg[1]["fecha"]);
      if (fecha_dosis2 > fecha_dosis) {
        mensaje =
          "La fecha de la tercera dosis no puede ser anterior a la fecha de la segunda dosis";
      } else {
        if (fecha_act < fecha_dosis) {
          mensaje =
            "La fecha de la tercera dosis no puede ser posterior a la fecha actual";
        } else {
          retornar = true;
        }
      }
      break;
  }

  if (!retornar) {
    swal({
      type: "error",
      title: "Error",
      text: mensaje,
      timer: 2000,
      showConfirmButton: false,
    });
  }

  return retornar;
}

function add_vacuna(index, remove) {
  if (!remove) {
    var vacuna_info = new Object();
    vacuna_info["dosis"] = dosis_select.value;
    vacuna_info["fecha"] = fechas_input.value;
    vacunas_agg.push(vacuna_info);
    dosis_select.value = 0;
    fechas_input.value = '';
    dosis_select.options[index].disabled = "disabled";
    dosis_select.options[index].style.background = "#C3DAE5";
    if (index < 3) {
      dosis_select.options[index + 1].disabled = "";
      dosis_select.options[index + 1].style.background = "";
    }
  } else {
    switch (vacunas_agg.length) {
      case 0:
        dosis_select.options[1].disabled = "";
        dosis_select.options[1].style.background = "";
        dosis_select.options[2].disabled = "disabled";
        dosis_select.options[2].style.background = "#C3DAE5";
        dosis_select.options[3].disabled = "disabled";
        dosis_select.options[3].style.background = "#C3DAE5";
        break;
      case 1:
        dosis_select.options[2].disabled = "";
        dosis_select.options[2].style.background = "";
        dosis_select.options[1].disabled = "disabled";
        dosis_select.options[1].style.background = "#C3DAE5";
        dosis_select.options[3].disabled = "disabled";
        dosis_select.options[3].style.background = "#C3DAE5";
        break;
      default:
        dosis_select.options[3].disabled = "";
        dosis_select.options[3].style.background = "";
        dosis_select.options[2].disabled = "disabled";
        dosis_select.options[2].style.background = "#C3DAE5";
        dosis_select.options[1].disabled = "disabled";
        dosis_select.options[1].style.background = "#C3DAE5";
        break;
    }
  }

  var html = "";
  for (var i = 0; i < vacunas_agg.length; i++) {
    if (i == vacunas_agg.length - 1) {
      html +=
        '<div class="mt-3 d-flex flex-row justify-content-around"><div>' +
        vacunas_agg[i]["dosis"] +
        "</div><div>" +
        vacunas_agg[i]["fecha"] +
        '</div><div><i onclick="remove_vacuna()" class="iconDelete fa fa-times-circle" style="font-size:22px"></i></div></div>';
    } else {
      html +=
        '<div class="mt-3 d-flex flex-row justify-content-around"><div>' +
        vacunas_agg[i]["dosis"] +
        "</div><div>" +
        vacunas_agg[i]["fecha"] +
        "</div><div></div></div><hr>";
    }
  }

  div_vacunas.innerHTML = html;
}

btn_registrar.onclick = function () {
  var valid = false;
  if (cedula.value == "" || cedula.value == null) {
    swal({
      type: 'error',
      title: 'Error',
      text: "Debe ingresar la cédula de una persona",
      timer: 2000,
      showConfirmButton: false,
    });
  } else {
    $.ajax({
      type: "POST",
      url: BASE_URL + "app/Direcciones.php",
      data: {
        direction: "Personas/Consultas_cedulaV2",
        accion: "codificar",
      },
      success: function (direccion_segura) {
        $.ajax({
          type: "POST",
          url: BASE_URL + direccion_segura,
          data: { cedula: cedula.value },
        }).done(function (result) {

          if (result != 1) {
            swal({
                type: 'error',
                title: 'Error',
                text: "La cédula ingresada no se encuentra registrada en el sistema",
                timer: 2000,
                showConfirmButton: false,
              });
          } else {

            if(vacunas_agg.length == 0) {
                swal({
                    type: 'error',
                    title: 'Error',
                    text: "Debe ingresar al menos una dosis para la persona",
                    timer: 2000,
                    showConfirmButton: false,
                  });
            }

            else{

           $.ajax({
                     type: "POST",
                     url: BASE_URL + "app/Direcciones.php",
                     data: {
                         direction: "Vacunados/Administrar",
                         accion: "codificar"
                     },
                     success: function(direccion_segura) {
                         $.ajax({
                             type: "POST",
                             url: BASE_URL + direccion_segura,
                             data: {
                                 peticion: "Existe",
                                 "cedula": cedula.value
                             }
                         }).done(function(result) {
                            console.log(result);
                             if (result) {
                                var datos = new Object();
                                datos ['info_dosis'] = vacunas_agg;
                                datos ['cedula_persona'] = cedula.value;
                                 $.ajax({
                                     type: 'POST',
                                     url: BASE_URL + direccion_segura,
                                     data: {
                                         datos: datos,
                                         peticion: "Registrar",
                                         sql: "SQL_02",
                                         accion: "Se ha registrado un nuevo vacunado: " + cedula.value,
                                     },
                                     success: function(respuesta) {
                                         if(respuesta) {
                                            swal({
                                                type: "success",
                                                title: "Enhorabuena",
                                                text: "Se ha guardado la información satisfactoriamente",
                                                timer: 2000,
                                                showConfirmButton: false
                                            });

                                            setTimeout(function(){Direccionar('Vacunados/Administrar/Consultas');},1000);
                                         }
                                     },
                                     error: function(respuesta) {
                                         alert("Error al enviar Controlador")
                                     }
                                 });
                             } else {
   
                                swal({
                                     type: "error",
                                     title: "Error",
                                     text: "Esta persona ya se encuentra registrada como vacunado",
                                     timer: 2000,
                                     showConfirmButton: false
                                 });
                             }
                         });
                     },
                     error: function() {
                         alert('Error al codificar dirreccion');
                     }
                 });
                }
          }
        });
      },
      error: function () {
        alert("Error al codificar dirreccion");
      },
    });
  }
};

function remove_vacuna() {
  vacunas_agg.pop();
  add_vacuna(0, true);
}