var title=document.getElementById('title-solicitud-view');
var id=document.getElementById("id_solicitud");
var persona=document.getElementById("persona");
var date=document.getElementById("fecha_solicitud");
var tipo=document.getElementById("tipo_constancia");
var motivo=document.getElementById("motivo");
var div_background=document.getElementById('div_background');
var div_fecha=document.getElementById('fecha_proceso');
var div_rechazo=document.getElementById('rechazo_div');
var motivo_rechazo=document.getElementById("motivo_rechazo");






$.ajax({
            type: 'POST',
            url: BASE_URL + 'Solicitudes/Consultar_solicitudes_all',
        })
            .done(function (datos) {
              var result_s=JSON.parse(datos);
              var cuerpo_s="";
              var titulo_solicitud="";

                for (var i=0;i<result_s.length;i++){

                   if(result_s[i]['id_solicitud']==id.value){

                         switch(result_s[i]['tipo_constancia']){
                      case 'Residencia':
                             titulo_solicitud="<em class='fas fa-home'></em> Solicitud de constancia de "+result_s[i]['tipo_constancia'];
                      break;
                      case 'Buena conducta':
                             titulo_solicitud="<em class='fas fa-address-card'></em> Solicitud de constancia de "+result_s[i]['tipo_constancia'];
                      break;
                      case 'No poseer vivienda':
                            titulo_solicitud="<em class='fas fa-hotel'></em> Solicitud de constancia de "+result_s[i]['tipo_constancia'];
                      break;
                  }
                   

                   var fecha_s=new Date(result_s[i]['fecha_solicitud'])

                   var fecha_soli=fecha_s.getDate()+"-"+(fecha_s.getMonth()+1)+"-"+fecha_s.getFullYear(); 

                   date.innerHTML=fecha_soli;

                   persona.innerHTML=result_s[i]['primer_nombre']+" "+result_s[i]['primer_apellido'];

                   tipo.innerHTML="Constancia de "+result_s[i]['tipo_constancia'];

                   motivo.innerHTML=result_s[i]['motivo_constancia'];

                   title.innerHTML=titulo_solicitud;

                   if(result_s[i]['procesada']==1){
                    div_background.style.background="#94EDE4";
                    div_fecha.innerHTML=result_s[i]['observaciones'];
                   }
                   else{
                    div_rechazo.style.display="";
                    var observaciones_separado=result_s[i]['observaciones'].split("/");
                    div_fecha.innerHTML=observaciones_separado[0];
                    motivo_rechazo.innerHTML=observaciones_separado[1];
                    div_background.style.background="#C59696";
                   }

               }

              }
          });
