$(document).ready(function () {
    var btn_agregar = document.getElementById("agregar");
    var div_integrantes = document.getElementById("integrantes_agregados");
    var integrantes = [];
    var integrantes_input = document.getElementById("integrantes");
    var valid_integrantes = document.getElementById("valid_integrantes");
    btn_agregar.onclick = function () {
        if ((integrantes_input.style.display != 'none' && integrantes_input.value == '')) {
            valid_integrantes.innerHTML = 'Ingrese el integrante';
            integrantes_input.style.borderColor = 'red';
            integrantes_input.focus();
        } else {
            valid_integrantes.innerHTML = '';
            integrantes_input.style.borderColor = '';
            var enfer = new Object();
            var texto_integrantes = "";
            var existe=false;
            enfer['integrantes'] = integrantes_input.value;
            for(int of integrantes){
                if(int['integrantes'] === integrantes_input.value){
                    console.log('fororo');
                    existe=true;
                }
            }   
            if(existe){
            valid_integrantes.innerHTML = 'Esta persona ya fue ingresada al equipo';
            integrantes_input.style.borderColor = 'red';
            integrantes_input.focus();
            }
            else{
            valid_integrantes.innerHTML = '';
            integrantes_input.style.borderColor = '';
            texto_integrantes = integrantes_input.value;
            var div = document.createElement("div");
            var table = document.createElement("table");
            table.style.width = '100%';
            var tr = document.createElement("tr");
            var td1 = document.createElement("td");
            var td2 = document.createElement("td");
            var td3 = document.createElement("td");
            td3.style.textAlign = 'right';
            for (var opt of document.getElementById('cedula').options){
                if(opt.value===texto_integrantes){
                    texto_integrantes=opt.innerHTML;
                }
            }
            td1.innerHTML = texto_integrantes;
            integrantes_input.value = '';
            var button = document.createElement("input");
            button.type = 'button';
            button.value = 'X';
            button.className = 'btn btn-danger';
            td3.appendChild(button);
            tr.appendChild(td1);
            tr.appendChild(td2);
            tr.appendChild(td3);
            table.appendChild(tr);
            div.appendChild(table);
            var hr = document.createElement("hr");
            integrantes.push(enfer);
            div.appendChild(hr);
            div_integrantes.appendChild(div);

            button.onclick = function () {
                div_integrantes.removeChild(div);
                integrantes.splice(integrantes.indexOf(enfer), 1);

            }
        }
    }
    }
    $(document).on('click', '#guardar', function () {
        if(document.getElementById('id_deporte').value == null || document.getElementById('id_deporte').value == ''){
            document.getElementById('id_deporte').style.borderColor='red';
            document.getElementById('id_deporte').focus();
            document.getElementById('span_deporte').innerHTML='Debe ingresar el deporte';
        }
        else{
            document.getElementById('id_deporte').style.borderColor='';
            document.getElementById('span_deporte').innerHTML='';
            document.getElementById('id_deporte').blur();
            if(document.getElementById('nombre_grupo_deportivo').value==null || document.getElementById('nombre_grupo_deportivo').value == '' ){
                document.getElementById('nombre_grupo_deportivo').style.borderColor='red';
                document.getElementById('span_nombre_grupo').innerHTML='Ingrese el nombre del grupo';  
                document.getElementById('nombre_grupo_deportivo').focus(); 
            }
            else{
                document.getElementById('nombre_grupo_deportivo').style.borderColor='';
                document.getElementById('span_nombre_grupo').innerHTML='';   
                document.getElementById('nombre_grupo_deportivo').blur(); 
                if(integrantes.length == 0){
                document.getElementById('integrantes').style.borderColor='red';
                document.getElementById('integrantes').focus(); 
                document.getElementById('valid_integrantes').innerHTML='Debe agregar los integrantes del grupo deportivo';
                }
                else{
                document.getElementById('integrantes').style.borderColor='';
                document.getElementById('integrantes').blur(); 
                document.getElementById('valid_integrantes').innerHTML='';

                var datos = {
                    id_deporte: $('#id_deporte').val(),
                    nombre_grupo_deportivo: $('#nombre_grupo_deportivo').val(),
                    descripcion: $('#descripcion').val(),
                    estado: 1
                };
                $.ajax({
                    type: "POST",
                    url: BASE_URL + "app/Direcciones.php",
                    data: {
                        direction: "Grupos_Deportivos/Administrar",
                        accion: "codificar"
                    },
                    success: function (direccion_segura) {
                        $.ajax({
                            type: "POST",
                            url: BASE_URL + direccion_segura,
                            data: {
                                peticion: "Administrar",
                                sql: "SQL_01",
                                datos: datos,
                                integrantes: integrantes,
                                accion: "Se ha Registrado el  Grupos Deportivo pordator de la Cedula: " + $('#nombre_grupo_deportivo').val(),
                            },
                        }).done(function (result) {
                            if (result == 1) {
                                swal({
                                    title: "Registrado!",
                                    text: "El elemento fue Registrado con exito.",
                                    type: "success",
                                    showConfirmButton: false
                                });
                                Direccionar("Grupos_Deportivos/Administrar/Consultas");
                            } else {
                                swal({
                                    title: "ERROR!",
                                    text: "Ha ocurrido un Error.</br>" + result,
                                    type: "error",
                                    html: true,
                                    showConfirmButton: true,
                                    customClass: "bigSwalV2",
                                });
                            }
                        }).fail(function () {
                            alert("error")
                        })
                    },
                    error: function () {
                        alert('Error al codificar dirreccion');
                    }
                });
                }
            }
        }
    });
   
});

document.getElementById("nombre_grupo_deportivo").onkeyup=function(){
    document.getElementById('nombre_equipo').innerHTML=document.getElementById("nombre_grupo_deportivo").value;
}

document.getElementById('id_deporte').onkeyup=function(){
    document.getElementById('id_deporte').style.borderColor='';
    document.getElementById('span_deporte').innerHTML='';
}

document.getElementById('nombre_grupo_deportivo').onkeyup=function(){
    document.getElementById('nombre_grupo_deportivo').style.borderColor='';
    document.getElementById('span_nombre_grupo').innerHTML='';
}

document.getElementById('descripcion').onkeyup=function(){
    document.getElementById('descripcion').style.borderColor='';
    document.getElementById('span_descripcion').innerHTML='';
}

document.getElementById('integrantes').onkeyup=function(){
    document.getElementById('integrantes').style.borderColor='';
    document.getElementById('valid_integrantes').innerHTML='';
}