var dosis_select = document.getElementById('dosis');
var fechas_input = document.getElementById('fecha');
var btn_agregar = document.getElementById('agregar');
var vacunas_agg = [];
var btn_registrar = document.getElementById('enviar');
var div_vacunas = document.getElementById('vacunas-agregadas');

btn_agregar.onclick = function(){

    if(dosis_select.value == 0 || (fechas_input.value == null || fechas_input.value == '')){
        swal({
            type: "error",
            title: "Error",
            text: "Debe seleccionar una dosis y colocar la fecha",
            timer: 2000,
            showConfirmButton: false
        });
    }
    
    else {
            switch (vacunas_agg.length) {
                case 0:
                    if(valid_fecha_vacunado(1)) {
                        add_vacuna(1,false);
                    }
                break;
                case 1:
                    if(valid_fecha_vacunado(2)) {
                        add_vacuna(2,false);

                    }
                break;

                case 2:
                    if(valid_fecha_vacunado(3)) {
                        add_vacuna(3,false);
                    }
                break;
            }
    }
}


function valid_fecha_vacunado(index){
    var fecha_dosis = new Date(fechas_input.value);
    var fecha_act = new Date();
    var retornar = false;
    var mensaje = '';
switch(index) {
    case 1:
        if(fecha_act < fecha_dosis) {
           mensaje = 'La fecha de la primera dosis no puede ser posterior a la fecha actual';
        }
        else {
            retornar = true;
        }
    break;

    case 2:
        var fecha_dosis1 = new Date(vacunas_agg[0]['fecha']);
        if(fecha_dosis1 > fecha_dosis) {
           mensaje = 'La fecha de la segunda dosis no puede ser anterior a la fecha de la primera dosis';
        }
        else {
            if(fecha_act < fecha_dosis) {
                mensaje = 'La fecha de la segunda dosis no puede ser posterior a la fecha actual';
             }
             else {
                 retornar = true;
             }
        }
    break;

    default:
        var fecha_dosis2 = new Date(vacunas_agg[1]['fecha']);
        if(fecha_dosis2 > fecha_dosis) {
           mensaje = 'La fecha de la tercera dosis no puede ser anterior a la fecha de la segunda dosis';
        }
        else {
            if(fecha_act < fecha_dosis) {
                mensaje = 'La fecha de la tercera dosis no puede ser posterior a la fecha actual';
             }
             else {
                 retornar = true;
             }
        }
    break;
}

   if(!retornar) {
    swal({
        type: "error",
        title: "Error",
        text: mensaje,
        timer: 2000,
        showConfirmButton: false
    });
   }

return retornar;
}

function add_vacuna(index,remove) {
    if(!remove){
    var vacuna_info = new Object();
    vacuna_info['dosis'] = dosis_select.value;
    vacuna_info['fecha'] = fechas_input.value;
    vacunas_agg.push(vacuna_info);
    dosis_select.value = 0;
    dosis_select.options[index].disabled = 'disabled';
    dosis_select.options[index].style.background = '#C3DAE5';
    if (index < 3) {
    dosis_select.options[index+1].disabled = '';
    dosis_select.options[index+1].style.background = '';
    }
    }
    else{
        switch(vacunas_agg.length){
            case 0:
                dosis_select.options[1].disabled = '';
                dosis_select.options[1].style.background = '';
                dosis_select.options[2].disabled = 'disabled';
                dosis_select.options[2].style.background = '#C3DAE5';
                dosis_select.options[3].disabled = 'disabled';
                dosis_select.options[3].style.background = '#C3DAE5';
            break;
            case 1:
                dosis_select.options[2].disabled = '';
                dosis_select.options[2].style.background = '';
                dosis_select.options[1].disabled = 'disabled';
                dosis_select.options[1].style.background = '#C3DAE5';
                dosis_select.options[3].disabled = 'disabled';
                dosis_select.options[3].style.background = '#C3DAE5';
            break;
            default:
                dosis_select.options[3].disabled = '';
                dosis_select.options[3].style.background = '';
                dosis_select.options[2].disabled = 'disabled';
                dosis_select.options[2].style.background = '#C3DAE5';
                dosis_select.options[1].disabled = 'disabled';
                dosis_select.options[1].style.background = '#C3DAE5';
            break;
        }

    }
    
    var html = '';
    for (var i = 0; i<vacunas_agg.length ; i++){
        if(i == vacunas_agg.length-1){
            html+='<div class="mt-3 d-flex flex-row justify-content-around"><div>'+vacunas_agg[i]['dosis']+'</div><div>'+vacunas_agg[i]['fecha']+'</div><div><i onclick="remove_vacuna()" class="iconDelete fa fa-times-circle" style="font-size:22px"></i></div></div>';
        }
        else{
            html+='<div class="mt-3 d-flex flex-row justify-content-around"><div>'+vacunas_agg[i]['dosis']+'</div><div>'+vacunas_agg[i]['fecha']+'</div><div></div></div><hr>';   
        }
    }

    div_vacunas.innerHTML=html;

}

