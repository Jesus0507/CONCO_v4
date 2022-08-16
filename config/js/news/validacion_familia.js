var integrantes=[];
var valid_vivienda=document.getElementById('valid_1');
var valid_nombre_familia=document.getElementById("valid_2");
var valid_telefono_familia=document.getElementById("valid_3");
var valid_ingreso_familia=document.getElementById("valid_4");
var valid_integrantes=document.getElementById("valid_5");
var vivienda=document.getElementById("vivienda_familia");
var btn_vivienda_nueva=document.getElementById("nueva_vivienda");
var nombre_familia=document.getElementById("nombre_familia");
var telefono_familia=document.getElementById('telefono_familia');
var ingreso_aprox = document.getElementById("ingreso_aprox");
var integrantes_input=document.getElementById("integrante_input");
var btn_nuevo_integrante=document.getElementById("btn_nuevo");
var btn_agregar_integrante=document.getElementById("btn_agregar");
var div_integrantes=document.getElementById("integrantes_agregados");
var observaciones=document.getElementById("observaciones_familia");
var btn_limpiar=document.getElementById("limpiar");
var btn_guardar=document.getElementById("guardar");
var condicion_ocupacion_select=document.getElementById("select-cond-ocupacion");
var condicion_ocupacion_input=document.getElementById("input_condicion_ocupacion");
var boton_otro_cond=document.getElementById("nueva_condicion_ocupacion");
var valid_cond_ocupacion=document.getElementById("valid_cond_ocupacion");

btn_vivienda_nueva.onclick=function(){
	window.open(BASE_URL+"Viviendas/Registros/");
}


btn_nuevo_integrante.onclick=function(){
	window.open(BASE_URL+"Personas/Registros/");
}


btn_guardar.onclick=function(){
	enviar_informacion();
}


boton_otro_cond.onclick=function(){
	if(condicion_ocupacion_input.style.display=='none'){
         condicion_ocupacion_input.style.display='';
         condicion_ocupacion_select.style.display='none';
         boton_otro_cond.innerHTML='Atrás';
         condicion_ocupacion_input.focus();
         condicion_ocupacion_select.value='0';

	}
	else{
    condicion_ocupacion_input.style.display='none';
         condicion_ocupacion_select.style.display='';
         boton_otro_cond.innerHTML='Otra';
         condicion_ocupacion_input.value='';
	}
}


    document.onkeypress=function(e){
 if(e.which == 13  || e.keyCode==13 ) {

      enviar_informacion();
          return false;
       
       }
       else{return true;}
}



function enviar_informacion(){

	if(validar_informacion()){
   
   var datos_familia=new Object();
   datos_familia['id_vivienda']=parseInt(vivienda.value);
   datos_familia['nombre_familia']=nombre_familia.value;
   datos_familia['telefono_familia']=telefono_familia.value;
   datos_familia['ingreso_mensual_aprox']=ingreso_aprox.value;
   condicion_ocupacion_select.style.display!='none'?datos_familia['condicion_ocupacion']=condicion_ocupacion_select.value:datos_familia['condicion_ocupacion']=condicion_ocupacion_input.value
   observaciones.value==''?datos_familia['observacion']="Sin observaciones":datos_familia['observacion']=observaciones.value;
   
   datos_familia['integrantes']=integrantes;
   datos_familia['estado']=1;   


	$.ajax({
         type:"POST",
         url:BASE_URL+"Familias/registrar_familia",
         data:{"datos":datos_familia}
	}).done(function(result){
           console.log(result);
            
            swal({
            	title:"Éxito",
            	text:"Familia registrada satisfactoriamente",
            	timer:2000,
            	showConfirmButton:false,
            	type:"success"
            });

            setTimeout(function(){location.href=BASE_URL+"Familias/Consultas";},1000);


	});
}
}



integrantes_input.onkeyup=function(){
	if(integrantes_input.value!=''){
		valid_integrantes.innerHTML='';
	}
}



btn_agregar.onclick=function(){
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
				td1.innerHTML=result[0]['primer_nombre']+" "+result[0]['primer_apellido'];
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
	}



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


vivienda.onchange=function(){
	if(vivienda.value!='vacio'){
		valid_vivienda.innerHTML='';
	}
	else{
		valid_vivienda.innerHTML="Debe seleccionar la vivienda de la familia";
	}
}

condicion_ocupacion_select.onchange=function(){
	if(condicion_ocupacion_select.value!=''){
		valid_cond_ocupacion.innerHTML='';
	}
	else{
		valid_cond_ocupacion.innerHTML="Campo vacío";
	}
}

condicion_ocupacion_input.onkeyup=function(){
	if(condicion_ocupacion_select.value!=''){
		valid_cond_ocupacion.innerHTML='';
	}
	else{
		valid_cond_ocupacion.innerHTML="Campo vacío";
	}
}


nombre_familia.onkeyup=function(){
	if(nombre_familia.value!=''){
		valid_nombre_familia.innerHTML='';
	}
	else{
		valid_nombre_familia.innerHTML="Debe ingresar el nombre de la familiao";
	}
}

telefono_familia.onkeyup=function(){
	if(telefono_familia.value!=''){
		valid_telefono_familia.innerHTML='';
	}
	else{
		valid_telefono_familia.innerHTML="Ingrese el teléfono de la familia";
	}
}

ingreso_aprox.onkeyup=function(){
	if(ingreso_aprox.value!=''){
		valid_ingreso_familia.innerHTML='';
	}
	else{
		valid_ingreso_familia.innerHTML="Ingrese el ingreso mensual aproximado";
	}
}




	function validar_informacion(){
		var validar=false;
		if(vivienda.value=="vacio"){
			valid_vivienda.innerHTML="Debe seleccionar la vivienda de la familia";
		}
		else{
			valid_vivienda.innerHTML="";
            
            if((condicion_ocupacion_input.style.display!='none' && condicion_ocupacion_input.value=='') || (condicion_ocupacion_select.style.display!='none' && condicion_ocupacion_select.value=='0')){
            	valid_cond_ocupacion.innerHTML='Campo vacío';
            	condicion_ocupacion_input.focus();
            	condicion_ocupacion_select.focus();
            }
            else{

               valid_cond_ocupacion.innerHTML='';



			if(nombre_familia.value==""){
				valid_nombre_familia.innerHTML="Debe ingresar el nombre de la familia";
				nombre_familia.focus();
			}
			else{
              valid_nombre_familia.innerHTML="";
              if(telefono_familia.value==""){
              	valid_telefono_familia.innerHTML="Ingrese el teléfono de la familia";
              	telefono_familia.focus();
              }
              else{
              	valid_telefono_familia.innerHTML="";

              	if(ingreso_aprox.value==""){
              		valid_ingreso_familia.innerHTML="Ingrese el ingreso mensual aproximado";
              		ingreso_aprox.focus();
              	}
              	else{
              		valid_ingreso_familia.innerHTML="";

              		if(integrantes.length<2){
              			valid_integrantes.innerHTML="Ingrese al menos 2 integrantes de la familia";
              			integrantes_input.focus();
              		}
              		else{
              			valid_integrantes.innerHTML="";
              			validar=true;
              		}
              	}

              }
		}
	}

		return validar;
	}
}
