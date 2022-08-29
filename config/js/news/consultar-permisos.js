consulta_permisos();

function consulta_permisos() {
	$.ajax({
		type: "POST",
		url: BASE_URL + "app/Direcciones.php",
		data: {
			direction: "Seguridad/obtener_permisos_dinamico",
			accion: "codificar"
		},
		success: function (direccion_segura) {
			$.ajax({
				type: "POST",
				url: BASE_URL + direccion_segura
			}).done(function (result) {

				setTimeout(function () { consulta_permisos(); }, 10000);
			});
		},
		error: function () {
			alert('Error al codificar dirreccion');
		}
	});

}