btn_registrar.onclick = function (){

}

function remove_vacuna(){
     vacunas_agg.pop();
     add_vacuna(0,true);
}
//  $(document).ready(function() {



//      $('#agregar').click(function() {
         
//      });
//      $(document).on('click', '.eliminar', function() {
//          var boton = $(this).attr("id");
//          $('#row' + boton + '').remove();
//          i == 1 ? i = 1 : i--;
//          document.getElementById("texto").innerHTML = "";
//          console.log(i);
//      });
//      $(document).on('click', '#enviar', function() {
//          if (document.getElementById("cedula_persona").value != "") {
//              var todos_inputs = $('#tabla :input');
//              var dosis = [];
//              var fecha = [];
//              var validado = true;
//              for (var i = 0; i < todos_inputs.length; i++) {
//                  if (todos_inputs[i].type == 'text') {
//                      dosis.push(todos_inputs[i].value);
//                  }
//              }
//              for (var i = 0; i < todos_inputs.length; i++) {
//                  if (todos_inputs[i].type == 'date') {
//                      if (todos_inputs[i].value == "") {
//                          validado = false;
//                      } else {
//                          fecha.push(todos_inputs[i].value);
//                      }
//                  }
//              }
//              if (validado == false) {
//                  swal({
//                      type: "error",
//                      title: "Error",
//                      text: "Debe agregar las fechas de vacunación",
//                      timer: 2000,
//                      showConfirmButton: false
//                  });
//              } else {
//                  // $.ajax({
//                  //     type: "POST",
//                  //     url: BASE_URL + "Personas/consulta_vacunado",
//                  //     data: {
//                  //         "cedula": document.getElementById("cedula_persona").value
//                  //     }
//                  // }).done(function(result) {
//                  //     console.log(result);
//                  //     if (result) {
//                  //         swal({
//                  //             type: "success",
//                  //             title: "Éxito",
//                  //             text: "Se han registrado los vacunados exitosamente",
//                  //             timer: 2000,
//                  //             showConfirmButton: false
//                  //         });
//                  //         setTimeout(function() {
//                  //             document.getElementById("formulario").submit();
//                  //         }, 1000);
//                  //     } else {
//                  //         swal({
//                  //             type: "error",
//                  //             title: "Error",
//                  //             text: "Esta persona ya se encuentra registrada como vacunado",
//                  //             timer: 2000,
//                  //             showConfirmButton: false
//                  //         });
//                  //     }
//                  // });
//                  $.ajax({
//                      type: "POST",
//                      url: BASE_URL + "app/Direcciones.php",
//                      data: {
//                          direction: "Vacunados/Administrar",
//                          accion: "codificar"
//                      },
//                      success: function(direccion_segura) {
//                          var datos = {
//                              cedula_persona: document.getElementById("cedula_persona").value,
//                              dosis: dosis,
//                              fecha_vacuna: fecha,
//                              estado: 1
//                          };
//                          $.ajax({
//                              type: "POST",
//                              url: BASE_URL + direccion_segura,
//                              data: {
//                                  peticion: "Existe",
//                                  "cedula": document.getElementById("cedula_persona").value
//                              }
//                          }).done(function(result) {
//                              if (result) {
//                                  $.ajax({
//                                      type: 'POST',
//                                      url: BASE_URL + direccion_segura,
//                                      data: {
//                                          datos: datos,
//                                          peticion: "Registrar",
//                                          sql: "SQL_02",
//                                          accion: "Se ha registrado un nuevo vacunado: " + document.getElementById("cedula_persona").value,
//                                      },
//                                      success: function(respuesta) {
//                                          if (respuesta == 1) {
//                                              swal({
//                                                  type: "success",
//                                                  title: "Éxito",
//                                                  text: "Se han registrado los vacunados exitosamente",
//                                                  timer: 2000,
//                                                  showConfirmButton: false
//                                              });
//                                              Direccionar('Vacunados/Administrar/Consultas');
//                                          } else {
//                                              swal({
//                                                  title: "ERROR!",
//                                                  text: respuesta,
//                                                  type: "error",
//                                                  html: true,
//                                                  showConfirmButton: true,
//                                                  customClass: "bigSwalV2",
//                                              });
//                                          }
//                                      },
//                                      error: function(respuesta) {
//                                          alert("Error al enviar Controlador")
//                                      }
//                                  });
//                              } else {
//                                  swal({
//                                      type: "error",
//                                      title: "Error",
//                                      text: "Esta persona ya se encuentra registrada como vacunado",
//                                      timer: 2000,
//                                      showConfirmButton: false
//                                  });
//                              }
//                          });
//                      },
//                      error: function() {
//                          alert('Error al codificar dirreccion');
//                      }
//                  });
//              }
//          } else {
//              swal({
//                  type: "error",
//                  title: "Error",
//                  text: "Debe seleccionar una persona",
//                  timer: 2000,
//                  showConfirmButton: false
//              });
//          }
//      });
//  });
 
