  $(document).ready(function() {
      $("#enviar").on("click", function() {
          var datos = {
              cedula_persona: $("#cedula_persona").val(),
              cargo_persona: $("#cargo_persona").val(),
              fecha_ingreso: $("#fecha_ingreso").val(),
              fecha_salida: $("#fecha_salida").val(),
          };
          $.ajax({
              type: "POST",
              url: BASE_URL + "app/Direcciones.php",
              data: {
                  direction: "Consejo_Comunal/Administrar",
                  accion: "codificar"
              },
              success: function(direccion_segura) {
                  $.ajax({
                      type: "POST",
                      url: BASE_URL + direccion_segura,
                      data: {
                          datos: datos,
                          nombre_comite: $("#nombre_comite").val(),
                          peticion: "Registrar",
                          sql: "SQL_02",
                          accion: "El portador de la cedula" + datos.cedula_persona + " fue Registrado como vocero \\Exitosamente.",
                      },
                      success: function(datos) {
                          if (datos == 1) {
                              swal({
                                  title: "Registrado!",
                                  text: "El elemento fue Registrado con exito.",
                                  type: "success",
                                  showConfirmButton: false
                              });
                              Direccionar('Consejo_Comunal/Administrar/Consultas');
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
                      },
                      error: function(datos) {
                          alert("Error al enviar Controlador")
                      }
                  });
              },
              error: function() {
                  alert('Error al codificar dirreccion');
              }
          });
      });
      document.onkeypress = function(e) {
          if (e.which == 13 || e.keyCode == 13) {
              envioFormulario();
              return false;
          } else {
              return true;
          }
      }
  });