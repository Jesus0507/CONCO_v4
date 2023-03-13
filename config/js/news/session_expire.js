var keep = document.getElementById('keep');
var close_session = document.getElementById('close');
var count = 20;  // cambiar por 1800
var paused = false;
var n = 10;
var counter_modal = document.getElementById('modal_count');

keep.onclick = function(){
    $("#modal-session").modal("hide");
    paused = false;
    count = 20;
    n = 10;
}

close_session.onclick = function(){
    document.getElementById('close-button').click();
}


window.setInterval(function () {
    if (!paused) {
        document.onmousemove = function () {
            if(count > 0) {
                paused = false;
                count = 20;
            }
        }

        document.onclick = function () {
            if(count > 0) {
                paused = false;
                count = 20;
            }
        }
        count--;
        $.ajax({
            type: 'POST',
            url: BASE_URL + "app/Direcciones.php",
            data: {
                direction: "Notificaciones/Administrar",
                accion: "codificar"
            },
        }).done(function (direccion_segura) {
            $.ajax({
                type: 'POST',
                url: BASE_URL + direccion_segura,
                data: {
                    datos: count,
                    peticion: "Expirar"
                },
            }).done(function (result) {
                if (result == 0) {
                    paused = true;
                    expirar_session_modal();
                }
            });
        });
    }

}, 1200);

function expirar_session_modal() {
    counter_modal.innerText = n;
    decrementar_counter();
    $('#modal-session').modal({backdrop: 'static', keyboard: false})
    $("#modal-session").modal("show");
}

function decrementar_counter(){
    if(n>0){
    setTimeout(function(){
        if(paused){
            n--;
            counter_modal.innerText = n;
            decrementar_counter();
        }
    },1000);
    }
    else{
        document.getElementById('close-button').click();
    }
}