//  // $(document).ready(function() {
//  //     var i = 1;
//  //     $('#agregar').click(function() {
//  //         var html1 = '<tr id="row' + i + '" >' + '<td class="col-6">' + '<div class="input-group"><select class="custom-select" id="dosis" name="dosis[]"><option selected value="Primera Dosis">Primera Dosis</option><option value="Segunda Dosis">Segunda Dosis</option><option value="Tercera Dosis">Tercera Dosis</option></select></div>' + '</td>' + '<td class="col-6">' + '<div class="input-group"><input class="form-control no-simbolos" id="fecha" name="fecha[]" type="date"></div>' + '</td>' + '<td>' + '<button type="button" name="eliminar" id="' + i + '" class="btn btn-danger eliminar">X</button>' + '</td>' + '</tr>';
//  //         var html2 = '<tr id="row' + i + '" >' + '<td class="col-6">' + '<div class="input-group"><select class="custom-select" id="dosis" name="dosis[]"><option value="Primera Dosis">Primera Dosis</option><option selected value="Segunda Dosis">Segunda Dosis</option><option value="Tercera Dosis">Tercera Dosis</option></select></div>' + '</td>' + '<td class="col-6">' + '<div class="input-group"><input class="form-control no-simbolos" id="fecha" name="fecha[]" type="date"></div>' + '</td>' + '<td>' + '<button type="button" name="eliminar" id="' + i + '" class="btn btn-danger eliminar">X</button>' + '</td>' + '</tr>';
//  //         var html3 = '<tr id="row' + i + '" >' + '<td class="col-6">' + '<div class="input-group"><select class="custom-select" id="dosis" name="dosis[]"><option value="Primera Dosis">Primera Dosis</option><option value="Segunda Dosis">Segunda Dosis</option><option selected value="Tercera Dosis">Tercera Dosis</option></select></div>' + '</td>' + '<td class="col-6">' + '<div class="input-group"><input class="form-control no-simbolos" id="fecha" name="fecha[]" type="date"></div>' + '</td>' + '<td>' + '<button type="button" name="eliminar" id="' + i + '" class="btn btn-danger eliminar">X</button>' + '</td>' + '</tr>';
//  //         if (i <= 1) {
//  //             $('#tabla').append(html2);
//  //         } else {
//  //             if (i <= 2) {
//  //                 $('#tabla').append(html3);
//  //             } else {
//  //                 if (i <= 3) {
//  //                     document.getElementById("texto").innerHTML = "No puede agregar mas";
//  //                 } else {}
//  //             }
//  //         }
//  //         i == 3 ? i = 3 : i++;
//  //         console.log(i);
//  //     });
//  //     $(document).on('click', '.eliminar', function() {
//  //         var boton = $(this).attr("id");
//  //         $('#row' + boton + '').remove();
//  //         i == 1 ? i = 1 : i--;
//  //         document.getElementById("texto").innerHTML = "";
//  //         console.log(i);
//  //     });
//  //     $(document).on('click', '#enviar', function() {
//  //         if (document.getElementById("cedula_persona").value != "") {
//  //             var todos_inputs = $('#tabla :input');
//  //             var dosis = [];
//  //             var fecha = [];
//  //             var validado = true;
//  //             for (var i = 0; i < todos_inputs.length; i++) {
//  //                 if (todos_inputs[i].type == 'text') {
//  //                     dosis.push(todos_inputs[i].value);
//  //                 }
//  //             }
//  //             for (var i = 0; i < todos_inputs.length; i++) {
//  //                 if (todos_inputs[i].type == 'date') {
//  //                     if (todos_inputs[i].value == "") {
//  //                         validado = false;
//  //                     } else {
//  //                         fecha.push(todos_inputs[i].value);
//  //                     }
//  //                 }
//  //             }
//  //             if (validado == false) {
//  //                 swal({
//  //                     type: "error",
//  //                     title: "Error",
//  //                     text: "Debe agregar las fechas de vacunación",
//  //                     timer: 2000,
//  //                     showConfirmButton: false
//  //                 });
//  //             } else {
//  //                 $.ajax({
//  //                     type: "POST",
//  //                     url: BASE_URL + "app/Direcciones.php",
//  //                     data: {
//  //                         direction: "Vacunados/Administrar",
//  //                         accion: "codificar"
//  //                     },
//  //                     success: function(direccion_segura) {
//  //                        var datos = {
//  //                        cedula_persona: document.getElementById("cedula_persona").value,
//  //                    dosis: dosis,
//  //                    fecha_vacuna: fecha,
//  //                    estado: 1
//  //                    };
//  //                         $.ajax({
//  //                             type: "POST",
//  //                             url: BASE_URL + direccion_segura,
//  //                             data: {
//  //                                peticion: "Existe",
//  //                                 "cedula": document.getElementById("cedula_persona").value
//  //                             }
//  //                         }).done(function(result) {
//  //                             if (result) {
//  //                                $.ajax({
//  //                        type: 'POST',
//  //                        url: BASE_URL + direccion_segura,
//  //                        data: {
//  //                            datos: datos,
//  //                            peticion: "Registrar",
//  //                            sql: "SQL_02",
//  //                            accion: "Se ha registrado un nuevo vacunado: " + document.getElementById("cedula_persona").value,
//  //                        },
//  //                        success: function(respuesta) {
//  //                            if (respuesta == 1) {
//  //                                 swal({
//  //                                     type: "success",
//  //                                     title: "Éxito",
//  //                                     text: "Se han registrado los vacunados exitosamente",
//  //                                     timer: 2000,
//  //                                     showConfirmButton: false
//  //                                 });
//  //                                Direccionar('Vacunados/Administrar/Consultas');
//  //                            } else {
//  //                                swal({
//  //                                    title: "ERROR!",
//  //                                    text: respuesta,
//  //                                    type: "error",
//  //                                    html: true,
//  //                                    showConfirmButton: true,
//  //                                    customClass: "bigSwalV2",
//  //                                });
//  //                            }
//  //                        },
//  //                        error: function(respuesta) {
//  //                            alert("Error al enviar Controlador")
//  //                        }
//  //                    });
//  //                             } else {
//  //                                 swal({
//  //                                     type: "error",
//  //                                     title: "Error",
//  //                                     text: "Esta persona ya se encuentra registrada como vacunado",
//  //                                     timer: 2000,
//  //                                     showConfirmButton: false
//  //                                 });
//  //                             }
//  //                         });
//  //                     },
//  //                     error: function() {
//  //                         alert('Error al codificar dirreccion');
//  //                     }
//  //                 });
//  //             }
//  //         } else {
//  //             swal({
//  //                 type: "error",
//  //                 title: "Error",
//  //                 text: "Debe seleccionar una persona",
//  //                 timer: 2000,
//  //                 showConfirmButton: false
//  //             });
//  //         }
//  //     });
//  // });