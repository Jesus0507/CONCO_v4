consulta_permisos();



function consulta_permisos(){

$.ajax({
	type:"POST",
	url:BASE_URL+"Seguridad/obtener_permisos_dinamico"
}).done(function(result){
      //console.log(result);
	 setTimeout(function(){consulta_permisos();},10000);
});


}