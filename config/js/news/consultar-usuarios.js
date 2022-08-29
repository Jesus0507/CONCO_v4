function prueba(ced) {
  $.ajax({
    type: "POST",
    url: BASE_URL + "app/Direcciones.php",
    data: {
      direction: 'Usuario/Consultas_Usuario_Ajax',
      accion: "codificar"
    },
    success: function (direccion_segura) {
      $.ajax({
        type: 'POST',
        url: BASE_URL + direccion_segura,
      })
        .done(function (datos) {
          usuarios = JSON.parse(datos);
          for (var i = 0; i < usuarios.length; i++) {
            if (usuarios[i]['cedula_usuario'] == ced) {
              document.getElementById("descripcion").innerHTML = usuarios[i]['nombre'] + " " + usuarios[i]['apellido'];
              document.getElementById("telefono").innerHTML = usuarios[i]['telefono'];
              document.getElementById("correo").innerHTML = usuarios[i]['correo'];
              document.getElementById("rol").innerHTML = usuarios[i]['rol_inicio'];
            }
          }
        });
    },
    error: function () {
      alert('Error al codificar dirreccion');
    }
  });

}

function eliminar(cedula) {
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
  }, function (isConfirm) {

    $.ajax({
      type: "POST",
      url: BASE_URL + "app/Direcciones.php",
      data: {
        direction: 'Usuario/eliminacion_logica',
        accion: "codificar"
      },
      success: function (direccion_segura) {
        $.ajax({
          type: 'POST',
          url: BASE_URL + direccion_segura,
          data: { 'cedula': cedula }
        })
          .done(function (datos) {
            if (datos == 1) {
              swal({
                title: "Eliminado",
                text: "El elemento fue eliminado con exito.",
                type: "success",
                showConfirmButton: false,
                timer: 3000
              });

              setTimeout(function () { location.reload(); }, 2000);
            }

          });
      },
      error: function () {
        alert('Error al codificar dirreccion');
      }
    });
  });
}

function verEditar(cedula) {
  var nombre = document.getElementById("editNombre");
  var apellido = document.getElementById("editApellido");
  var telefono = document.getElementById("editTelefono");
  var correo = document.getElementById("editCorreo");
  var cedulaField = document.getElementById("editCedula");

  $.ajax({
    type: "POST",
    url: BASE_URL + "app/Direcciones.php",
    data: {
      direction: 'Usuario/Consultas_Usuario_Ajax',
      accion: "codificar"
    },
    success: function (direccion_segura) {
      $.ajax({
        type: 'POST',
        url: BASE_URL + direccion_segura,
      }).done(function (datos) {
        usuarios = JSON.parse(datos);

        for (var i = 0; i < usuarios.length; i++) {
          if (usuarios[i]['cedula_usuario'] == cedula) {
            nombre.value = usuarios[i]['nombre'];
            apellido.value = usuarios[i]['apellido'];
            telefono.value = usuarios[i]['telefono'];
            correo.value = usuarios[i]['correo'];
            cedulaField.innerHTML = cedula
          }
        }
      });
    },
    error: function () {
      alert('Error al codificar dirreccion');
    }
  });
}

document.getElementById("enviarEditar").onclick = function () {
  var nombre = document.getElementById("editNombre");
  var apellido = document.getElementById("editApellido");
  var telefono = document.getElementById("editTelefono");
  var correo = document.getElementById("editCorreo");
  var cedula = document.getElementById("editCedula");

  if (nombre.value == "" || apellido.value == "" || telefono.value == "" || correo.value == "") {
    swal({
      title: "Atención",
      type: "warning",
      text: "Todos los campos deben estar llenos para poder modificar",
      showConfirmButton: false,
      timer: 2000
    })
  }
  else {

    var cambios = new Object();
    cambios['nombre'] = nombre.value;
    cambios['apellido'] = apellido.value;
    cambios['telefono'] = telefono.value;
    cambios['correo'] = correo.value;
    cambios['cedula'] = cedula.innerHTML;


    $.ajax({
      type: "POST",
      url: BASE_URL + "app/Direcciones.php",
      data: {
        direction: 'Usuario/modificar',
        accion: "codificar"
      },
      success: function (direccion_segura) {
        $.ajax({
          type: 'POST',
          url: BASE_URL + direccion_segura,
          data: { 'cambios': cambios }
        })
          .done(function (datos) {
            if (datos == 1) {
              swal({
                title: "Éxito",
                text: "Se han guardado las modificaciones.",
                type: "success",
                showConfirmButton: false,
                timer: 3000
              });

              setTimeout(function () { location.reload(); }, 2000);
            }

          });
      },
      error: function () {
        alert('Error al codificar dirreccion');
      }
    });
  }
}
