$(document).ready(function() {
    var btn_agregar = document.getElementById("agregar");
    var div_integrantes = document.getElementById("integrantes_agregados");
    var integrantes = [];
    var integrantes_input = document.getElementById("integrantes");
    var valid_integrantes = document.getElementById("valid_integrantes");
    btn_agregar.onclick = function() {
        if ((integrantes_input.style.display != 'none' && integrantes_input.value == '')) {
            valid_integrantes.innerHTML = 'Ingrese el integrante';
            integrantes_input.style.borderColor = 'red';
            integrantes_input.focus();
        } else { 
            valid_integrantes.innerHTML = '';
            integrantes_input.style.borderColor = '';
            var enfer = new Object();
            var texto_integrantes = "";
            enfer['integrantes'] = integrantes_input.value;
            texto_integrantes = integrantes_input.value;
            var div = document.createElement("div");
            var table = document.createElement("table");
            table.style.width = '100%';
            var tr = document.createElement("tr");
            var td1 = document.createElement("td");
            var td2 = document.createElement("td");
            var td3 = document.createElement("td");
            td3.style.textAlign = 'right';
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
            
            button.onclick = function() {
                div_integrantes.removeChild(div);
                integrantes.splice(integrantes.indexOf(enfer), 1);
                
            }
        }
    }
    $(document).on('click', '#guardar', function() {
        
        var datos = {
            id_deporte: $('#id_deporte').val(),
            nombre_grupo_deportivo: $('#nombre_grupo_deportivo').val(),
            descripcion: $('#descripcion').val(),
            estado: 1
        };
        $.ajax({
            type: "POST",
            url: BASE_URL + "Grupos_Deportivos/Administrar",
            data: {
                peticion: "Administrar",
                sql: "SQL_01",
                datos: datos,
                integrantes: integrantes,   
                accion: "Se ha Registrado el  Grupos Deportivo pordator de la Cedula: " + $('#nombre_grupo_deportivo').val(),
            },
        }).done(function(result) {
           if (result == 1) {
                swal({
                    title: "Registrado!",
                    text: "El elemento fue Registrado con exito.",
                    type: "success",
                    showConfirmButton: false
                });
                setTimeout(function() {
                    location.href = BASE_URL + "Grupos_Deportivos/Administrar/Consultas"
                }, 1000);
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
        }).fail(function() {
            alert("error")
        })
    });
});