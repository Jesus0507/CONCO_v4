var lista=document.getElementById('listados');
var imprimir=document.getElementById("imprimir");


lista.onchange=function(){
    var select=document.querySelector("#estadisticas_div");
    var secciones=select.querySelectorAll("section");

    for(var i=0;i<secciones.length;i++){

        $("#"+secciones[i].id).hide().fadeIn(1000);
        secciones[i].style.display='none';
    }

    if(lista.value!='0'){

        if(lista.value!='todos'){
         document.getElementById(lista.value).style.display='block';
     }
     else{

        for(var i=0;i<secciones.length;i++){
            secciones[i].style.display='block';
        }
    }
}


}



imprimir.onclick=function(){
    if(lista.value=='0'){
        swal({
            type:"error",
            title:"Error",
            text:"Debe seleccionar una opción para poder imprimir",
            timer:3000,
            showConfirmButton:false
        })
    }
    else{
        window.print();
    }
}