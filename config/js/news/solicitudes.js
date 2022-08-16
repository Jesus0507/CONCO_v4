 var cantidad_s=document.getElementById("cant_solicitudes");
 var solicitudes_no_leidas=document.getElementById("solicitudes-no-leidas");
 var solicitudes=document.getElementById("body-solicitudes");
 var page_title=document.getElementById("page-title");


 getSolicitudes();



 function getSolicitudes(){
   $.ajax({
    type: 'POST',
    url: BASE_URL + 'Solicitudes/Consultar_solicitudes',
  })
   .done(function (datos) {
    var result_s=JSON.parse(datos);
    var cuerpo_s="";

    for (var i=0;i<result_s.length;i++){
      var icono_s="";
      var fecha_s=new Date(result_s[i]['fecha_solicitud']);
      var span_s=getSpan(fecha_s,new Date());

      var texto_mensaje=result_s[i]['primer_nombre']+" "+result_s[i]['primer_apellido']+" ";


      switch(result_s[i]['tipo_constancia']){
        case 'Residencia':
        icono_s="<i class='fas fa-home'></i>";
        texto_mensaje+="Ha realizado una solicitud de constancia de "+result_s[i]['tipo_constancia'];

        break;
        case 'Buena conducta':
        icono_s="<i class='fas fa-address-card'></i>";
        texto_mensaje+="Ha realizado una solicitud de constancia de "+result_s[i]['tipo_constancia'];

        break;
        case 'No poseer vivienda':
        icono_s="<i class='fas fa-hotel'></i>";
        texto_mensaje+="Ha realizado una solicitud de constancia de "+result_s[i]['tipo_constancia'];

        break;
        case 'Vivienda':
        icono_s="<i class='fas fa-plus-square'></i>";
        texto_mensaje+="Ha realizado una solicitud de registro de "+result_s[i]['tipo_constancia'];

        break;

        case 'Familia':
        icono_s="<i class='fas fa-users'></i>";
        texto_mensaje+="Ha realizado una solicitud de registro de "+result_s[i]['tipo_constancia'];

        break;
      }



      var mensaje_s=getRecortado(texto_mensaje);


      cuerpo_s+="<a title='"+texto_mensaje+"' href='javascript:void(0)' style='font-size:12px !important' class='dropdown-item' onclick='goToSolicitud(`"+result_s[i]['id_solicitud']+"`,`"+result_s[i]['tipo_constancia']+"`)'>";
      cuerpo_s+=icono_s+" "+mensaje_s+span_s;
      cuerpo_s+="</a><div class='dropdown-divider'></div>";


    }


    if(result_s.length==0){
      solicitudes_no_leidas.innerHTML="No hay solcitudes pendientes";
      solicitudes.style.display="none";
      cantidad_s.innerHTML='0';
      cantidad_s.style.display="none";

    }
    else{      
      solicitudes_no_leidas.innerHTML=result_s.length+" Solicitudes";
      cantidad_s.style.display="";
      cantidad_s.innerHTML=result_s.length;
      solicitudes.innerHTML=cuerpo_s;
      solicitudes.style.display="";



    }


    var texto_titulo="C.C Prados de Occidente";
    if(cantidad.innerHTML!="0"){
     texto_titulo="("+cantidad.innerHTML+")Notificaciones";

   }

   if(cantidad_s.innerHTML!="0"){
    texto_titulo="("+cantidad_s.innerHTML+")Solicitudes";
  }

  if(cantidad.innerHTML!="0" && cantidad_s.innerHTML!="0"){
    texto_titulo="("+(parseInt(cantidad_s.innerHTML)+parseInt(cantidad.innerHTML))+")C.C Prados de Occidente";
  }

  page_title.innerHTML=texto_titulo;

});

   setTimeout(function(){getSolicitudes();},5000);
 }



 function goToSolicitud(id,tipo_solicitud){

  if(tipo_solicitud=="Vivienda"){
      window.open(BASE_URL + 'Solicitudes/Solicitud_vivienda&id='+id);
  }
  else{

    if(tipo_solicitud=="Familia"){
      window.open(BASE_URL + 'Solicitudes/Solicitud_familia&id='+id);
    }
    else{

  window.open(BASE_URL + 'Solicitudes/Solicitud&id='+id);
    }

}

}





