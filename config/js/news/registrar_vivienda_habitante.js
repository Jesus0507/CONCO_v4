   $(document).ready(function() {
    var i=1;

    $("#gas").on("change", function() {

        var value = $("#gas").val();
        if (value == "1") {
            $("#tabla_gas").modal('show');
        }

    });


    $('#agregar').click(function(){
        i++;
        var html = 
        '<tr id="row'+i+'" >'
        +'<td class="col-6">'
        +'<input list="techo"  type="text" name="tipo_techo[]" placeholder="Tipo Techo" class="form-control" /><datalist id="techo"><?php foreach($this->tipo_techo as $techo){   ?><option value="<?php echo $techo["techo"];?>"></option><?php  }   ?></datalist>'
        +'</td>'
        +'<td>' 
        +'<button type="button" name="eliminar" id="'+i+'" class="btn btn-danger eliminar">X</button>'
        +'</td>'
        +'</tr>';


        $('#tabla_techo').append(html);

    });

    $('#agregar2').click(function(){
        i++;

        var html2 = 
        '<tr id="row'+i+'" >'
        +'<td class="col-6">'
        +'<input list="pared"  type="text" name="tipo_pared[]" placeholder="Tipo Pared" class="form-control " /><datalist id="pared"><?php foreach($this->tipo_pared as $pared){   ?><option value="<?php echo $pared["pared"];?>"></option><?php  }   ?></datalist>'
        +'</td>'
        +'<td>' 
        +'<button type="button" name="eliminar" id="'+i+'" class="btn btn-danger eliminar">X</button>'
        +'</td>'
        +'</tr>'; 

        $('#tabla_pared').append(html2);
    });

    $('#agregar3').click(function(){
        i++;

        var html3 = 
        '<tr id="row'+i+'" >'
        +'<td class="col-6">'
        +'<input list="piso"  type="text" name="tipo_piso[]" placeholder="Tipo piso" class="form-control " /><datalist id="piso"><?php foreach($this->tipo_piso as $piso){   ?><option value="<?php echo $piso["piso"];?>"></option><?php  }   ?></datalist>'
        +'</td>'
        +'<td>' 
        +'<button type="button" name="eliminar" id="'+i+'" class="btn btn-danger eliminar">X</button>'
        +'</td>'
        +'</tr>'; 

        $('#tabla_piso').append(html3);
    });

    $(document).on('click', '.eliminar', function(){
        var boton = $(this).attr("id"); 
        $('#row'+boton+'').remove();
    });


    $(document).on('click', '#guardar', function(){
        var datos = {
            id_calle:  $("#id_calle").val(),
            id_tipo_vivienda:  $("#id_tipo_vivienda").val(),
            //    id_condicion_ocupacion:  $("#id_condicion_ocupacion").val(),
            direccion_vivienda:  $("#direccion_vivienda").val(),
            numero_casa:  $("#numero_casa").val(),
            cantidad_habitaciones:  $("#cantidad_habitaciones").val(),
            espacio_siembra:  $("#espacio_siembra").val(),
            hacinamiento:  $("#hacinamiento").val(),
            banio_sanitario:  $("#banio_sanitario").val(),
            condicion:  $("#condicion").val(),
            descripcion:  $("#descripcion").val(),
            animales_domesticos:  $("#animales_domesticos").val(),
            insectos_roedores:  $("#insectos_roedores").val(),
            agua_consumo:  $("#agua_consumo").val(),
            agua_consumo:  $("#agua_consumo").val(),
            residuos_solidos: $("#residuos_solidos").val(),
            aguas_negras: $("#aguas_negras").val(),
            cable_telefonico: $("#cable_telefonico").val(),
            internet: $("#internet").val(),
            servicio_electrico: $("#servicio_electrico").val()
        };

        var todos_inputs_techo=$('#tabla_techo :input');
        var todos_inputs_pared=$('#tabla_pared :input');
        var todos_inputs_piso=$('#tabla_piso :input');

        var tipo_techo=[];
        var tipo_pared=[];
        var tipo_piso=[];

        for(var i=0;i<todos_inputs_techo.length;i++){
          if(todos_inputs_techo[i].type=='text'){
            tipo_techo.push(todos_inputs_techo[i].value);
        }
    }

    for(var i=0;i<todos_inputs_pared.length;i++){
      if(todos_inputs_pared[i].type=='text'){
        tipo_pared.push(todos_inputs_pared[i].value);
    }
}

for(var i=0;i<todos_inputs_piso.length;i++){
  if(todos_inputs_piso[i].type=='text'){
    tipo_piso.push(todos_inputs_piso[i].value);
}
}

if(validar_vivienda()){

    $.ajax({
        type: 'POST',
        url: BASE_URL + 'Viviendas/Asignar_Servicios',
        data: {
            'datos': datos
        }
    }).done(function(id) {
        console.log(id);
        var id_servicio = id;

        $.ajax({
            type: 'POST',
            url: BASE_URL + 'Viviendas/Nueva_Vivienda_Habitante',
            data: {
                'datos': datos,
                'id_servicio': id_servicio
            }
        }).done(function(datos) {
            console.log(datos);
            $.ajax({
                type: 'POST',
                url: BASE_URL + 'Viviendas/Techo_Pared_Piso',
                data: {
                    'tipo_techo': tipo_techo,
                    'tipo_pared': tipo_pared,
                    'tipo_piso': tipo_piso,            
                }
            }).done(function(datos) {
                console.log(datos);

                $.ajax({
                    type: 'POST',
                    url: BASE_URL + 'Viviendas/Electrodomesticos_Gases',
                    data: {
                        'electrodomesticos': electrodomesticos_agregados,
                        'gases': gases_agregados,         
                    }
                }).done(function(datos) {
                    console.log(datos);


                    var datos_persona=new Object();
                    datos_persona['cedula_persona']=document.getElementById("user_cedula").value;
                    datos_persona['tipo_constancia']='Vivienda';
                    datos_persona['motivo_constancia']="Registro vivienda";

                    console.log(datos_persona);
                    $.ajax({
                        type:"POST",
                        url:BASE_URL+"Solicitudes/Nueva_solicitud_vivienda",
                        data:{"datos":datos_persona}

                    }).done(function(result){
                        console.log(result);
                        if(result==1){
                            swal({
                                title:"Éxito",
                                type:"success",
                                text:"Su solicitud de registro de vivienda fue enviado con éxito",
                                showConfirmButton:false,
                                timer:2000,
                            });

                            setTimeout(function(){ location.reload();},1000);

                        }
                    });



                }).fail(function() {
                    alert("error")
                })


            }).fail(function() {
                alert("error")
            })

        }).fail(function() {
            alert("error")
        })

    }).fail(function() {
        alert("error")
    })
}

});





   var gases_agregados=[];

   document.getElementById("agregar_servicio").onclick=function(){
     if(document.getElementById("gas_input").style.display=='none'){
        document.getElementById("gas_input").style.display="";
        document.getElementById("gas_select").style.display='none';
        document.getElementById("agregar_servicio").innerHTML='Atrás';
        document.getElementById("gas_input").focus();
        document.getElementById("gas_select").value='vacio';

    }
    else{
        document.getElementById("gas_input").style.display="none";
        document.getElementById("gas_select").style.display='';
        document.getElementById("agregar_servicio").innerHTML='Nuevo';
        document.getElementById("gas_input").value='';
    }
}


document.getElementById("agregar_gas").onclick=function(){

    var validacion=valid_gases_agregados();

    if(validacion['continuar']){
       document.getElementById("gas_input").value='';
       document.getElementById("gas_select").value='vacio';
       document.getElementById("tipo_bombona").value='vacio';
       document.getElementById("tiempo_duracion").value='vacio';

       gases_agregados.push(validacion['gas']);
       console.log(gases_agregados);
       var div=document.createElement("div");
       var table=document.createElement("table");
       table.style.width="100%";
       var tr=document.createElement("tr");
       var td1=document.createElement("td");
       td1.style.width='25%';
       td1.style.textalign='center';
       var td2=document.createElement("td");
       td2.style.width='25%';
       td2.style.textalign='center';
       var td3=document.createElement("td");
       td3.style.width='25%';
       td3.style.textalign='center';
       var td4=document.createElement("td");

       td4.style.textAlign='right';

       td1.innerHTML=validacion['gas']['mostrar_gas'];
       td2.innerHTML=validacion['gas']['tipo_bombona'];
       td3.innerHTML=validacion['gas']['tiempo_duracion']+" días";

       var button=document.createElement("input");
       button.className='btn btn-danger';
       button.value='X';
       button.style.width='20%';
       td4.appendChild(button);

       tr.appendChild(td1);
       tr.appendChild(td2);
       tr.appendChild(td3);
       tr.appendChild(td4);

       table.appendChild(tr);
       var hr=document.createElement("hr");

       div.appendChild(table);
       div.appendChild(hr);

       document.getElementById("gases_agregados").appendChild(div);

       button.onclick=function(){
        document.getElementById("gases_agregados").removeChild(div);
        gases_agregados.splice(gases_agregados.indexOf(validacion['gas']),1);
        console.log(gases_agregados);
    }

}

}

function valid_gases_agregados(){
    var validar=new Object;
    validar['continuar']=false;
    if((document.getElementById("gas_input").style.display=='none' && document.getElementById("gas_select").value=="vacio") || (document.getElementById("gas_input").style.display!='none' && document.getElementById("gas_input").value=="") ){
        document.getElementById("valid_gases_agregados").innerHTML='Indique la compañía de gas';
        document.getElementById("gas_input").style.borderColor=document.getElementById("gas_select").style.borderColor="red";
    }
    else{
      document.getElementById("valid_gases_agregados").innerHTML='';  
      document.getElementById("gas_input").style.borderColor=document.getElementById("gas_select").style.borderColor="";

      if(document.getElementById("tipo_bombona").value=='vacio'){
        document.getElementById("valid_gases_agregados").innerHTML='Indique el tipo de bombona'; 
        document.getElementById("tipo_bombona").style.borderColor='red';
    }
    else{
        document.getElementById("valid_gases_agregados").innerHTML=''; 
        document.getElementById("tipo_bombona").style.borderColor='';

        if(document.getElementById("tiempo_duracion").value=='vacio'){
            document.getElementById("valid_gases_agregados").innerHTML='Ingrese el tiempo aproximado de duración'; 
            document.getElementById("tiempo_duracion").style.borderColor='red';
        }
        else{
            document.getElementById("valid_gases_agregados").innerHTML=''; 
            document.getElementById("tiempo_duracion").style.borderColor='';
            
            var cont=0;
            var gas=new Object();
            if(document.getElementById("gas_input").style.display=='none'){
                gas['servicio_gas']=document.getElementById("gas_select").value;
                gas['mostrar_gas']=document.getElementById("gas_select").options[document.getElementById("gas_select").selectedIndex].text;
                gas['nuevo']='0';
            }
            else{
                gas['servicio_gas']=document.getElementById("gas_input").value;
                gas['mostrar_gas']=document.getElementById("gas_input").value;
                gas['nuevo']='1';
            }
            gas['tiempo_duracion']=document.getElementById("tiempo_duracion").value;
            gas['tipo_bombona']=document.getElementById("tipo_bombona").value;

            for(var i=0;i<gases_agregados.length;i++){
                console.log(JSON.stringify(gases_agregados[i])+" -- "+JSON.stringify(gas));
                if(JSON.stringify(gases_agregados[i])==JSON.stringify(gas)){
                    cont++;
                }
            }

            if(cont==0){
                validar['continuar']=true;
                validar['gas']=gas;
                document.getElementById("valid_gases_agregados").innerHTML=''; 
            }
            else{
                document.getElementById("valid_gases_agregados").innerHTML='Este servicio de gas ya fue agregado'; 
            }



        }
    }
}

return validar;
}



var electrodomesticos_agregados=[];

document.getElementById("nuevo_electrodomestico").onclick=function(){
 if(document.getElementById("electrodomestico_input").style.display=='none'){
    document.getElementById("electrodomestico_input").style.display="";
    document.getElementById("electrodomestico_select").style.display='none';
    document.getElementById("nuevo_electrodomestico").innerHTML='Atrás';
    document.getElementById("electrodomestico_input").focus();
    document.getElementById("electrodomestico_select").value='vacio';

}
else{
    document.getElementById("electrodomestico_input").style.display="none";
    document.getElementById("electrodomestico_select").style.display='';
    document.getElementById("nuevo_electrodomestico").innerHTML='Nuevo electrodoméstico';
    document.getElementById("electrodomestico_input").value='';
}
}


document.getElementById("agregar_electrodomestico").onclick=function(){

    var validacion=valid_electrodomesticos_agregados();

    if(validacion['continuar']){
        document.getElementById("electrodomestico_select").value='vacio';
        document.getElementById("electrodomestico_input").value='';
        document.getElementById("cantidad_electrodomestico").value='';

        electrodomesticos_agregados.push(validacion['valor_electrodomestico']);
        console.log(electrodomesticos_agregados);
        var div=document.createElement("div");
        var table=document.createElement("table");
        table.style.width="100%";
        var tr=document.createElement("tr");
        var td1=document.createElement("td");
        td1.style.width='35%';
        td1.style.textalign='center';
        var td2=document.createElement("td");
        td2.style.width='35%';
        td2.style.textalign='center';
        var td3=document.createElement("td");
        td3.style.width='30%';
        td3.style.textalign='right';

        td1.innerHTML=validacion['valor_electrodomestico']['mostrar_electrodomestico'];
        td2.innerHTML=validacion['valor_electrodomestico']['cantidad']+" Unidades";

        var button=document.createElement("input");
        button.className='btn btn-danger';
        button.value='X';
        button.style.width='20%';
        td3.appendChild(button);

        tr.appendChild(td1);
        tr.appendChild(td2);
        tr.appendChild(td3);

        table.appendChild(tr);
        var hr=document.createElement("hr");

        div.appendChild(table);
        div.appendChild(hr);

        document.getElementById("electrodomesticos_agregados").appendChild(div);

        button.onclick=function(){
            document.getElementById("electrodomesticos_agregados").removeChild(div);
            electrodomesticos_agregados.splice(electrodomesticos_agregados.indexOf(validacion['gas']),1);
            console.log(electrodomesticos_agregados);
        }

    }

}

function valid_electrodomesticos_agregados(){
    var validar=new Object;
    validar['continuar']=false;
    if((document.getElementById("electrodomestico_input").style.display=='none' && document.getElementById("electrodomestico_select").value=="vacio") || (document.getElementById("electrodomestico_input").style.display!='none' && document.getElementById("electrodomestico_input").value=="") ){
        document.getElementById("valid_electrodomesticos_agregados").innerHTML='Indique el electrodoméstico';
        document.getElementById("electrodomestico_input").style.borderColor=document.getElementById("electrodomestico_select").style.borderColor="red";
    }
    else{
      document.getElementById("valid_electrodomesticos_agregados").innerHTML='';  
      document.getElementById("electrodomestico_input").style.borderColor=document.getElementById("electrodomestico_select").style.borderColor="";

      if(document.getElementById("cantidad_electrodomestico").value==""){
       document.getElementById("valid_electrodomesticos_agregados").innerHTML='Indique la cantidad de unidades'; 
       document.getElementById("cantidad_electrodomestico").style.borderColor='red';
       document.getElementById("cantidad_electrodomestico").focus();
   }
   else{
     document.getElementById("valid_electrodomesticos_agregados").innerHTML=''; 
     document.getElementById("cantidad_electrodomestico").style.borderColor='';

     var cont=0;
     var electrodomestico=new Object();
     if(document.getElementById("electrodomestico_input").style.display=='none'){
        electrodomestico['electrodomestico']=document.getElementById("electrodomestico_select").value;
        electrodomestico['mostrar_electrodomestico']=document.getElementById("electrodomestico_select").options[document.getElementById("electrodomestico_select").selectedIndex].text;
        electrodomestico['nuevo']='0';
    }
    else{
        electrodomestico['electrodomestico']=document.getElementById("electrodomestico_input").value;
        electrodomestico['mostrar_electrodomestico']=document.getElementById("electrodomestico_input").value;
        electrodomestico['nuevo']='1';
    }
    electrodomestico['cantidad']=document.getElementById("cantidad_electrodomestico").value;

    for(var i=0;i<electrodomesticos_agregados.length;i++){
        console.log(JSON.stringify(electrodomesticos_agregados[i])+" -- "+JSON.stringify(electrodomestico));
        if(JSON.stringify(electrodomesticos_agregados[i])==JSON.stringify(electrodomestico)){
            cont++;
        }
    }

    if(cont==0){
        validar['continuar']=true;
        validar['valor_electrodomestico']=electrodomestico;
        document.getElementById("valid_electrodomesticos_agregados").innerHTML=''; 
    }
    else{
        document.getElementById("valid_electrodomesticos_agregados").innerHTML='Este servicio de gas ya fue agregado'; 
    }

}

}

return validar;
}


document.getElementById("id_calle").onchange=function(){
 if(document.getElementById("id_calle").value == "vacio"){
    document.getElementById("id_calle").style.borderColor='red';
    document.getElementById("id_calle").focus();
    document.getElementById("valid_calle").innerHTML='Ingrese la calle';
}
else{
   document.getElementById("id_calle").style.borderColor='';
   document.getElementById("valid_calle").innerHTML='';
}
}


document.getElementById("direccion_vivienda").onkeyup=function(){
   if(document.getElementById("direccion_vivienda").value=='' || document.getElementById("direccion_vivienda").value==null){
    document.getElementById("direccion_vivienda").style.borderColor='red';
    document.getElementById("direccion_vivienda").focus();
    document.getElementById("valid_direccion").innerHTML='Ingrese la dirección';
}
else{
   document.getElementById("direccion_vivienda").style.borderColor='';
   document.getElementById("valid_direccion").innerHTML='';
}
}

document.getElementById("numero_casa").onkeyup=function(){
    if(document.getElementById("numero_casa").value=='' || document.getElementById("numero_casa").value==null){
     document.getElementById("numero_casa").focus();
     document.getElementById("numero_casa").style.borderColor='red';
     document.getElementById("valid_numero_casa").innerHTML='Ingrese el nro de casa';
 } 
 else{
     document.getElementById("numero_casa").style.borderColor='';
     document.getElementById("valid_numero_casa").innerHTML='';
 }
}


document.getElementById("cantidad_habitaciones").onkeyup=function(){
 if(document.getElementById("cantidad_habitaciones").value=='' || document.getElementById("cantidad_habitaciones").value==null){
   document.getElementById("cantidad_habitaciones").style.borderColor='red';
   document.getElementById("cantidad_habitaciones").focus();
   document.getElementById("valid_cantidad_habitaciones").innerHTML='Ingrese la cantidad de habitaciones';   
}
else{
    document.getElementById("cantidad_habitaciones").style.borderColor='';

    document.getElementById("valid_cantidad_habitaciones").innerHTML='';  
}
}

document.getElementById("id_tipo_vivienda").onkeyup=function(){

   if(document.getElementById("id_tipo_vivienda").value==''|| document.getElementById("id_tipo_vivienda").value==null){
    document.getElementById("id_tipo_vivienda").style.borderColor='red';
    document.getElementById("id_tipo_vivienda").focus();
    document.getElementById("valid_tipo_vivienda").innerHTML='Ingrese el tipo de vivienda';
}        
else{
    document.getElementById("id_tipo_vivienda").style.borderColor='';
    document.getElementById("valid_tipo_vivienda").innerHTML='';
}
}

document.getElementById("condicion").onchange=function(){
    if(document.getElementById("condicion").value=='0'){
        document.getElementById("condicion").focus();
        document.getElementById("condicion").style.borderColor='red';
        document.getElementById("valid_condicion_vivienda").innerHTML='Ingrese la condición de la vivienda';
    }  
    else{
        document.getElementById("condicion").style.borderColor='';
        document.getElementById("valid_condicion_vivienda").innerHTML='';
    }  
}

document.getElementById("agua_consumo").onchange=function(){
  if(document.getElementById("agua_consumo").value=='vacio'){
      document.getElementById("agua_consumo").style.borderColor='red';
      document.getElementById("agua_consumo").focus();
      document.getElementById("valid_agua_consumo").innerHTML='Campo vacío';
  }
  else{
    document.getElementById("agua_consumo").style.borderColor='';
    document.getElementById("valid_agua_consumo").innerHTML='';
}
}


document.getElementById("aguas_negras").onchange=function(){
  if(document.getElementById("aguas_negras").value=='0'){
      document.getElementById("aguas_negras").style.borderColor='red';
      document.getElementById("aguas_negras").focus();
      document.getElementById("valid_aguas_negras").innerHTML='Campo vacío';
  }
  else{
    document.getElementById("aguas_negras").style.borderColor='';
    document.getElementById("valid_aguas_negras").innerHTML='';
}
}


function validar_vivienda(){
    var validar=false;

    if(document.getElementById("id_calle").value == "vacio"){
        document.getElementById("id_calle").style.borderColor='red';
        document.getElementById("id_calle").focus();
        document.getElementById("valid_calle").innerHTML='Ingrese la calle';
    }
    else{
       document.getElementById("id_calle").style.borderColor='';
       document.getElementById("valid_calle").innerHTML='';


       if(document.getElementById("direccion_vivienda").value=='' || document.getElementById("direccion_vivienda").value==null){
        document.getElementById("direccion_vivienda").style.borderColor='red';
        document.getElementById("direccion_vivienda").focus();
        document.getElementById("valid_direccion").innerHTML='Ingrese la dirección';
    }
    else{
       document.getElementById("direccion_vivienda").style.borderColor='';
       document.getElementById("valid_direccion").innerHTML='';


       if(document.getElementById("numero_casa").value=='' || document.getElementById("numero_casa").value==null){
         document.getElementById("numero_casa").focus();
         document.getElementById("numero_casa").style.borderColor='red';
         document.getElementById("valid_numero_casa").innerHTML='Ingrese el nro de casa';
     } 
     else{
         document.getElementById("numero_casa").style.borderColor='';
         document.getElementById("valid_numero_casa").innerHTML='';

         if(document.getElementById("cantidad_habitaciones").value=='' || document.getElementById("cantidad_habitaciones").value==null){
           document.getElementById("cantidad_habitaciones").style.borderColor='red';
           document.getElementById("cantidad_habitaciones").focus();
           document.getElementById("valid_cantidad_habitaciones").innerHTML='Ingrese la cantidad de habitaciones';   
       }
       else{
        document.getElementById("cantidad_habitaciones").style.borderColor='';

        document.getElementById("valid_cantidad_habitaciones").innerHTML='';  

        if(document.getElementById("id_tipo_vivienda").value==''|| document.getElementById("id_tipo_vivienda").value==null){
            document.getElementById("id_tipo_vivienda").style.borderColor='red';
            document.getElementById("id_tipo_vivienda").focus();
            document.getElementById("valid_tipo_vivienda").innerHTML='Ingrese el tipo de vivienda';
        }        
        else{
            document.getElementById("id_tipo_vivienda").style.borderColor='';
            document.getElementById("valid_tipo_vivienda").innerHTML='';

            if(document.getElementById("condicion").value=='0'){
                document.getElementById("condicion").focus();
                document.getElementById("condicion").style.borderColor='red';
                document.getElementById("valid_condicion_vivienda").innerHTML='Ingrese la condición de la vivienda';
            }  
            else{
                document.getElementById("condicion").style.borderColor='';
                document.getElementById("valid_condicion_vivienda").innerHTML='';


                if(document.getElementById("agua_consumo").value=='vacio'){
                  document.getElementById("agua_consumo").style.borderColor='red';
                  document.getElementById("agua_consumo").focus();
                  document.getElementById("valid_agua_consumo").innerHTML='Campo vacío';
              }
              else{
                document.getElementById("agua_consumo").style.borderColor='';
                document.getElementById("valid_agua_consumo").innerHTML='';

                if(document.getElementById("aguas_negras").value=='0'){
                  document.getElementById("aguas_negras").style.borderColor='red';
                  document.getElementById("aguas_negras").focus();
                  document.getElementById("valid_aguas_negras").innerHTML='Campo vacío';
              }
              else{
                document.getElementById("aguas_negras").style.borderColor='';
                document.getElementById("valid_aguas_negras").innerHTML='';

                if(document.getElementById("residuos_solidos").value=='0'){
                  document.getElementById("residuos_solidos").style.borderColor='red';
                  document.getElementById("residuos_solidos").focus();
                  document.getElementById("valid_residuos_solidos").innerHTML='Campo vacío';
              }
              else{
                document.getElementById("residuos_solidos").style.borderColor='';
                document.getElementById("valid_residuos_solidos").innerHTML='';

                var tipos_techo=$('#tabla_techo :input');
                var tipos_pared=$('#tabla_pared :input');
                var tipos_piso=$('#tabla_piso :input');


                var contTecho=0;
                var contPared=0;
                var contPiso=0;

                for(var i=0;i<tipos_techo.length;i++){
                    console.log("valor "+tipos_techo[i].value);
                    if(tipos_techo[i].value!=''){
                        contTecho++;
                    }
                }

                console.log("contTecho: "+contTecho);


                for(var i=0;i<tipos_pared.length;i++){
                    if(tipos_pared[i].value!=''){
                        contPared++;
                    }
                }


                for(var i=0;i<tipos_piso.length;i++){
                    if(tipos_piso[i].value!=''){
                        contPiso++;
                    }
                }

                
                if(contTecho==0){
                    swal({
                        type:"error",
                        title:"Error",
                        text:"Agregue al menos un tipo de techo",
                        showConfirmButton:false,
                        timer:2000
                    });
                }
                else{
                 if(contPared==0){
                    swal({
                        type:"error",
                        title:"Error",
                        text:"Agregue al menos un tipo de pared",
                        showConfirmButton:false,
                        timer:2000
                    });
                }
                else{
                 if(contPiso==0){
                    swal({
                        type:"error",
                        title:"Error",
                        text:"Agregue al menos un tipo de piso",
                        showConfirmButton:false,
                        timer:2000
                    });
                }
                else{

                   if(gases_agregados.length==0){
                    swal({
                        type:"error",
                        title:"Error",
                        text:"Agregue al menos un servicio de gas",
                        showConfirmButton:false,
                        timer:2000
                    });
                }
                else{

                 if(electrodomesticos_agregados.length==0){
                     swal({
                        type:"error",
                        title:"Error",
                        text:"Agregue al menos un electrodoméstico",
                        showConfirmButton:false,
                        timer:2000
                    });

                 }  


                 else{
                    validar=true;
                } } } } } } } } } } } } } } 


                return validar;

            }  






        });

