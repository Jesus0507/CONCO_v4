<?php include (call."Inicio.php"); ?>
<?php include (call."data-table.php"); ?>

<!-- Contenido de la pagina -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Consulta de Grupos deportivos </h1>
                </div><!-- /.col -->
                <!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Consulta y exportacion de datos de grupos deportivos</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered  table-hover">
                    <thead>
                        <tr>
                            <th>Nombre del grupo</th>
                            <th>Deporte</th>
                            <th>Descripción</th>
                             <th style="width: 20px;">Ver</th>
                            <?php if ($_SESSION['Grupos deportivos']['modificar']) {?>
                            <th>Editar</th>
                            <?php }?>
                            <?php if ($_SESSION['Grupos deportivos']['eliminar']) {?>
                            <th>Eliminar</th>
                            <?php }?>

                        </tr>
                    </thead>
                    <tbody>
                       
                    </tbody>
                    <tfoot>
                        <tr>

                            <th>Nombre del grupo</th>
                            <th>Deporte</th>
                            <th>Descripción</th>
                             <th style="width: 20px;">Ver</th>
                            <?php if ($_SESSION['Grupos deportivos']['modificar']) {?>
                            <th>Editar</th>
                            <?php }?>
                            <?php if ($_SESSION['Grupos deportivos']['eliminar']) {?>
                            <th>Eliminar</th>
                            <?php }?>

                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>

    <!-- /.content -->
    <!-- /.content -->
