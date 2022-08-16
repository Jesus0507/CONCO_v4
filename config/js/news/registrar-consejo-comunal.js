  $(document).ready(function() {
      $("#enviar").on("click", function() {
          var form = $("#formulario");
          var cedula_persona = document.getElementById("cedula_persona");
          var nombre_comite = document.getElementById("nombre_comite");
          var cargo_persona = document.getElementById("cargo_persona");
          var fecha_ingreso = document.getElementById("fecha_ingreso");
          var fecha_salida = document.getElementById("fecha_salida");
          var mensaje_1 = document.getElementById("mensaje_1");
          var mensaje_2 = document.getElementById("mensaje_2");
          var mensaje_3 = document.getElementById("mensaje_3");
          var mensaje_4 = document.getElementById("mensaje_4");
          var datos = {
              cedula_persona: $("#cedula_persona").val(),
              nombre_comite: $("#nombre_comite").val(),
              cargo_persona: $("#cargo_persona").val(),
              fecha_ingreso: $("#fecha_ingreso").val(),
              fecha_salida: $("#fecha_salida").val(),
          };
          var retornar = false;
          if (cedula_persona.value == '' || cedula_persona.value == null) {
              mensaje_1.innerHTML = 'Debe escribir una cedula ';
              cedula_persona.style.borderColor = 'red';
              mensaje_1.style.color = 'red';
              cedula_persona.focus();
          } else {
              mensaje_1.innerHTML = '';
              cedula_persona.style.borderColor = '';
              if (nombre_comite.value == '' || nombre_comite.value == null) {
                  mensaje_2.innerHTML = 'el campo nombre no puede estar vacio';
                  nombre_comite.style.borderColor = 'red';
                  mensaje_2.style.color = 'red';
                  nombre_comite.focus();
              } else {
                  mensaje_2.innerHTML = '';
                  nombre_comite.style.borderColor = '';
                  if (cargo_persona.value == '0') {
                      mensaje_3.innerHTML = 'el campo cargo  no puede estar vacio';
                      cargo_persona.style.borderColor = 'red';
                      mensaje_3.style.color = 'red';
                      cargo_persona.focus();
                  } else {
                      mensaje_3.innerHTML = '';
                      cargo_persona.style.borderColor = '';
                      if (fecha_ingreso.value == '' || fecha_ingreso.value == null) {
                          mensaje_4.innerHTML = 'el campo fecha de ingreso no puede estar vacio';
                          fecha_ingreso.style.borderColor = 'red';
                          mensaje_4.style.color = 'red';
                          fecha_ingreso.focus();
                      } else {
                          mensaje_4.innerHTML = '';
                          fecha_ingreso.style.borderColor = '';
                          $.ajax({
                              type: "POST",
                              url: BASE_URL + "Consejo_Comunal/Administrar",
                              data: {
                                  datos: datos,
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
                                      setTimeout(function() {
                                          location.href = BASE_URL + 'Consejo_Comunal/Administrar/Consultas';
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
                              },
                              error: function(datos) {
                                  alert("Error al enviar Controlador")
                              }
                          });
                      }
                  }
              }
          }
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