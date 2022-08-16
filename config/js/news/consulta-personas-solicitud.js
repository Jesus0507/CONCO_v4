var lupa=document.getElementById('consultaPersona');
var cedula_persona=document.getElementById("cedulaPersona");
var div_validacion=document.getElementById("mensajeValidacionPersona");
var div_form_solicitud=document.getElementById("formulario-consulta-persona");
var doc=document.getElementById("documento-solicitado");
var mot=document.getElementById("motivo-solicitud");
var valid_doc=document.getElementById("valid_doc");
var valid_mot=document.getElementById("valid_mot");
var boton_enviar=document.getElementById("enviar-solicitud");
 
localStorage.clear();
 

lupa.onclick=function(){
	if(cedula_persona.value==""){
		div_validacion.innerHTML="Ingrese su cédula";
		cedula_persona.style.borderColor="red";
		cedula_persona.focus();
	}
	else{
        cedula_persona.style.borderColor="";
		$.ajax({
            type: 'POST',
            url: BASE_URL + 'Personas/Consultas_cedula',
            data:{'cedula':cedula_persona.value}
        })
            .done(function (datos) {
                if(datos!=0){
                		
                	var result=JSON.parse(datos);

                 cedula_persona.disabled="disabled";
                 cedula_persona.style.borderColor="";
                 div_validacion.style.display='none';

                    swal({
                           title:"Bienvenido(a)",
                           type:"success",
                           text:result[0]['primer_nombre']+" "+result[0]['primer_apellido'],
                           timer:2000,
                           showConfirmButton:false
                    });

                    localStorage.setItem("cedula_habitante",cedula_persona.value);
                    localStorage.setItem("habitante",result[0]['primer_nombre']+" "+result[0]['primer_apellido']);
                    setTimeout(function(){location.href=BASE_URL+"Habitante/";},1000);


                // 	var antiguedad=new Date(result[0]['antiguedad_comunidad']);
                // 	var meses_antiguedad=get_antiguedad(antiguedad);
                // 	if(meses_antiguedad){
                // 	div_validacion.style.color='#00A4A4';
                // 	div_validacion.innerHTML="<br><b>"+result[0]['primer_nombre']+" "+result[0]['primer_apellido']+"<b>";
                //     div_form_solicitud.style.display="";
                //     cedula_persona.disabled="disabled";
                // }
                // else{
                // 	cedula_persona.focus();
                // 	cedula_persona.style.borderColor="red";
                // 	div_validacion.style.color="red";
                // 	div_validacion.innerHTML="Estimado(a) ciudadano(a), para poder realizar la solicitud de una<br> constancia, debe poseer más de tres meses en la comunidad";
                //     div_form_solicitud.style.display="none";
                //     doc.value=0;
                //     mot.value="";
                // }
                }
                else{
                	cedula_persona.focus();
                	cedula_persona.style.borderColor="red";
                	div_validacion.style.color="red";
                	div_validacion.innerHTML="Usted no se encuentra registrado en el sistema";
                    div_form_solicitud.style.display="none";
                    doc.value=0;

                    mot.value="";
                }
            });
	}
}


function get_antiguedad(fecha){
	var actual=new Date();
	var retornar=true;

	if(fecha.getFullYear()==actual.getFullYear()){
		var meses=(actual.getMonth()+1) - (fecha.getMonth()+1);
             if(meses<=3){
             	retornar = false;
             }
	}

	return retornar;
}

boton_enviar.onclick=function(){
	lupa.click();
	if(doc.value==0){
		valid_doc.innerHTML="Debe ingresar el documento a solicitar";
		doc.style.borderColor="red";
	}
	else{
		valid_doc.innerHTML="";
		doc.style.borderColor="";

		if(mot.value==""){
			valid_mot.innerHTML="Debe ingresar el motivo de su solicitud";
			mot.style.borderColor="red";
			mot.focus();
		}
		else{
			valid_mot.innerHTML="";
			mot.style.borderColor="";

            send_request();
	}
	}
}


function send_request (){

	var datos_persona=new Object();
	datos_persona['cedula_persona']=cedula_persona.value;
	datos_persona['tipo_constancia']=doc.value;
	datos_persona['motivo_constancia']=mot.value;

 
 $.ajax({
 	type:"POST",
 	url:BASE_URL+"Solicitudes/Nueva_solicitud",
 	data:{"datos":datos_persona}

 }).done(function(result){
          if(result==1){
          	swal({
          		title:"Éxito",
                type:"success",
                text:"Su solicitud de documento ha sido enviada satisfactoriamente",
                showConfirmButton:false,
                timer:2000,
          	});
            
            setTimeout(function(){location.reload();},1000);
          }
 });

}