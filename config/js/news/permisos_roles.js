var body_permisos=document.getElementById('body-permisos');
var rol_user=document.getElementById('rol_user');
var clave=document.getElementById('contrasenia-editar');
var btn_ver=document.getElementById('botonVer');
var btn_guardar=document.getElementById('enviar');
var cedula_oculta=document.getElementById("cedulaOculta");
var rol_oculto=document.getElementById("rolOculto");




function modificar_rol(rol,contrasenia,cedula){
	cedula_oculta.value=cedula;
  console.log(cedula);
  rol_oculto.value=rol_user.value=rol;
  clave.value=contrasenia;

  $("#ver_roles").modal().show();
}


btn_guardar.onclick=function(){
	if(clave.value=="" || rol_user.value==0){
		swal({
      title:"Error",
      type:"error",
      text:"Debe ingresar un rol y una clave para el usuario",
    });
	}
	else{

		var datos_modificacion=new Object();
		datos_modificacion['cedula_usuario']=cedula_oculta.value;
    datos_modificacion['clave']=clave.value;
    datos_modificacion['rol']=rol_user.value;

    if(rol_user.value==rol_oculto.value){
     swal({
      title:"Antes de continuar...",
      type:"warning",
      text:"¿Desea reestablecer los permisos por defecto para el rol de este usuario?",
      showCancelButton:true,
      cancelButtonText:"No, conservar permisos actuales",
      confirmButtonText:"Si, reestablecer permisos para este rol",
      customClass:"bigSwal"
    },function(isConfirm){
     if(isConfirm){
      datos_modificacion['cambiar_permisos']="si";

      edit_rol(datos_modificacion);
    }
    else{
      datos_modificacion['cambiar_permisos']="no";
      edit_rol(datos_modificacion);
    }
  });
   }
   else{
     datos_modificacion['cambiar_permisos']="si";

     edit_rol(datos_modificacion);
   }

 }
}



function edit_rol(data){
	$.ajax({
		url:BASE_URL+"Seguridad/cambiar_roles",
		type:"POST",
		data:{"datos":data}
	}).done(function(result){
		console.log(data);
    if(result==true){

     $('#example1').DataTable().clear().destroy();
     cargar_tabla();
     swal({
      title:"Éxito",
      text:"Se han guardado los cambios exitosamente",
      type:"success",
      timer:2000,
      showConfirmButton:false,
    });
     $("#ver_roles").modal("hide");
   }
 });
}


btn_ver.onclick=function(){
	if(clave.type=="password"){
		clave.type="text";
		btn_ver.innerHTML='<i  style="font-size:22px" class="fa fa-eye-slash">';
	}
	else{
		clave.type="password";
		btn_ver.innerHTML='<i  style="font-size:22px" class="fa fa-eye">';
	}
}


function get_permisos_rol(rol){
  document.getElementById("rolOculto").value=rol;
  llenar_permisos(rol);

  $("#ver_permisos").modal().show();
}


function get_permiso(permiso,tipo_permiso,rol,modulo){

	var tag="";

  if(permiso==1){
    tag="<span class='fa fa-minus-circle negativo' title='Denegar permiso' onclick='change_permiso(`"+permiso+"`,`"+tipo_permiso+"`,`"+rol+"`,`"+modulo+"`);'></span>";

  }
  else{
   tag="<span class='fa fa-plus-circle positivo' title='Otorgar permiso' onclick='change_permiso(`"+permiso+"`,`"+tipo_permiso+"`,`"+rol+"`,`"+modulo+"`);'></span>";
 }

 return tag;

}


function llenar_permisos(rol){

 $.ajax({
   type:"POST",
   url:BASE_URL+"Seguridad/get_permisos_rol",
   data:{"rol":rol}
 }).done(function(result){
  var permisos=JSON.parse(result);
  var texto_permisos="";

  for(var i=0;i<permisos.length;i++){
    var permiso_nombre="";
    switch(permisos[i]['id_modulo']){
      case 1:
      permiso_nombre="Solicitudes"
      break;
      case 2:
      permiso_nombre="Personas"
      break;
      case 3:
      permiso_nombre="Agenda"
      break;
      case 4:
      permiso_nombre="Comité"
      break;
      case 5:
      permiso_nombre="Grupos deportivos"
      break;
      case 6:
      permiso_nombre="Parto Humanizado"
      break;
      case 7:
      permiso_nombre="Enfermos "
      break;
      case 8:
      permiso_nombre="Negocios"
      break;
      case 9:
      permiso_nombre="Nucleo familiar"
      break;
      case 10:
      permiso_nombre="Sector agricola"
      break;
      case 11:
      permiso_nombre="Centros de votacion"
      break;
      case 12:
      permiso_nombre="Viviendas"
      break;
      case 13:
      permiso_nombre="Inmuebles"
      break;
      case 14:
      permiso_nombre="Discapacitados"
      break;
      case 15:
      permiso_nombre="Vacunados COVID"
      break;
      default:
      permiso_nombre="Seguridad"
      break;
    }


    document.getElementById("title_permisos").innerHTML="<b>"+rol+"</b>";


    texto_permisos+="<tr><td style='text-align:center'>"+permiso_nombre+"</td><td style='text-align:center'>"+get_permiso(permisos[i]['registrar'],1,rol,permisos[i]['id_modulo'])+"</td>";
    texto_permisos+="<td style='text-align:center'>"+get_permiso(permisos[i]['consultar'],2,rol,permisos[i]['id_modulo'])+"</td><td style='text-align:center'>"+get_permiso(permisos[i]['modificar'],3,rol,permisos[i]['id_modulo'])+"</td>";
    texto_permisos+="<td style='text-align:center'>"+get_permiso(permisos[i]['eliminar'],4,rol,permisos[i]['id_modulo'])+"</td></tr>";
  }

  body_permisos.innerHTML=texto_permisos;
});

}


