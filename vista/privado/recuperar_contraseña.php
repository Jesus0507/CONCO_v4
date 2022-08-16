<div id="password" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title text-center">Recuperación de contraseña</h3>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<form method="POST" enctype="multipart/form-data" action="" name="" id="cambioForm">
				<div class="modal-body">
					<div class="panel-body">

						<h5 class="modal-title text-center" style="margin-bottom: 8px;">Datos del usuario</h5>

						<input type="number" class="form-control input-number" placeholder="Ingrese su cédula" id="cedulaEmergente" name="cedulaEmergente" />
						<div id="textoCedula" style='color:red'></div>

						<br>
                        <div id='info' style='display:none'>
						<h5 class="modal-title text-center" style="margin-bottom: 8px;">Preguntas de seguridad</h5>

						<input type="text" class="form-control validar-letras validar-simbolos" id="mascota" name="mascota" placeholder="Nombre de su primera mascota" style="margin-bottom: 4px;">
						<div id="textoMascota" style='color:red'></div>
						<br>

						<div class="">
							<input class="form-control select" style="margin-bottom: 4px;" placeholder="Escriba su animal favorito" id="animFav" name="animFav">

						</div>
						<div id="textoAnimFav" style='color:red'></div>
						<br>

						<div>
							<input class="form-control validar-letras validar-simbolos" id="colorFav" placeholder='Escriba su color favorito' name="colorFav">

						</div>
						<div id="textoColorFav" style='color:red'></div>

						</br>

						<h5 class="modal-title text-center" style="margin-bottom: 8px;">Nueva contraseña</h5>


						<input type="password" class="form-control espacios" name="passwordEmergente" id="passwordEmergente" placeholder="Contraseña" style="margin-bottom: 4px;">
						<div id="textoClave1" style='color:red'></div>
						<input type="password" class="form-control espacios" name="passwordEmergente2" id="passwordEmergente2" placeholder="Confirmar contraseña">


						<div id="textoClave2" style='color:red'></div>

					</div>
				</div>
				<div class="modal-footer">
					<input type="button" value="Consultar" class="btn btn-primary " id="modificarContrasenia" />
				</div>
			</form>
		</div>
	</div>
</div>