</div>
<?php include modal."ver-grupo_deportivo.php"; ?>
<?php include modal."editar-grupo_deportivo.php"; ?>
 <script type="text/javascript">
                             var integrantes_input = document.getElementById("integrantes_grupo_input");
 var integrantes = [];
 var valid_integrantes = document.getElementById("valid_5");
 var div_integrantes = document.getElementById("integrantes_agregados");
 var id_grupo_deportivo_global = "";
 $(function() {
     $.ajax({
         type: "POST",
         url: BASE_URL + "app/Direcciones.php",
         data: {
             direction: "Grupos_Deportivos/Administrar",
             accion: "codificar"
         },
         success: function(direccion_segura) {
             $.ajax({
                 type: "POST",
                 url: BASE_URL + direccion_segura,
                 data: {
                     peticion: "Consulta_Ajax",
                 },
             }).done(function(datos) {
                 var data = JSON.parse(datos);
                 var tabla = $("#example1").DataTable({
                     "data": data,
                     "columns": [{
                             "data": "nombre_grupo_deportivo"
                         }, {
                             "data": "nombre_deporte"
                         }, {
                             "data": "descripcion"
                         }, {
                             "data": function(data) {
                                 return '<td class="text-center">' + '<a href="javascript:void(0)" style="margin-right: 5px;background: #4dbdbd !important;" class="btn bg-info ver-popup" title="Ver" type="button" data-toggle="modal" data-target="#ver">' + '<i class="fa fa-eye"></i>' + '</a>' + '<p style="display: none;">' + data.id_grupo_deportivo + '</p>' + '</td>';
                             }
                         }, 
                          <?php if ($_SESSION['Grupos deportivos']['modificar']) {?>
                         {
                             "data": function(data) {
                                 return '<td class="text-center">' + '<a href="javascript:void(0)" style="margin-right: 5px;" class="btn bg-info btnEditar"  title="Actualizar" type="button" data-toggle="modal" data-target="#actualizar" onclick="editar(' + data.id_grupo_deportivo + ',' + data.cedula_persona + ')">' + '<i class="fa fa-edit" style="color: white;"></i>' + '</a>' + '</td>';
                             }
                         },
                         <?php }?>
<?php if ($_SESSION['Grupos deportivos']['eliminar']) {?>
                          {
                             "data": function(data) {
                                 return '<td class="text-center">' + '<a href="javascript:void(0)" style="margin-right: 5px;" class="btn bg-danger mensaje-eliminar" title="Eliminar">' + '<i class="fa fa-trash"></i>' + '</a>' + '</td>';
                             }
                         },
                         <?php }?>
                     ],
                     "responsive": true,
                     "autoWidth": false,
                     "ordering": true,
                     "info": true,
                     "processing": true,
                     "pageLength": 10,
                     "lengthMenu": [5, 10, 20, 30, 40, 50, 100]
                 }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                 $(document).on("click", ".mensaje-eliminar", function() {
                     fila = $(this).closest("tr");
                     id = fila.find('td:eq(3)').text();
                     var estado = {
                         tabla: "grupo_deportivo",
                         id_tabla: "id_grupo_deportivo",
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
                         closeOnCancel: false
                     }, function(isConfirm) {
                         if (isConfirm) {
                             $.ajax({
                                 url: BASE_URL + direccion_segura,
                                 type: "POST",
                                 data: {
                                     peticion: "Eliminar",
                                     estado: estado,
                                     sql: "ACT_DES",
                                     accion: "Se ha Eliminado el  Grupo Deportivo: " + fila.find("td:eq(0)").text(),
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
                             })
                         } else {
                             swal("Cancelado", "La accion fue cancelada, la informacion esta segura.", "error");
                         }
                     });
                 });
                 $(document).on('click', '.ver-popup', function() {
                     fila = $(this).closest("tr");
                     nombre_grupo = fila.find('td:eq(0)').text();
                     deporte = fila.find('td:eq(1)').text();
                     descripcion = fila.find('td:eq(2)').text();
                     id = fila.find('td:eq(3)').text();
                     $('#nombre_grupo').val(nombre_grupo);
                     $('#id_deporte').val(deporte);
                     $('#descripcion').val(descripcion);
                     $.ajax({
                         type: "POST",
                         url: BASE_URL + direccion_segura,
                         data: {
                             peticion: "Grupos_Deportivos_Personas",
                             "id": id
                         },
                     }).done(function(result) {
                         var result = JSON.parse(result);
                         td = "";
                         for (var i = 0; i < result.length; i++) {
                             td += "<tr><td>" + result[i]["cedula_persona"] + "</td><td>" + result[i]["primer_nombre"] + "</td><td>" + result[i]["primer_apellido"] + "</td></tr>";
                         }
                         $('#tabla').html(td);
                     });
                 });
                 integrantes_input.onkeyup = function() {
                     if (integrantes_input.value != "") {
                         valid_integrantes.innerHTML = "";
                     }
                 }
                 $(document).on('click', '#btn_agregar', function() {
                     if (integrantes_input.value == "") {
                         integrantes_input.focus();
                         valid_integrantes.innerHTML = 'Debe ingresar la cédula o el nombre de una persona';
                     } else {
                         valid_integrantes.innerHTML = "";
                         document.getElementById('integrantes_grupo_input').style.borderColor = '';
                         document.getElementById('span_integrantes').innerHTML = '';
                         var datos2 = {
                             cedula_persona: integrantes_input.value,
                             id_grupo_deportivo: id_grupo_deportivo_global,
                             estado: 1
                         };
                         $.ajax({
                             type: "POST",
                             url: BASE_URL + direccion_segura,
                             data: {
                                 datos: datos2,
                                 peticion: "Agregar",
                                 sql: "SQL_06",
                             },
                         }).done(function(datos) {
                             if (datos == 1) {
                                 actualizar_integrantes(id_grupo_deportivo_global);
                             } else {
                                 swal({
                                     type: "error",
                                     title: "Error",
                                     text: "Esta persona ya se encuentra registrada en el grupo deportivo",
                                     timer: 2000,
                                     showConfirmButton: false
                                 });
                             }
                             integrantes_input.value = "";
                         });
                     }
                 });
                 $(document).on('click', '.btnEditar', function() {
                     fila = $(this).closest("tr");
                     nombre_grupo = fila.find('td:eq(0)').text();
                     deporte = fila.find('td:eq(1)').text();
                     descripcion = fila.find('td:eq(2)').text();
                     id = fila.find('td:eq(3)').text();
                     $('#nombre_grupo2').val(nombre_grupo);
                     $('#id_deporte2').val(deporte);
                     $('#descripcion2').val(descripcion);
                     $(document).on("click", "#enviar", function() {
                         if (document.getElementById('id_deporte2').value == '' || document.getElementById('id_deporte2').value == null) {
                             document.getElementById('id_deporte2').style.borderColor = 'red';
                             document.getElementById('id_deporte2').focus();
                             document.getElementById('span_deporte').innerHTML = 'Ingrese el deporte';
                         } else {
                             document.getElementById('id_deporte2').style.borderColor = '';
                             document.getElementById('id_deporte2').blur();
                             document.getElementById('span_deporte').innerHTML = '';
                             if (document.getElementById('nombre_grupo2').value == '' || document.getElementById('nombre_grupo2').value == null) {
                                 document.getElementById('nombre_grupo2').style.borderColor = 'red';
                                 document.getElementById('nombre_grupo2').focus();
                                 document.getElementById('span_nombre').innerHTML = 'Ingrese el nombre del grupo';
                             } else {
                                 document.getElementById('nombre_grupo2').style.borderColor = '';
                                 document.getElementById('nombre_grupo2').blur();
                                 document.getElementById('span_nombre').innerHTML = '';
                                 if (document.getElementById('integrantes_agregados').innerHTML == '') {
                                     document.getElementById('integrantes_grupo_input').style.borderColor = 'red';
                                     document.getElementById('integrantes_grupo_input').focus();
                                     document.getElementById('span_integrantes').innerHTML = 'No hay integrantes agregados a este grupo';
                                 } else {
                                     document.getElementById('integrantes_grupo_input').style.borderColor = '';
                                     document.getElementById('integrantes_grupo_input').blur();
                                     document.getElementById('span_integrantes').innerHTML = '';
                                     var datos = {
                                         id_grupo_deportivo: id,
                                         id_deporte: document.getElementById("id_deporte2").value,
                                         nombre_grupo_deportivo: document.getElementById("nombre_grupo2").value,
                                         descripcion: document.getElementById("descripcion2").value,
                                         estado: 1
                                     };
                                     $.ajax({
                                         type: "POST",
                                         url: BASE_URL + direccion_segura,
                                         data: {
                                             datos: datos,
                                             integrantes: integrantes,
                                             peticion: "Administrar",
                                             sql: "SQL_02",
                                             accion: "Se ha Actualizado el  Grupo Deportivo: " + nombre_grupo,
                                         },
                                     }).done(function(datos) {
                                         if (datos == 1) {
                                             swal({
                                                 title: "Actualizado!",
                                                 text: "El elemento fue Actualizado con exito.",
                                                 type: "success",
                                                 showConfirmButton: false
                                             });
                                             setTimeout(function() {
                                                 location.reload();
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
                                     }).fail(function() {
                                         alert("error");
                                     });
                                 }
                             }
                         }
                     });
                 });
             }).fail(function() {
                 alert("error")
             })
         },
         error: function() {
             alert('Error al codificar dirreccion');
         }
     });
 });

 function editar(id_grupo_deportivo, cedula_persona) {
     id_grupo_deportivo_global = id_grupo_deportivo;
     $.ajax({
         type: "POST",
         url: BASE_URL + "app/Direcciones.php",
         data: {
             direction: "Grupos_Deportivos/Administrar",
             accion: "codificar"
         },
         success: function(direccion_segura) {
             $.ajax({
                 type: "POST",
                 url: BASE_URL + direccion_segura,
                 data: {
                     id_grupo_deportivo: id_grupo_deportivo,
                     cedula_persona: cedula_persona,
                     peticion: "Datos",
                     sql: "SQL_05",
                 },
             }).done(function(datos) {
                 var data = JSON.parse(datos);
                 var grupos = document.getElementById('integrantes_agregados');
                 if (data.length == 0) {
                     grupos.innerHTML = "No aplica";
                 } else {
                     grupos.innerHTML = "";
                     for (var i = 0; i < data.length; i++) {
                         var inte = JSON.parse(data[i]['integrantes']);
                         for (var j = 0; j < inte.length; j++) {
                             var tabl = grupos.innerHTML += " <table style='width:95%'><tr><hr><td>-" + inte[j]["primer_nombre"] + " " + inte[j]["primer_apellido"] + "</td><td style='text-align:right'><span onclick='borrar_integrante(" + data[i]['id_grupo_deportivo'] + "," + inte[j]['cedula_persona'] + ")' class='iconDelete fa fa-times-circle' title='Eliminar Familia' style='font-size:22px;cursor:pointer'></span></td></tr></table><br><hr>";
                         }
                     }
                 }
             });
         },
         error: function() {
             alert('Error al codificar dirreccion');
         }
     });
 }

 function borrar_integrante(id, cedula_param) {
     swal({
         type: "warning",
         title: "¿Está seguro?",
         text: "Está por eliminar este integrantes , ¿desea continuar?",
         showCancelButton: true,
         confirmButtonText: "Si, continuar",
         cancelButtonText: "No"
     }, function(isConfirm) {
         if (isConfirm) {
             $.ajax({
                 type: "POST",
                 url: BASE_URL + "app/Direcciones.php",
                 data: {
                     direction: "Grupos_Deportivos/Administrar",
                     accion: "codificar"
                 },
                 success: function(direccion_segura) {
                     $.ajax({
                         type: "POST",
                         url: BASE_URL + direccion_segura,
                         data: {
                             id_grupo_deportivo: id,
                             cedula_persona: cedula_param,
                             peticion: "Eliminar_Integrantes",
                         },
                     }).done(function(result) {
                         revisar(result)
                         result = JSON.parse(result);
                         actualizar_integrantes(id);
                         editar(id);
                     })
                 },
                 error: function() {
                     alert('Error al codificar dirreccion');
                 }
             });
         }
     });
 }

 function actualizar_integrantes(id) {
     $.ajax({
         type: "POST",
         url: BASE_URL + "app/Direcciones.php",
         data: {
             direction: "Grupos_Deportivos/Administrar",
             accion: "codificar"
         },
         success: function(direccion_segura) {
             $.ajax({
                 type: "POST",
                 url: BASE_URL + direccion_segura,
                 data: {
                     id: id,
                     peticion: "Obtener_Integrantes",
                 },
             }).done(function(result) {
                // revisar(result)
                 var integrantes = document.getElementById('integrantes_agregados');
                 integrantes.innerHTML = "";
                 result = JSON.parse(result);
                 for (var i = 0; i < result.length; i++) {
                     integrantes.innerHTML += "<table style='width:95%'><tr><hr><td>-" + result[i]["primer_nombre"] + " " + result[i]["primer_apellido"] + "</td><td style='text-align:right'><span onclick='borrar_integrante(" + id + "," + result[i]['cedula_persona'] + ")' class='iconDelete fa fa-times-circle' title='Eliminar Familia' style='font-size:22px;cursor:pointer'></span></td></tr></table><br><hr>";
                 }
             })
         },
         error: function() {
             alert('Error al codificar dirreccion');
         }
     });
 }

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
 document.getElementById('id_deporte2').onkeyup = function() {
     document.getElementById('id_deporte2').style.borderColor = '';
     document.getElementById('span_deporte').innerHTML = '';
 }
 document.getElementById('nombre_grupo2').onkeyup = function() {
     document.getElementById('nombre_grupo2').style.borderColor = '';
     document.getElementById('span_nombre').innerHTML = '';
 }
 document.getElementById('integrantes_grupo_input').onkeyup = function() {
     document.getElementById('integrantes_grupo_input').style.borderColor = '';
     document.getElementById('span_integrantes').innerHTML = '';
 }
                        </script>
<!-- /.content-wrapper -->
<?php include (call."Fin.php"); ?>