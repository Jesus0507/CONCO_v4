    var titulo_habitante=document.getElementById("titulo_accion_habitante");
    var index_habitante=0;
//
var div_calendario_habitante=document.getElementById('calendario_eventos_habitante');
var btn_calendario_habitante=document.getElementById("calendario_panel");

var div_solicitar_habitante=document.getElementById("formulario-consulta-persona");
var btn_solicitar_habitante=document.getElementById("solicitar_panel");
var doc=document.getElementById("documento-solicitado");
var mot=document.getElementById("motivo-solicitud");
var valid_doc=document.getElementById("valid_doc");
var valid_mot=document.getElementById("valid_mot");
var boton_enviar=document.getElementById("enviar-solicitud");


var div_registrar_vivienda=document.getElementById("formulario_vivienda");
var btn_registrar_vivienda=document.getElementById("vivienda_panel");

var div_registrar_familia=document.getElementById("formulario_familia");
var btn_registrar_familia=document.getElementById("familia_panel");



btn_calendario_habitante.onclick=function(){index_habitante=1; cambio_vista();}

btn_solicitar_habitante.onclick=function(){index_habitante=2; cambio_vista();}

btn_registrar_vivienda.onclick=function(){index_habitante=3; cambio_vista();}

btn_registrar_familia.onclick=function(){index_habitante=4; cambio_vista();}

doc.onchange=function(){
    if(doc.value!='0'){
        doc.style.borderColor='';
        valid_doc.innerHTML="";
    }
    else{
        doc.style.borderColor='red';
        valid_doc.innerHTML="Debe ingresar el documento a solicitar";
    }
}

mot.onkeyup=function(){
    if(mot.value!=''){
        mot.style.borderColor='';
        valid_mot.innerHTML="";
    }
    else{
        mot.style.borderColor='red';
        valid_mot.innerHTML="Debe ingresar el motivo de su solicitud";
    }
}


function cambio_vista(){
   switch(index_habitante){
    case 1:
    titulo_habitante.innerHTML="Calendario de eventos";
    div_calendario_habitante.style.display="";
    $("#calendario_eventos_habitante").hide().fadeIn(1000);

    div_solicitar_habitante.style.display="none";
    div_registrar_vivienda.style.display="none";
    div_registrar_familia.style.display="none";
    doc.value='0';
    mot.value='';
    doc.style.borderColor='';
    valid_doc.innerHTML="";
    mot.style.borderColor='';
    valid_mot.innerHTML="";
    break;

    case 2:
    titulo_habitante.innerHTML="Solicitar constancias";
    div_solicitar_habitante.style.display="";

    $("#formulario-consulta-persona").hide().fadeIn(1000);
    div_calendario_habitante.style.display="none";
    div_registrar_vivienda.style.display="none";
    div_registrar_familia.style.display="none";
    break;

    case 3:
    titulo_habitante.innerHTML="Registrar vivienda";
    div_registrar_vivienda.style.display="";

    $("#formulario_vivienda").hide().fadeIn(1000);
    div_calendario_habitante.style.display="none";
    div_solicitar_habitante.style.display="none";
    div_registrar_familia.style.display="none";
    break;

    case 4:
    titulo_habitante.innerHTML="Registrar familia";
    div_registrar_familia.style.display="";

    $("#formulario_familia").hide().fadeIn(1000);
    div_calendario_habitante.style.display="none";
    div_solicitar_habitante.style.display="none";
    div_registrar_vivienda.style.display="none";
    break;

}

}


boton_enviar.onclick=function(){
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
    datos_persona['cedula_persona']=document.getElementById("user_cedula").value;
    datos_persona['tipo_constancia']=doc.value;
    datos_persona['motivo_constancia']=mot.value;

    console.log(datos_persona);
    $.ajax({
        type:"POST",
        url:BASE_URL+"Solicitudes/Nueva_solicitud",
        data:{"datos":datos_persona}

    }).done(function(result){
        console.log(result);
        if(result==1){
            swal({
                title:"Éxito",
                type:"success",
                text:"Su solicitud de documento ha sido enviada satisfactoriamente",
                showConfirmButton:false,
                timer:2000,
            });
            
            doc.value='0';
            mot.value='';

            index=1;
            cambio_vista();
        }
    });

}
