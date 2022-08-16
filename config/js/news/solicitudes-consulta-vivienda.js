var title = document.getElementById("title-solicitud");
var id = document.getElementById("id_solicitud");
var persona = document.getElementById("persona");
var date = document.getElementById("fecha_solicitud");
var aprobar = document.getElementById("aprobar");
var rechazar = document.getElementById("rechazar");
var solicitante = "";
var id_servicio = document.getElementById("id_servicio");

$.ajax({
  type: "POST",
  url: BASE_URL + "Solicitudes/Consultar_solicitudes_vivienda",
  data: { id: id.value },
}).done(function (datos) {
  var result_s = JSON.parse(datos);
  console.log(result_s);
  var cuerpo_s = "";
  var titulo_solicitud = "";

  for (var i = 0; i < result_s.length; i++) {
    if (result_s[i]["id_solicitud"] == id.value) {
      solicitante = result_s[i];
      // document.getElementById("email_boton").click();
      //      enviar_correo();

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
        case "Vivienda":
          titulo_solicitud =
            "<em class='fas fa-plus-square'></em> Solicitud de registro de " +
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
      title.innerHTML = titulo_solicitud;
      document.getElementById("calle").innerHTML = result_s[i]["nombre_calle"];
      document.getElementById("direccion").innerHTML =
        result_s[i]["direccion_vivienda"];
      document.getElementById("nro_vivienda").innerHTML =
        result_s[i]["numero_casa"];

      document.getElementById("habitaciones").innerHTML =
        result_s[i]["cantidad_habitaciones"];
      document.getElementById("tipo_vivienda").innerHTML =
        result_s[i]["nombre_tipo_vivienda"];
      document.getElementById("condicion").innerHTML = result_s[i]["condicion"];

      result_s[i]["hacinamiento"] == 1
        ? (document.getElementById("hacinamiento").innerHTML =
            "<span class='fa fa-check'></span>")
        : (document.getElementById("hacinamiento").innerHTML =
            "<span class='fa fa-times'></span>");
      result_s[i]["espacio_siembra"] == 1
        ? (document.getElementById("espacio_siembra").innerHTML =
            "<span class='fa fa-check'></span>")
        : (document.getElementById("espacio_siembra").innerHTML =
            "<span class='fa fa-times'></span>");
      result_s[i]["banio_sanitario"] == 1
        ? (document.getElementById("sanitario").innerHTML =
            "<span class='fa fa-check'></span>")
        : (document.getElementById("sanitario").innerHTML =
            "<span class='fa fa-times'></span>");

      document.getElementById("agua_consumo").innerHTML =
        result_s[i]["agua_consumo"];
      document.getElementById("aguas_negras").innerHTML =
        result_s[i]["aguas_negras"];
      document.getElementById("residuos_solidos").innerHTML =
        result_s[i]["residuos_solidos"];

      result_s[i]["servicio_electrico"] == 1
        ? (document.getElementById("cableado_electrico").innerHTML =
            "<span class='fa fa-check'></span>")
        : (document.getElementById("cableado_electrico").innerHTML =
            "<span class='fa fa-times'></span>");
      result_s[i]["cable_telefonico"] == 1
        ? (document.getElementById("cableado_telefonico").innerHTML =
            "<span class='fa fa-check'></span>")
        : (document.getElementById("cableado_telefonico").innerHTML =
            "<span class='fa fa-times'></span>");
      result_s[i]["internet"] == 1
        ? (document.getElementById("internet").innerHTML =
            "<span class='fa fa-check'></span>")
        : (document.getElementById("internet").innerHTML =
            "<span class='fa fa-times'></span>");

      result_s[0]["servicio_gas"].length != 0
        ? (document.getElementById("gas").innerHTML =
            "<span class='fa fa-check'></span>")
        : (document.getElementById("gas").innerHTML =
            "<span class='fa fa-times'></span>");
      result_s[i]["animales domesticos"] == 1
        ? (document.getElementById("animales").innerHTML =
            "<span class='fa fa-check'></span>")
        : (document.getElementById("animales").innerHTML =
            "<span class='fa fa-times'></span>");
      result_s[i]["insectos_roedores"] == 1
        ? (document.getElementById("plagas").innerHTML =
            "<span class='fa fa-check'></span>")
        : (document.getElementById("plagas").innerHTML =
            "<span class='fa fa-times'></span>");

      document.getElementById("descripcion").innerHTML =
        result_s[i]["descripcion"];
      document.getElementById("tipo_techo").innerHTML =
        result_s[i]["tipos_techo"];
      document.getElementById("tipo_piso").innerHTML =
        result_s[i]["tipos_piso"];
      document.getElementById("tipo_pared").innerHTML =
        result_s[i]["tipos_pared"];

      id_servicio.value = result_s[i]["id_servicio"]+"-"+result_s[i]['observaciones'];

      document.getElementById("tipo_gas").innerHTML =
        result_s[i]["gas_detalle"];

      document.getElementById("electrodomestico").innerHTML =
        result_s[i]["electrodomesticos"];

      console.log(result_s[i]["servicio_gas"]);
    }
  }
});

rechazar.onclick = function () {
  var textoSwal =
    "Está por rechazar la solicitud de un registro de vivienda ¿desea continuar?<br><br>";
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
          rechazoSolicitud(document.getElementById("text-area").value,id_servicio.value);
          var datos_notificacion = new Object();
          datos_notificacion["tipo_notificacion"] = 5;
          datos_notificacion["usuario_receptor"] =
            solicitante["cedula_persona"];
          datos_notificacion["accion"] =
            "Rechazó su solicitud para registro de " +
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
            "Su solicitud para registro de " +
            solicitante["tipo_constancia"] +
            " ha sido rechazada. El motivo del rechazo es: " +
            motivo_rechazo;

          if (solicitante["correo"] != "No posee") {
            document.getElementById("btn_correo").click();
          }
          else{
            setTimeout(function(){location.href=BASE_URL+"Solicitudes/"},1000);
          }

          // setTimeout(function(){location.href=BASE_URL+"Solicitudes/"},1000);
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
        }).done(function(){
          $.ajax({
            type: "POST",
            url: BASE_URL + "Viviendas/activar_vivienda",
            data: {
              "id_vivienda": id_servicio.value,
            },
          }).done(function(result){
          })   
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
        datos_notificacion["usuario_receptor"] = solicitante["cedula_persona"];
        datos_notificacion["accion"] =
          "Aprobó su solicitud para registro de " +
          solicitante["tipo_constancia"] +
          ".";

        console.log(datos_notificacion);

        solicitante["asunto"] = "Se ha aprobado su solicitud";
        solicitante["mensaje"] =
          "Su solicitud para registro de " +
          solicitante["tipo_constancia"] +
          " ha sido aprobada.";

        if (solicitante["correo"] != "No posee") {
          document.getElementById("btn_correo").click();
        }
        else{
          setTimeout(function(){location.href=BASE_URL+"Solicitudes/"},1000);
        }

        nueva_notificacion(datos_notificacion);

        // setTimeout(function(){

        //   print_pdf();
        //   window.open(BASE_URL+"Solicitudes/");

        // },1000);
      }

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
  }).done(function(){
    $.ajax({
      type: "POST",
      url: BASE_URL + "Viviendas/eliminar_vivienda",
      data: {
        "id": id_servicio.value
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
