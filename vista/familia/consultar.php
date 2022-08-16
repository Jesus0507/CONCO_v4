<?php include (call."Inicio.php"); ?>
<?php include (call."data-table.php"); ?>

<!-- Contenido de la pagina -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Consulta de Familias </h1>
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
                <h3 class="card-title">Consulta y Exportacion de Datos de Usuarios</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered  table-hover">
                    <thead>
                        <tr>
                            <th>Familia</th>
                            <th>Teléfono</th>
                            <th>Dirección</th>
                            <th>Nro Casa</th>
                            <th>Ingreso mensual aprox</th>
                            <th style="width: 20px;">Ver</th> 
                            <?php if($_SESSION['Nucleo familiar']['modificar']){ ?>
                                <th style="width: 20px;">Editar</th>
                            <?php } ?>
                            <?php if($_SESSION['Nucleo familiar']['eliminar']){ ?>
                                <th style="width: 20px;">Eliminar</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <script>

                            $(function() {
                                $.ajax({
                                    type: 'POST',
                                    url: BASE_URL + 'Familias/consultar_info_familia'
                                }).done(function(datos) {
                                    var data = JSON.parse(datos);

                                    $("#example1").DataTable({
                                        "data": data,
                                        "columns": [{
                                            "data": "familia"
                                        },
                                        {
                                            "data": "telefono"
                                        },
                                        {
                                            "data": "direccion"
                                        },
                                        {
                                            "data":"Nro Casa"
                                        },
                                        {
                                            "data":"ingreso_mensual"
                                        },
                                        {
                                            "data": "ver"
                                        },
                                        <?php if($_SESSION['Nucleo familiar']['modificar']){ ?>
                                            {
                                                "data": "editar"
                                            },
                                        <?php } ?>
                                        <?php if($_SESSION['Nucleo familiar']['eliminar']){ ?>  
                                            {
                                                "data": "eliminar"
                                            }
                                        <?php } ?>
                                        ],
                                        "responsive": true,
                                        "autoWidth": false,
                                        "ordering": true,
                                        "info": true,
                                        "processing": true,
                                        "pageLength": 10,
                                        "lengthMenu": [5, 10, 20, 30, 40, 50, 100]
                                    }).buttons().container().appendTo(
                                    '#example1_wrapper .col-md-6:eq(0)');

                                    
                                }).fail(function() {
                                    alert("error")
                                })

                                $(document).on('click', '#enviar', function() {
                                    var vivienda=document.getElementById("vivienda_familia");
                                    var nombre_familia=document.getElementById("nombre_familia");
                                    var telefono_familia=document.getElementById('telefono_familia');
                                    var ingreso_aprox = document.getElementById("ingreso_aprox");
                                    var observaciones=document.getElementById("observaciones_familia");
                                    var condicion_ocupacion_select=document.getElementById("select-cond-ocupacion");
var condicion_ocupacion_input=document.getElementById("input_condicion_ocupacion");
                                    var datos_familia=new Object();
                                    datos_familia['id_vivienda']=parseInt(vivienda.value);
                                    datos_familia['nombre_familia']=nombre_familia.value;
                                    datos_familia['telefono_familia']=telefono_familia.value;
                                    datos_familia['ingreso_mensual_aprox']=ingreso_aprox.value;
                                    condicion_ocupacion_select.style.display!='none'?datos_familia['condicion_ocupacion']=condicion_ocupacion_select.value:datos_familia['condicion_ocupacion']=condicion_ocupacion_input.value
                                    observaciones.value==''?datos_familia['observacion']="Sin observaciones":datos_familia['observacion']=observaciones.value;

                                    datos_familia['integrantes']=integrantes;
                                    datos_familia['estado']=1;   
                                    datos_familia['id_familia']=$('#id_familia').val()


                                    $.ajax({
                                     type:"POST",
                                     url:BASE_URL+"Familias/actualizar_familia",
                                     data:{"datos":datos_familia}
                                 }).done(function(result){
                                   console.log(result);

                                   swal({
                                    title:"Éxito",
                                    text:"Familia Actualizada satisfactoriamente",
                                    timer:2000,
                                    showConfirmButton:false,
                                    type:"success"
                                });

                                   // setTimeout(function(){location.href=BASE_URL+"Familias/Consultas";},1000);


                               });
                             });

                                $(document).on('click', '#btn_agregar', function() {

                                    if(integrantes_input.value==""){
                                        integrantes_input.focus();
                                        valid_integrantes.innerHTML='Debe ingresar la cédula o el nombre de una persona';
                                    }
                                    else{
                                        valid_integrantes.innerHTML="";

                                        if(valid_integrantes_agregados()){
                                           valid_integrantes.innerHTML="";
                                           $.ajax({
                                            type: 'POST',
                                            url: BASE_URL + 'Personas/Consultas_cedula',
                                            data:{'cedula':integrantes_input.value}
                                        })
                                           .done(function (datos) {


                                            if(datos!=0){

                                                var result=JSON.parse(datos);
                                                integrantes.push(result[0]['cedula_persona']);
                                                integrantes_input.value='';
                                                var div=document.createElement("div");
                                                div.style.width='100%';
                                                var tabla=document.createElement("table");
                                                tabla.style.width='100%';
                                                var tr=document.createElement("tr");
                                                var td1=document.createElement("td");
                                                var td2=document.createElement("td");
                                                td1.innerHTML="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-"+result[0]['primer_nombre']+" "+result[0]['primer_apellido'];
                                                var btn=document.createElement("input");
                                                btn.type="button";
                                                btn.className="btn btn-danger";
                                                btn.value="X";
                                                td2.style.textAlign="right";
                                                td2.appendChild(btn);
                                                tr.appendChild(td1);
                                                tr.appendChild(td2);
                                                tabla.appendChild(tr);
                                                div.appendChild(tabla);
                                                var hr=document.createElement("hr");
                                                div.appendChild(tabla);
                                                div.appendChild(hr);
                                                div_integrantes.appendChild(div);
                                                btn.onclick=function(){
                                                 div_integrantes.removeChild(div);
                                                 integrantes.splice(integrantes.indexOf(result[0]['cedula_persona']),1);
                                                 console.log(integrantes);
                                             }
                                             console.log(integrantes);
                                         }
                                         else{
                                            valid_integrantes.innerHTML="Esta persona no está registrada";
                                        }

                                    });

                                       }
                                   }
                               });

                            });
                        </script>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Familia</th>
                            <th>Teléfono</th>
                            <th>Dirección</th>
                            <th>Nro Casa</th>
                            <th>Ingreso mensual aprox</th>
                            <th>Ver</th> 
                            <?php if($_SESSION['Nucleo familiar']['modificar']){ ?>
                                <th>Editar</th>
                            <?php } ?>
                            <?php if($_SESSION['Nucleo familiar']['eliminar']){ ?>
                                <th>Eliminar</th>
                            <?php } ?>
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
<?php include modal."editar-familia.php"; ?> 
<!-- /.content-wrapper -->
<?php include (call."Fin.php"); ?>
<?php include (call."style-agenda.php"); ?>
<script type="text/javascript" src="<?php echo constant('URL')?>config/js/news/consultar-familias.js"></script>

<script type="text/javascript">
    function editar(id_familia,id_familia_persona){
document.getElementById("id_familia").value =id_familia;
     $.ajax({
         type:"POST",
         url:BASE_URL+"Familias/consultar_familia_datos",
         data:{'id_familia':id_familia}
     }).done(function(datos){
         var data = JSON.parse(datos);
         var familia = document.getElementById('integrantes_agregados');

         if (data.length == 0) {
            familia.innerHTML = "No aplica";
        } else {
            familia.innerHTML = "";
            for (var i = 0; i < data.length; i++) {
                document.getElementById("vivienda_familia").value =data[i]['id_vivienda'];
                document.getElementById("select-cond-ocupacion").value =data[i]['condicion_ocupacion'];
                document.getElementById("nombre_familia").value =data[i]['familia'];
                document.getElementById("telefono_familia").value =data[i]['telefono'];
                document.getElementById("observaciones_familia").value =data[i]['observacion'];
                document.getElementById("ingreso_aprox").value =data[i]['ingreso_mensual'];

                var inte = JSON.parse(data[i]['integrantes']);

                for (var j = 0; j < inte.length; j++) {
                    var tabl=
                    familia.innerHTML += " <table style='width:95%'><tr><hr><td>-" + inte[j]["primer_nombre"]+" " +inte[j]["primer_nombre"]+ "</td><td style='text-align:right'><span onclick='borrar_familia("+data[i]['id_familia']+","+inte[j]['cedula_persona']+")' class='iconDelete fa fa-times-circle' title='Eliminar Familia' style='font-size:22px'></span></td></tr></table><br><hr>";
                }
                console.log(data)
            }
        }

    });
 }

 function borrar_familia(id,cedula_param){
    swal({
      type:"warning",
      title:"¿Está seguro?",
      text:"Está por eliminar este integrantes , ¿desea continuar?",
      showCancelButton:true,
      confirmButtonText:"Si, continuar",
      cancelButtonText:"No"
  },function(isConfirm){
      if(isConfirm){
        $.ajax({
          type:"POST",
          url:BASE_URL+"Familias/eliminar_integrantes",
          data:{"id_familia_persona":id,"cedula_persona":cedula_param}
      }).done(function(result){
          result=JSON.parse(result);
          actualizar_integrantes(result,cedula_param);
          editar(id);
          
      })
  }
});
}

function actualizar_integrantes(result,cedula_param){

  var enfermedades = document.getElementById('integrantes_agregados'); 
  if(result!=0){
    enfermedades.innerHTML = "";
    for (var i = 0; i < result.length; i++) {
      enfermedades.innerHTML += " <table style='width:95%'><tr><td>- " + result[i]["cedula_persona"] + "</td><td style='text-align:right'><span onclick='borrar_familia("+result[i]['id_familia_persona']+","+result[i]['cedula_persona']+")' class='iconDelete fa fa-times-circle' title='Eliminar' style='font-size:22px'></span></td></tr></table><br><hr>";
  }
}

}
var integrantes_input=document.getElementById("integrante_input");
var integrantes=[];
var valid_integrantes=document.getElementById("valid_5");
var div_integrantes=document.getElementById("integrantes_agregados");

function valid_integrantes_agregados(){
    var validar=true;
    for(var i=0;i<integrantes.length;i++){
        if(integrantes[i]==integrantes_input.value){
            validar=false;
        }
    }

    if(!validar){
        valid_integrantes.innerHTML='Ya esta persona fue agregada';
    }

    return validar;
}
</script>
