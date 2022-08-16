var title = document.getElementById("title-solicitud");
var id = document.getElementById("id_solicitud");
var persona = document.getElementById("persona");
var date = document.getElementById("fecha_solicitud");
var tipo = document.getElementById("tipo_constancia");
var motivo = document.getElementById("motivo");
var aprobar = document.getElementById("aprobar");
var rechazar = document.getElementById("rechazar");
var solicitante = "";

$.ajax({
  type: "POST",
  url: BASE_URL + "Solicitudes/Consultar_solicitudes",
}).done(function (datos) {
  var result_s = JSON.parse(datos);
  var cuerpo_s = "";
  var titulo_solicitud = "";

  for (var i = 0; i < result_s.length; i++) {
    if (result_s[i]["id_solicitud"] == id.value) {
      solicitante = result_s[i];
      // document.getElementById("email_boton").click();
      //      enviar_correo();

      console.log(solicitante);

      switch (result_s[i]["tipo_constancia"]) {
        case "Residencia":
          titulo_solicitud =
            "<em class='fas fa-home'></em> Solicitud de constancia de " +
            result_s[i]["tipo_constancia"];
          break;
        case "Buena conducta":
          titulo_solicitud =
            "<em class='fas fa-address-card'></em> Solicitud de constancia de " +
            result_s[i]["tipo_constancia"];
          break;
        case "No poseer vivienda":
          titulo_solicitud =
            "<em class='fas fa-hotel'></em> Solicitud de constancia de " +
            result_s[i]["tipo_constancia"];
          break;
      }

      var fecha_s = new Date(result_s[i]["fecha_solicitud"]);

      var fecha_soli =
        fecha_s.getDate() +
        "-" +
        (fecha_s.getMonth() + 1) +
        "-" +
        fecha_s.getFullYear();

      date.innerHTML = fecha_soli;

      persona.innerHTML =
        result_s[i]["primer_nombre"] + " " + result_s[i]["primer_apellido"];

      tipo.innerHTML = "Constancia de " + result_s[i]["tipo_constancia"];

      motivo.innerHTML = result_s[i]["motivo_constancia"];

      title.innerHTML = titulo_solicitud;
    }
  }
});

rechazar.onclick = function () {
  var textoSwal =
    "Está por rechazar la solicitud de un documento ¿desea continuar?<br><br>";
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
          rechazoSolicitud(document.getElementById("text-area").value);
          var datos_notificacion = new Object();
          datos_notificacion["tipo_notificacion"] = 2;
          datos_notificacion["usuario_receptor"] =
            solicitante["cedula_persona"];
          datos_notificacion["accion"] =
            "Rechazó su solicitud para Constancia de " +
            solicitante["tipo_constancia"] +
            " debido a :" +
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
            "Su solicitud para constancia de " +
            solicitante["tipo_constancia"] +
            " ha sido rechazada. El motivo del rechazo es: " +
            motivo_rechazo;

          if (solicitante["correo"] != "No posee") {
            document.getElementById("btn_correo").click();
          }
          else{
           setTimeout(function(){location.href=BASE_URL+"Solicitudes/"},1000);
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
  var contenido = get_formato(solicitante);

  contenido =
    "<div style='width:100%;height:300px !important; overflow-y:scroll;background:#E0F6F5'><center><div style='width:90%'><br>" +
    contenido +
    "</div></center></div>";

  swal(
    {
      title: "¿Ya revisó toda la información del documento?",
      text: contenido,
      html: true,
      customClass: "bigSwalV2",
      showCancelButton: true,
      cancelButtonText: "Regresar",
      confirmButtonText: "Si, aprobar",
      closeOnConfirm: true,
    },
    function (isConfirm) {
      if (isConfirm) {
        $.ajax({
          type: "POST",
          url: BASE_URL + "Solicitudes/Set_status",
          data: {
            id: id.value,
            procesada: 1,
            observaciones: "Aprobada el " + fecha_actual,
          },
        });

        swal({
          title: "Exito",
          text: "La solicitud ha sido aprobada",
          type: "success",
          showConfirmButton: false,
          timer: 2000,
        });

        var datos_notificacion = new Object();
        datos_notificacion["tipo_notificacion"] = 1;
        datos_notificacion["usuario_receptor"] = solicitante["cedula_persona"];
        datos_notificacion["accion"] =
          "Aprobó su solicitud para Constancia de " +
          solicitante["tipo_constancia"] +
          " puede retirarla cuando desee.";

        console.log(datos_notificacion);

        solicitante["asunto"] = "Se ha aprobado su solicitud";
        solicitante["mensaje"] =
          "Su solicitud para constancia de " +
          solicitante["tipo_constancia"] +
          " ha sido aprobada. Puede pasar a retirarla cuando desee.";

        if (solicitante["correo"] != "No posee") {
          document.getElementById("btn_correo").click();
        }
        else{
          setTimeout(function(){location.href=BASE_URL+"Solicitudes/"},1000);
        }

        nueva_notificacion(datos_notificacion);


        print_pdf();

        // setTimeout(function(){

        //   print_pdf();
        //   window.open(BASE_URL+"Solicitudes/");

        // },1000);
      }
    }
  );
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
  });
}

