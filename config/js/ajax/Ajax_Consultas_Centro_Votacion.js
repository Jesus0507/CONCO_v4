  cargar_tabla();

  function editar(tag, id) {
      var fila = tag.closest("tr");
      var td = fila.querySelectorAll("td");
      var cedula_persona = td[0].innerHTML;
      var nombre_centro = td[2].innerHTML;
      var parroquia = td[3].innerHTML;
      document.getElementById("cedula_persona2").value = cedula_persona;
      document.getElementById("nombre_centro2").value = nombre_centro;
      $.ajax({
          type: "POST",
          url: BASE_URL + "Centro_Votacion/Administrar",
          data: {
              peticion: "Parroquias",
              id: parroquia
          },
      }).done(function(result) {
          document.getElementById("id_parroquia2").value = parseInt(result);
          $("#actualizar").modal("show");
      })
      document.getElementById("enviar").onclick = function() {
          if (document.getElementById("nombre_centro2").value == "") {
              swal({
                  type: "error",
                  title: "Error",
                  text: "Debe indicar el centro de votación",
                  timer: 2000,
                  showConfirmButton: false
              });
          } else {
              var datos = {
                  nombre_centro: document.getElementById("nombre_centro2").value,
                  cedula_persona: cedula_persona,
                  id_parroquia: document.getElementById("id_parroquia2").value,
                  id_votante_centro_votacion: id,
                  estado: 1
              };
              $.ajax({
                  type: "POST",
                  url: BASE_URL + "Centro_Votacion/Administrar",
                  data: {
                      peticion: "Editar",
                      datos: datos,
                      sql: "SQL_05"
                  },
              }).done(function(datos) {
                  if (datos == 1) {
                      swal({
                          type: "success",
                          title: "Éxito",
                          text: "Los cambios se han realizado exitosamente",
                          timer: 2000,
                          showConfirmButton: false
                      });
                      setTimeout(function() {
                          $('#example1').DataTable().clear().destroy();
                          cargar_tabla();
                          $("#actualizar").modal("hide");
                      }, 1000);
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
              })
          }
      }
  }

  function cargar_tabla() {
      $.ajax({
          type: "POST",
          url: BASE_URL + "Centro_Votacion/Administrar",
          data: {
              peticion: "Consulta_Ajax",
          },
      }).done(function(datos) {
          var data = JSON.parse(datos);
          var tabla = $("#example1").DataTable({
              "data": data,
              "columns": [{
                  "data": "cedula_persona"
              }, {
                  "data": function(data) {
                      return data.primer_nombre + " " + data.primer_apellido;
                  }
              }, {
                  "data": "nombre_centro"
              }, {
                  "data": "nombre_parroquia"
              }, {
                  "data": function(data) {
                      return '<td class="text-center">' + '<a href="javascript:void(0)" style="margin-right: 5px;" class="btn bg-info ver-popup" title="Ver" type="button" data-toggle="modal" data-target="#ver">' + '<i class="fa fa-eye"></i>' + '</a>' + '<a href="javascript:void(0)" style="margin-right: 5px;" class="btn bg-success btnEditar" onclick="editar(this,' + data.id_votante_centro_votacion + ')"  title="Actualizar" type="button">' + '<i class="fa fa-edit" style="color: white;"></i>' + '</a>' + '<a href="javascript:void(0)" style="margin-right: 5px;" class="btn bg-danger mensaje-eliminar" title="Eliminar">' + '<i class="fa fa-trash"></i>' + '</a>' + '<p style="display: none;">' + data.id_votante_centro_votacion + '</p>' + '</td>';
                  }
              }, ],
              "responsive": true,
              "autoWidth": false,
              "ordering": true,
              "info": true,
              "processing": true,
              "pageLength": 10,
              "lengthMenu": [5, 10, 20, 30, 40, 50, 100]
          }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
          $(document).on("click", ".ver-popup", function() {
              fila = $(this).closest("tr");
              cedula_persona = fila.find("td:eq(0)").text();
              nombre_apellido = fila.find("td:eq(1)").text();
              nombre_centro = fila.find("td:eq(2)").text();
              id_parroquia = fila.find("td:eq(3)").text();
              $("#cedula_persona").val(cedula_persona);
              $("#nombre_apellido").val(nombre_apellido);
              $("#nombre_centro").val(nombre_centro);
              $("#id_parroquia").val(id_parroquia);
          });
          $(document).on("click", ".mensaje-eliminar", function() {
              fila = $(this).closest("tr");
              id = fila.find("td:eq(4)").text();
              var estado = {
                  tabla: "votantes_centro_votacion",
                  id_tabla: "id_votante_centro_votacion",
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
                          url: BASE_URL + "Centro_Votacion/Administrar",
                          type: "POST",
                          data: {
                              peticion: "Administrar",
                              estado: estado,
                              sql: "ACT_DES",
                              accion: "Se ha Eliminado el  Votante: " + fila.find("td:eq(1)").text() + " del centro de votacion: " + fila.find("td:eq(2)").text(),
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
      }).fail(function() {
          alert("error")
      });
  }