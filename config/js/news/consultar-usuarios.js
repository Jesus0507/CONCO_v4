 function prueba(ced){
 $.ajax({
           type: 'POST',
           url: BASE_URL + 'Usuario/Consultas_Usuario_Ajax',
       })
           .done(function (datos) {
               usuarios = JSON.parse(datos);
               
               for(var i=0;i<usuarios.length;i++){
               	if(usuarios[i]['cedula_usuario']==ced){
               		document.getElementById("descripcion").innerHTML=usuarios[i]['nombre']+" "+usuarios[i]['apellido'];
               		document.getElementById("telefono").innerHTML=usuarios[i]['telefono'];
               		document.getElementById("correo").innerHTML=usuarios[i]['correo'];
               		document.getElementById("rol").innerHTML=usuarios[i]['rol_inicio'];
               	}
               }



           });
    }

function eliminar(cedula){
   swal({
          title: "¿Desea Eliminar este usuario?",
          text: "El elemento seleccionado sera eliminado del sistema",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Si, eliminar",
          cancelButtonText: "No, cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
              }, function(isConfirm) {
                 $.ajax({
           type: 'POST',
           url: BASE_URL + 'Usuario/eliminacion_logica',
           data:{'cedula':cedula}
       })
           .done(function (datos) {
              if(datos==1){
                swal({
                title:"Eliminado",
               text:"El elemento fue eliminado con exito.",
               type:"success",
              showConfirmButton:false,
              timer:3000
             });

                setTimeout(function(){location.reload();},2000);
              }

           });
              // if (isConfirm) {
              // /* location.href = BASE_URL +
              // "Calles/Eliminar_Calle/"; */
              // swal("Eliminado!",
              // "El elemento fue eliminado con exito.",
              // "success");
              //  } else {
              // swal("Cancelado",
              // "La accion fue cancelada, la informacion esta segura.",
              // "error");
              //  }
  });
}

function verEditar(cedula){
  var nombre=document.getElementById("editNombre");
  var apellido=document.getElementById("editApellido");
  var telefono=document.getElementById("editTelefono");
  var correo=document.getElementById("editCorreo");
  var cedulaField=document.getElementById("editCedula");
   $.ajax({
           type: 'POST',
           url: BASE_URL + 'Usuario/Consultas_Usuario_Ajax',
       })
           .done(function (datos) {
               usuarios = JSON.parse(datos);
               
               for(var i=0;i<usuarios.length;i++){
                if(usuarios[i]['cedula_usuario']==cedula){
                  nombre.value=usuarios[i]['nombre'];
                  apellido.value=usuarios[i]['apellido'];
                  telefono.value=usuarios[i]['telefono'];
                  correo.value=usuarios[i]['correo'];
                  cedulaField.innerHTML=cedula
                }
               }



           });
}

document.getElementById("enviarEditar").onclick=function(){
  var nombre=document.getElementById("editNombre");
  var apellido=document.getElementById("editApellido");
  var telefono=document.getElementById("editTelefono");
  var correo=document.getElementById("editCorreo");
  var cedula=document.getElementById("editCedula");

  if(nombre.value=="" || apellido.value=="" || telefono.value=="" || correo.value==""){
    swal({
      title:"Atención",
      type:"warning",
      text:"Todos los campos deben estar llenos para poder modificar",
      showConfirmButton:false,
      timer:2000
    })
  }
  else{

      var cambios=new Object();
      cambios['nombre']=nombre.value;
      cambios['apellido']=apellido.value;
      cambios['telefono']=telefono.value;
      cambios['correo']=correo.value;
      cambios['cedula']=cedula.innerHTML;

    $.ajax({
            type: 'POST',
            url: BASE_URL + 'Usuario/modificar',
            data:{'cambios':cambios}
        })
            .done(function (datos) {
                if(datos==1){
                  swal({
                  title:"Éxito",
                 text:"Se han guardado las modificaciones.",
                 type:"success",
                showConfirmButton:false,
                timer:3000
               });

                  setTimeout(function(){location.reload();},2000);
                }

            });
  }
}
