var title=document.getElementById('title-notification');
var id=document.getElementById("id_notificacion");
var user=document.getElementById("usuario");
var date=document.getElementById("fecha");
var notification=document.getElementById("notificacion");





$.ajax({
           type: 'POST',
           url: BASE_URL + 'Notificaciones/Consultar_notificaciones',
       })
           .done(function (datos) {
              var result=JSON.parse(datos);
              var cant=0;
              var cuerpo="";

              for (var i=0;i<result.length;i++){
//              	 alert(result[i]['id_notificacion']+" - "+localStorage.getItem('id_notificacion'));
                   if(result[i]['id_notificacion']==id.value){

                          var tipo=result[i]['accion'].split("/");
                          switch(tipo[0]){
                          	case '1': 
                          	title.innerHTML="<em class='fa fa-unlock'></em> Se te ha concedido un permiso";
                          	break;
                          	case '2':
                          	title.innerHTML="<em class='fa fa-lock'></em> Se te ha denegado un permiso";
                          	break;
                            case '3': 
                            title.innerHTML="<em class='fa fa-calendar'></em> Un evento ha sido creado";
                            break;
                            case '4': 
                            title.innerHTML="<em class='fa fa-check'></em> Se aprobó tu solicitud de registro";
                            break;
                            case '5': 
                            title.innerHTML="<em class='fa fa-times'></em>Se rechazó tu solicitud de registro";
                            break;
                          }
                   

                   var fechaN=new Date(result[i]['fecha'])

                   var fechaNoti=fechaN.getDate()+"-"+(fechaN.getMonth()+1)+"-"+fechaN.getFullYear(); 

                   date.innerHTML=fechaNoti;

                   var separado=tipo[1].split(" ");

                   user.innerHTML=separado[0]+" "+separado[1];

                   var text="";

                   for(var j=2;j<separado.length;j++){
                   	text+=separado[j]+" ";
                   }

                   notificacion.innerHTML=text;
               }

              }
          });