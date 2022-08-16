var tot_aprobadas=document.getElementById('total_aprobadas');
var tot_pendientes=document.getElementById('total_pendientes');
var tot_rechazadas=document.getElementById('total_rechazadas');
var div_aprobadas=document.getElementById("solicitudes_aprobadas");
var div_pendientes=document.getElementById("solicitudes_pendientes");
var div_rechazadas=document.getElementById("solicitudes_rechazadas");


getSolicitudesIndex();


function getSolicitudesIndex(){

$.ajax({
           type: 'POST',
           url: BASE_URL + 'Solicitudes/Consultar_solicitudes_all',
       })
           .done(function (datos) {
            var cuerpo_aprobadas="";
            var cuerpo_pendientes="";
            var cuerpo_rechazadas="";
            var cont_aprobada=0;
            var cont_pendiente=0;
            var cont_rechazada=0;

            var solicitudes_datos=JSON.parse(datos);

            for(var i=0;i<solicitudes_datos.length;i++){
              var fecha_solicitud=new Date(solicitudes_datos[i]['fecha_solicitud']);
              var date_solicitud=fecha_solicitud.getDate()+"-"+(fecha_solicitud.getMonth()+1)+"-"+fecha_solicitud.getFullYear();
                 
              var icono_solicitud="";
              
              switch(solicitudes_datos[i]['tipo_constancia']){
                case "Residencia":
                icono_solicitud="fas fa-home";
                break;

                case"Buena conducta":
                icono_solicitud="fas fa-address-card";
                break;

                case"Vivienda":
                icono_solicitud="fas fa-plus-square";
                break;

                case"Familia":
                icono_solicitud="fas fa-users";
                break;

                default :
                icono_solicitud="fas fa-hotel";
                break;

              }



              
              switch(solicitudes_datos[i]['procesada']){
                   
                   case 1:  //aprobada

                   cuerpo_aprobadas+="<table onclick='openLink(`"+solicitudes_datos[i]["id_solicitud"]+"`,`2`);'";
                   cuerpo_aprobadas+=" style='width:100%;cursor:pointer;border-radius:5px' onmouseover='this.style.background=`#5CC8BD`'";
                   cuerpo_aprobadas+="onmouseout='this.style.background=``' ><tr>";
                   cuerpo_aprobadas+="<td colspan='2' style='text-align:right;font-size:12px' >"+date_solicitud+"</td></tr>";
                   cuerpo_aprobadas+="<tr><td><em class='fa fa-user-circle'></em>";
                   cuerpo_aprobadas+="<span style='font-weight: bolder'>";
                   cuerpo_aprobadas+=solicitudes_datos[i]["primer_nombre"]+" "+solicitudes_datos[i]['primer_apellido'];
                   cuerpo_aprobadas+="</span></td></tr><tr><td style='font-size:12px'>";
                   cuerpo_aprobadas+="Constancia de "+solicitudes_datos[i]['tipo_constancia'];
                   cuerpo_aprobadas+=" <em class='"+icono_solicitud+"'></em></td>";
                   cuerpo_aprobadas+="</tr></table><hr>";
                  
                   cont_aprobada++;
                   break;

                   case 2: //rechazada
                   cuerpo_rechazadas+="<table onclick='openLink(`"+solicitudes_datos[i]["id_solicitud"]+"`,`2`);'";
                   cuerpo_rechazadas+=" style='width:100%;cursor:pointer;border-radius:5px' onmouseover='this.style.background=`#A84F4F`'";
                   cuerpo_rechazadas+=" onmouseout='this.style.background=``;'><tr>";
                   cuerpo_rechazadas+="<td colspan='2' style='text-align:right;font-size:12px' >"+date_solicitud+"</td></tr>";
                   cuerpo_rechazadas+="<tr><td><em class='fa fa-user-circle'></em>";
                   cuerpo_rechazadas+="<span style='font-weight: bolder'>";
                   cuerpo_rechazadas+=solicitudes_datos[i]["primer_nombre"]+" "+solicitudes_datos[i]['primer_apellido'];
                   cuerpo_rechazadas+="</span></td></tr><tr><td style='font-size:12px'>";
                   cuerpo_rechazadas+="Constancia de "+solicitudes_datos[i]['tipo_constancia'];
                   cuerpo_rechazadas+=" <em class='"+icono_solicitud+"'></em></td>";
                   cuerpo_rechazadas+="</tr></table><hr>";
                  
                   cont_rechazada++;
                   break;


                   default : //pendiente
                   cuerpo_pendientes+="<table style='width:100%;cursor:pointer;border-radius:5px' onmouseover='this.style.background=`#A9CFB3`'";
                   cuerpo_pendientes+="onmouseout='this.style.background=``' ";
                   cuerpo_pendientes+=" onclick='openLink(`"+solicitudes_datos[i]["id_solicitud"]+"`,`1`);' ><tr>";
                   cuerpo_pendientes+="<td colspan='2' style='text-align:right;font-size:12px' >"+date_solicitud+"</td></tr>";
                   cuerpo_pendientes+="<tr><td><em class='fa fa-user-circle'></em>";
                   cuerpo_pendientes+="<span style='font-weight: bolder'>";
                   cuerpo_pendientes+=solicitudes_datos[i]["primer_nombre"]+" "+solicitudes_datos[i]['primer_apellido'];
                   cuerpo_pendientes+="</span></td></tr><tr><td style='font-size:12px'>";
                   cuerpo_pendientes+="Constancia de "+solicitudes_datos[i]['tipo_constancia'];
                   cuerpo_pendientes+=" <em class='"+icono_solicitud+"'></em></td>";
                   cuerpo_pendientes+="</tr></table><hr>";
                  
                   cont_pendiente++;
                   break;

              }


            }

             total_rechazadas.innerHTML="Total:"+cont_rechazada;
             total_aprobadas.innerHTML="Total:"+cont_aprobada;
             total_pendientes.innerHTML="Total:"+cont_pendiente;

             div_rechazadas.innerHTML=cuerpo_rechazadas;
             div_aprobadas.innerHTML=cuerpo_aprobadas;
             div_pendientes.innerHTML=cuerpo_pendientes;


             setTimeout(function(){getSolicitudesIndex();},30000);

           });


}



function openLink(id,tipo){
   
   if(tipo==1){

    window.open(BASE_URL + 'Solicitudes/Solicitud&id='+id);

   }

   else{

    window.open(BASE_URL+"Solicitudes/Solicitud_viewOnly&id="+id);

   }


}