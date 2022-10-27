document.getElementById("imprimir").onclick=function(){
var selected = document.getElementById('censos').options[document.getElementById('censos').selectedIndex].text;
switch(selected){
    case 'Reporte de Niños':
        window.open(document.getElementById("censos").value+"?id="+document.getElementById("familia").value);
    break;
    case 'Censo Poblacional':
        if(document.getElementById('familia').value == ''){
            swal({
                type:'error',
                title: 'Error',
                text: 'Debe seleccionar una familia',
                timer: 2000,
                showConfirmButton: false
            });
        }
        else {
            var existe = false;
            for(var opt of document.getElementById('cedula').options){
                if(document.getElementById('familia').value === opt.value){
                    existe=true;
                }
            }

            if(!existe){
                swal({
                    type:'error',
                    title: 'Error',
                    text: 'Seleccione o ingrese una familia valida',
                    timer: 2000,
                    showConfirmButton: false
                });
            }
            else{
                window.open(document.getElementById("censos").value+"?id="+document.getElementById("familia").value);
            }
        }
    break;
    default:
        swal({
            type:'error',
            title: 'Error',
            text: 'Debe seleccionar un tipo de censo',
            timer: 2000,
            showConfirmButton: false
        });
    break;
}
 }

 document.getElementById('censos').onchange=function(){
    if(document.getElementById('censos').options[document.getElementById('censos').selectedIndex].text == 'Censo Poblacional'){
        document.getElementById('familia_section').classList.remove('d-none');
        document.getElementById('censo_section').className='col-md-6 mt-2';
    }
    else{
        document.getElementById('familia_section').classList.add('d-none');
        document.getElementById('censo_section').className='col-md-12 mt-2';
        document.getElementById('familia').value='';
    }
 }