function change_permiso(permiso,tipo_permiso,rol,modulo){



	if(permiso=="1"){
		permiso="0";
	}
	else{
		permiso="1";
	}


	var  campo="";


	switch(parseInt(tipo_permiso)){

		case 1:
		campo="registrar";
		break;

		case 2:
		campo="consultar";
		break;

		case 3:
		campo="modificar";
		break;

		default:
		campo="eliminar";
		break;
	}

	var datos=new Object();
	datos['rol']=rol;
	datos['campo']=campo;
	datos['permiso']=permiso;
  datos['modulo']=modulo;



  $.ajax({
    url:BASE_URL+"Seguridad/change_permiso",
    type:"POST",
    data:{"datos":datos}

  }).done(function(result){

    console.log(result);

    if(result!=0){
     llenar_permisos(rol);
       //     var notificacion=new Object();
       //     notificacion['usuario_receptor']=cedula;
       //     if(permiso==1){
       //     notificacion['accion']="Te ha concedido el permiso de "+campo+" en el módulo "+nombre;
       //     notificacion['tipo_notificacion']=1;
       // }
       // else{
       // 	notificacion['accion']="Te ha denegado el permiso de "+campo+" en el módulo "+nombre;
       // 	notificacion['tipo_notificacion']=2;
       // }


       //     nueva_notificacion(notificacion);
           // $('#example1').DataTable().clear().destroy();
           // cargar_tabla();

         }


       });

}

function cambiar_estado_persona(cedula,estado_nuevo){
 if(estado_nuevo==1){
  swal({
   type:"warning",
   title:"Atención",
   text:"Está por activar este usuario, al hacerlo este podrá ingresar nuevamente al sistema conforme los permisos que posea. ¿Desea continuar?",
   showCancelButton:true,
   cancelButtonText:"No",
   confirmButtonText:"Si"
 },function(isConfirm){

  if(isConfirm){
   cambio_estado_permiso(cedula,estado_nuevo);
 }
});
}
else{
  swal({
   type:"warning",
   title:"Atención",
   text:"Está por desactivar este usuario, al hacerlo este será desplazado del sistema y no podrá ingresar. ¿Desea continuar?",
   showCancelButton:true,
   cancelButtonText:"No",
   confirmButtonText:"Si"
 },function(isConfirm){

  if(isConfirm){
   cambio_estado_permiso(cedula,estado_nuevo);
 }
});
}
}


function cambio_estado_permiso(cedula,estado){
	$.ajax({
		type:"POST",
		url:BASE_URL+"Seguridad/cambio_estado",
		data:{'cedula_persona':cedula,"estado":parseInt(estado)}
	}).done(function(result){
		console.log(result);
		var mensaje="";
   if(result==1){

    estado==1?mensaje="activado":mensaje='desactivado';
    setTimeout(function(){
      swal({
       type:"success",
       title:"Éxito",
       text:"Se ha "+mensaje+" la persona exitosamente",
       showConfirmButton:false,
       timer:2000
     });

      setTimeout(function(){$('#example1').DataTable().clear().destroy();
       cargar_tabla();},1000);
    },500);

  }
})
}

function changePermisosHead(tipoPermiso,tag){
 swal({
  type:"warning",
  title:"Atención",
  text:"Esta acción afectará los permisos de este rol para todos los modulos, ¿desea continuar?",
  showCancelButton:true,
  cancelButtonText:"No",
  confirmButtonText:"Si"
},function(isConfirm){
       if(isConfirm){

        var permiso='';
        if(tag.className=='fa fa-minus-circle negativoHead'){
          permiso='1';
          tag.className='fa fa-plus-circle positivoHead';
        }
        else{
          permiso='0';
          tag.className='fa fa-minus-circle negativoHead';
        }
            for(var i=1;i<17;i++){
              change_permiso(permiso,tipoPermiso,document.getElementById("rolOculto").value,i);
            }
       }
});

}