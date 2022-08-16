var title = document.getElementById("title-solicitud");
var id = document.getElementById("id_solicitud");
var persona = document.getElementById("persona");
var date = document.getElementById("fecha_solicitud");
var aprobar = document.getElementById("aprobar");
var rechazar = document.getElementById("rechazar");
var id_familia = document.getElementById("id_familia");
var solicitante = new Object();
solicitante["correo"] = document.getElementById("correo_solicitante").value;

rechazar.onclick = function () {
  var textoSwal =
    "Está por rechazar la solicitud de un registro de familia ¿desea continuar?<br><br>";
  textoSwal +=
    "<textArea class='form-control' placeholder='Motivo de rechazo' id='text-area'></textArea><br>";
  textoSwal += "<div style='color:red' id='valid-text-area'></div>";

  swal(
    {
      title: "Atención",
      type: "warning",
      text: textoSwal,
      showCancelButton: true,
      confirmButtonText: "Si, rechazar",
      cancelButtonText: "No, cancelar",
      closeOnConfirm: false,
      html: true,
    },
    function (isConfirm) {
      if (isConfirm) {
        //eliminarSolicitud();
        if (document.getElementById("text-area").value == "") {
          document.getElementById("text-area").focus();
          document.getElementById("text-area").style.borderColor = "red";
          document.getElementById("valid-text-area").innerHTML =
            "Debe ingresar el motivo del rechazo de la solicitud";
        } else {
          var motivo_rechazo = document.getElementById("text-area").value;
          document.getElementById("valid-text-area").innerHTML = "";
          document.getElementById("text-area").style.borderColor = "";
          document.getElementById("text-area").blur();
          rechazoSolicitud(
            document.getElementById("text-area").value,
            id_familia.value
          );
          var datos_notificacion = new Object();
          datos_notificacion["tipo_notificacion"] = 5;
          datos_notificacion["usuario_receptor"] =
            document.getElementById("cedula_solicitante").value;
          datos_notificacion["accion"] =
            "Rechazó su solicitud para registro de familia debido a :" +
            document.getElementById("text-area").value +
            ".";

          console.log(datos_notificacion);
          nueva_notificacion(datos_notificacion);
          swal({
            title: "Exito",
            text: "La solicitud ha sido rechazada",
            type: "success",
            showConfirmButton: false,
            timer: 2000,
          });

          solicitante["asunto"] = "Se ha rechazado su solicitud";
          solicitante["mensaje"] =
            "Su solicitud para registro de familia ha sido rechazada. El motivo del rechazo es: " +
            motivo_rechazo;

          if (solicitante["correo"] != "No posee") {
            document.getElementById("btn_correo").click();
          } else {
            setTimeout(function () {
              location.href = BASE_URL + "Solicitudes/";
            }, 1000);
          }
        }
      }
    }
  );
};

aprobar.onclick = function () {
  var fecha_actual = new Date();
  fecha_actual =
    fecha_actual.getDate() +
    "-" +
    (fecha_actual.getMonth() + 1) +
    "-" +
    fecha_actual.getFullYear();

  $.ajax({
    type: "POST",
    url: BASE_URL + "Solicitudes/Set_status",
    data: {
      id: id.value,
      procesada: 1,
      observaciones: "Aprobada el " + fecha_actual,
    },
  }).done(function () {
    $.ajax({
      type: "POST",
      url: BASE_URL + "Familias/activar_familia",
      data: {
        id_familia: id_familia.value,
      },
    }).done(function (result) {});
  });

  swal({
    title: "Exito",
    text: "La solicitud ha sido aprobada",
    type: "success",
    showConfirmButton: false,
    timer: 2000,
  });

  var datos_notificacion = new Object();
  datos_notificacion["tipo_notificacion"] = 4;
  datos_notificacion["usuario_receptor"] =
    document.getElementById("cedula_solicitante").value;
  datos_notificacion["accion"] =
    "Aprobó su solicitud para registro de familia.";

  console.log(datos_notificacion);

  solicitante["asunto"] = "Se ha aprobado su solicitud";
  solicitante["mensaje"] =
    "Su solicitud para registro de familia ha sido aprobada.";

  nueva_notificacion(datos_notificacion);

  if (solicitante["correo"] != "No posee") {
    document.getElementById("btn_correo").click();
  }
  {
    setTimeout(function () {
      location.href = BASE_URL + "Solicitudes/";
    }, 1000);
  }

  // setTimeout(function(){

  //   print_pdf();
  //   window.open(BASE_URL+"Solicitudes/");

  // },1000);
};