function print_pdf() {
  $.ajax({
    type: "POST",
    url: BASE_URL + "Solicitudes/Consultar_solicitudes_all",
  }).done(function (datos) {
    var result = JSON.parse(datos);
    var header = "";
    var body = "";
    var footer = "";

    for (var i = 0; i < result.length; i++) {
      if (result[i]["id_solicitud"] == id.value) {
        content = get_formato(result[i]);
      }
    }

    var myWindow = window.open("", "", "");
    myWindow.document.write(content);
    myWindow.blur();
    myWindow.print();
    myWindow.close();
  });
}

function get_formato(solicitud) {
  var header = "";
  var body = "";
  var footer = "";

  switch (solicitud["tipo_constancia"]) {
    case "Residencia":
      header =
        "<title>Constancia de residencia</title><center>REPUBLICA BOLIVARIANA DE VENEZUELA<br>";
      header += "CONSEJO COMUNAL <br>PRADOS DE OCCIDENTE SECTOR III<br>";
      header += "RIF. J-30725585 CODIGO 13-03-04-608-0002<br>";
      header += "Barquisimeto Municipio Iribarren<br>";
      header +=
        "Parroquia Guerrera Ana Soto Estado Lara<br><u><h4><b>CONSTANCIA DE RESIDENCIA</b></h4></u>";
      header += "<br></center>";

      body =
        "<div style='width:100%;text-align:justify'><b>&nbsp;&nbsp;Quienes suscriben Miembros del Consejo Comunal de Prados ";
      body +=
        "de Occidente Sector III, hacen constar por medio de la presente que el (la) ";
      body +=
        "ciudadano(a) <u>&nbsp;&nbsp;" +
        solicitud["primer_nombre"] +
        " " +
        solicitud["primer_apellido"] +
        "&nbsp;&nbsp;</u>";
      body +=
        " portador de la cédula de identidad <u>&nbsp;&nbsp;" +
        solicitud["cedula_persona"] +
        "&nbsp;&nbsp;</u> se encuentra";
      body +=
        " residenciado en esta Comunidad en la siguiente dirección:______________________________";
      body +=
        "<br><br>&nbsp;&nbsp;Constancia que se expide para fines legales, en la ciudad de Brquisimeto ";
      body +=
        "a los <u>&nbsp;&nbsp;" +
        new Date().getDate() +
        "&nbsp;&nbsp;</u> días del mes de <u>&nbsp;&nbsp;" +
        getMes(new Date().getMonth() + 1) +
        "&nbsp;&nbsp;</u><br>";
      body +=
        "<br>Firman Conformes los miembros autorizados para tal fin.<br><br></div>";

      footer = "<br><br><br><center><table style='width:80%'><tr><td>";
      footer +=
        "_________________<br><b>Firma y cédula del miembro del Consejo Comunal</b><br>";
      footer +=
        "Comité ______________________<br>Teléfono __________________</td>";
      footer +=
        "<td>_________________<br><b>Firma y cédula del miembro del Consejo Comunal</b><br>";
      footer +=
        "Comité ______________________<br>Teléfono __________________</td>";
      footer += "</tr><tr>";
      footer +=
        "<td colspan='2' style='text-align:center'><br><br>_________________<br><b>Firma y cédula del miembro del<br> Consejo Comunal</b><br>";
      footer +=
        "Comité ______________________<br>Teléfono __________________</td></tr></table>";
      footer += "<br><br><br><b>Sello del Consejo Comunal</b></center>";

      break;

    case "Buena conducta":
      header =
        "<title>Constancia de buena conducta</title><center>REPUBLICA BOLIVARIANA DE VENEZUELA<br>";
      header += "CONSEJO COMUNAL <br>PRADOS DE OCCIDENTE SECTOR III<br>";
      header += "RIF. J-30725585 CODIGO 13-03-04-608-0002<br>";
      header += "Barquisimeto Municipio Iribarren<br>";
      header += "Parroquia Guerrera Ana Soto Estado Lara<br>";
      header += "<u><h4><b>CERTIFICADO DE BUENA CONDUCTA</b></h4></u><br>";
      header += "</center>";

      body =
        "<div style='width:100%;text-align:justify'><b>&nbsp;&nbsp;Quienes suscriben Miembros del Consejo Comunal de Prados ";
      body +=
        "de Occidente Sector III, ubicado en la Autopista Florencio Jiménez Vía Quibor Km 7 y medio de la ";
      body +=
        "parroquia Guerrera Ana Soto del Municipio Iribarren del estado Lara, hacemos constar que el (la) ";
      body +=
        "cidudano(a) <u>&nbsp;&nbsp;" +
        solicitud["primer_nombre"] +
        " " +
        solicitud["primer_apellido"] +
        "&nbsp;&nbsp;</u>";
      body +=
        " portador de la cédula de identidad <u>&nbsp;&nbsp;" +
        solicitud["cedula_persona"] +
        "&nbsp;&nbsp;</u> quien se encuentra";
      body +=
        " residenciado en esta Comunidad en la siguiente dirección: Parados de Occidente Sector III ______________________________________";
      body +=
        " declaramos que conocemos suficientemente de vista, trato y comunicación al (la) mencionado(a) ciudadano(a),";
      body +=
        " así como también nos consta QUE VIVE EN NUESTRA COMUNIDAD DESDE HACE <u>&nbsp;&nbsp" +
        getAntiguedad(solicitud["antiguedad_comunidad"]) +
        "&nbsp;&nbsp;</u>";
      body +=
        " AÑOS Y DURANTE ESTE TIEMPO DE RESIDENCIA EN NUESTRA COMUNIDAD SIEMPRE HA MANTENIDO BUENA CONDUCTA";
      body += " ACATANDO LAS NORMAS DE CONVIVENCIA Y RESPETO.";
      body +=
        "<br><br>&nbsp;&nbsp;CERTIFICADO que se expide para fines legales, en la ciudad de Brquisimeto ";
      body +=
        "a los <u>&nbsp;&nbsp;" +
        new Date().getDate() +
        "&nbsp;&nbsp;</u> días del mes de <u>&nbsp;&nbsp;" +
        getMes(new Date().getMonth() + 1) +
        "&nbsp;&nbsp;</u>";
      body +=
        " del Año <u>&nbsp;&nbsp;" +
        new Date().getFullYear() +
        "&nbsp;&nbsp</u>.";
      body +=
        "<br><br>Firman Conformes los miembros autorizados para tal fin.<br><br></div>";

      footer = "<br><br><br><center><table style='width:80%'><tr><td>";
      footer +=
        "_________________<br><b>Firma y cédula del miembro del Consejo Comunal</b><br>";
      footer +=
        "Comité ______________________<br>Teléfono __________________</td>";
      footer +=
        "<td>_________________<br><b>Firma y cédula del miembro del Consejo Comunal</b><br>";
      footer +=
        "Comité ______________________<br>Teléfono __________________</td>";
      footer += "</tr><tr>";
      footer +=
        "<td colspan='2' style='text-align:center'><br><br>_________________<br><b>Firma y cédula del miembro del<br> Consejo Comunal</b><br>";
      footer +=
        "Comité ______________________<br>Teléfono __________________</td></tr></table>";
      footer += "<br><br><br><b>Sello del Consejo Comunal</b></center>";

      break;

    case "No poseer vivienda":
      header =
        "<title>Constancia de no poseer vivienda</title><center>REPUBLICA BOLIVARIANA DE VENEZUELA<br>";
      header += "MINISTERIO DEL PODER POPULAR PARA LAS COMUNAS<br>";
      header +=
        "CONSEJO COMUNAL <u>&nbsp;&nbsp;PRADOS DE OCCIDENTE SECTOR III&nbsp;&nbsp;</u><br>";
      header += "RIF J- <u>&nbsp;30725585&nbsp;</u><br>";
      header += "<u><h4><b>CONSTANCIA DE NO POSEER VIVIENDA</b></h4></u><br>";
      header += "</center>";

      body = "<div style='width:100%;text-align:justify'><b>&nbsp;&nbsp;";
      body +=
        "Por medio de la persente, el Consejo Comunal ''<u>&nbsp;&nbsp;PRADOS DE OCCIDENTE";
      body +=
        " SECTOR III&nbsp;&nbsp;</u>'' integrado por los voceros [Cambiar por voceros]";
      body +=
        " Venezolanos mayores de edad, civilmente hábiles, y respectivamente ubicados";
      body +=
        " en el Sector <u>&nbsp;III&nbsp;</u>, Parroquia <u>&nbsp;&nbsp;Guerrera Ana Soto&nbsp;&nbsp;</u>";
      body +=
        " Municipio Iribarren del Estado Lara, mediante la presente hacemos constar que el ciudadano(a):";
      body +=
        "<u>&nbsp;&nbsp;" +
        solicitud["primer_nombre"] +
        " " +
        solicitud["primer_apellido"] +
        "&nbsp;&nbsp;</u>";
      body +=
        " Venezolano(a), mayor de edad, portador de la cédula de identidad <u>&nbsp;&nbsp;" +
        solicitud["cedula_persona"];
      body += "&nbsp;&nbsp;</u>.";
      body +=
        "<br>&nbsp;&nbsp;Hacemos constar que el(ella) <u>no posee vivienda propia</u> y requiere de una solución";
      body +=
        " habitacional por carecer de ella. Y reside en: _____________________________________, en calidad de:";
      body += "_____________________________________. <br><br>";
      body +=
        "&nbsp;&nbsp;Constancia que se expide a para fines consiguientes, en Barquisimeto, a los " +
        new Date().getDate();
      body +=
        " días del mes de " +
        getMes(new Date().getMonth() + 1) +
        " del " +
        new Date().getFullYear();

      footer = "<br><br><br><center>Por el consejo Comunal<br>";
      footer +=
        "<table style='width:80%'><tr><td>______________________________<br>Voc. Órgano de Admin y Finanzas</td>";
      footer +=
        "<td>______________________________<br>Voc. Órgano de Admin y Finanzas</td>";
      footer +=
        "</tr><tr><td colspan='2' style='text-align:center'>________________________<br> Voc. Contraloría</td>";
      footer += "</table>";

      break;
  }

  var content = header + body + footer;
  return content;
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
