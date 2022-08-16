var divNotificaciones=document.getElementById("divNotificaciones");

chargeNotes();


function chargeNotes(){
$.ajax({
           type: 'POST',
           url: BASE_URL + 'Notificaciones/Consultar_notificaciones',
       })
           .done(function (datos) {
              var result=JSON.parse(datos);
              var cant=0;
              var body="";

              for (var i=0;i<result.length;i++){
                  var fechaN=new Date(result[i]['fecha'])
                  var fechaNoti=fechaN.getDate()+"-"+(fechaN.getMonth()+1)+"-"+fechaN.getFullYear(); 
                   var tipo=result[i]['accion'].split("/");
                  var separado=tipo[1].split(" ");
                  var user =separado[0]+" "+separado[1];
                   var text="";
                   for(var j=2;j<separado.length;j++){
                    text+=separado[j]+" ";
                   }

                   var color="";
                   if(result[i]['leido']==1){
                      color='#BFBFBF';
                   }
                   else{
                    color='#94EDE4';
                   }

                   var clase='';

                   switch(tipo[0]){
                    case '1':
                    clase='fa fa-unlock';
                    break;
                    case '2':
                    clase='fa fa-lock';
                    break;
                    case '3':
                    clase='fa fa-calendar';
                    break;
                    case 4:
                    clase="fas fa-check";
                    break;
                    case 5:
                    clase="fas fa-times";
                    break;
                   }
                  


                   body+='<br> <div onclick="setStatus(`'+result[i]['id_notificacion']+'`);chargeNotes();" style="width:100%;cursor:pointer;background: '+color+';padding-left: 6%;padding-right: 6%;border-radius: 30px" ';
                   body+='onmouseover="this.style.background=`#00B9B9`" onmouseout="this.style.background=`'+color+'`">';
                   body+='<br><table style="width:100%"><tr><td style="width:7%;text-align: center">';
                   body+='<em style="font-size:60px" class="fa fa-user"></em> <h3>'+user+'</h3></td>';
                   body+='<td style="width:70%;text-align:center"><h5>'+text+'</h5></td>';
                   body+='<td style="width:20%;text-align:right"><em style="font-size:40px;padding-top:0px" class="'+clase+'"></em><br><br>';
                   body+='<b>'+fechaNoti+'</b></td></tr></table><br></div>';


              }
              
              divNotificaciones.innerHTML=body;
          });

                      setTimeout(function(){chargeNotes();},30000);

}



            
            
    