function rechazoSolicitud(motivo) {
  var fecha_actual = new Date();
  fecha_actual =
    fecha_actual.getDate() +
    "-" +
    (fecha_actual.getMonth() + 1) +
    "-" +
    fecha_actual.getFullYear();

  $.ajax({
    type: "POST",
    url: BASE_URL + "Solicitudes/Set_status",
    data: {
      id: id.value,
      procesada: 2,
      observaciones: "Rechazada el " + fecha_actual + "/" + motivo,
    },
  }).done(function () {
    $.ajax({
      type: "POST",
      url: BASE_URL + "Familias/eliminar_familia",
      data: {
        id: id_familia.value,
      },
    });
  });
}

function getMes(mesNro) {
  var mesRetornar = "";

  switch (mesNro) {
    case 1:
      mesRetornar = "Enero";
      break;
    case 2:
      mesRetornar = "Febrero";
      break;
    case 3:
      mesRetornar = "Marzo";
      break;
    case 4:
      mesRetornar = "Abril";
      break;
    case 5:
      mesRetornar = "Mayo";
      break;
    case 6:
      mesRetornar = "Junio";
      break;
    case 7:
      mesRetornar = "Julio";
      break;
    case 8:
      mesRetornar = "Agosto";
      break;
    case 9:
      mesRetornar = "Septiembre";
      break;
    case 10:
      mesRetornar = "Octubre";
      break;
    case 11:
      mesRetornar = "Noviembre";
      break;
    default:
      mesRetornar = "Diciembre";
      break;
  }

  return mesRetornar;
}

function getAntiguedad(anios) {
  var tiempo = new Date(anios);
  tiempo = new Date().getFullYear() - tiempo.getFullYear();

  return tiempo;
}

(function () {
  emailjs.init("user_HmtuJhVZ1daCClSuC185g");
})();
const vue = new Vue({
  el: "#app",
  data() {
    return {
      from_name: "",
      from_email: "",
      message: "",
      subject: "",
    };
  },
  methods: {
    enviar() {
      let data = {
        from_name: "C.C Prados de Occidente",
        from_email: solicitante["correo"],
        message: solicitante["mensaje"],
        subject: solicitante["sujeto"],
      };

      emailjs.send("service_rbn54tj", "template_vqh9lqb", data).then(
        function (response) {
          if (response.text === "OK") {
            location.href = BASE_URL + "Solicitudes/";
          }
          console.log(
            "Exito. status=%d, text=%s",
            response.status,
            response.text
          );
        },
        function (err) {
          console.log("Fallo. error=", err);
          location.href = BASE_URL + "Solicitudes/";
        }
      );
    },
  },
});

