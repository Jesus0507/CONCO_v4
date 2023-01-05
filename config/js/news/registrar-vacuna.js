 $(document).ready(function() {
     var i = 1;
     $('#agregar').click(function() {
         var html1 = '<tr id="row' + i + '" >' + '<td class="col-6">' + '<div class="input-group"><select class="custom-select" id="dosis" name="dosis[]"><option selected value="Primera Dosis">Primera Dosis</option><option value="Segunda Dosis">Segunda Dosis</option><option value="Tercera Dosis">Tercera Dosis</option></select></div>' + '</td>' + '<td class="col-6">' + '<div class="input-group"><input class="form-control no-simbolos" id="fecha" name="fecha[]" type="date"></div>' + '</td>' + '<td>' + '<button type="button" name="eliminar" id="' + i + '" class="btn btn-danger eliminar">X</button>' + '</td>' + '</tr>';
         var html2 = '<tr id="row' + i + '" >' + '<td class="col-6">' + '<div class="input-group"><select class="custom-select" id="dosis" name="dosis[]"><option value="Primera Dosis">Primera Dosis</option><option selected value="Segunda Dosis">Segunda Dosis</option><option value="Tercera Dosis">Tercera Dosis</option></select></div>' + '</td>' + '<td class="col-6">' + '<div class="input-group"><input class="form-control no-simbolos" id="fecha" name="fecha[]" type="date"></div>' + '</td>' + '<td>' + '<button type="button" name="eliminar" id="' + i + '" class="btn btn-danger eliminar">X</button>' + '</td>' + '</tr>';
         var html3 = '<tr id="row' + i + '" >' + '<td class="col-6">' + '<div class="input-group"><select class="custom-select" id="dosis" name="dosis[]"><option value="Primera Dosis">Primera Dosis</option><option value="Segunda Dosis">Segunda Dosis</option><option selected value="Tercera Dosis">Tercera Dosis</option></select></div>' + '</td>' + '<td class="col-6">' + '<div class="input-group"><input class="form-control no-simbolos" id="fecha" name="fecha[]" type="date"></div>' + '</td>' + '<td>' + '<button type="button" name="eliminar" id="' + i + '" class="btn btn-danger eliminar">X</button>' + '</td>' + '</tr>';
         if (i <= 1) {
             $('#tabla').append(html2);
         } else {
             if (i <= 2) {
                 $('#tabla').append(html3);
             } else {
                 if (i <= 3) {
                     document.getElementById("texto").innerHTML = "No puede agregar mas";
                 } else {}
             }
         }
         i == 3 ? i = 3 : i++;
         console.log(i);
     });
     $(document).on('click', '.eliminar', function() {
         var boton = $(this).attr("id");
         $('#row' + boton + '').remove();
         i == 1 ? i = 1 : i--;
         document.getElementById("texto").innerHTML = "";
         console.log(i);
     });
     $(document).on('click', '#enviar', function() {
         if (document.getElementById("cedula_persona").value != "") {
             var todos_inputs = $('#tabla :input');
             var dosis = [];
             var fecha = [];
             var validado = true;
             for (var i = 0; i < todos_inputs.length; i++) {
                 if (todos_inputs[i].type == 'text') {
                     dosis.push(todos_inputs[i].value);
                 }
             }
             for (var i = 0; i < todos_inputs.length; i++) {
                 if (todos_inputs[i].type == 'date') {
                     if (todos_inputs[i].value == "") {
                         validado = false;
                     } else {
                         fecha.push(todos_inputs[i].value);
                     }
                 }
             }
             if (validado == false) {
                 swal({
                     type: "error",
                     title: "Error",
                     text: "Debe agregar las fechas de vacunación",
                     timer: 2000,
                     showConfirmButton: false
                 });
             } else {
                 // $.ajax({
                 //     type: "POST",
                 //     url: BASE_URL + "Personas/consulta_vacunado",
                 //     data: {
                 //         "cedula": document.getElementById("cedula_persona").value
                 //     }
                 // }).done(function(result) {
                 //     console.log(result);
                 //     if (result) {
                 //         swal({
                 //             type: "success",
                 //             title: "Éxito",
                 //             text: "Se han registrado los vacunados exitosamente",
                 //             timer: 2000,
                 //             showConfirmButton: false
                 //         });
                 //         setTimeout(function() {
                 //             document.getElementById("formulario").submit();
                 //         }, 1000);
                 //     } else {
                 //         swal({
                 //             type: "error",
                 //             title: "Error",
                 //             text: "Esta persona ya se encuentra registrada como vacunado",
                 //             timer: 2000,
                 //             showConfirmButton: false
                 //         });
                 //     }
                 // });
                 $.ajax({
                     type: "POST",
                     url: BASE_URL + "app/Direcciones.php",
                     data: {
                         direction: "Vacunados/Administrar",
                         accion: "codificar"
                     },
                     success: function(direccion_segura) {
                         var datos = {
                             cedula_persona: document.getElementById("cedula_persona").value,
                             dosis: dosis,
                             fecha_vacuna: fecha,
                             estado: 1
                         };
                         $.ajax({
                             type: "POST",
                             url: BASE_URL + direccion_segura,
                             data: {
                                 peticion: "Existe",
                                 "cedula": document.getElementById("cedula_persona").value
                             }
                         }).done(function(result) {
                             if (result) {
                                 $.ajax({
                                     type: 'POST',
                                     url: BASE_URL + direccion_segura,
                                     data: {
                                         datos: datos,
                                         peticion: "Registrar",
                                         sql: "SQL_02",
                                         accion: "Se ha registrado un nuevo vacunado: " + document.getElementById("cedula_persona").value,
                                     },
                                     success: function(respuesta) {
                                         if (respuesta == 1) {
                                             swal({
                                                 type: "success",
                                                 title: "Éxito",
                                                 text: "Se han registrado los vacunados exitosamente",
                                                 timer: 2000,
                                                 showConfirmButton: false
                                             });
                                             Direccionar('Vacunados/Administrar/Consultas');
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
         } else {
             swal({
                 type: "error",
                 title: "Error",
                 text: "Debe seleccionar una persona",
                 timer: 2000,
                 showConfirmButton: false
             });
         }
     });
 });
 
 // $(document).ready(function() {
 //     var i = 1;
 //     $('#agregar').click(function() {
 //         var html1 = '<tr id="row' + i + '" >' + '<td class="col-6">' + '<div class="input-group"><select class="custom-select" id="dosis" name="dosis[]"><option selected value="Primera Dosis">Primera Dosis</option><option value="Segunda Dosis">Segunda Dosis</option><option value="Tercera Dosis">Tercera Dosis</option></select></div>' + '</td>' + '<td class="col-6">' + '<div class="input-group"><input class="form-control no-simbolos" id="fecha" name="fecha[]" type="date"></div>' + '</td>' + '<td>' + '<button type="button" name="eliminar" id="' + i + '" class="btn btn-danger eliminar">X</button>' + '</td>' + '</tr>';
 //         var html2 = '<tr id="row' + i + '" >' + '<td class="col-6">' + '<div class="input-group"><select class="custom-select" id="dosis" name="dosis[]"><option value="Primera Dosis">Primera Dosis</option><option selected value="Segunda Dosis">Segunda Dosis</option><option value="Tercera Dosis">Tercera Dosis</option></select></div>' + '</td>' + '<td class="col-6">' + '<div class="input-group"><input class="form-control no-simbolos" id="fecha" name="fecha[]" type="date"></div>' + '</td>' + '<td>' + '<button type="button" name="eliminar" id="' + i + '" class="btn btn-danger eliminar">X</button>' + '</td>' + '</tr>';
 //         var html3 = '<tr id="row' + i + '" >' + '<td class="col-6">' + '<div class="input-group"><select class="custom-select" id="dosis" name="dosis[]"><option value="Primera Dosis">Primera Dosis</option><option value="Segunda Dosis">Segunda Dosis</option><option selected value="Tercera Dosis">Tercera Dosis</option></select></div>' + '</td>' + '<td class="col-6">' + '<div class="input-group"><input class="form-control no-simbolos" id="fecha" name="fecha[]" type="date"></div>' + '</td>' + '<td>' + '<button type="button" name="eliminar" id="' + i + '" class="btn btn-danger eliminar">X</button>' + '</td>' + '</tr>';
 //         if (i <= 1) {
 //             $('#tabla').append(html2);
 //         } else {
 //             if (i <= 2) {
 //                 $('#tabla').append(html3);
 //             } else {
 //                 if (i <= 3) {
 //                     document.getElementById("texto").innerHTML = "No puede agregar mas";
 //                 } else {}
 //             }
 //         }
 //         i == 3 ? i = 3 : i++;
 //         console.log(i);
 //     });
 //     $(document).on('click', '.eliminar', function() {
 //         var boton = $(this).attr("id");
 //         $('#row' + boton + '').remove();
 //         i == 1 ? i = 1 : i--;
 //         document.getElementById("texto").innerHTML = "";
 //         console.log(i);
 //     });
 //     $(document).on('click', '#enviar', function() {
 //         if (document.getElementById("cedula_persona").value != "") {
 //             var todos_inputs = $('#tabla :input');
 //             var dosis = [];
 //             var fecha = [];
 //             var validado = true;
 //             for (var i = 0; i < todos_inputs.length; i++) {
 //                 if (todos_inputs[i].type == 'text') {
 //                     dosis.push(todos_inputs[i].value);
 //                 }
 //             }
 //             for (var i = 0; i < todos_inputs.length; i++) {
 //                 if (todos_inputs[i].type == 'date') {
 //                     if (todos_inputs[i].value == "") {
 //                         validado = false;
 //                     } else {
 //                         fecha.push(todos_inputs[i].value);
 //                     }
 //                 }
 //             }
 //             if (validado == false) {
 //                 swal({
 //                     type: "error",
 //                     title: "Error",
 //                     text: "Debe agregar las fechas de vacunación",
 //                     timer: 2000,
 //                     showConfirmButton: false
 //                 });
 //             } else {
 //                 $.ajax({
 //                     type: "POST",
 //                     url: BASE_URL + "app/Direcciones.php",
 //                     data: {
 //                         direction: "Vacunados/Administrar",
 //                         accion: "codificar"
 //                     },
 //                     success: function(direccion_segura) {
 //                        var datos = {
 //                        cedula_persona: document.getElementById("cedula_persona").value,
 //                    dosis: dosis,
 //                    fecha_vacuna: fecha,
 //                    estado: 1
 //                    };
 //                         $.ajax({
 //                             type: "POST",
 //                             url: BASE_URL + direccion_segura,
 //                             data: {
 //                                peticion: "Existe",
 //                                 "cedula": document.getElementById("cedula_persona").value
 //                             }
 //                         }).done(function(result) {
 //                             if (result) {
 //                                $.ajax({
 //                        type: 'POST',
 //                        url: BASE_URL + direccion_segura,
 //                        data: {
 //                            datos: datos,
 //                            peticion: "Registrar",
 //                            sql: "SQL_02",
 //                            accion: "Se ha registrado un nuevo vacunado: " + document.getElementById("cedula_persona").value,
 //                        },
 //                        success: function(respuesta) {
 //                            if (respuesta == 1) {
 //                                 swal({
 //                                     type: "success",
 //                                     title: "Éxito",
 //                                     text: "Se han registrado los vacunados exitosamente",
 //                                     timer: 2000,
 //                                     showConfirmButton: false
 //                                 });
 //                                Direccionar('Vacunados/Administrar/Consultas');
 //                            } else {
 //                                swal({
 //                                    title: "ERROR!",
 //                                    text: respuesta,
 //                                    type: "error",
 //                                    html: true,
 //                                    showConfirmButton: true,
 //                                    customClass: "bigSwalV2",
 //                                });
 //                            }
 //                        },
 //                        error: function(respuesta) {
 //                            alert("Error al enviar Controlador")
 //                        }
 //                    });
 //                             } else {
 //                                 swal({
 //                                     type: "error",
 //                                     title: "Error",
 //                                     text: "Esta persona ya se encuentra registrada como vacunado",
 //                                     timer: 2000,
 //                                     showConfirmButton: false
 //                                 });
 //                             }
 //                         });
 //                     },
 //                     error: function() {
 //                         alert('Error al codificar dirreccion');
 //                     }
 //                 });
 //             }
 //         } else {
 //             swal({
 //                 type: "error",
 //                 title: "Error",
 //                 text: "Debe seleccionar una persona",
 //                 timer: 2000,
 //                 showConfirmButton: false
 //             });
 //         }
 //     });
 // });