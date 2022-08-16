function ver_familia(integrantes,nombre,tlf,direccion,numero_casa,ingreso){

var integrants=JSON.parse(integrantes);

var texto_integrantes="";
 for(var i=0;i<integrants.length;i++){
 	console.log(integrants[i]['cedula_persona']);
 	texto_integrantes+="<table style='width:100%'><tr><td>"+integrants[i]['primer_nombre']+" "+integrants[i]['primer_apellido'];
 	texto_integrantes+="</td><td>"+integrants[i]['cedula_persona']+"</td></tr></table><br><hr>";
 }

 var texto_swal="<center><em class='fa fa-users' style='font-size:60px'></em></center><br>";
 texto_swal+="<table border='1' style='width:100%'><tr style='color:white;background:#7BACAA;font-weight:bold'><td>Teléfono</td><td>Dirección</td><td>Nro de Casa</td>";
 texto_swal+="<td>Ingreso mensual</td><td>Integrantes ("+integrants.length+")</td></tr>";

 texto_swal+="<tr><td>"+tlf+"</td><td>"+direccion+"</td><td>"+numero_casa+"</td><td>"+ingreso+"</td>";
 texto_swal+="<td><div style='overflow-y:scroll; width:100%;height:120px;background:#D0E8E7'>";
 texto_swal+="<center><div style='width:90%'>"+texto_integrantes+"</div></center></div></td></tr></table>";

swal({
	title:"Familia "+nombre,
	text:texto_swal,
	html:true,
	customClass:"bigSwalV2"
});


}



function eliminar(id){
	swal({
		type:"warning",
		title:"Atención",
		text:"Estás por eliminar esta familia, ¿deseas continuar?",
		showCancelButton:true,
		cancelButtonText:"No",
		confirmButtonText:"Si"
	},function(isConfirm){
		if(isConfirm){
			$.ajax({
				type:"POST",
				url:BASE_URL+"Familias/eliminar_logica",
				data:{'id':id}
			}).done(function(result){
                     setTimeout(function(){
                    	swal({
                    		type:"success",
                    		title:"Éxito",
                    		text:"Se ha eliminado exitosamente esta familia",
                    		timer:2000,
                    		showConfirmButton:false
                    	});

                    	setTimeout(function(){location.reload();},1000);
                  },500);
			});
		}
	})
}