function ver_info_integrante(persona) {
  var persona_info = JSON.parse(persona);

  $.ajax({
    type: "POST",
    url: BASE_URL + "Personas/get_info_habitante",
    data: { cedula_persona: persona_info["cedula_persona"] },
  }).done(function (resultado) {
    var consulta = JSON.parse(resultado);

    var ocupacion_info = JSON.parse(consulta["ocupacion"]);
    var condicion_lab_info = JSON.parse(consulta["condicion_lab"]);
    var transporte_info = JSON.parse(consulta["transporte"]);
    var bonos_info = JSON.parse(consulta["bonos"]);
    var misiones_info = JSON.parse(consulta["misiones"]);
    var proyectos_info = JSON.parse(consulta["proyectos"]);
    var comunidad_i_info = JSON.parse(consulta["comunidad_i"]);
    var org_politica_info = JSON.parse(consulta["org_politica"]);

    var tabla =
      "<div style='height:380px;overflow-y:scroll;'><em class='fa fa-user' style='font-size:60px'></em>";
    tabla +=
      "<br><table style='width:100%' border='1'><tr  style='background:#057E9F;color:white;'><td style='width:25%'>Cédula</td><td style='width:25%'>Nacionalidad</td><td style='width:25%'>Teléfono</td><td style='width:25%'>WhatsApp</td></tr>";
    tabla +=
      "<tr><td style='width:25%'><em class='fa fa-drivers-license-o'></em> " +
      persona_info["cedula_persona"];
    tabla +=
      "</td><td style='width:25%'><em class='fa fa-globe'></em> " +
      persona_info["nacionalidad"] +
      "</td><td style='width:25%'><em class='fa fa-phone'></em> " +
      persona_info["telefono"] +
      "</td><td style='width:25%'><em class='fa fa-whatsapp'></em> " +
      get_letras(persona_info["whatsapp"]) +
      "</td></tr></table>";

    var tabla2 =
      "<br><table style='width:100%' border='1'><tr  style='background:#057E9F;color:white;'><td style='width:25%'>Correo</td><td style='width:25%'>Fecha de nacimiento</td><td style='width:25%'>Género</td><td style='width:25%'>Orientación sexual</td></tr>";
    tabla2 +=
      "<tr><td style='width:25%'><em class='fa fa-envelope'></em> " +
      persona_info["correo"];
    var gen;
    persona_info["genero"] == "M" ? (gen = "mars") : (gen = "venus");
    tabla2 +=
      "</td><td style='width:25%'><em class='fa fa-birthday-cake'></em> " +
      persona_info["fecha_nacimiento"] +
      "</td><td style='width:25%'><em class='fa fa-" +
      gen +
      "'></em> " +
      persona_info["genero"] +
      "</td><td style='width:25%'><em class='fa fa-intersex'></em> " +
      persona_info["sexualidad"] +
      "</td></tr></table>";

    var tabla3 =
      "<br><table style='width:100%' border='1'><tr  style='background:#057E9F;color:white;'><td style='width:25%'>Estado civil</td><td style='width:25%'>Nivel educativo</td><td style='width:25%'>Antigüedad comunidad</td><td style='width:25%'>Miliciano</td></tr>";
    tabla3 +=
      "<tr><td style='width:25%'><em class='fa fa-address-card'></em> " +
      persona_info["estado_civil"];
    tabla3 +=
      "</td><td style='width:25%'><em class='fa fa-mortar-board'></em> " +
      persona_info["nivel_educativo"] +
      "</td><td style='width:25%'><em class='fa fa-calendar'></em> " +
      persona_info["antiguedad_comunidad"] +
      "</td><td style='width:25%'><em class='fa fa-vcard'></em> " +
      get_letras(persona_info["miliciano"]) +
      "</td></tr></table>";

    var tabla4 =
      "<br><table style='width:100%' border='1'><tr  style='background:#057E9F;color:white;'><td style='width:25%'>Jefe de familia</td><td style='width:25%'>Propietario de vivienda</td><td style='width:25%'>Jefe de calle</td><td style='width:25%'>Privado de libertad</td></tr>";
    tabla4 +=
      "<tr><td style='width:25%'><em class='fa fa-users'></em> " +
      get_letras(persona_info["jefe_familia"]);
    tabla4 +=
      "</td><td style='width:25%'><em class='fa fa-home'></em> " +
      get_letras(persona_info["propietario_vivienda"]) +
      "</td><td style='width:25%'><em class='fa fa-road'></em> " +
      get_letras(persona_info["jefe_calle"]) +
      "</td><td style='width:25%'><em class='fa fa-balance-scale'></em> " +
      get_letras(persona_info["privado_libertad"]) +
      "</td></tr></table>";

    var tabla5 =
      "<br><table style='width:100%' border='1'><tr  style='background:#057E9F;color:white;'><td style='width:25%'>Afrodescendencia</td><td style='width:25%'>Comunidad indígena</td><td style='width:25%'>Ocupación</td><td style='width:25%'>Condición laboral</td></tr>";
    tabla5 +=
      "<tr><td style='width:25%'><em class='fa fa-universal-access'></em> " +
      get_letras(persona_info["afrodescendencia"]);
    var comunidad_i;
    var ocup;
    var cond;
    ocupacion_info.length == 0
      ? (ocup = "No posee")
      : (ocup = ocupacion_info[0]["nombre_ocupacion"]);
    condicion_lab_info.length == 0
      ? (cond = "No posee")
      : (cond = condicion_lab_info[0]["nombre_cond_laboral"]);
    comunidad_i_info.length == 0
      ? (comunidad_i = "No")
      : (comunidad_i = comunidad_i_info[0]["nombre_comunidad"]);

    tabla5 +=
      "</td><td style='width:25%'><em class='fa fa-street-view'></em> " +
      comunidad_i +
      "</td><td style='width:25%'><em class='fa fa-briefcase'></em> " +
      ocup +
      "</td><td style='width:25%'><em class='fa fa-industry'></em> " +
      cond +
      "</td></tr></table>";

    var tabla6 =
      "<br><table style='width:100%' border='1'><tr  style='background:#057E9F;color:white;'><td style='width:25%'>Organización política</td><td style='width:25%'>Transporte</td><td style='width:25%'>Bonos</td><td style='width:25%'>Misiones</td></tr>";
    var org;
    org_politica_info.length == 0
      ? (org = "No")
      : (org = org_politica_info[0]["nombre_org"]);

    var transp;

    transporte_info.length == 0
      ? (transp = "Público")
      : (transp = transporte_info[0]["descripcion_transporte"]);

    tabla6 +=
      "<tr><td style='width:25%'><em class='fa fa-puzzle-piece'></em> " +
      org +
      "</td>";

    tabla6 +=
      "<td style='width:25%'><em class='fa fa-car'></em> " + transp + "</td>";

    if (bonos_info.length == 0) {
      tabla6 += "<td style='width:25%'>No aplica</td>";
    } else {
      var texto = "";
      for (var i = 0; i < bonos_info.length; i++) {
        texto += " - " + bonos_info[i]["nombre_bono"] + "<br><hr>";
      }

      tabla6 +=
        "<td ><div style='width:100%;overflow-y:scroll;background:#C5E6EF;border-radius:6px'><center>" +
        texto;
      tabla6 += "</center></div></td>";
    }

    if (misiones_info.length == 0) {
      tabla6 += "<td style='width:25%'>No aplica</td></tr></table>";
    } else {
      var texto = "";
      for (var i = 0; i < misiones_info.length; i++) {
        texto += " - " + misiones_info[i]["nombre_mision"] + "<br><hr>";
      }

      tabla6 +=
        "<td ><div style='width:100%;overflow-y:scroll;background:#C5E6EF;border-radius:6px'><center>" +
        texto;
      tabla6 += "</center></div></td></tr><table>";
    }

    tabla +=
      "<br>" +
      tabla2 +
      "<br>" +
      tabla3 +
      "<br>" +
      tabla4 +
      "<br>" +
      tabla5 +
      "<br>" +
      tabla6;

    tabla +=
      "<br><br><table style='width:100%' border='1'><tr  style='background:#057E9F;color:white;'><td colspan='4'>Proyectos en los que labora</td></tr>";

    if (proyectos_info.length == 0) {
      tabla += "<tr><td colspan='4'>No aplica</td></tr></table>";
    } else {
      var texto = "";
      for (var i = 0; i < proyectos_info.length; i++) {
        texto +=
          "<table style='width:100%' border='1'><tr><td style='width:25%'>Nombre</td><td style='width:25%'>Área</td><td style='width:25%'>Estado</td></tr>";
        texto +=
          "<tr><td style='width:25%'>" +
          proyectos_info[i]["nombre_proyecto"] +
          "</td><td style='width:25%'>" +
          proyectos_info[i]["area_proyecto"] +
          "</td>";
        texto +=
          "<td style='width:25%'>" +
          proyectos_info[i]["estado_proyecto"] +
          "</td></tr></table> <br>";
      }

      tabla +=
        "<tr><td colspan='4'><div style='width:100%;overflow-y:scroll;background:#C5E6EF;border-radius:6px'><center>" +
        texto;
      tabla += "</center></div></td></tr></table>";
    }

    swal({
      title:
        persona_info["primer_nombre"] +
        " " +
        persona_info["segundo_nombre"] +
        " " +
        persona_info["primer_apellido"] +
        " " +
        persona_info["segundo_apellido"],
      text: tabla,
      html: true,
      customClass: "bigSwalV2",
    });
  });
}

function get_letras(dato) {
  if (parseInt(dato) == 0) {
    return "No";
  } else {
    return "Si";
  }
}
